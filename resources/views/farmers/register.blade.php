<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">

        <h2>Farmer Registration</h2>
        <form action="{{ route('farmers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">District:</label>
                <input type="text" id="email" name="district" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Phone:</label>
                <input type="number" id="email" name="phone" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="confirm_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="device_id">Select Device:</label>
                <select id="device_id" name="device_id" class="form-control" required>
                    @foreach($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->id }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>
