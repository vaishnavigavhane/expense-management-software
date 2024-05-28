<?php

    require_once "include/header.php";
?>

<?php 
date_default_timezone_set("Asia/kolkata");
    $todayExp = $yesterdayExp = $weeklyExp = $monthlyExp = $yearlyExp = $totalExp = 0;

    $current_date = date("Y-m-d " , strtotime("now"));
    $yesterday_date = date("Y-m-d " , strtotime("yesterday"));
    $weekly_date = date("Y-m-d " , strtotime("-1 week"));
    $monthly_date = date("Y-m-d " , strtotime("-1 month"));
    $yearly_date =  date("Y-m-d " , strtotime("-1 year"));

    // database connection
    require_once "include/database-connection.php";

// Today's expense------------------------------------------------------------------------------------------------
 

// Yesterday's Expense--------------------------------------------------------------------------------------------------------
$sql_command_yesterdayExp = "SELECT price , date FROM expenses Where date = '$yesterday_date' AND email = '$_SESSION[email]' ";
$result_y = mysqli_query($conn ,$sql_command_yesterdayExp);
$rows_y =  mysqli_num_rows($result_y);

if($rows_y > 0){
    while ($rows_y = mysqli_fetch_assoc($result_y) ){
        $yesterdayExp += $rows_y["price"];
    }
}

// weekly expense------------------------------------------------------------------------------------------------------------
$sql_command_weeklyExp = "SELECT price , date FROM expenses Where date BETWEEN '$weekly_date' AND '$current_date' AND email = '$_SESSION[email]'  ORDER BY date ";
$result_w = mysqli_query($conn , $sql_command_weeklyExp) ;
$rows_w =  mysqli_num_rows($result_w);
if($rows_w > 0){
    while ($rows_w = mysqli_fetch_assoc($result_w) ){
        $weeklyExp += $rows_w["price"];
    }
}

// monthly expense -----------------------------------------------------------------------------------------------------------
$sql_command_monthlyExp = "SELECT price , date FROM expenses Where date BETWEEN '$monthly_date' AND '$current_date' AND email = '$_SESSION[email]' ORDER BY date ";
$result_m = mysqli_query($conn , $sql_command_monthlyExp) ;
$rows_m =  mysqli_num_rows($result_m);
if($rows_m > 0){
    while ($rows_m = mysqli_fetch_assoc($result_m) ){
        $monthlyExp += $rows_m["price"];
    }
}

// yearly expense----------------------------------------------------------------------------------------------------------
$sql_command_yearlyExp = "SELECT price , date  FROM expenses Where date BETWEEN '$yearly_date' AND '$current_date' AND  email = '$_SESSION[email]' ";
$result_year = mysqli_query($conn , $sql_command_yearlyExp) ;
$rows_year =  mysqli_num_rows($result_year);
if($rows_year > 0){
    while($rows_year = mysqli_fetch_assoc($result_year)){
        $yearlyExp += $rows_year['price'];  
    }
}

 

// total expense------------------------------------------------------------------------------------------------------
$sql_command_totalExp = "SELECT price , date FROM expenses Where email = '$_SESSION[email]' ORDER BY date ";
$result_t = mysqli_query($conn , $sql_command_totalExp) ;
$rows_t =  mysqli_num_rows($result_t); 
if($rows_t > 0){
    while ($rows_t = mysqli_fetch_assoc($result_t) ) { 
        $totalExp += $rows_t["price"];
    }
}

?>



<h1 class=" display-4 pb-5 pt-4 " > <i> DASHBOARD </i> </h1>

<?php 
$snehal = "Snehal";
$anita = "Anita";
$vaishnavi = "Vaishnavi"; 

// total expense------------------------------------------------------------------------------------------------------
$sql_command_totalExp = "SELECT SUM(price) as addition FROM expenses Where uname = '$snehal' and add_minus = 'add' ";
$sql_command_totalExp1 = "SELECT SUM(price) as minus FROM expenses Where uname = '$snehal' and add_minus = 'minus' ";
$result_t = mysqli_query($conn , $sql_command_totalExp) ;
$result_t1 = mysqli_query($conn , $sql_command_totalExp1) ;
$row =  mysqli_fetch_assoc($result_t); 
$row1 =  mysqli_fetch_assoc($result_t1); 

