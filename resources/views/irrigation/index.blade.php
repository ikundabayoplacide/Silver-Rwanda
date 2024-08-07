<!DOCTYPE html>
<html>
<head>
    <title>Irrigation Prediction</title>
</head>
<body>
    <h1>Irrigation Prediction Result</h1>
    <p>Input Data: [{{ implode(', ', $inputData) }}]</p>
    <p>Predicted Irrigation Amount: {{ $predictedIrrigation }}</p>

    <h2>Training Data Samples</h2>
    <table border="1">
        <tr>
            <th>Soil Temperature</th>
            <th>Soil Humidity</th>
            <th>Air Temperature</th>
            <th>Air Humidity</th>
            <th>Irrigation Amount</th>
        </tr>
        @foreach ($samples as $index => $sample)
        <tr>
            <td>{{ $sample[0] }}</td>
            <td>{{ $sample[1] }}</td>
            <td>{{ $sample[2] }}</td>
            <td>{{ $sample[3] }}</td>
            <td>{{ $targets[$index] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
