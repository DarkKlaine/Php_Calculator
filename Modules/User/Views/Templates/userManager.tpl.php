<?php
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
?>
<div class="text-center">
    <h3><?php echo $this->vars[ViewConst::TITLE] ?></h3>
</div>

<div class="col-12">
    <div class="d-grid">
        <a href="<?php echo $this->vars['ShowUsersList'] ?>" class="btn btn-light row g-0">Список пользователей</a>
        <br>
        <form class="row g-0" method="post" action="<?php echo $this->vars['CreateUser'] ?>">
            <input type="hidden" name="<?php echo UserConst::OPERATION ?>" value="<?php echo UserConst::CREATE ?>">
            <button type="submit" class="btn btn-light">Добавить нового пользователя</button>
        </form>
    </div>
</div>
