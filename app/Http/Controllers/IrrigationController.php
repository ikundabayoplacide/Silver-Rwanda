<?php

namespace App\Http\Controllers;

use App\Models\DeviceData;
use Illuminate\Http\Request;
use Phpml\Regression\LeastSquares;

class IrrigationController extends Controller
{
    public function index()
    {
        // Get all device data
        $data_devices = DeviceData::all()->toArray();

        // Export data to CSV
        $data_devices_csv = $this->exportToCsv($data_devices);

        // Check if the file exists
        if (!$data_devices_csv) {
            return response()->json(['error' => 'data not found.'], 404);
        }

        // Read the CSV file
        $data = array_map('str_getcsv', file($data_devices_csv));

        // Remove the header row if it exists
        $header = array_shift($data);

        // Extract samples and targets
        $samples = [];
        $targets = [];

        foreach ($data as $row) {
            // Ensure the row has at least 6 columns
            if (count($row) < 6) {
                continue;
            }
            $samples[] = array_slice($row, 1, 4); // Get columns 1 to 4
            $targets[] = $row[5]; // Get column 5
        }

        // Train the Linear Regressor
        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        // Get the most recent data entry for prediction
        $latestData = end($data); // Get the last row from the dataset

        if (count($latestData) >= 5) {
            // Use columns 1 to 4 for input data
            $inputData = array_slice($latestData, 1, 4);

            // Predict irrigation amount for the most recent data
            $predictedIrrigation = $regression->predict($inputData);
        } else {
            // Handle cases where there isn't enough data
            return response()->json(['error' => 'Not enough data for prediction.'], 400);
        }

        // Pass the predicted irrigation amount and other data to the view
        return view('irrigation.index', [
            'predictedIrrigation' => $predictedIrrigation,
            'inputData' => $inputData,
            'samples' => $samples,
            'targets' => $targets,
        ]);
    }

    /**
     * Export data to a CSV file.
     *
     * @param array $data
     * @return string|bool The file path of the CSV file or false on failure
     */
    private function exportToCsv($data)
    {
        $fileName = 'device_data.csv';
        $filePath = storage_path('app/' . $fileName);

        // Open the file for writing
        $file = fopen($filePath, 'w');

        if ($file === false) {
            return false;
        }

        // Write the header (assuming each row has the same keys)
        if (!empty($data)) {
            fputcsv($file, array_keys($data[0]));
        }

        // Write each row to the CSV file
        foreach ($data as $row) {
            fputcsv($file, $row);
        }

        fclose($file);

        return $filePath;
    }
}
