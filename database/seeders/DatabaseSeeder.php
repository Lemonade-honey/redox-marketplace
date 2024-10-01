<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Admin Aplication
        $superUser = User::create([
            'name' => 'Redox Market Owner',
            'email' => 'redox@market.laris',
            'email_verified_at' => now(),
            'password' => '123123',
            'role' => 'SUPERADMIN',
        ]);


        \App\Models\UserProfile::create([
            'user_id' => $superUser->id
        ]);

        if (\Illuminate\Support\Facades\App::isLocal()) {
            \App\Models\Master\Categorie::factory(5)->has(\App\Models\Master\Product::factory(5))->create();
        }
    }
}
