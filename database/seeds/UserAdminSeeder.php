<?php

use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = str_random(10);

        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt($pass),
            'api_token' => str_random(59),
            'uren_min' => 0,
            'uren_max' => 0,
            'user_level' => 5,
        ]);

        echo "User admin added with password: " . $pass . "\r\n";
    }
}
