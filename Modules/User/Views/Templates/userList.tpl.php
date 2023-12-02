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
                <tr>
                    <td>Username</td>
                    <td>Администратор</td>
                    <td>
                        <table>
                            <form method="post" action="/">
                                <input type="hidden" name="username" value="username">
                                <button type="submit" style="display: none;"></button>
                                <img src="/assets/images/info24.png" alt="Info"
                                     onclick="document.querySelector('button[type=submit]').click();"
                                     style="cursor: pointer;">
                            </form>&nbsp;
                            <form method="post" action="/">
                                <input type="hidden" name="username" value="username">
                                <button type="submit" style="display: none;"></button>
                                <img src="/assets/images/edit24.png" alt="Edit"
                                     onclick="document.querySelector('button[type=submit]').click();"
                                     style="cursor: pointer;">
                            </form>&nbsp;
                            <form method="post" action="/">
                                <input type="hidden" name="username" value="username">
                                <button type="submit" style="display: none;"></button>
                                <img src="/assets/images/delete24.png" alt="Delete"
                                     onclick="document.querySelector('button[type=submit]').click();"
                                     style="cursor: pointer;">
                            </form>
                        </table>
                    </td>
                </tr>
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

