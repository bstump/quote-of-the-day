<?php

namespace Tests\Unit;
use Tests\TestCase;

class QuoteSearchAPITest extends TestCase
{
    /**
     * A unit test to search quotes in the API.
     *
     * @return void
     */
    public function test_can_search_quotes()
    {
        $this->get('/api/quotes/search?q=a')
            ->assertStatus(200)
            ->assertJsonStructure([
                'quotes'
            ]);
    }
}
