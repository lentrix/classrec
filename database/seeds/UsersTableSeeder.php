<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'lentrix',
            'email' => 'benjielenteria@yahoo.com',
            'lname' => 'Lenteria',
            'fname' => 'Benjie',
            'role' => 'teacher',
            'password' => bcrypt('system32'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'username' => 'benjie',
            'email' => 'hawkmanlentrix@gmail.com',
            'idnum' => '001683',
            'lname' => 'Lenteria',
            'fname' => 'Benjie',
            'role' => 'student',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'username' => 'stud1',
            'email' => 'student@email.com',
            'idnum' => '010239',
            'lname' => 'Student',
            'fname' => 'Sample',
            'role' => 'student',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
    }
}
