<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        DB::table('users')->insert([
            'name' => 'timestart',
            'email' => 'test@gmail.com',
            'role' => 'admin',
            'confirmed' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            'password' => bcrypt('12345678'),
        ]);
    }

}
