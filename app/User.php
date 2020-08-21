<?php

namespace App;

use App\UserView;
use App\UserVisit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Helpers\Paginator;

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


    public static function addAViewToEveryone()
    {
        $query = "INSERT INTO user_views (user_id)
        SELECT id
        FROM `users`";

        return DB::statement($query);
    }


    public static function getByWeeklyVisits()
    {
        $query = "SELECT * FROM `users` u
            LEFT JOIN ( 
                SELECT user_id, COUNT(*) AS weekly_visits FROM `user_visits` uv GROUP BY user_id
            ) v ON (u.id = v.user_id)
        ORDER BY v.weekly_visits DESC";

        $query_results = DB::select($query);
        $results = [];

        foreach ($query_results as $result) {
            $results[] = new User((array) $result);
        }

        return Paginator::paginate($results);
    }
}
