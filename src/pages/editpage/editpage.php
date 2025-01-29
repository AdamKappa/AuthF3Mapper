<div class="edit-container">
    
        <h2>Edit page</h2>
        <p>Hi {{ @UserData->username }}!</p>
    
    <check if="{{ @UserData->access_level === 'Simple User' }}">
        <div class="simple-container">    
            <form action="/submitSimpleEditpage" method="post">
                <div class="card border-info mb-3">
                    <div class="card-header bg-transparent border-info">
                        <div class="form-group admin-group">
                            <label>User Card </label>
                        </div>
                    </div>
                    <div class="card-body text-info">
                        <div class="form-group simple-user-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter new username" value="{{ @UserData->username }}" required>
                        </div>
                        <div class="form-group simple-user-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Please enter new password" required>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-info">
                        
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="save" value="Save">
                    <input type="button" class="btn btn-secondary" onclick="location.href='{{@BASE}}/welcome'"  value="Cancel" >
                </div>
            </form>
        </div>
    </check>
    <check if="{{ @UserData->access_level === 'Administrator' }}">
        <div class="admin-wrapper">
            <form action="/submitAdminEditpage" method="post">
                <div class="card-container">
                    <repeat group="{{ @Users }}" value="{{ @User }}">
                        <div class="card border-info mb-3">
                            <div class="card-header bg-transparent border-info">
                                <div class="form-group admin-group">
                                    <label for="{{ 'userID_'.@User['ID'] }}">User [ ID:{{ @User['ID'] }} ] Card </label>
                                </div>
                            </div>
                            <div class="card-body text-info">
                                <div class="form-group admin-group">
                                    <label for="{{ 'username_'.@User['ID'] }}">Username:</label>
                                    <input type="text" id="{{ 'username_'.@User['ID'] }}" name="usernames[{{ @User['ID'] }}]" placeholder="Enter new username" value="{{ @User['username'] }}">
                                </div>
                                <div class="form-group admin-group">
                                    <label for="{{ 'password_'.@User['ID'] }}">Password:</label>
                                    <input type="password" id="{{ 'password_'.@User['ID'] }}" name="passwords[{{ @User['ID'] }}]" placeholder="Enter new password" >
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-info">
                                <div class="form-group admin-group select-group">
                                    <label class="form-check-label" for="{{ 'editCheckbox_'.@User['ID'] }}">Select</label>
                                    <input class="form-check-input" type="checkbox" name="selected_users[]" id="{{ 'editCheckbox_'.@User['ID'] }}" value="{{ @User['ID'] }}">                        
                                </div>
                            </div>
                        </div>
                    </repeat>
                </div> 
                <check if="{{ @Users }}">
                    <true>
                        <input type="submit" class="btn btn-primary" name="save" value="Save">
                        <input type="button" class="btn btn-secondary"  onclick="location.href='{{@BASE}}/welcome'" value="Cancel" >
                    </true>
                    <false>
                        <p>No data to show</p>
                    </false>
                </check>
            </form>
        </div>
    </check>
    
    <check if="{{ $message }}">
        <div class="alert alert-info message"> {{ @message }}</div>
    </check>
</div>