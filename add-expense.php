<?php
    require_once "include/header.php";
?>
   <?php

        $date = $item = $price =  $expense_added = $note="";
        $dateErr = $itemErr = $priceErr = $noteErr= "";
         $email = $_SESSION["email"];


            if($_SERVER["REQUEST_METHOD"] == "POST" ) { 
                
        require_once "include/database-connection.php";

                if( empty($_POST["expense_date"]) ){
                    $dateErr = "<P style='color:red'>* Please Add a Expense Date </p>";
               }else {
                   $date = trim($_POST["expense_date"]);
               }

               if( empty($_POST["item"]) ){ 
                $itemErr = "<P style='color:red'>* Please Add a Item Name </p>";
              }else {
               $item = trim($_POST["item"]);
               $item = ucwords($item);
              }

              if( empty($_POST["expense_price"]) ){
                $priceErr = "<P style='color:red'>* Please Add a Item Price </p>";
              }else {
               $price = trim($_POST["expense_price"]);
              }

                if(empty($_POST['note'])){
                    $noteErr= "<p style= 'color:red'>* Please Add  Note </p>";
                }else{
                    $note = trim($_POST["note"]);
                    $note = ucwords($note);
                }

                $uname = $_POST['uname'];

                $add_minus = $_POST['add_minus'];


                if ( !empty($date) && !empty($item) && !empty($price) && !empty($note)) 
                { 
                   
                        $add_expense = "INSERT INTO expenses( date , item , price , email, note ,uname ,add_minus) VALUES ( '$date','$item','$price','$email', '$note' , '$uname' ,'$add_minus')" ;
                        $result = mysqli_query($conn , $add_expense);
                        $date = $item = $price = $note= "" ;

                        $expense_added = " <div class='alert alert-warning alert-dismissible fade show'>
                        Item added to the Expense List !
                         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                         </button> " ;  
                } 
            }
   ?>


          <div class="container">
                <?php   echo $expense_added; ?>
   
                </div>
               <div class="form-input-content m-5">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">
                                    <h4 class="text-center">Add Expenses </h4>

                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="">
                            
                                <div class="form-group">
                                    <label >Date :</label>
                                    <input type="date" class="form-control" value="<?php echo $date; ?>"  name="expense_date" >
                                    <?php echo $dateErr; ?>                     
                                </div> 

                                <div class="form-group">
                                    <label >Expenses Details :</label>
                                    <input type="text" class="form-control" value="<?php echo $item; ?>" name="item" >
                                    <?php echo $itemErr; ?>        
                                </div>

                                <div class="form-group">
                                    <label >Price :</label>
                                    <input type="number" class="form-control " value="<?php echo $price; ?>"  name="expense_price" >
                                    <?php echo $priceErr; ?>        
                                </div>

                                <div class="form-group">
                                    <label >Note :</label>
                                    <input type="text" class="form-control" value="<?php echo $note; ?>" name="note" >
                                    <?php echo $noteErr; ?>        
                                </div>

                                <div class="form-group">
                                <select class="form-control" name="uname" id="">
                                    <option value="">Select</option>
                                    <option value="Snehal">Snehal</option>
                                    <option value="Anita">Anita</option>
                                    <option value="Vaishnavi">Vaishnavi</option>

                                </select>
                               
                                    <?php echo "Select Name"; ?>        
                                </div>

                                <div class="form-group">
                                    <input class="ml-1" type="radio" name="add_minus" value="add" id="add" required><label style="font-size : 15px; " for="add">Add</label>
                                    <input class="ml-5" type="radio" name="add_minus" value="minus" id="minus" required><label style="font-size : 15px; " for="minus">Minus</label>
                                </div> 



                                <div class="form-group">
                                    <input type="submit" value="Add" class="btn login-form__btn submit w-10 " name="submit_expense" >
                                </div>
  
                                  </form>
                            </div>
                        </div>
                    </div>
</div>

<?php
    require_once "include/footer.php";
?>