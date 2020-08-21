<?php

namespace App;

use Illuminate\Foundation\Auth\User;
use App\Traits\WeeklyAndMonthlyScope;
use Illuminate\Database\Eloquent\Model;

class UserVisit extends Model
{
    use WeeklyAndMonthlyScope;

    protected $fillable = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
