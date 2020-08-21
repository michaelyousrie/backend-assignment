<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserView;
use App\UserVisit;

class VisitsAndViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 50000)->create();

        foreach ($users as $user) {
            factory(UserView::class, 20)->create([
                'user_id'   => $user->id
            ]);

            factory(UserVisit::class, 20)->create([
                'user_id'   => $user->id
            ]);
        }
    }
}
