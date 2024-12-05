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

// Prepare the query to fetch transactions based on the logged-in username
$query = "SELECT owner, category, description, amount, id FROM transactions WHERE owner = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error preparing the statement: " . $conn->error);
}

// Bind the parameters and execute the statement
$stmt->bind_param("s", $username);
$stmt->execute();

// Fetch the result
$result = $stmt->get_result();

if (!$result) {
    die("Error fetching result: " . $stmt->error);
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - View Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body class="flex flex-column">
    <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="transactionModalLabel">Add Transaction</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="process_add.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3 d-flex flex-column">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" name="category" class="form-select input">
                                <option value="Income">Income</option>
                                <option value="Expense">Expense</option>
                            </select>
                        </div>
                        <div class="mb-3 d-flex flex-column">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="amount" class="input" required>
                        </div>
                        <div class="mb-3 d-flex flex-column">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="input" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card m-5 p-5 glass-card">
        <div class="card-title flex justify-content-start">
            <button type="button" class="btn btn-danger mb-3" id="homeButton">
                Back to Home
            </button>
            <h1 class="text-white mr-2">View Transactions</h1>
            <button type="button" class="btn btn-primary" id="addTransaction" data-bs-toggle="modal"
                data-bs-target="#transactionModal">
                Add Transaction
            </button>
        </div>
        <div class="card-body">
            <?php
            if ($result->num_rows > 0) {
                echo "<table class='table table-dark'>";
                echo "<thead><tr><th>Category</th><th>Description</th><th>Amount</th><th>Actions</th></tr></thead><tbody>";

                // Loop through and display each transaction
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                    echo "<td>
                <form action='process_delete.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='transaction_id' value='" . htmlspecialchars($row['id']) . "'>
                    <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                </form>
                <button 
                    class='btn btn-warning btn-sm edit-btn' 
                    data-id='" . htmlspecialchars($row['id']) . "'
                    data-category='" . htmlspecialchars($row['category']) . "' 
                    data-description='" . htmlspecialchars($row['description']) . "' 
                    data-amount='" . htmlspecialchars($row['amount']) . "' 
                    data-bs-toggle='modal' 
                    data-bs-target='#transactionModal'>
                    Edit
                </button>
              </td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<p class='text-center'>No transactions found for this user.</p>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </div>
        <script>
            const category = document.getElementById("catergory");
            const amount = document.getElementById("amount");
            const description = document.getElementById("description");
            const form = document.querySelector("form");

            form.addEventListener("submit", (event) => {
                if (category.value.trim() === "" || amount.value.trim() === "" || description.value.trim() === "") {
                    event.preventDefault();
                    alert("All fields are required!");
                    return;
                }
            })

            // Select all edit buttons
            const editButtons = document.querySelectorAll('.edit-btn');

            // Add click event to each button
            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Get data from the button's dataset
                    const id = button.dataset.id;
                    const category = button.dataset.category;
                    const description = button.dataset.description;
                    const amount = button.dataset.amount;

                    // Populate the modal fields
                    document.querySelector('#transactionModalLabel').textContent = 'Edit Transaction';
                    document.querySelector('#category').value = category;
                    document.querySelector('#description').value = description;
                    document.querySelector('#amount').value = amount;

                    // Change the form's action to the update script
                    const form = document.querySelector('#transactionModal form');
                    form.action = 'process_edit.php';

                    // Add a hidden input for transaction ID
                    let hiddenInput = form.querySelector('input[name="transaction_id"]');
                    if (!hiddenInput) {
                        hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'transaction_id';
                        form.appendChild(hiddenInput);
                    }
                    hiddenInput.value = id;
                });
            });

            // Reset modal on close
            const modalElement = document.querySelector('#transactionModal');
            modalElement.addEventListener('hidden.bs.modal', () => {
                document.querySelector('#transactionModalLabel').textContent = 'Add Transaction';
                document.querySelector('#transactionModal form').action = 'process_add.php';
                document.querySelector('#transactionModal form').reset();
                const hiddenInput = document.querySelector('#transactionModal form input[name="transaction_id"]');
                if (hiddenInput) {
                    hiddenInput.remove();
                }
            });

            const homeButton = document.getElementById("homeButton");
            homeButton.addEventListener("click", () => {
                window.location.href = "home.php";
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