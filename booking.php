<?php
include "header.html";
session_start();

// Customer details 
$customer_name      = $_POST["firstName"] . " " . $_POST["lastName"];
$customer_email     = $_POST["email"];
$customer_address   = $_POST["address1"] . ", " . $_POST["states"] . "-" . $_POST["postcode"]; 

?>

    <div class="container" style="text-align: center;">
        <h2> Thanks <?php echo $customer_name;?>, Your booking has been placed successfully!</h2>
        <h4>Your booking details will be sent here soon: <?php echo $customer_email;?></h4>

        <h4>Your billing address is:</h4>
        <table class="table">
            <thead class="thead-light text-center">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><?php echo $customer_name;?></th>
                    <th><?php echo $customer_email;?></th>
                    <th><?php echo $customer_address;?></th>
                    <th><?php echo "$".$_SESSION["total_cost"]?></th>
                </tr>
            </tbody>
        </table>
    </div>

<?php include "footer.html"; ?>