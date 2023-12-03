<div class="text-center">
    <h3 class="">
        <?php echo $this->vars['Title'] ?>
    </h3><br>
</div>

<div class="form-body">
    <form class="row g-3" method="post" action="<?php echo $this->vars['Action'] ?>">

        <div class="col-12">
            <input type="hidden" name="operation" value="<?php echo $this->vars['Operation'] ?>">
            <input type="hidden" name="currentUsername" value="<?php echo $this->vars['CurrentUsername'] ?>">
            <input type="hidden" name="username" value="<?php echo $this->vars['Username'] ?>">
            <input type="hidden" name="password" value="<?php echo $this->vars['Password'] ?>">
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
