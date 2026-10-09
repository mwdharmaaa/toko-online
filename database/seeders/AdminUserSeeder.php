<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@monoarchive.id'],
            [
                'name' => 'Mono Archive Administrator',
                'password' => Hash::make('admin12345'),
                'is_admin' => true,
            ]
        );
    }
}
