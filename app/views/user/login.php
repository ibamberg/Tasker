<div class="container pt-md-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Account Login</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email-input">Username </label>
                            <input type="text" id="email-input" class="form-control" name="email" />
                        </div>
                        <div class="form-group">
                            <label for="password-input">Password </label>
                            <input type="password" id="password-input" class="form-control" name="password" />
                        </div>
                        <input type="hidden" name="csrf_token" value="" />
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>