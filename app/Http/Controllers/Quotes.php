<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class Quotes extends Controller
{
    /**
     * Construct function
     */
    public function __construct($new_quotes = []) {
        $this->setQuotes($new_quotes);
    }

    /**
     * Should return the entire array of quotes.
     */
    public function getQuotes() {
        return config('quotes');
    }

    /**
     * Replace the array of quotes.
     */
    public function setQuotes($quotes) {
        $get_quotes = config('quotes');
        $get_quotes['quotes'] = $quotes;
    
        $save_quotes = var_export($get_quotes, 1);
        File::put(config_path() . '/quotes.php', "<?php\n return $save_quotes ;");

        Artisan::call('cache:clear');
        Artisan::call('config:cache');
    }
}
