<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'student',
            'email' => 'student@app.com',
            'role_id' => '1',
            'password' => bcrypt('123456'),
        ]);

        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john@app.com',
            'role_id' => '1',
            'password' => bcrypt('123456'),
        ]);

        DB::table('users')->insert([
            'name' => 'Jane Doe',
            'email' => 'jane@app.com',
            'role_id' => '1',
            'password' => bcrypt('123456'),
        ]);

        DB::table('users')->insert([
            'name' => 'staff',
            'email' => 'staff@app.com',
            'role_id' => '2',
            'password' => bcrypt('123456'),
        ]);

        DB::table('users')->insert([
            'name' => 'committee',
            'email' => 'committee@app.com',
            'role_id' => '3',
            'password' => bcrypt('123456'),
        ]);
    }
}
