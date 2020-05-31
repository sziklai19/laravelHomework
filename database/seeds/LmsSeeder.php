<?php

use App\Subject;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 15; ++$i)
        {
            DB::table('users')->insert([
                'name' => 'Tanár '.$i,
                'email' => 'tanar'.$i.'@gmail.com',
                'password' => Hash::make('password'),
                'teacher' => 1,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        for ($i = 1; $i <= 30; ++$i)
        {
            DB::table('users')->insert([
                'name' => 'Diák '.$i,
                'email' => 'diak'.$i.'@gmail.com',
                'password' => Hash::make('password'),
                'teacher' => 0,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        for ($i = 1; $i <= 50; ++$i)
        {
            $ids = User::where('teacher', true)->get();

            DB::table('subjects')->insert([
                'name' => 'Tárgy '.$i,
                'desc' => 'Tárgy '.$i.' leírása.',
                'code' => 'IK-'.chr(rand(65, 90)).chr(rand(65, 90)).chr(rand(65, 90)).rand(0, 9).rand(0, 9).rand(0, 9),
                'value' => rand(2,8),
                'public' => rand(0, 1),
                'teacher' => $ids[rand(0,count($ids)-1)]->id,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        $stud = User::where('teacher', false)->get();
        $sub = Subject::where('public', true)->get();

        for ($i = 1; $i <= 100; ++$i)
        {
            DB::table('connections')->insert([
                'student' => $stud[($i % (count($stud) - 1)) + 1]->id,
                'subject' => $sub[($i % (count($sub) - 1)) + 1]->id,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
        
        

        for ($i = 1; $i <= 100; ++$i){
            $month = rand(1, 12);
            $day = rand(1, 30);
            $hour = rand(0, 23);
            $min = rand(0, 59);
            $m = rand($month, 12);
            $d = rand($day, 30);
            $h = rand($hour, 23);
            $mi = rand($min, 59);
            
            DB::table('assignments')->insert([
                'name' => 'Feladat '.$i,
                'desc' => 'Feladat '.$i.' leírása.',
                'value' => rand(0, 100),
                'deadline_from' => '2020-'.
                    ($month > 9 ? $month : '0'.$month).'-'.
                    ($day > 9 ? $day : '0'.$day).' '.
                    ($hour > 9 ? $hour : '0'.$hour).':'.
                    ($min > 9 ? $min : '0'.$min),
                'deadline_to' => '2020-'.
                    ($m > 9 ? $m : '0'.$m).'-'.
                    ($d > 9 ? $d : '0'.$d).' '.
                    ($h > 9 ? $h : '0'.$h).':'.
                    ($mi > 9 ? $mi : '0'.$mi),
                'subject' => $sub[($i % (count($sub) - 1)) + 1]->id,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
