@section('edittask')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <div>

        <div class="container mt-5">
            <h1 class="text-center">Edit Profile</h1>
            <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Back to Task List</a>

            <form method="POST" action="{{ route('updatedprofile', $user->id) }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
