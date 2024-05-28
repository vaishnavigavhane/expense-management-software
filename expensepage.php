<?php
    require_once "include/header.php";
    require "include/database-connection.php";

if(isset($_GET['name']))
{
    
    $uname = $_GET['name'];
    
    // Fetch expense details from the database within the date range
    $email = $_SESSION["email"];
    $sql_command = "SELECT * FROM expenses WHERE uname = '$uname' ORDER BY date";
    $stmt = mysqli_query($conn, $sql_command);
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
    <h4 class='text-center pt-5 hide'> Expenses</h4>
    <table class="table table-bordered table-hover border-primary">
    <thead>
    <tr>
        <th scope="col">Sr.No</th> 
        <th scope="col">Register Date</th>  
        <th scope="col">Item</th>  
        <th scope="col">Expenses Details</th> 
        <th scope="col">Price in &#8377;</th>
        <th scope="col">Action</th> 
    </tr>
</thead>
<tbody>
    <?php
    $i = 1;
    if (true) { 
        while ($row = mysqli_fetch_assoc($stmt)) {
    ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row['date'];?></td>
        <td><?php echo $row['item'];?></td>
        <td><?php echo $row['note'];?></td>
        <?php if($row['add_minus'] == 'add') { ?>
        <td style="color:green"><?php echo $row['price'];?> (Added)</td>
        <?php } else { ?>
        <td style="color:red"><?php echo $row['price'];?> (Deducted)</td>
        <?php } ?>
        <?php 
        $edit_icon = "<span><i class='fa fa-edit'></i></span>";
        $edit = "<a href='edit-expense.php?id={$row['id']}&item={$row['item']}&price={$row['price']}&date={$row['date']}' class='btn-sm btn-primary float-right'>$edit_icon</a>";
        $bin = "<a href='delete-expense.php?id={$row['id']}' id='bin' class='btn-sm btn-primary float-right ml-2'><span><i class='fa fa-trash'></i></span></a>";
        echo "<td>{$bin} {$edit}</td>";
        ?>
    </tr>
    <?php 
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
}
else
{
    echo '<script>alert("invalid request!");</script>';
    echo '<script>window.location.href = "index.php" ;</script>';
}
?>
</body>
</html>





