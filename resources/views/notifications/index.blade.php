@foreach ($notifications as $notification)
    <div>
        {{ $notification->data['user_name'] }} has registered.
    </div>
@endforeach
