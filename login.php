<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body class="flex flex-column">
    <div>
        <?php
        if (isset($_GET['error'])) {
            $error = htmlspecialchars($_GET['error']);
            $errorMessage = "";

            if ($error === "invalid_password") {
                $errorMessage = "Invalid password. Please try again.";
            } elseif ($error === "no_user") {
                $errorMessage = "No user found with the given username.";
            } elseif ($error === "please_login") {
                $errorMessage = "Please login to access the dashboard.";
            }

            if ($errorMessage) {
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    $errorMessage
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
        ?>
    </div>
    <div class="card m-5 p-5 glass-card">
        <div class="card-title d-flex justify-content-center">
            <h1>Login</h1>
        </div>
        <div class="card-body">
            <form action="process_login.php" method="POST">
                <div class="mb-3 d-flex flex-column">
                    <label for="username" class="form-label">username</label>
                    <input type="text" name="username" id="username" class="input">
                </div>
                <div class="mb-3 d-flex flex-column">
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" class="input">
                </div>
                <div class="mb-3 d-flex flex-row">
                    <a href="register.php" class="text-white">Register</a>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const username = document.getElementById("username");
        const password = document.getElementById("password");
        const form = document.querySelector("form");

        form.addEventListener("submit", (event) => {
            if (username.value.trim() === "" || password.value.trim() === "" || confirmPassword.value.trim() === "") {
                event.preventDefault();
                alert("All fields are required!");
                return;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>