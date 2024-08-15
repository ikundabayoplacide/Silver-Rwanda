<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SSEController extends Controller
{
    public function stream()
{
    // Set maximum execution time to 60 seconds
    ini_set('max_execution_time', 5); // 60 seconds

    $response = new StreamedResponse(function () {
        $connection = DB::connection();

        // Get the last id from the cache, or default to 0
        $lastId = cache()->get('last_device_data_id', 0);

        while (true) {
            $rows = $connection->table('device_data')
                ->where('id', '>', $lastId)
                ->orderBy('id', 'asc')
                ->limit(10)
                ->get();

            if ($rows->isNotEmpty()) {
                foreach ($rows as $row) {
                    echo "data: " . json_encode($row) . "\n\n";
                    ob_flush();
                    flush();
                    $lastId = $row->id;

                    // Store the last id in the cache
                    cache()->put('last_device_data_id', $lastId);
                }
            }

            sleep(5); // Delay before the next check, adjusted to reduce load
        }
    });

    $response->headers->set('Content-Type', 'text/event-stream');
    $response->headers->set('Cache-Control', 'no-cache');
    $response->headers->set('Connection', 'keep-alive');

    return $response;
}

}