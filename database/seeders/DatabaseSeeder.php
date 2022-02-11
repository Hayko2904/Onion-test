<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Onion\Domains\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
