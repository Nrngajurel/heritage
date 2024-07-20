<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $event = Event::create([
            'name'=> 'HERITAGE PAGEANTS 2024',
            'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'form_start_date'=> Carbon::now(),
            'form_end_date'=> Carbon::parse('2024-09-01')->endOfDay(),
            'voting_start_date'=> Carbon::parse('2024-09-25')->startOfDay(),
            'voting_end_date'=> Carbon::parse('2024-11-15')->endOfDay(),
        ]);

        $competitions = Competition::all();

        $event->competitions()->attach($competitions);
    }
}
