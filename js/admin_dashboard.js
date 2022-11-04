window.addEventListener("load", function () {
    var add_car = document.getElementById("add-car-form");
    add_car.addEventListener("submit", function (event) {
        var XHR = new XMLHttpRequest();
        var add_car_form_data = new FormData(add_car);

        // On success
        XHR.addEventListener("load", add_success);

        // On error
        XHR.addEventListener("error", on_error);

        // Set up request
        XHR.open("POST", "api/add_new_car.php");

        // Form data is sent with request
        XHR.send(add_car_form_data);

        document.getElementById("loading").style.display = 'block';
        event.preventDefault();
    });
    
    var all_cars = document.getElementsByClassName("delete-icon");
    Array.from(all_cars).forEach(element => {
        element.addEventListener("click", function (event) {
            var XHR = new XMLHttpRequest();
            var car_id = event.target.getAttribute("car_id");
            // On success
            XHR.addEventListener("load", delete_car);

            // On error
            XHR.addEventListener("error", on_error);

            // Set up request
            XHR.open("GET", "api/delete_car.php?car_id=" + car_id);

            // Initiate the request
            XHR.send();

            document.getElementById("loading").style.display = 'block';
            // event.preventDefault();
        });
    });
});
var add_success = function (event) {
    document.getElementById("loading").style.display = 'none';
    console.log(event.target.responseText)
    let response = JSON.parse(event.target.responseText);
    alert(response.message);
    location.reload();
};

var delete_car = function (event) {
    document.getElementById("loading").style.display = 'none';

    let response = JSON.parse(event.target.responseText);
    if (response.success) {
        alert(response.message);
    } else {
        alert(response.message);
    }
    location.reload();
        
};
var on_error = function (event) {
    document.getElementById("loading").style.display = 'none';

    alert('Oops! Something went wrong.');
};