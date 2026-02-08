<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
     @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">

                        <h3 class="text-center mb-4">Login with OTP</h3>
                       
                        <form method="POST" action="{{ route('verifyotppost') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="{{ $email }}"
                                    readonly required placeholder="{{ $email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">OTP</label>
                                <input type="text" name="otp" class="form-control" placeholder="Enter your OTP">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Verify OTP
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
