<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Track Smart, Spend Smarter.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <div class="p-5">
        <div class="flex justify-content-center m-5 mt-5">
            <h1 class="text-white title">Expense Tracker</h1>
            <p class="text-white font-monospace">Track Smart, Spend Smarter.</p>
        </div>
        <div class="d-grid gap-2 m-5">
            <button type="button" id="getStarted-Button" class="btn btn-primary">
                Get Started
            </button>
        </div>
    </div>
    <script>
        document.getElementById("getStarted-Button").addEventListener("click", function () {
            window.location.href = "login.php";
        });
    </script>
</body>

</html>