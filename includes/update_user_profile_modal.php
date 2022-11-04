<div class="modal fade" id="update-user-profile-modal" tabindex="-1" role="dialog" aria-labelledby="signup-heading" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signup-heading">Update Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="update-user-profile-form" class="form" role="form" method="post" action="api/update_user_profile.php">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="full_name" value='<?= $user_name ?>' placeholder="Full Name" maxlength="30" required>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-phone-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="phone" value='<?= $user_phone ?>' placeholder="Phone Number" maxlength="10" minlength="10" required>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        <input type="email" class="form-control" name="email" value='<?= $user_email ?>' placeholder="Email" required>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-address-card"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="address" value='<?= $user_address ?>' placeholder="Address" maxlength="150" required>
                    </div>

                    <div class="form-group">
                        <span>I'm a</span>
                        <input type="radio" 
                            class="ml-3" 
                            id="gender-male" 
                            name="gender" 
                            value="male"  
                            checked=
                            <?php $user_gender = "male" ? "checked" : "unchecked"; ?>
                        /> 
                            Male
                        <label for="gender-male">
                        </label>
                        <input type="radio" 
                            class="ml-3" 
                            id="gender-female" 
                            name="gender"
                            value="female"
                            <?php $user_gender = "female" ? "checked" : "unchecked"; ?>
                        />
                        <label for="gender-female">
                            Female
                        </label>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Enter password to make changes" minlength="6" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
