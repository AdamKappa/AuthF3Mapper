<div class="welcome-container">
    <div class="exit-wrapper">
        <form method="post" action="{{@BASE}}/logout">
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
    </div>
    <check if="{{ @message }}">
        <div class="alert alert-success message">{{ @message }}</div>
    </check>
    <div class="welcome-wrapper">
        <p>Welcome {{ @username }}. You are an {{ @accessLevel }}.</p>
        <p><a href="{{@BASE}}/editpage">Go to edit page</a></p>
    </div>
</div>