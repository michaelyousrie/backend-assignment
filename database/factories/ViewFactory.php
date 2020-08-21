<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\UserView;
use Faker\Generator as Faker;

$factory->define(UserView::class, function (Faker $faker) {
    return [
        'user_id'   => 1
    ];
});
