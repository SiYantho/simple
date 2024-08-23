<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("/asset/background.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .bg-white-transparent {
            background-color: rgba(255, 255, 255, 0.7);
            /* White color with 50% opacity */
        }

        .position-relative {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body class= "me-0 overflow-hidden">
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <form class="bg-white-transparent border border-dark rounded shadow p-5 d-flex flex-column align-items-center"
            method="POST" action="{{ route('login') }}">
            @csrf
            <h2 class="mb-4">Login</h2>
            <div class="mb-3">
                <center><label for="username" class="form-label">username</label></center>
                <input type="username" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3 position-relative">
                <center><label for="password" class="form-label">Password</label></center>
                <div class="d-flex">
                <input type="password" class="form-control" id="password" name="password" required >
                <span class="eye-icon mt-3" onclick="togglePasswordVisibility()">
                    <i id="eye-icon" class="fa-solid fa-eye"></i>
                </span>

            </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @if(session('status'))
    <script>
        alert("{{ session('status') }}");
    </script>
    @endif
    @if($errors->any())
    <script>
        alert("{{ $errors->first() }}");
    </script>
    @endif

    <div class="d-flex justify-content-center ">
        <p class="text-light">Sistem monitoring<a href="https://www..co.id" class="text-light">Jas</a> © 2024</p>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
