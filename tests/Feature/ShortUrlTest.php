<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ShortUrl;


class ShortUrlTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_can_create_short_url()
    {
        $response = $this->postJson('/api/v1/short-urls', [
            'url' => 'https://example.com'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'short_url'
            ]);
    }    


}
