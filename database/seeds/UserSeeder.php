<?php

use App\Leads;
use App\Tasks;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Omar',
            'email' => 'Omar@gmail.com',
            'password' => Hash::make('password1'),
        ]);

        $user2 = User::create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('password2'),
        ]);

        $leads1 = factory(Leads::class, 10)->create([
            'user_id' => $user1->id,
        ]);

        $leads1->each(function ($lead) {
            factory(Tasks::class, 15)->create([
                'lead_id' => $lead->id,
            ]);
        });

        $leads2 = factory(Leads::class, 10)->create([
            'user_id' => $user2->id,
        ]);

        $leads2->each(function ($lead) {
            factory(Tasks::class, 15)->create([
                'lead_id' => $lead->id,
            ]);
        });
    }
}
