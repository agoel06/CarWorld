window.addEventListener("load", function () {
    var is_interested_images = document.getElementsByClassName("is-interested-image");
    Array.from(is_interested_images).forEach(element => {
        element.addEventListener("click", function (event) {
            var XHR = new XMLHttpRequest();
            var car_id = event.target.getAttribute("car_id");

            // On success
            XHR.addEventListener("load", remove_interested_success);

            // On error
            XHR.addEventListener("error", on_error);

            // Set up request
            XHR.open("GET", "api/toggle_interested.php?car_id=" + car_id);

            // Initiate the request
            XHR.send();

            document.getElementById("loading").style.display = 'block';
            event.preventDefault();
        });
    });
    var edit_user_form = document.getElementById("update-user-profile-form");
    edit_user_form.addEventListener("submit", function (event) {
        var XHR = new XMLHttpRequest();
        var user_form_data = new FormData(edit_user_form);

        // On success
        XHR.addEventListener("load", profile_edit_success);

        // On error
        XHR.addEventListener("error", on_error);

        // Set up request
        XHR.open("POST", "api/update_user_profile.php");

        // Form data is sent with request
        XHR.send(user_form_data);
        console.log("hello");
        document.getElementById("loading").style.display = 'block';
        event.preventDefault();
    });
    var password_edit_form = document.getElementById("update-user-password-form");
    password_edit_form.addEventListener("submit", function (event) {
        var XHR = new XMLHttpRequest();
        var password_form_data = new FormData(password_edit_form);

        // On success
        XHR.addEventListener("load", profile_edit_success);

        // On error
        XHR.addEventListener("error", on_error);

        // Set up request
        XHR.open("POST", "api/update_user_password.php");

        // Form data is sent with request
        XHR.send(password_form_data);

        document.getElementById("loading").style.display = 'block';
        event.preventDefault();
    });
    
});

var remove_interested_success = function (event) {
    document.getElementById("loading").style.display = 'none';

    var response = JSON.parse(event.target.responseText);
    if (response.success) {
        var car_id = response.car_id;

        document.getElementsByClassName("car-id-" + car_id)[0].style.display = 'none';
        location.reload();
    }
};
var profile_edit_success = function (event) {
    document.getElementById("loading").style.display = 'none';

    let response = JSON.parse(event.target.responseText);
    alert(response.message);
    location.reload();

};

