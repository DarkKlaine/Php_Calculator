<?php

use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;

?>
<div class="text-center">
    <h3><?php
        echo $this->vars[ViewConst::TITLE] ?></h3>
    <h3><?php
        echo $this->vars['HistoryData'][0]['username'] ?? UserConst::GUEST_NAME; ?></h3>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive-sm">
            <table id="userhistory" class="table table-striped table-bordered" style="min-width: 500px;">
                <thead>
                <tr>
                    <th>Выражение</th>
                    <th>Дата</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($this->vars['HistoryData'] as $historyData) { ?>
                    <tr>
                        <td style="text-align: center"><?php
                            echo $historyData['expression']; ?></td>
                        <td><?php
                            echo $historyData['date']; ?></td>

                    </tr>
                <?php
                } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Выражение</th>
                    <th>Дата</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

