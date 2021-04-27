<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'firstname' => 'Windelle John',
                'middlename' => 'Gajes',
                'lastname' => 'Vega',
                'email_address' => 'windellevega@gmail.com',
                'username' => 'windellevega',
                'password' => Hash::make('pass123'),
                'address' => 'Woodcrest Subdivision, Alimannao, Peñablanca, Cagayan',
                'current_long' => '121.764786',
                'current_lat' => '17.643702',
                'is_worker' => 0,
                'profile_picture_url' => 'assets/profile_pictures/windellevega.jpg',
                'mobile_number' => '09171234567'
            ],
            [
                'firstname' => 'Pauline Alexandra',
                'middlename' => 'Co',
                'lastname' => 'Espejo',
                'email_address' => 'apolita.f@gmail.com',
                'username' => 'apolita',
                'password' => Hash::make('pass123'),
                'address' => 'Caritan Highway, Tuguegarao City',
                'current_long' => '121.726320',
                'current_lat' => '17.618404',
                'is_worker' => 1,
                'profile_picture_url' => 'assets/profile_pictures/apolita.jpg',
                'mobile_number' => '09179876543'
            ]
        ];

        //DB::statement('SET FOREIGN_KEY_CHECKS=0');

        //DB::table('users')->truncate();

        User::insert($users);

        //DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
