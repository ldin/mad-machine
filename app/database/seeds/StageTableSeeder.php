<?php

class StageTableSeeder extends Seeder {

    public function run()
    {
        $stage = array(
            array('name' => 'Предпосевная', 'slug'=>'seedbed'),
            array('name' => 'Посевная', 'slug'=>'sowing'),
            array('name' => 'Старт-ап', 'slug'=>'start_up'),
            array('name' => 'Ранний рост', 'slug'=>'early_growth'),
            array('name' => 'Расширение', 'slug'=>'expansion')
        );

        // Uncomment the below to run the seeder
        DB::table('stage')->insert($stage);
    }

}

//загрузить данные в бд:
//php artisan db:seed --class="StageTableSeeder"
