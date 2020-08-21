<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\UserVisit;
use Faker\Generator as Faker;

$factory->define(UserVisit::class, function (Faker $faker) {
    return [
        'user_id'   => 1
    ];
});
