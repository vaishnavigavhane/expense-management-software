<?php
    // Include necessary files
    require_once "include/header.php";
    require "include/database-connection.php";

    // Fetch expenses data from the database
    $email = $_SESSION["email"];
    $sql_command = "SELECT * FROM expenses WHERE email = '$email'  ORDER BY date ";
    $result = mysqli_query($conn, $sql_command);
    $row_count = mysqli_num_rows($result);
    echo ''.$row_count;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Expenses</title>
    <!-- Include jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
</head>
<body>

<div class="container bg-light shadow mt-5">
    
    <h4 class='text-center pt-5 hide'>All Expenses</h4>
    <table class="table table-bordered table-hover border-primary">
        <thead>
            <tr>
                <th scope="col" class="text-danger">S.No.</th>
                <th scope="col" class="text-danger">Register Date</th>
                <th scope="col" class="text-danger">Name</th>
                <th scope="col" class="text-danger">Expenses Details</th>
                <th scope="col" class="text-danger">Price in &#8377;</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
        
                $i = 1;
                if ($row_count > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["id"];
                        $date = date("jS F", strtotime($row["date"]));
                        $uname = $row["uname"];
                        $item = $row["item"];
                        $price = $row["price"];
                        
                        $edit_icon = "<span><i class='fa fa-edit'></i></span>";
                        $edit = "<a href='edit-expense.php?id={$id}&item={$item}&price={$price}&date={$date}' class='btn-sm btn-primary float-right'>$edit_icon</a>";
                        $bin = "<a href='delete-expense.php?id={$id}' id='bin' class='btn-sm btn-primary float-right ml-2'><span><i class='fa fa-trash'></i></span></a>";
                        
                        echo "<tr><th>{$i}.</th><th>{$date}</th><th>{$uname}</th><th>{$item}</th><th>{$price} {$bin} {$edit}</th></tr>";
                        $i++;
                    }
                } else {
                    echo "<script>
                            $(document).ready(function() {
                                $('#addMsg').text('You dont have any expenses!');
                                $('#changeHrefForAdding').attr('href', 'add-expense.php');
                                $('#changeHrefToShowReport').text('Remind me later');
                                $('#changeHrefForAdding').text('Add Expenses');
                                $('#showModal').modal('show');
                            });
                          </script>";
                }
            ?>
        </tbody>
    </table>
</div>

<?php
    // Include footer
    require_once "include/footer.php";
?>
</body>
</html>
