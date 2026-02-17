<?php

namespace Database\Seeders;

use App\Models\Resister;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResisterSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Sujan',
                'surname' => 'Thapa',
                'mobile' => '9845678901',
                'DOB' => '2000-01-01',
                'email' => 'sujan1@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Ramesh',
                'surname' => 'Sharma',
                'mobile' => '9845678902',
                'DOB' => '1999-05-12',
                'email' => 'ramesh@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Amit',
                'surname' => 'Verma',
                'mobile' => '9845678903',
                'DOB' => '1998-08-20',
                'email' => 'amit@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Priya',
                'surname' => 'Singh',
                'mobile' => '9845678904',
                'DOB' => '2001-02-14',
                'email' => 'priya@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Neha',
                'surname' => 'Patel',
                'mobile' => '9845678905',
                'DOB' => '1997-11-30',
                'email' => 'neha@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Rahul',
                'surname' => 'Gupta',
                'mobile' => '9845678906',
                'DOB' => '1996-06-18',
                'email' => 'rahul@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Anjali',
                'surname' => 'Mehta',
                'mobile' => '9845678907',
                'DOB' => '2002-03-09',
                'email' => 'anjali@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Vikas',
                'surname' => 'Yadav',
                'mobile' => '9845678908',
                'DOB' => '1995-12-25',
                'email' => 'vikas@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Pooja',
                'surname' => 'Joshi',
                'mobile' => '9845678909',
                'DOB' => '1999-09-15',
                'email' => 'pooja@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Karan',
                'surname' => 'Malhotra',
                'mobile' => '9845678910',
                'DOB' => '1998-04-04',
                'email' => 'karan@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name'=> 'aatish',
                'surname' => 'kapoor',
                'mobile' => '9845678911',
                'DOB' => '2000-07-22',
                'email' => 'aatish@gmail.com',
                'password' => Hash::make('password123'),
            ],
        ];

        Resister::insert($data); 
    }
}
