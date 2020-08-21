<?php

namespace App;

use App\User;
use App\Traits\WeeklyAndMonthlyScope;
use Illuminate\Database\Eloquent\Model;

class UserView extends Model
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
