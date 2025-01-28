
<div class="container">
    <div class="login-wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger"><?= ($errorMessage) ?></div>
        <?php endif; ?>
        <?php if ($successMessage): ?>
            <div class="alert alert-success"><?= ($successMessage) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= ($BASE) ?>/login/authenticate" >
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Please enter Username" required>
            </div>    
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Please enter password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="<?= ($BASE) ?>/signup">Sign up now</a>.</p>
        </form>
    </div>
</div>