<?php
use Engine\Views\ViewConst;
use Modules\User\Controllers\UserConst;
?>
<div class="text-center">
    <h3><?php echo $this->vars[ViewConst::TITLE] ?></h3><br>
</div>

<div class="form-body">
    <form class="row g-3" method="post" action="<?php echo $this->vars[ViewConst::ACTION] ?>">

        <div class="col-12">
            <input type="hidden" name="<?php echo UserConst::OPERATION ?>" value="<?php echo $this->vars[UserConst::OPERATION] ?>">
            <input type="hidden" name="<?php echo UserConst::USERNAME ?>" value="<?php echo $this->vars[UserConst::USERNAME] ?>">
            <input type="hidden" name="<?php echo UserConst::USERNAME_OLD ?>" value="<?php echo $this->vars[UserConst::USERNAME_OLD] ?>">
            <input type="hidden" name="<?php echo UserConst::PASSWORD ?>" value="<?php echo $this->vars[UserConst::PASSWORD] ?>">
            <select class="form-select mb-3" aria-label="Select role" name="role">
                <option selected value="Счетовод">Счетовод</option>
                <option value="Администратор">Администратор</option>
            </select>
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-light">Сохранить</button>
            </div>
        </div>
    </form>
</div>
