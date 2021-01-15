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
        $quotes = config('quotes');
        $qotd_today = date('Ymd').'_qotd';
        $qotd_yesterday = date('Ymd', strtotime("-1 days")).'_qotd';
        $random_number = rand(0, (count($quotes['quotes'])-1));

        if (!Cache::get($qotd_today)) {
            Cache::put(
                $qotd_today,
                $quotes['quotes'][$random_number],
                strtotime('tomorrow') - time()
            );
            Cache::forget($qotd_yesterday);
        }

        return response()->json(
            Cache::get(
                $qotd_today
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
                    stripos($quote['quote'], $query) !== false ||
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
