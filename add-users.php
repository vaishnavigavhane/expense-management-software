<?php
    require_once "include/header.php";
    require_once "include/db_connection.php"; // Include your database connection file

    // Define error variables
    $unameErr = $dateErr = $budgetErr = "";
    $uname = $date = $budget = "";

    // Define a variable to store success message
    $expense_added = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate input
        if (empty($_POST["uname"])) {
            $unameErr = "User name is required";
        } else {
            $uname = $_POST["uname"];
        }

        if (empty($_POST["expense_date"])) {
            $dateErr = "Date is required";
        } else {
            $date = $_POST["expense_date"];
        }

        if (empty($_POST["expense_budget"])) {
            $budgetErr = "Budget is required";
        } else {
            $budget = $_POST["expense_budget"];
        }

        // If there are no validation errors, insert data into the database
        if (empty($unameErr) && empty($dateErr) && empty($budgetErr)) {
            // Sanitize inputs to prevent SQL injection
            $uname = mysqli_real_escape_string($connection, $uname);
            $date = mysqli_real_escape_string($connection, $date);
            $budget = mysqli_real_escape_string($connection, $budget);

            // Insert data into the database
            $query = "INSERT INTO users (username, date, budget) VALUES ('$uname', '$date', '$budget')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                $expense_added = "Expense added successfully.";
            } else {
                // Handle database error
                $expense_added = "Error: " . mysqli_error($connection);
            }
        }
    }
?>
<div class="container">
    <?php echo isset($expense_added) ? $expense_added : ''; ?>
    <div class="form-input-content m-5">
        <div class="card login-form mb-0">
            <div class="card-body pt-5 shadow">
                <h4 class="text-center">Add Users</h4>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="">
                    <div class="form-group">
                        <label>User Name:</label>
                        <input type="text" class="form-control" value="<?php echo $uname; ?>" name="uname">
                        <span class="text-danger"><?php echo $unameErr; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" class="form-control" value="<?php echo $date; ?>" name="expense_date">
                        <span class="text-danger"><?php echo $dateErr; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Budget:</label>
                        <input type="number" class="form-control" value="<?php echo $budget; ?>" name="expense_budget">
                        <span class="text-danger"><?php echo $budgetErr; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add" class="btn login-form__btn submit w-10" name="submit_expense">
                    </div>
                </form> 
            </div> 
        </div>
    </div>
</div>

<?php
    require_once "include/footer.php";
?>
