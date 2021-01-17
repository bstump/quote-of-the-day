<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class QuoteController extends Controller
{
    /**
     * Return the quote of the day
     */
    public function quotd() {
        $requested_date = (request()->has('d')) ? request()->input('d').'_qotd' : date('Y-m-d').'_qotd';
        $quotes = config('quotes');
        $random_number = rand(0, (count($quotes['quotes'])-1));

        if (!Cache::get($requested_date)) {
            Cache::put(
                $requested_date,
                $quotes['quotes'][$random_number],
                strtotime('tomorrow') - time()
            );
        }

        return response()->json(
            Cache::get(
                $requested_date
            )
        );
    }

    /**
     * Return a random quote
     */
    public function random() {
        $quotes = config('quotes');

        $random_number = rand(0, (count($quotes['quotes'])-1));

        return response()->json(
            $quotes['quotes'][$random_number]
        );
    }

    /**
     * Search quotes
     */
    public function search() {
        $quotes = config('quotes');
        $return_quotes = [];
        $query = (request()->has('q')) ? request()->input('q') : null;

        if ($query) {
            foreach($quotes['quotes'] as $quote) {
                if (
                    stripos($quote['text'], $query) !== false ||
                    stripos($quote['author'], $query) !== false
                ) {
                    $return_quotes[] = $quote;
                }
            }

            return response()->json(
                $return_quotes
            );
        }

        return response()->json(
            $quotes['quotes']
        );
    }
}
