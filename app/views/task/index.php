<div class="container pt-md-5">
    <div class="row justify-content-end">
        <?=$limitTab?>
    </div>
    <div class="row justify-content-center my-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="w-20">Username</th>
                    <th class="w-20">E-mail</th>
                    <th class="w-50">Task text</th>
                    <?php if($isAdmin): ?><th></th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?=$task["username"]?></td>
                    <td><?=$task["email"]?></td>
                    <td><?=$task["taskText"]?></td>
                    <?php if($isAdmin): ?>
                        <td class="text-center" ><a href="/task/delete?id=<?=$task['id']?>"><i class="fas fa-trash"></i></a></td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row justify-content-center">
        <?=$pagination?>
    </div>
</div>