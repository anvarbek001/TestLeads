<?php

namespace Tests\Feature;

use App\Leads;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use RefreshDatabase;
    public function user_lead_test()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $lead = factory(Leads::class)->create([
            'user_id' => $user1->id,
            'full_name' => 'Lead One',
            'phone' => '998901234567',
        ]);

        $response = $this->actingAs($user2)->get(route('home', $lead->id));
        $response->assertStatus(403);
    }

    public function full_name_and_phone_test()
    {
        $user = factory(User::class)->create();

        $data = [
            'full_name' => '',
            'phone' => '',
            'status' => 'new',
        ];

        $response = $this->actingAs($user)
            ->post(route('leads.store'), $data);

        $response->assertSessionHasErrors(['full_name', 'phone']);

        $this->assertDatabaseMissing('leads', [
            'full_name' => '',
            'phone' => '',
        ]);
    }
}
