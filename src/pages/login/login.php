
<div class="container">
    <div class="login-wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        
        <check if="{{ @errorMessage }}">
            <div class="alert alert-danger">{{  @errorMessage }}</div>
        </check>
        <check if="{{ @successMessage }}">
            <div class="alert alert-success">{{  @successMessage }}</div>
        </check>
        
            <form method="post" action="{{@BASE}}/login/authenticate" >
                <div class="login-form">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="username_descr">Username</span>
                        <input type="text" name="username" id="username" class="form-control" aria-label="Username" aria-describedby="username_descr" placeholder="Please enter username" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="password_descr">Password</span> 
                        <input type="password" name="password" id="password" class="form-control" aria-label="Password" aria-describedby="password_descr" placeholder="Please enter password" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </div>
            </form>
        
        <p>Don't have an account? <a href="{{@BASE}}/signup">Sign up now</a>.</p>
    </div>
</div>