if($row['addition'] > 0 || $row1['minus'] > 0 ) 
{ 
    $snehalexpense = $row['addition'] - $row1['minus'] ; 
} 
else 
{
    $snehalexpense = 0 ; 
}


$sql_command_totalExp = "SELECT SUM(price) as addition FROM expenses Where uname = '$anita' and add_minus = 'add' ";
$sql_command_totalExp1 = "SELECT SUM(price) as minus FROM expenses Where uname = '$anita' and add_minus = 'minus' ";
$result_t = mysqli_query($conn , $sql_command_totalExp) ;
$result_t1 = mysqli_query($conn , $sql_command_totalExp1) ;
$row =  mysqli_fetch_assoc($result_t); 
$row1 =  mysqli_fetch_assoc($result_t1); 

if($row['addition'] > 0 || $row1['minus'] > 0 ) 
{ 
    $anitaexpense = $row['addition'] - $row1['minus'] ; 
} 
else 
{
    $anitaexpense = 0 ; 
}


$sql_command_totalExp = "SELECT SUM(price) as addition FROM expenses Where uname = '$vaishnavi' and add_minus = 'add' ";
$sql_command_totalExp1 = "SELECT SUM(price) as minus FROM expenses Where uname = '$vaishnavi' and add_minus = 'minus' ";
$result_t = mysqli_query($conn , $sql_command_totalExp) ;
$result_t1 = mysqli_query($conn , $sql_command_totalExp1) ;
$row =  mysqli_fetch_assoc($result_t); 
$row1 =  mysqli_fetch_assoc($result_t1); 

if($row['addition'] > 0 || $row1['minus'] > 0 ) 
{ 
    $vaishnaviexpense = $row['addition'] - $row1['minus'] ; 
} 
else 
{
    $vaishnaviexpense = 0 ; 
}
?>

