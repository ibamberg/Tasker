<div class="container pt-md-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Create new task</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username">Username </label>
                            <input type="text" id="username" class="form-control" name="username" required/>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail </label>
                            <input type="email" id="email" class="form-control" name="email" required/>
                        </div>
                        <div class="form-group">
                            <label for="task">Task </label>
                            <textarea class="form-control" id="task" name="taskText" required></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$test?>