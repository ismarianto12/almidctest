<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f8f9fa;
        }

        .register-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container register-container">
        <h2 class="text-center">Register</h2>
        <form>
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="tmlevel_id" class="form-label">TM Level ID</label>
                <input type="text" class="form-control" id="tmlevel_id" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role" required>
            </div>
            <div class="mb-3">
                <label for="created_at" class="form-label">Created At</label>
                <input type="datetime-local" class="form-control" id="created_at" required>
            </div>
            <div class="mb-3">
                <label for="statuslogin" class="form-label">Status Login</label>
                <input type="text" class="form-control" id="statuslogin" required>
            </div>
            <div class="mb-3">
                <label for="token" class="form-label">Token</label>
                <input type="text" class="form-control" id="token" required>
            </div>
            <div class="mb-3">
                <label for="updated_at" class="form-label">Updated At</label>
                <input type="datetime-local" class="form-control" id="updated_at" required>
            </div>
            <div class="mb-3">
                <label for="id_user" class="form-label">ID User</label>
                <input type="text" class="form-control" id="id_user" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
