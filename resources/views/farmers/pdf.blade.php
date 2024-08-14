<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer PDF</title>
</head>
<body>
    <h1>Farmers List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Farmer ID</th>
                <th>Farmer Name</th>
                <th>Farmer Email</th>
                <th>Farmer District</th>
                <th>Farmer Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $farmer)
                <tr>
                    <td>{{ $farmer->id }}</td>
                    <td>{{ $farmer->name }}</td>
                    <td>{{ $farmer->email }}</td>
                    <td>{{ $farmer->district }}</td>
                    <td>{{ $farmer->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
