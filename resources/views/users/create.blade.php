<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Form</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Create New User</h2>
        <form action="{{Route('users.store')}}"  method="post">
            <!-- For Laravel CSRF token -->
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" required placeholder="Enter full name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="Enter email address">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Enter password">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Confirm password">
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
