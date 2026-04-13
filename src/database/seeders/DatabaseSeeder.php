<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { {
            User::create([
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@test.com',
                'password' => Hash::make('password'),
            ]);

            $this->call([
                SeasonSeeder::class,
                ProductSeeder::class,
            ]);
        }
    }
}
