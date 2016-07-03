<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        DB::table('users')->delete();

        $users = array(
            ['name' => 'Luke Skywalker', 'email' => 'luke@gmail.com', 'password' => Hash::make('luke')],
            ['name' => 'Muremaru Ochikawaga', 'email' => 'japani_halar_put@gmail.com', 'password' => Hash::make('nippon')],
            ['name' => 'Gojira', 'email' => 'seriously@gmail.com', 'password' => Hash::make('g')],
            ['name' => 'Mohaiminul Islam', 'email' => 'mohaiminul.sust@gmail.com', 'password' => Hash::make('a')],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

        Model::reguard();
    }
}
