<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator as PG;
use Illuminate\Pagination\LengthAwarePaginator;

class Paginator
{
    /**
     * @see https://gist.github.com/vluzrmos/3ce756322702331fdf2bf414fea27bcb
     */
    public static function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (PG::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
