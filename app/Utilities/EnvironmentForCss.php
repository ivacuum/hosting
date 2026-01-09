<?php

namespace App\Utilities;

class EnvironmentForCss implements \Stringable
{
    protected string $userAgent;

    public function __construct(string|null $userAgent)
    {
        $this->userAgent = mb_strtolower($userAgent ?? '');
    }

    public function __toString(): string
    {
        return implode(
            ' ',
            array_merge(
                $this->browserClasses(),
                $this->mobileOrDesktopClasses(),
                $this->operatingSystemClasses()
            )
        );
    }

    public function browserClasses(): array
    {
        if (preg_match('/msie|trident/', $this->userAgent) && !str_contains($this->userAgent, 'opera')) {
            return ['ie'];
        } elseif (str_contains($this->userAgent, 'edge')) {
            return ['edge'];
        } elseif (str_contains($this->userAgent, 'firefox')) {
            return ['firefox'];
        } elseif (str_contains($this->userAgent, 'safari') && !str_contains($this->userAgent, 'chrome')) {
            return ['safari'];
        } elseif (preg_match('/opera|opr/', $this->userAgent)) {
            return ['opera'];
        } elseif (str_contains($this->userAgent, 'chrome')) {
            return ['chrome'];
        }

        return [];
    }

    public function isCrawler(): bool
    {
        return preg_match('/(bot|crawler|google|spider)/i', $this->userAgent);
    }

    public function isMobile(): bool
    {
        return preg_match('/Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone|Opera Mini/i', $this->userAgent);
    }

    public function mobileOrDesktopClasses(): array
    {
        return $this->isMobile() ? ['is-mobile'] : ['is-desktop'];
    }

    public function operatingSystemClasses(): array
    {
        if (str_contains($this->userAgent, 'win')) {
            return ['windows'];
        } elseif (preg_match('/iphone|ipad|ipod/', $this->userAgent)) {
            return ['ios'];
        } elseif (str_contains($this->userAgent, 'mac')) {
            return ['macos'];
        } elseif (str_contains($this->userAgent, 'linux')) {
            return ['linux'];
        } elseif (str_contains($this->userAgent, 'android')) {
            return ['android'];
        }

        return [];
    }
}
