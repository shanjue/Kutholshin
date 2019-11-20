<?php

use App\User;
use App\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'mgmg',
            'email' => 'mgmg@gmail.com',
            'password' => bcrypt('12345678'),
            'active' => 1
        ]);
        factory(App\User::class, 100)->create();
    }
}
