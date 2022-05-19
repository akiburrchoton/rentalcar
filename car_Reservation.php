<?php
    include "header.html";
    session_start();
    

    // Load JSON File  
    $JSON = file_get_contents("cars.json");
    
    // Convert JSON content to array
    $JSON_Decode = json_decode($JSON, true);

    // Converted Object to array
    $cars_array = $JSON_Decode["cars"];
  
    if(empty($_SESSION['carId'])){
        $_SESSION['carId']= array();
        echo    "<div class='container text-center'>
                    <h3>No car has been reserved</h3>
                </div>";
    }else{

    ?>
        <!-- Display cars from session in the reservation page  -->
        <div class="container">
            <form action="checkout.php" method="post">
                <table class="table table-dark">
                    <thead class="text-center">
                        <tr>
                            <th>Thumbnail</th>
                            <th>Vehicle</th>
                            <th>Price Per Day</th>
                            <th>Rental Days</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody class="text-center">
                        <?php
                            
                            if (isset($_SESSION["carId"])) {
                                
                                foreach ($_SESSION["carId"] as $carId) {
                                                        
                                    foreach ($cars_array as $key ) {
                                        if($key["id"] == $carId){
                                            $car_Name = $key["brand"] . "-" . $key["model"] . "-" . $key["model_year"];

                        ?>                  
                                            <tr id="<?php echo $key["id"] ;?>">
                                                <td><img src="./images/<?php echo $key["model"];?>.jpg" alt="" width="100px;"></td>
                                                <td><?php echo $car_Name ;?></td>
                                                <td><?php echo "$" . $key["price_per_day"] ;?></td>
                                                <!-- 
                                                    Car ID from JSON file was set as the 
                                                    NAME of each input field that would use in the 
                                                    checkout page to calculate the total cost 
                                                -->
                                                <td><input type='number' name="<?php echo $key["id"] ;?>" value='1' min='1' required/></td>

                                                
                                                <td><a href="#" class="btn btn-primary" onclick="delete_car(<?php echo $key["id"] ;?> )">Delete</a></td>
                                            </tr>
                        <?php                    
                                        }
                                    }
                                }
                            }else {
                                
                                echo "<h3 style='color: red;'><I>Car cart is empty<I></h3>";
                            }
                        ?> 
                    </tbody>
                </table>
                
                <div class="row pt-1">
                    <div class="col-9">

                    </div>
                    
                    <?php 
                        // if session is not empty show the proceed to checkout button then
                        if(!empty($_SESSION['carId'])){
                    ?>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">Procced to Checkout</button>
                            </div>
                    <?php 
                        }              
                    ?>
                </div>
            </form>
        </div>
<?php
    }
?>

<?php include "footer.html"; ?>