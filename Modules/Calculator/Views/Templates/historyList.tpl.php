<?php
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
?>
<div class="text-center">
    <h3><?php echo $this->vars[ViewConst::TITLE] ?></h3>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive-sm">
            <table id="history" class="table table-striped table-bordered" style="min-width: 500px;">
                <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Выражение</th>
                    <th>Дата</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->vars['HistoryData'] as $historyData) { ?>
                <tr>
                    <td><?php echo $historyData['username'] ?? 'Гость'; ?></td>
                    <td style="text-align: center"><?php echo $historyData['expression']; ?></td>
                    <td><?php echo $historyData['date']; ?></td>
                    <?php } ?>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Выражение</th>
                    <th>Дата</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

