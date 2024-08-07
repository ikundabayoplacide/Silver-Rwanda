<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Data PDF</title>
</head>
<body>
    <h1>Device Data</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Device ID</th>
                <th>Sensor Temperature</th>
                <th>Sensor Humidity</th>
                <th>Ambient Temperature</th>
                <th>Ambient Humidity</th>
                <th>Prediction Irrigation Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $device_data)
                <tr>
                    <td>{{ $device_data->DEVICE_ID }}</td>
                    <td>{{ $device_data->S_TEMP }}</td>
                    <td>{{ $device_data->S_HUM }}</td>
                    <td>{{ $device_data->A_TEMP }}</td>
                    <td>{{ $device_data->A_HUM }}</td>
                    <td>{{ $device_data->PRED_AMOUNT }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
