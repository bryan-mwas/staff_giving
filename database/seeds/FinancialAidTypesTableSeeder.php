<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 8/8/2017
 * Time: 5:19 PM
 */
use Illuminate\Database\Seeder;

class FinancialAidTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('financial_aid_types')->insert([
            'name' => 'fees',
            'amount' => '50000',
            'months_valid' => '3'
        ]);

        DB::table('financial_aid_types')->insert([
            'name' => 'stipend',
            'amount' => '6000',
            'months_valid' => '3'
        ]);

        DB::table('financial_aid_types')->insert([
            'name' => 'accommodation',
            'amount' => null,
            'months_valid' => '3'
        ]);

        DB::table('application_types')->insert([
            'name' => 'helb'
        ]);

        DB::table('application_types')->insert([
            'name' => 'crb'
        ]);

        DB::table('application_types')->insert([
            'name' => 'workstudy'
        ]);
    }
}