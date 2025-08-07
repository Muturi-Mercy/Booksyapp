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
        //  default admin account
        User::create([
            'name' => 'Admin',
            'email' => 'adminbooksy@gmail.com',
            'password' => Hash::make('booksycrud'), 
            'role' => 'admin',
        ]);

        

        echo "Admin account created:\n";
        echo "Email: adminbooksy@gmail.com\n";
        echo "Password: booksycrud\n";
    }
}
