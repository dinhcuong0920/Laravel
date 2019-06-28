<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->delete();
        $faker=Faker::create();
        for($i=1;$i<100;$i++){
        DB::table('user')->insert(
            ['email'=>$faker->email,'password'=>bcrypt('123456'),'full'=>$faker->name,'address'=>$faker->streetAddress,'phone'=>$faker->e164PhoneNumber,'level'=>rand(0,1)],
        );
        }
    }
}
