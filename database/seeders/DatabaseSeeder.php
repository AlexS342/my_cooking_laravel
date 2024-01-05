<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Test User1',
             'email' => 'test1@example.com',
             'password' => Hash::make('123')
         ]);
        User::factory()->create([
            'name' => 'Test User2',
            'email' => 'test2@example.com',
            'password' => Hash::make('123')
        ]);

        $this->call([
            RecipeSeeder::class,
            ProductSeeder::class,
            ActionSeeder::class
        ]);

    }


}
