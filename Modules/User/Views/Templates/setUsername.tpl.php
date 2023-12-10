<?php
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
?>
<div class="text-center">
    <h3><?php echo $this->vars[ViewConst::TITLE] ?></h3>
    <?php echo $this->vars[ViewConst::DESCRIPTION] ?>
    <?php echo $this->vars[ViewConst::ERROR_MSG] ?>
</div>

<div class="form-body">
    <form class="row g-3" method="post" action="<?php echo $this->vars[ViewConst::ACTION] ?>">
        <input type="hidden" name="<?php echo UserConst::OPERATION ?>" value="<?php echo $this->vars[UserConst::OPERATION] ?>">
        <input type="hidden" name="<?php echo UserConst::USERNAME_OLD ?>" value="<?php echo $this->vars[UserConst::USERNAME_OLD] ?>">
        <div class="col-12">
            <label for="inputUsername"></label>
            <input type="text"
                   class="form-control <?php echo $this->vars[ViewConst::FRAME_STYLE] ?>"
                   onclick="this.select(); this.classList.remove('is-invalid')"
                   id="inputUsername"
                   name="<?php echo UserConst::USERNAME ?>"
                   value="<?php echo $this->vars[UserConst::USERNAME_OLD] ?>"
                   placeholder="Имя пользователя"
                   <?php echo $this->vars[ViewConst::REQUIRED] ?>
                   pattern="^[A-Za-z0-9]{2,12}$">
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-light">Далее</button>
            </div>
        </div>
    </form>
</div>
