<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Torrent
 */
class Torrent extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'html' => $this->html,
            'size' => \ViewHelper::size($this->size),
            'title' => $this->title,
            'views' => $this->views,
            'clicks' => $this->clicks,
            'magnet' => $this->magnet(),
            'title_tags' => $this->titleTags(),
            'category_id' => $this->category_id,
            'external_link' => $this->externalLink(),
            'registered_at' => $this->fullDate(),

            'related' => $this->when($this->related_query, fn () => new TorrentCollection($this->relatedTorrents())),
            // 'comments' => $this->relationLoaded('comments') ? Comment::collection($this->comments) : null,
            'comments' => $this->whenLoaded('comments', Comment::collection($this->comments), null),
        ];
    }
}
