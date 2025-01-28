
<div class="container">
    <div class="signup-wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form method="post" action="<?= ($BASE) ?>/signup">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Please enter a username" required> 
            </div>    
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Please enter a password" oninput="checkPasswords()" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Please re-enter the password" oninput="checkPasswords()" required>
                <div class="alert alert-warning display-no" role="alert" id="password_feedback"></div>
            </div>
            <div class="form-group">
                <div>
                    <label>User Type </label>
                </div>
                <label for="simple_user">Simple User</label>
                <input type="radio" name="access_level" id="simple_user" class="form-check-input" value="Simple User" checked>
                <label for="admin">Admin</label>
                <input type="radio" name="access_level" id="admin" class="form-check-input" value="Administrator">
            </div>
            <div class="form-group">
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