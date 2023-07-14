<?php

namespace App\Http\Middleware;

use App\Action\GetModelBreadcrumbAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AcpNavigation
{
    public function __construct(private GetModelBreadcrumbAction $getModelBreadcrumb)
    {
    }

    public function handle(Request $request, \Closure $next)
    {
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        str($request->route()->uri)
            ->explode('/')
            ->reduce(function ($carry, $part) use ($request) {
                $carry = trim("{$carry}/{$part}", '/');

                if (str_starts_with($part, '{')) {
                    $this->pushModel($carry, $request->route($this->trimCurlyBraces($part)));
                }

                $level = str($carry)->substrCount('/') + 1;

                // Разделы вроде `acp/cities`
                if ($level === 2) {
                    $this->pushUrlBased($carry);
                }

                // Страницы вроде `acp/cities/create`
                if ($level === 3) {
                    match ($part) {
                        'create' => $this->push(str($carry)->replace('/', '.')->value(), $carry),
                        default => null,
                    };
                }

                // Страны вроде `acp/cities/{city}/edit`
                if ($level === 4) {
                    match ($part) {
                        'edit' => $this->push($this->transKeyFromRouteWithoutModel($carry), $carry),
                        default => null,
                    };
                }

                match ($carry) {
                    'acp' => $this->pushUrlBased($carry),
                    'acp/domains/{domain}/mail' => $this->push('acp.domains.mailboxes', $carry),
                    default => null,
                };

                return $carry;
            });

        return $next($request);
    }

    private function push(string $text, string $url = null)
    {
        \Breadcrumbs::push(__($text), trim($url, '/'));
    }

    // acp/cities/{city}/edit => acp.cities.edit
    private function transKeyFromRouteWithoutModel(string $carry): string
    {
        return str($carry)
            ->explode('/')
            ->reject(fn ($dir) => str($dir)->startsWith('{'))
            ->implode('.');
    }

    private function pushModel(string $route, $model)
    {
        if (!$model instanceof Model) {
            return;
        }

        \Breadcrumbs::push(
            $this->getModelBreadcrumb->execute($model),
            trim(to($route, $model), '/')
        );
    }

    private function pushUrlBased(string $url)
    {
        $transKey = str($url)
            ->replace('/', '.')
            ->append('.index')
            ->value();

        if ($transKey !== $trans = __($transKey)) {
            \Breadcrumbs::push($trans, $url);
        }
    }

    private function trimCurlyBraces(string $text): string
    {
        return trim($text, '{}');
    }
}
