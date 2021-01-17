<?php

namespace Tests\Unit;
use Tests\TestCase;

class QuoteOfTheDayAPITest extends TestCase
{
    /**
     * A unit test to retrieve a random quote from the API service.
     *
     * @return void
     */
    public function test_can_get_quote_of_the_day()
    {
        $this->get('/api/quotes/quotd')
            ->assertStatus(200)
            ->assertJsonStructure([
                'text',
                'author'
            ]);
    }

    /**
     * A unit test to retrieve a random quote from the API service.
     *
     * @return void
     */
    public function test_can_get_quote_of_the_day_with_date()
    {
        $this->get('/api/quotes/quotd?d='.date('Y-m-d'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'text',
                'author'
            ]);
    }
}
