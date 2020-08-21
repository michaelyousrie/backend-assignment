<?php

use App\User;
use App\UserView;
use App\UserVisit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Truncater extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        UserView::truncate();
        UserVisit::truncate();
        User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
