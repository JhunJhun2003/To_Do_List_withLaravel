<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with OTP</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">

                        <h3 class="text-center mb-4">Login with OTP</h3>

                        <form method="POST" action="{{ route('loginwithotppost') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Enter your email">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Send OTP
                                </button>
                            </div>
                        </form>
                        <p class="text-center mt-3">
                            Don’t have an account?
                            <a href="/register">Create account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
