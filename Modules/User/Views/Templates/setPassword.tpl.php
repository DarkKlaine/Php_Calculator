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
        <div class="col-12">
            <input type="hidden" name="<?php echo UserConst::OPERATION ?>" value="<?php echo $this->vars[UserConst::OPERATION] ?>">
            <input type="hidden" name="<?php echo UserConst::USERNAME ?>" value="<?php echo $this->vars[UserConst::USERNAME] ?>">
            <input type="hidden" name="<?php echo UserConst::USERNAME_OLD ?>" value="<?php echo $this->vars[UserConst::USERNAME_OLD] ?>">

            <label for="inputPassword"></label>
            <div class="input-group" id="password">
                <input type="password"
                       class="form-control <?php echo $this->vars[ViewConst::FRAME_STYLE] ?>"
                       onclick="this.classList.replace('is-invalid', 'border-end-0')"
                       id="inputPassword"
                       name="<?php echo UserConst::PASSWORD ?>"
                       placeholder="Пароль"
                       <?php echo $this->vars[ViewConst::REQUIRED] ?>
                       pattern="^[A-Za-z0-9]{2,12}$">
                <a href="javascript:" class="input-group-text"><i class='bx bx-hide'></i></a>
            </div>
            <label for="confirmPassword"></label>
            <div class="input-group" id="confirm_password">
                <input type="password"
                       class="form-control <?php echo $this->vars[ViewConst::FRAME_STYLE] ?>"
                       onclick="this.classList.replace('is-invalid', 'border-end-0')"
                       id="confirmPassword"
                       name="<?php echo UserConst::PASSWORD_CONFIRM ?>"
                       placeholder="Повторите пароль"
                       <?php echo $this->vars[ViewConst::REQUIRED] ?>
                       pattern="^[A-Za-z0-9]{2,12}$">
                <a href="javascript:" class="input-group-text"><i class='bx bx-hide'></i></a>
            </div>
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-light">Далее</button>
            </div>
        </div>
    </form>
</div>
