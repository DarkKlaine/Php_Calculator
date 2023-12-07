<?php
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
?>
<div class="text-center">
    <h3><?php echo $this->vars[ViewConst::TITLE] ?></h3><br>
    <h4><?php echo $this->vars[UserConst::USERNAME] ?></h4>
    <h6><?php echo 'Роль: ' . $this->vars[UserConst::ROLE] ?></h6>
    <h6><?php echo 'Зарегистрирован: ' . $this->vars[UserConst::DATE] ?></h6><br>
</div>

<div class="col-12">
    <div class="d-grid">
        <form class="row g-0" method="post" action="<?php echo $this->vars['SetUsername'] ?>">
            <input type="hidden" name="<?php echo UserConst::USERNAME_OLD ?>" value="<?php echo $this->vars[UserConst::USERNAME] ?>">
            <input type="hidden" name="<?php echo UserConst::OPERATION ?>" value="<?php echo UserConst::EDIT ?>">
            <button type="submit" class="btn btn-light">Редактировать пользователя</button>
        </form>
        <br>
        <a href="<?php echo $this->vars['ShowUsersList'] ?>" class="btn btn-light row g-0">Список пользователей</a>
    </div>
</div>