<div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Today's Expense</h3> 
                                <div class="d-inline-block"> 
                                    <h2 class="text-white"><?php echo $todayExp; ?></h2>
                                    <p class="text-white mb-0"><?php echo date("jS F " , strtotime("now")); ?></p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-rupee"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Yesterday's Expense</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $yesterdayExp; ?></h2>
                                    <p class="text-white mb-0"><?php echo date("jS F " , strtotime("yesterday")); ?></p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-rupee "></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Last 7 Day's Expense</h3>
                                <div class="d-inline-block">
                                <span class="float-right display-6   opacity-5"><i class="fa fa-rupee" ></i></span>

                                    <h2 class="text-white"><?php echo $weeklyExp; ?></h2>
                                    <p class="text-white mb-0"><?php echo date("jS F" , strtotime("-7 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
                               
                                </div>
                             </div>
                             <a href="7days.php" style="text-align:center; color:black; margin-top:-30px;">More info <i style="color:black;" class="fa fa-angle-double-right"></i></a>
                              </div>
                    </div>

<!------------------------------------------------------------------------------->
<div class="col-lg-3 col-sm-6">
                        <div class="card gradient-7">
                            <div class="card-body">
                                <h3 class="card-title text-white">Last 30 Day's Expense</h3>
                                <div class="d-inline-block">
                                <span class="float-right display-6   opacity-5"><i class="fa fa-rupee" ></i></span>

                                    <h2 class="text-white"><?php echo $monthlyExp;  ?></h2>
                                    <p class="text-white mb-0"><?php echo date("jS F" , strtotime("-30 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
                               
                                </div>
                             </div>
                             <a href="7days.php" style="text-align:center; color:black; margin-top:-30px;">More info <i style="color:black;" class="fa fa-angle-double-right"></i></a>
                              </div>
                    </div>
<!----------------------------------------------------------------------------->
                    <!-- <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-7">
                            <div class="card-body">
                                <h3 class="card-title text-white">Last 30 Day's Expense</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php //echo $monthlyExp; ?></h2>
                                    <p class="text-white mb-0"><?php //echo date("jS F" , strtotime("-30 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
                                </div>
                                <span class="float-right display-5 opacity-5 "  ><i class="fa fa-rupee"></i></span>
                            </div>
                            <a href="30days.php" style="text-align:center;color:black; margin-top:-80px;">More info <i class="fa fa-angle-double-right"></i></a>

                        </div>
                    </div> -->
                    <!-- <div class = "col-3">

                    </div> -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">One Year Expense</h3>
                                <div class="d-inline-block">
                                <span class="float-right display-5 opacity-5"><i class="fa fa-rupee"></i></span>
                         <h2 class="text-white"><?php echo $yearlyExp; ?></h2>
                                    <p class="text-white mb-0"><?php echo date("d F Y" , strtotime("-1 year")); echo " - " . date("d F Y" , strtotime("now")); ?></p>
                                </div>
                            </div>
                            <a href="1year.php" style="text-align:center; color:black; margin-top:-20px">More info <i class="fa fa-angle-double-right"></i></a>
                         </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-9">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total Expenses    </h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $totalExp; ?></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-rupee"></i></span>
                            </div>
                            <a href="totalexpenses.php" style="text-align:center; color:black; margin-top:-10px">More info <i class="fa fa-angle-double-right"></i></a>

                        </div>
                    </div>





                    <!-- ////////////////////////////////////// -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-9">
                            <div class="card-body">
                                <h3 class="card-title text-white"><?php echo $snehal; ?></h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $snehalexpense; ?></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-rupee"></i></span>
                            </div>
                            <a href="expensepage.php?name=<?php echo $snehal; ?>" style="text-align:center; color:black; margin-top:-10px">More info <i class="fa fa-angle-double-right"></i></a>

                        </div>
                    </div> <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-9">
                            <div class="card-body">
                                <h3 class="card-title text-white"><?php echo $anita; ?></h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $anitaexpense; ?></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-rupee"></i></span>
                            </div>
                            <a href="expensepage.php?name=<?php echo $anita; ?>" style="text-align:center; color:black; margin-top:-10px">More info <i class="fa fa-angle-double-right"></i></a>

                        </div>
                    </div> 
                    
                    
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-9">
                            <div class="card-body">
                                <h3 class="card-title text-white"><?php echo $vaishnavi; ?></h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $vaishnaviexpense ; ?></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-rupee"></i></span>
                            </div>
                            <a href="expensepage.php?name=<?php echo $vaishnavi; ?>" style="text-align:center; color:black; margin-top:-10px">More info <i class="fa fa-angle-double-right"></i></a>

                        </div>
                    </div>


<!-- //try dynamic dashboard  -->

                    <?php 
                    $query = mysqli_query($conn , "select * from users");
                    while($row = mysqli_fetch_array($query)) {
                        $name = $row['name'];
                        $sql_command_totalExp = "SELECT SUM(price) as addition FROM expenses Where uname = '$name' and add_minus = 'add' ";
                        $sql_command_totalExp1 = "SELECT SUM(price) as minus FROM expenses Where uname = '$name' and add_minus = 'minus' ";
                        $result_t = mysqli_query($conn , $sql_command_totalExp) ;
                        $result_t1 = mysqli_query($conn , $sql_command_totalExp1) ;
                        $row2 =  mysqli_fetch_assoc($result_t); 
                        $row1 =  mysqli_fetch_assoc($result_t1); 

                        if($row2['addition'] > 0 || $row1['minus'] > 0 ) 
                        { 
                            $vaishnaviexpense = $row2['addition'] - $row1['minus'] ; 
                        } 
                        else 
                        {
                            $vaishnaviexpense = 0 ; 
                        }
                    ?>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-9">
                            <div class="card-body">
                                <h3 class="card-title text-white"><?php echo $row['name']; ?></h3>
                                <!-- Assuming you have another field in your database for displaying some other information -->
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $vaishnaviexpense; ?></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-rupee"></i> </span>
                            </div>
                            <!-- Assuming you want to pass the user's name to the expensepage.php -->
                            <a href="expensepage.php?name=<?php echo $row['name']; ?>" style="text-align:center; color:black; margin-top:-10px">More info <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>

                    <?php } ?>



                </div>
  
<?php 
require_once "include/footer.php";
?>