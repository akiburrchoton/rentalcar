// Function to load Cars.json file to load the JSON file and fetch the data

window.onload = function () {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    //4: request finished and response is ready, status 200: "OK"
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      //To get the response from a server, use the responseText or responseXML
      var cars = JSON.parse(xhttp.responseText);
      display_Cars(cars);
    }
  };

  xhttp.open("GET", "cars.json", true);
  xhttp.send();
}

// Declaring array to store the cars status 'avilablity = true'
var availabilityStatus = new Array();


/**
== This function displays the cars on the homepage
**/
function display_Cars(cars) {

  // Fetching 'row' DOM from homepage
  const row = document.getElementById("cars");
  var car_card = "";

  // Storing the car objects in an array
  let cars_arr = cars.cars;

  // Displaying each car details in card by iterating the array
  cars_arr.forEach(car => {
    const car_name = car.brand + "-" + car.model + "-" + car.model_year;
    const desc = car.description.substring(0, 50) + "...";

    // Store the car id in the status array if availablity is TRUE
    if (car.availability == "True") {
      availabilityStatus.push(car.id);
    }

    // Card items to display the car information
    car_card += `
        <div class="col-md-3">
          <div class="card" style="width: 18rem;">

            <div class="card-body">
              <img src="./images/${car.model}.jpg" class="card-img-top" alt="${car.model}">
            </div>
            
            <div class="card-body">
              <h5 class="card-title">
                ${car_name}
              </h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Mileage</strong>: ${car.milage} </li>
              <li class="list-group-item"><strong>Fuel Type</strong>: ${car.fuel_type} </li>
              <li class="list-group-item"><strong>Seats</strong>: ${car.seats}</li>
              <li class="list-group-item"><strong>Price Per Day</strong>: $${car.price_per_day}</li>
              <li class="list-group-item"><strong>Availabilty</strong>: ${car.availability}</li>

              <li class="list-group-item"><strong>Description</strong>: ${desc}</li>
            </ul>
            <div class="card-body">
              <!-- Make form and save the car info in session array by using post method -->
              <a href="#" class="btn btn-primary" onclick="add_to_cart('${car.id}')">Add to Cart</a>
            </div>
          </div>
        </div>`;

    // Adding the cards inside the 'row' on homepage
    row.innerHTML = car_card;

  });

}

/** Function: Storing cars into session
== If available then
    == Load the php file
    == Push it to session array  

== Display success msg by alert
== If not available display by alert  
**/

// Function to add  the items into the session 
function add_to_cart(id) {

  // Checking if the car id is in availabilityStatus array or not
  if (availabilityStatus.includes(id)) {

    // Load PHP file to execute the session function to add the car id into the session and show into the reservation page

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      //4: request finished and response is ready, status 200: "OK"
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        //To get the response from a server, use the responseText or responseXML

        // Success message after adding the car in the session
        alert("The car has been added to cart successfully!");
      }
    };

    xhttp.open("POST", "session.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Passing the car id to php file to add in the session
    xhttp.send("id=" + id.toString());
  } else {
    alert("Sorry, the car is not available now. Please try other cars!");
  }
}


/** Function: Removing cars from session and DOM 
== Remove from DOM to remove the car item immediately
== Remove from the session so that it doesn't exist in session and do not display in reservation page
== To remove the specific car
  == Load send the car id using POST by Ajax loading the PHP page
**/
function delete_car(id){

    // Load PHP file to execute the session function to add the car id into the session and show into the reservation page

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      //4: request finished and response is ready, status 200: "OK"
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        
        // Fetching the DOM
        const car_id = document.getElementById(id);

        // Removing the car DOM
        car_id.remove();

        // Success message after deleting the car from the session
        alert("The car has been deleted from cart successfully!");
      }
    };
    
    xhttp.open("POST", "session.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Passing the car id to php file to to remove from session
    xhttp.send("rid=" + id.toString());

}