<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'user_system');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=please_login", true, 301);
    exit;
}

// Get the username from the session
$username = $_SESSION['username'];

// Calculate the balance
$query = "SELECT category, amount FROM transactions WHERE owner = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$balance = 0;
if ($result) {
    while ($row = $result->fetch_assoc()) {
        if ($row['category'] === 'Income') {
            $balance += $row['amount'];
        } elseif ($row['category'] === 'Expense') {
            $balance -= $row['amount'];
        }
    }
}

$stmt->close();
$conn->close();

// Define a maximum limit for the progress bar
$maxLimit = 5000; // Example maximum limit
$progress = min(100, ($balance / $maxLimit) * 100); // Cap progress at 100%
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body class="flex flex-column">
    <div class="card m-5 p-5 glass-card">
        <div class="card-title d-flex justify-content-start">
            <?php
            echo '<h1 class="text-white">Greetings, ' . htmlspecialchars($_SESSION["username"]) . '!</h1>';
            ?>
        </div>
        <div class="card-body">
            <div class="container mt-5 d-flex justify-content-center">
                <div class="credit-card">
                    <div class="card-header d-flex align-items-center">
                        <div class="fw-bold">EXPENSE TRACKER</div>
                    </div>
                    <div class="balance">
                        <div>Balance</div>
                        <div><?php echo '$' . number_format($balance, 2); ?></div>
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%"
                                aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100">
                                <?php echo round($progress); ?>%
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        Expiry: 12/25
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 mt-5">
                <button type="button" class="btn btn-primary" id="ViewTransactions">
                    View Transactions
                </button>
                <button type="button" class="btn btn-danger" id="Signout">
                    Sign Out
                </button>
            </div>
        </div>
    </div>
    <script>
        const viewTransactions = document.getElementById("ViewTransactions");
        const signOut = document.getElementById("Signout");

        viewTransactions.addEventListener("click", () => {
            window.location.href = "view_transactions.php";
        });

        signOut.addEventListener("click", () => {
            window.location.href = "logout.php";
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>