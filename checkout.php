<?php 
include "header.html";


session_start();
$total_cost = 0;

// if(empty($_SESSION['total_cost'])){
//     $_SESSION['total_cost']= array();
// }

// Load JSON File  
$JSON = file_get_contents("cars.json");
// Convert JSON content to array
$JSON_Decode = json_decode($JSON, true);

// Converted Object to array
$cars_array = $JSON_Decode["cars"];

// Calculating the total cost 
if (isset($_SESSION["carId"])) {
    foreach ($_SESSION["carId"] as $carId) {
        foreach ($cars_array as $key) {
            // Checking if the car id of session matches the car id with the JSON file 
            if ($key["id"] == $carId) {
                $price = $key["price_per_day"] * $_POST["$carId"];
                $total_cost += $price;
            }
        }
    }
}

// Storing the total cost in session to use on other pages
$_SESSION["total_cost"] = $total_cost;
?>

<!-- Checkout form to submit the delivery details  -->
<div class="container" style="margin-top:-30px; margin-bottom:50px;">
    <h3 style="text-align:center; margin-bottom:40px;">Checkout</h3>
    <h4>Customer Details and Payment</h4>
    <h5>Please fill in your details (<span style="color: red;">*</span> indicates required field)</h5>


    <!-- Form for the booking page  -->
    <form method="POST" action="booking.php">
        <div class="form-group row pt-1">
            <label class="col-md-2" for="firstName">First Name<span style="color: red;"><b>*</b></span></label>
            <input class="col-md-10" type="text" name="firstName" id="firstName" required />
        </div>

        <div class="form-group row pt-3">
            <label class="col-md-2" for="lastName">Last Name<span style="color: red;"><b>*</b></span></label>
            <input class="col-md-10" type="text" name="lastName" id="lastName" required />
        </div>

        <div class="form-group row pt-3">
            <label class="col-md-2" for="email">Email<span style="color: red;"><b>*</b></span></label>
            <input class="col-md-10" type="email" name="email" id="email" required />
        </div>

        <div class="form-group row pt-3">
            <label class="col-md-2" for="address1">Address Line 1<span style="color: red;"><b>*</b></span></label>
            <input class="col-md-10" type="text" name="address1" id="address1" required />
        </div>

        <div class="form-group row pt-3">
            <label class="col-md-2" for="address2">Address Line 2</label>
            <input class="col-md-10" type="text" name="address2" id="address2" />
        </div>

        <div class="form-group row pt-3">
            <label class="col-md-2" for="city">City<span style="color: red;"><b>*</b></span></label>
            <input class="col-md-10" type="text" name="city" id="city" required />
        </div>

        <div class="form-group row pt-3">
            <label class="col-md-2" for="state">State<span style="color: red;"><b>*</b></span></label>
            <select class="col-md-10" name="states" id="states" required>
                <option>Australian Capital Territory</option>
                <option>New South Wales</option>
                <option>Queensland</option>
                <option>Western Australia</option>
                <option>South Australia</option>
                <option>Victoria</option>
                <option>Tasmania</option>
            </select>
        </div>

        <div class="form-group row pt-3">
            <label class="col-md-2" for="postcode">Postcode<span style="color: red;"><b>*</b></span></label>
            <input class="col-md-10" type="text" name="postcode" id="postcode" required />
        </div>

        <div class="form-group row pt-3">
            <label class="col-md-2" for="payment">Payment Type<span style="color: red;"><b>*</b></span></label>
            <select class="col-md-10" name="payment" id="payment" required>
                <option>Master</option>    
                <option>VISA</option>
                <option>PayPal</option>
                <option>Afterpay</option>
                <option>ZIP</option>
            </select>
        </div>

        <div class="row pt-3">
            <div class="col-md-8">
                <h4>Your are required to pay $<?php echo $total_cost; ?></h4>
            </div>


            <div class="col-md-4">
                <a href="car_Reservation.php" class="btn btn-secondary" role="button" style="text-decoration: none;">Continue Selection</a>
                <button class="btn btn-primary" type="submit">Booking</button>
            </div>
        </div>


    </form>
</div>


<?php include "footer.html"; ?>