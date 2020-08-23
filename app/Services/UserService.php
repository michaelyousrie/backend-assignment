<?php

namespace App\Services;

use App\Helpers\Paginator;
use App\Jobs\AddViewToEveryUserJob;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected static $cachedResultsKey = "users_ordered_by_weekly_visits";

    public function getUsersByWeeklyVisits($request)
    {
        $page = $request->page ?: 1;
        $cacheKey = $this->makeCacheKeyFromPage($page);
        $cacheTime = env("USERS_CACHE_TIME", '20') * 60;

        if (!Cache::has($cacheKey)) {
            $results = User::getByWeeklyVisits();
            Cache::put($cacheKey, $results, $cacheTime);
        } else {
            $results = Cache::get($cacheKey);
        }

        return Paginator::make($results);
    }

    public function addViewToEveryUser()
    {
        return AddViewToEveryUserJob::dispatch();
    }

    protected function makeCacheKeyFromPage(int $page)
    {
        return self::$cachedResultsKey . "_page_{$page}";
    }
}
