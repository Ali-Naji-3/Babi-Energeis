<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@babienergies.com',
            'password' => Hash::make('password'),
            'phone' => '+1 (555) 123-4567',
            'address' => '123 Admin Street, Eco City',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Sample Customers
        $customers = [
            [
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'phone' => '+1 (555) 111-1111',
                'address' => '123 Green Street, Eco City',
                'role' => 'customer',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'password' => Hash::make('password'),
                'phone' => '+1 (555) 222-2222',
                'address' => '456 Solar Avenue, Green Town',
                'role' => 'customer',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Mike Wilson',
                'email' => 'mike@example.com',
                'password' => Hash::make('password'),
                'phone' => '+1 (555) 333-3333',
                'address' => '789 Renewable Road, Clean City',
                'role' => 'customer',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($customers as $customer) {
            User::create($customer);
        }
    }
}