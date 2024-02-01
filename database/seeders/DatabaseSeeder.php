<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserLevel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@test.com';
        $user->password = bcrypt(12345);
        $user->level = UserLevel::Admin->value;
        $user->save();

        User::factory(40)->create();
    }
}
