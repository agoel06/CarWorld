window.addEventListener("load", function () {
    var is_interested_images = document.getElementsByClassName("is-interested-image");
    Array.from(is_interested_images).forEach(element => {
        element.addEventListener("click", function (event) {
            var XHR = new XMLHttpRequest();
            var car_id = event.target.getAttribute("car_id");

            // On success
            XHR.addEventListener("load", toggle_interested_success);

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
});

var toggle_interested_success = function (event) {
    document.getElementById("loading").style.display = 'none';

    var response = JSON.parse(event.target.responseText);
    if (response.success) {
        var car_id = response.car_id;

        var is_interested_image = document.querySelectorAll(".car-id-" + car_id + " .is-interested-image")[0];
        var interested_user_count = document.querySelectorAll(".car-id-" + car_id + " .interested-user-count")[0];

        if (response.is_interested) {
            is_interested_image.classList.add("fas");
            is_interested_image.classList.remove("far");
            interested_user_count.innerHTML = parseFloat(interested_user_count.innerHTML) + 1;
        } else {
            is_interested_image.classList.add("far");
            is_interested_image.classList.remove("fas");
            interested_user_count.innerHTML = parseFloat(interested_user_count.innerHTML) - 1;
        }
    } else if (!response.success && !response.is_logged_in) {
        window.$("#login-modal").modal("show");
    }
};
