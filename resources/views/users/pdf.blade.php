<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        /* Add your PDF styles here */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>User List</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $info)
                <tr>
                    <td>{{ $info->name }}</td>
                    <td>{{ $info->email }}</td>
                    <td>{{ $info->address }}</td>
                    <td>{{ $info->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
