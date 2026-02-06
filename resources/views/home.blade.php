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
        <h1 class="text-center">To Do Lists</h1>


        <form id="searchForm" action="{{ route('searchtitle') }}" method="POST">
            <div class="form-group">
                @csrf
                <input type="search" class="" name="search" placeholder="What are you searching for...">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            </form><br>
            <div class="text-center">
                <a href="{{ route('home') }}" class="btn btn-primary mb-3">Home</a>
                <a href="{{ route('addtask') }}" class="btn btn-primary mb-3">Add Task</a>
                <a href="{{ route('complete') }}" class="btn btn-primary mb-3">Completed Tasks</a>
                <a href="{{ route('pending') }}" class="btn btn-primary mb-3 ">Pending Tasks</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary mb-3">Logout</button>
                </form>
                {{-- <a href="{{ route('logout') }}" class="btn btn-primary mb-3 ">Logout</a> --}}
            </div>
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
                                <div class="form-check form-switch">
                                    <input class="form-check-input todo-toggle" type="checkbox" role="switch"
                                        id="todo-{{ $todo->id }}" data-todo-id="{{ $todo->id }}"
                                        {{ $todo->done ? 'checked' : '' }}>

                                    <label class="form-check-label" for="todo-{{ $todo->id }}">
                                        @if ($todo->done)
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </label>
                                </div>
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
<script>
    // document.querySelectorAll('.todo-toggle').forEach(toggle => {
    //     toggle.addEventListener('change', function() {
    //         const todoId = this.dataset.todoId;
    //         const label = this.nextElementSibling; // Targets the <label>
    //         const isChecked = this.checked;

    //         if (isChecked) {
    //             label.innerHTML = '<span class="badge bg-success">Completed</span>';
    //         } else {
    //             label.innerHTML = '<span class="badge bg-warning text-dark">Pending</span>';
    //         }
    //     });

    // });
    document.querySelectorAll('.todo-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const todoId = this.dataset.todoId;
            const label = this.nextElementSibling;

            // Send request to Laravel
            fetch(`/todos/${todoId}/toggle`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update UI based on the response from the database
                    if (data.done) {
                        label.innerHTML = '<span class="badge bg-success">Completed</span>';
                    } else {
                        label.innerHTML = '<span class="badge bg-warning text-dark">Pending</span>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Revert the toggle if something went wrong
                    this.checked = !this.checked;
                });
        });
    });
</script>

</html>
