<h2>Register</h2>

<form method="POST" action="{{ route('registerpost') }}">
    @csrf

    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <input type="password" name="password_confirmation" placeholder="Confirm Password"><br><br>

    <button type="submit">Register</button>
</form>

<a href="/login">Already have an account?</a>
