<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@edu.com',
            'password' => bcrypt('admin123'), // تأكد من تغيير كلمة المرور في بيئة الإنتاج
            'role' => 'admin',
            'branch_id' => null,

        ]);
        User::factory()->create([
            'name' => 'Kosti Manager User',
            'email' => 'k-admin@edu.com',
            'password' => bcrypt('manager123'),
            'role' => 'manager',
            'branch_id' => null,
        ]);
        User::factory()->create([
            'name' => 'Madni Manager User',
            'email' => 'm-admin@edu.com',
            'password' => bcrypt('manager123'),
            'role' => 'manager',
            'branch_id' => null,
        ]);
        User::factory()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@edu.com',
            'password' => bcrypt('teacher123'),
            'role' => 'teacher',
            'branch_id' => null,
        ]);
    }
}
