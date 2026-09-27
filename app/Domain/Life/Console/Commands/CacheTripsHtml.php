<?php

namespace App\Domain\Life\Console\Commands;

use App\Console\Commands\Command;
use App\Domain\Life\Action\RenderTripMarkdownAction;
use App\Domain\Life\Models\Trip;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('app:trips-cache-html')]
#[Description('Rebuild cached trip HTML using the current Markdown rendering rules')]
class CacheTripsHtml extends Command
{
    public function handle(RenderTripMarkdownAction $renderTripMarkdown): int
    {
        $updated = 0;

        $trips = Trip::query()
            ->where('markdown', '<>', '')
            ->get(['id', 'markdown']);

        foreach ($trips as $trip) {
            $html = $renderTripMarkdown->execute($trip->markdown);

            $updated += Trip::query()
                ->whereKey($trip->id)
                ->toBase()
                ->update(['html' => $html]);
        }

        $this->info("Rebuilt cached HTML for {$updated} trips.");

        return self::SUCCESS;
    }
}
