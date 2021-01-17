<?php

namespace Tests\Unit;
use Tests\TestCase;

class RandomQuoteAPI extends TestCase
{
    /**
     * A unit test to retrieve a random quote from the API service.
     *
     * @return void
     */
    public function test_can_get_random_quote()
    {
        $this->get('/api/quotes/random')
            ->assertStatus(200)
            ->assertJsonStructure([
                'text',
                'author'
            ]);
    }
}
