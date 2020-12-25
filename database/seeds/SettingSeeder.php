<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Settings seeder
        foreach (config('settings') as $item){
            DB::table('settings')
                ->insert(['key'=> $item['key'],'value' => $item['value'],'group'=>$item['group'] , 'description' => $item['description']]);
        }
        //end---mail settings

    }
}
