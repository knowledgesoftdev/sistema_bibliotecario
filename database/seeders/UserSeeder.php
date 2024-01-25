<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('admin')
        ]);

        $admin->assignRole('admin');

        $student=User::create([
            'name'=>'student',
            'email'=>'student@admin.com',
            'password'=>Hash::make('student')
        ]);

        $student->assignRole('student');
    }
}
