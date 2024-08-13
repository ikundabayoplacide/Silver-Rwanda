<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SSEController extends Controller
{
    public function stream()
    {
        // Set maximum execution time to 120 seconds
        ini_set('max_execution_time', 120); // 120 seconds = 2 minutes

        $response = new StreamedResponse(function () {
            $connection = DB::connection();

            $query = $connection->table('device_data')->select('*')->orderBy('id', 'desc');
            $lastId = 0;

            while (true) {
                $rows = $query->where('id', '>', $lastId)->get();
                if ($rows->isNotEmpty()) {
                    foreach ($rows as $row) {
                        echo "data: " . json_encode($row) . "\n\n";
                        ob_flush();
                        flush();
                        $lastId = $row->id;
                    }
                }
                sleep(10); // Delay before the next check
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }
}