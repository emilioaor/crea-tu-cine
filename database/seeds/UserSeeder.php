<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Cinema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->user = 'emilioaor';
        $user->email = 'emilioaor@gmail.com';
        $user->status = User::STATUS_ACTIVE;
        $user->level = User::LEVEL_USER;
        $user->password = bcrypt('emi21029522lio');
        $user->save();

        $cine = new Cinema();
        $cine->name = 'Cine en Casa';
        $cine->status = Cinema::STATUS_ACTIVE;
        $cine->image = Cinema::IMAGE_DEFAULT;
        $cine->user_id = $user->id;
        $cine->save();

        $cine->addDefaultStyles();
    }
}
