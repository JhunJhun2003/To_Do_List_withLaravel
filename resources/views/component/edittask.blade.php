@section('edittask')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div> 

    <div class="container mt-5">
    <h1 class="text-center">Edit Task</h1>
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Back to Task List</a>

    <form method="POST" action="{{ route('updatedtask', $todo->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Task Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $todo->title }}" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" id="done" name="done" class="form-check-input" value="1" {{ $todo->done ? 'checked' : '' }}>
            <label for="done" class="form-check-label">Done</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>