<div class="modal fade" id="update-user-password-modal" tabindex="-1" role="dialog" aria-labelledby="signup-heading" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signup-heading">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="update-user-password-form" class="form" role="form" method="post" action="api/update_user_password.php">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control" name="old_password" placeholder="Enter old password" minlength="6" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control" name="new_password" placeholder="Enter new password" minlength="6" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control" name="re_new_password" placeholder="Renter new password" minlength="6" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
