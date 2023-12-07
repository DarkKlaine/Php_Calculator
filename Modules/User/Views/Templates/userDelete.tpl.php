<?php
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
?>
<div class="text-center">
    <h3><?php echo $this->vars[ViewConst::TITLE] ?></h3><br>
    <h4><?php echo $this->vars[UserConst::USERNAME] ?></h4>
    <h6><?php echo 'Роль: ' . $this->vars[UserConst::ROLE] ?></h6>
    <h6><?php echo 'Зарегистрирован: ' . $this->vars[UserConst::DATE] ?></h6><br>
    <?php echo $this->vars[ViewConst::DESCRIPTION] ?>
</div>

<div class="col-12">
    <div class="d-grid">
        <form class="row g-0" method="post" action="<?php echo $this->vars['DeleteUser'] ?>">
            <input type="hidden" name="<?php echo UserConst::USERNAME ?>" value="<?php echo $this->vars[UserConst::USERNAME] ?>">
            <input type="hidden" name="<?php echo UserConst::OPERATION ?>" value="<?php echo $this->vars[UserConst::DELETE] ?>">
            <button type="submit" class="btn btn-light"><span style="color: red;">У Д А Л И Т Ь</span></button>
        </form>
        <br>
        <a href="<?php echo $this->vars['ShowUsersList'] ?>" class="btn btn-light row g-0">Отмена</a>
    </div>
</div>
