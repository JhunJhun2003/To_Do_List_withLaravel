@section('addtask')
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container mt-5">
        <h1>Add New Task</h1>

        <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Back to Task List</a>

        <form method="POST" action="{{ route('storetask') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Task Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>
