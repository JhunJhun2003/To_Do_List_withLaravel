@section('addtask?')
<div>
    <h1>Add New Task</h1>
    <form method="POST" action="{{ route('storetask') }}">
        @csrf
        <div>
            <label for="title">Task Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <button type="submit">Add Task</button>
    </form>
</div>