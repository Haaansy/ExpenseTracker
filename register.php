<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <div class="card m-5 p-5 glass-card">
        <div class="card-title d-flex justify-content-center">
            <h1>Register</h1>
        </div>
        <div class="card-body">
            <form action="process_registration.php" method="POST">
                <div class="mb-3 d-flex flex-column">
                    <label for="username" class="form-label">username</label>
                    <input type="text" name="username" id="username" class="input">
                </div>
                <div class="mb-3 d-flex flex-column">
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" class="input">
                </div>
                <div class="mb-3 d-flex flex-column">
                    <label for="password">confirm password</label>
                    <input type="password" name="password" id="confirmPassword" class="input">
                </div>
                <div class="mb-3 d-flex flex-row">
                    <a href="login.php" class="text-white">Already have an account?</a>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const username = document.getElementById("username");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");
        const form = document.querySelector("form");

        form.addEventListener("submit", (event) => {
            if (username.value.trim() === "" || password.value.trim() === "" || confirmPassword.value.trim() === "") {
                event.preventDefault();
                alert("All fields are required!");
                return;
            }

            if (password.value !== confirmPassword.value) {
                event.preventDefault();
                confirmPassword.setCustomValidity("Passwords do not match");
                alert("Passwords do not match");
            } else {
                confirmPassword.setCustomValidity("");
            }
        });

        confirmPassword.addEventListener("input", () => {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords do not match");
            } else {
                confirmPassword.setCustomValidity("");
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