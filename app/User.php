<?php

namespace App;

use App\UserView;
use App\UserVisit;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function visits()
    {
        return $this->hasMany(UserVisit::class);
    }


    public function views()
    {
        return $this->hasMany(UserView::class);
    }


    public function addVisit()
    {
        return $this->visits()->create([
            'user_id'   => $this->id
        ]);
    }


    public function addView()
    {
        return $this->views()->create([
            'user_id'       => $this->id
        ]);
    }

    public static function getByWeeklyVisits()
    {
        $select = DB::table('user_visits')
            ->select('user_id', DB::raw("COUNT(*) AS weekly_visits"))
            ->groupBy("user_id");

        $results = DB::table('users')
            ->leftJoinSub($select, 'user_visits', function ($join) {
                $join->on('user_visits.user_id', '=', 'users.id');
            })
            ->orderBy('weekly_visits', 'desc')
            ->get();

        return $results;
    }
}
