<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToShowAction;
use App\Image;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class ImagesController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Image::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new Image);

        $type = request('type');
        $year = request('year');
        $touch = request('touch');
        $userId = request('user_id');
        $imageSize = request('image_size');

        $models = Image::query()
            ->when($year, fn (Builder $query) => $query->whereYear('created_at', $year))
            ->when($touch, fn (Builder $query) => $query->whereYear('updated_at', now()->subYears($touch)->year))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->when(\App::isProduction(), fn (Builder $query) => $query->where('views', '<', 3000)->where('user_id', '<>', 1))
            ->orderBy(match ($sort->key) {
                'size',
                'views',
                'updated_at' => $sort->key,
                default => 'id',
            }, $sort->direction->value)
            ->paginate(111);

        return view('acp.images.index', [
            'type' => $type,
            'year' => $year,
            'touch' => $touch,
            'models' => $models,
            'user_id' => $userId,
            'imageSize' => $imageSize,
        ]);
    }

    public function batch()
    {
        $ids = request('ids', []);
        $action = request('action');

        $images = Image::query()->find($ids);

        foreach ($images as $image) {
            /** @var Image $image */
            if ($action === 'delete') {
                $image->deleteOrFail();
            }
        }

        return [
            'status' => 'OK',
            'redirect' => request()->header('referer'),
        ];
    }

    public function destroy(Image $image)
    {
        $image->deleteOrFail();

        return [
            'status' => 'OK',
            'redirect' => request()->header('referer'),
        ];
    }

    public function show(Image $image, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($image);
    }

    public function view(Image $image)
    {
        $image->views++;
        $image->save();

        return back();
    }
}
