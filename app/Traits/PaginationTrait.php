<?php

namespace App\Traits;

trait PaginationTrait
{

    public function PaginationInformation($obj)
    {
        $Pagination = [
            "meta" => [
                "current_page" => $obj->currentPage(),
                "last_page" => $obj->lastPage(),
                "per_page" => $obj->perPage(),
                "total" =>  $obj->total(),
            ],
            "links" => [
                "page_url" => $obj->url($obj->currentPage()),
                "next_page_url" => $obj->nextPageUrl(),
                "prv_page_url" => $obj->previousPageUrl(),
                "last_page_url" => $obj->url($obj->lastPage())
            ]
        ];
        return $Pagination;
    }
}
