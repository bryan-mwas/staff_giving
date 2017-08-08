<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 8/8/2017
 * Time: 5:19 PM
 */
use Illuminate\Database\Seeder;

class AidTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_types')->insert([
            'name' => 'fees',
            'amount' => '50000',
            'months_valid' => '3'
        ]);

        DB::table('aid_types')->insert([
            'name' => 'stipend',
            'amount' => '6000',
            'months_valid' => '3'
        ]);
    }
}