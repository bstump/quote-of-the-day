<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Quotes;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $get_quotes = Http::get('https://type.fit/api/quotes');
        $quotes = json_decode($get_quotes->body(), true);
        $assign_quotes = new Quotes(array_slice($quotes, 0, 40));
    }
}
