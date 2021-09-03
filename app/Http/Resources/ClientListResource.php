<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientListResource extends JsonResource
{
    private Paginator $paginator;

    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function toArray($request): array
    {
        return [
            'data' => ClientResource::collection($this->paginator->collect()),
            'links' => [
                'path' => $this->paginator->path(),
                'firstPageUrl' => $this->getPageUrl(1),
                'lastPageUrl' => $this->getPageUrl($this->paginator->lastPage()),
                'nextPageUrl' => $this->paginator->nextPageUrl(),
                'prevPageUrl' => $this->paginator->previousPageUrl(),
            ],
            'meta' => [
                'currentPage' => $this->paginator->currentPage(),
                'from' => $this->paginator->firstItem(),
                'lastPage' => $this->paginator->lastPage(),
                'perPage' => $this->paginator->perPage(),
                'to' => $this->paginator->lastItem(),
                'total' => $this->paginator->total(),
                'count' => $this->paginator->count(),
            ],
        ];
    }

    private function getPageUrl(int $page): string
    {
        return sprintf('%s?page=%d', $this->paginator->path(), $page);
    }
}
