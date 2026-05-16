<h1>Realtime Chat App</h1>

<hr>

<h3>Daftar User</h3>

@foreach ($users as $user)
    <p>{{ $user->name }}</p>
@endforeach

<hr>

<h3>Messages</h3>

@foreach ($messages as $message)
    <p>{{ $message->message }}</p>
@endforeach