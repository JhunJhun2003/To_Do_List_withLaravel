<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
    <h1 class="text-center">Task Lists</h1>

    <a href="{{ route('addtask') }}" class="btn btn-primary mb-3">Add Task</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>no</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
                <tr>
                    <td>{{ ($todos->currentPage() - 1) * $todos->perPage() + $loop->iteration }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>
                        @if ($todo->done)
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('edittask', $todo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('deletetask', $todo->id) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $todos->links() }}
    </div>
</div>


    @yield('addtask')
    @yield('edittask')

</body>

</html>