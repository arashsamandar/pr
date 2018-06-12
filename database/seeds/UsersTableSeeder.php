<?php

use Illuminate\Database\Seeder;
use App\User as User;
use Hekmatinasser\Verta\Verta as Verta;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
//        date_default_timezone_set('Asia/Tehran');
//
//        $datetime = new DateTime('2008-08-03 12:35:23');
//        echo $datetime->format('Y-m-d H:i:s') . "\n";
//        $la_time = new DateTimeZone('Asia/Tehran');
//        $datetime->setTimezone($la_time);
//        $datetime->format('Y-m-d H:i:s');
//
//        \DB::table('logs')->delete();
//        Logs::create([
//            'logDate' => $datetime,
//            'logTime' => $datetime,
//            'logCode' => '001',
//            'user_id' => '1'
//        ]);

        $v = new Verta();
        $time = $v->formatTime();
        $date = $v->formatDate();



        \DB::table('users')->delete();
        User::create([
            'name' => 'arash',
            'family' => 'aghashahee',
            'username' => 'samandar',
            'email' => 'arash.in@yahoo.com',
            'password' => bcrypt('samadnar'),
            'date_shamsi' => $date
        ]);

        User::create([
            'name' => 'mohamad',
            'family' => 'khalaji',
            'username' => 'arman',
            'email' => 'amir.in@yahoo.com',
            'password' => bcrypt('agoodman'),
            'date_shamsi' => $date
        ]);

        User::create([
            'name' => 'cimin',
            'family' => 'kalantary',
            'username' => 'moonlight',
            'email' => 'cimin.in@yahoo.com',
            'password' => bcrypt('goodwoman'),
            'date_shamsi' => $date
        ]);
    }
}
