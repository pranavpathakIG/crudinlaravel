<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background:#f8f9fa; }
    </style>
</head>
<body>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-sm w-100" style="max-width:420px;">
        <div class="card-body text-center">
            <h1 class="card-title mb-3">Login</h1>
            <p class="text-muted mb-4">Please login to continue.</p>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="d-grid gap-2">
                <a href="/loginuser" class="btn btn-primary btn-lg">Login</a>
            </div>

            <p class="mt-3 mb-0">
                New User ?
                <a href="/add">Registration</a>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
