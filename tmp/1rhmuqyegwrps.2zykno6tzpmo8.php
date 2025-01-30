
<div class="container">
    <div class="signup-wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form method="post" action="<?= ($BASE) ?>/signup">
            <div class="input-group mb-3">
                <span class="input-group-text" id="username_descr">Username</span>
                <input type="text" name="username" id="username" class="form-control" aria-label="Username" aria-describedby="username_descr" placeholder="Please enter a username" required>
            </div> 
            <div class="input-group mb-3">
                <span class="input-group-text" id="password_descr">Password</span> 
                <input type="password" name="password" id="password" class="form-control" aria-label="Password" aria-describedby="password_descr" placeholder="Please enter a password" oninput="checkPasswords()" required>
            </div> 
            <div class="input-group mb-3">
                <span class="input-group-text" id="confirm_password_descr">Confirm Password</span> 
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" aria-label="Confirm password" aria-describedby="confirm_password_descr" placeholder="Please re-enter the password" oninput="checkPasswords()" required>
            </div>
            <div class="alert alert-warning display-no" role="alert" id="password_feedback"></div>
            <div class="input-group mb-3">
                <!-- <label>User Type </label> -->
                <span class="input-group-text" id="user_type_descr">User Type</span> 
                <div class="form-control" aria-describedby="user_type_descr">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="access_level" id="simple_user" value="Simple User" checked>
                        <label class="form-check-label" for="simple_user">Simple User</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="access_level" id="admin" value="Administrator">
                        <label class="form-check-label" for="admin">Administrator</label>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary" id="submitBtn" value="Sign Up" disabled>
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="<?= ($BASE) ?>/login">Login here</a>.</p>
        </form>
        <!-- Display sign up error message here -->
        <?php if ($message): ?>
            <div class="alert alert-danger" ><?= ($message) ?></div>
        <?php endif; ?>
    </div>
</div>