<?php

namespace App\Http\Resources\V2\Version;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VersionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            env('APP_NAME') => 'version',
            'api_latest' => 'v' . config('app.api_latest'),
            'api_current' => 'v' . config('app.api_version'),
            'results' => $this->collection,
            // 'meta' => [
            //     'current_page' => $this->currentPage(),
            //     'total' => $this->total(),
            //     'per_page' => $this->perPage() === 999999999 ? 0 : $this->perPage(),
            //     'count' => $this->count(),
            //     'total_pages' => $this->lastPage(),
            // ],
            // 'links' => [
            //     'next' => $this->nextPageUrl() ?? '',
            //     'prev' => $this->previousPageUrl() ?? '',
            // ],
        ];
    }
}
