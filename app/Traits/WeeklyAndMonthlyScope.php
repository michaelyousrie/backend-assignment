<?php

namespace App\Traits;

use Carbon\Carbon;

trait WeeklyAndMonthlyScope
{
    public function scopeWeekly($query)
    {
        return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }


    public function scopeMonthly($query)
    {
        return $query->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
    }
}
