<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostcardControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {

        $user = User::factory()->create();
        $this->be($user)->post(route('postcards.store'), [
            'recipient_name' => 'John Doe',
            'street_1' => '123 Main St',
            'city' => 'Anytown',
            'message' => 'Some message',
            'state' => 'CA',
            'zip_code' => '12345',
        ])->assertSessionHasNoErrors();

        $this->assertDatabaseCount('postcards', 1);
    }
}
