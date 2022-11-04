<div class="modal fade" id="add-car-modal" tabindex="-1" role="dialog" aria-labelledby="signup-heading" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signup-heading">Add new car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="add-car-form" class="form" enctype="multipart/form-data" role="form" method="post" action="api/add_new_car.php">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="make" placeholder="Car make" minlength="3" maxlength="30" required>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-phone-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="model" placeholder="Car model" minlength="3" maxlength="50" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa-solid fa-users"></i>
                            </span>
                        </div>
                        <input type="number" class="form-control" name="owner" placeholder="Number of owners" min="0" required>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fa-regular fa-calendar-days"></i>
                            </span>
                        </div>
                        <input type="number" class="form-control" name="year" max="2022" placeholder="Year of registration" required>
                    </div>
                  
                    
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            </span>
                        </div>
                        <input type="number" class="form-control" name="price"  placeholder="Price" required>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fa-solid fa-gauge-high"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="mileage" placeholder="Mileage" maxlength="150" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-address-card"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="reg_number" placeholder="Car registration number" maxlength="150" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fa-solid fa-circle-info"></i>
                            </span>
                        </div>
                        <textarea class="form-control" name="description" placeholder="Car description (optional)"  maxlength="250" ></textarea>
                    </div>
                    <div class="form-group">
                        <span><b>Fuel:</b></span>
                        <input type="radio" class="ml-3" id="petrol" name="fuel_type" value="petrol" /> 
                        <label for="petrol">Petrol</label>
                        <input type="radio" class="ml-3" id="diesel" name="fuel_type" value="diesel" />
                        <label for="diesel">Diesel</label>
                        <input type="radio" class="ml-3" id="other" name="fuel_type" value="other" />
                        <label for="other">Other</label>
                    </div>
                    <div class="form-group">
                        <span><b>City:</b></span>
                        <input type="radio" class="ml-3" id="city-delhi" name="city" value="Delhi" /> 
                        <label for="city-delhi">Delhi</label>
                        <input type="radio" class="ml-3" id="city-mumbai" name="city" value="Mumbai" />
                        <label for="city-mumbai">Mumbai</label>
                        <input type="radio" class="ml-3" id="city-bengaluru" name="city" value="Bengaluru" />
                        <label for="city-bengaluru">Bengaluru</label>
                        <input type="radio" class="ml-3" id="city-hyderabad" name="city" value="Hyderabad" />
                        <label for="city-hyderabad">Hyderabad</label>
                    </div>

                    <div class="form-group">
            			<label><b>Upload Images</b> <i class="fa-solid fa-cloud-arrow-up"></i></label>
                        <input type="file" name="car_images[]" class="d-block" multiple required />
                    </div>                 

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Add</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>