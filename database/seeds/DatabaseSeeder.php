<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create(['role' => 'admin' , 'email' => 'admin@example.com']);
        factory(\App\User::class)->create(['role' => 'agent' , 'email' => 'agent@example.com']);

        factory(\App\Models\TicketCategory::class)->create();
        factory(\App\Models\TicketCategory::class)->create();

        factory(\App\Models\Priority::class , 5)->create();
        factory(\App\Models\Faq::class , 20)->create();

        $this->call([
            SettingSeeder::class,
        ]);

    }
}
