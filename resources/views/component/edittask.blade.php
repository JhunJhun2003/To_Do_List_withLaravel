@section('edittask')
<div>
    <h1>Edit Task</h1><br>
    back to <a href="{{ route('home') }}">Task List</a><br><br>
    <form method="POST" action="{{ route('updatedtask', $todo->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Task Title:</label>
            <input type="text" id="title" name="title" value="{{ $todo->title }}" required>
            <label for="done">done</label>
            <input type="checkbox" id="done" name="done" value="1" {{ $todo->done ? 'checked' : '' }}>
        </div>
        <button type="submit">Update Task</button>
    </form>
    </div>