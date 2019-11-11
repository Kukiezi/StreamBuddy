<?php

use App\Counter;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counter = new Counter();
        $counter->name = 'youtube';
        $counter->counter = 0;
        $counter->save();
    }
}