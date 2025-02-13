<?php

namespace Tests\Feature;

use App\Models\Postcard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostcardTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_postcard(): void
    {
        $postcard_data = [
            'recipient_name' => 'John Doe',
            'street_1' => '123 Main St',
            'street_2' => 'Apt 4B',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
            'message' => 'Hello from NYC!',
            'filename' => 'test-image.jpg',
        ];

        $postcard = Postcard::create($postcard_data);

        $this->assertDatabaseHas('postcards', $postcard_data);
        $this->assertEquals('John Doe', $postcard->recipient_name);
    }

    public function test_can_create_postcard_without_street_2(): void
    {
        $postcard_data = [
            'recipient_name' => 'Jane Doe',
            'street_1' => '456 Oak Ave',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'zip_code' => '90001',
            'message' => 'Greetings from LA!',
            'filename' => 'la-photo.jpg',
        ];

        $postcard = Postcard::create($postcard_data);

        $this->assertDatabaseHas('postcards', $postcard_data);
        $this->assertNull($postcard->street_2);
    }

    public function test_factory_creates_valid_postcard(): void
    {
        $postcard = Postcard::factory()->create();

        $this->assertNotNull($postcard->recipient_name);
        $this->assertNotNull($postcard->street_1);
        $this->assertNotNull($postcard->city);
        $this->assertNotNull($postcard->state);
        $this->assertNotNull($postcard->zip_code);
        $this->assertNotNull($postcard->message);
        $this->assertNotNull($postcard->filename);
    }
}
