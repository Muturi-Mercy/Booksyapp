<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // Default admin account
    User::updateOrCreate(
        ['email' => 'adminbooksy@gmail.com'], 
        [
            'name' => 'Admin',
            'password' => Hash::make('booksycrud'), 
            'role' => 'admin',
        ]
    );

    echo "Admin account ensured:\n";
    echo "Email: adminbooksy@gmail.com\n";
    echo "Password: booksycrud\n";
    }
}
