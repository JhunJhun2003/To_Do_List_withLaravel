<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div>
        <h1>Task List</h1>
        <button><a href="{{ route('addtask') }}">Add Task</a></button>
        <ul>
            @foreach ($todos as $todo)
                <li>
                    <strong>{{ $todo->title }}</strong> - 
                    @if ($todo->done)
                        Completed
                    @else
                        Pending
                    @endif

                    <button><a href="{{ route('edittask', $todo->id) }}">Edit</a></button>
                </li>
            @endforeach
        </ul>
    </div>
    @yield('addtask')
    @yield('edittask')
</body>
</html>