<div class="text-center">
    <h3 class="">
        <?php
        echo $this->vars['Title'] ?>
    </h3><br>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive-sm">
            <table id="example" class="table table-striped table-bordered" style="min-width: 500px;">
                <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($this->vars['UsersData'] as $userData) {
                    $username = $userData['username'];
                    $role = $userData['role'];
                    $queryParams = [
                        'username' => $username,
                    ];
                    $postData = http_build_query($queryParams);
                    $userInfoUrl = $this->vars['Info'] . '/?' . $postData;
                    ?>
                    <tr>
                        <td><?php echo $username; ?></td>
                        <td><?php echo $role; ?></td>
                    <td>
                        <table>
                            <a href="<?php echo $userInfoUrl; ?>">
                                <img src="/assets/images/info24.png" alt="Info" title="Информация о пользователе">
                            </a>&nbsp;
                            <form id="<?php echo $username; ?>_edit" method="post" action="<?php echo $this->vars['Edit']; ?>">
                                <input type="hidden" name="currentUsername" value="<?php echo $username; ?>">
                                <input type="hidden" name="operation" value="Edit">
                                <button id="submitButton" type="submit" style="display: none;"></button>
                                <img src="/assets/images/edit24.png" alt="Edit" title="Редактировать пользователя"
                                     onclick="document.getElementById('<?php echo $username; ?>_edit').submit();"
                                     style="cursor: pointer;">
                            </form>&nbsp;&nbsp;
                            <form id="<?php echo $username; ?>_delete" method="post" action="<?php echo $this->vars['Delete']; ?>">
                                <input type="hidden" name="username" value="<?php echo $username; ?>">
                                <button type="submit" style="display: none;"></button>
                                <img src="/assets/images/delete24.png" alt="Delete" title="Удалить пользователя"
                                     onclick="document.getElementById('<?php echo $username; ?>_delete').submit();"
                                     style="cursor: pointer;">
                            </form>
                        </table>
                    </td>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

