<div class="text-center">
    <h3 class="">
        <?php echo $this->vars['Title'] ?>
    </h3>
    <h7 class="">
        <?php echo $this->vars['Description'] ?>
    </h7>
</div>

<div class="form-body">
    <form class="row g-3" method="post" action="<?php echo $this->vars['Action'] ?>">
        <div class="col-12">
            <input type="hidden" name="username" value="<?php echo $this->vars['Username'] ?>">
            <label for="inputPassword" class="form-label"></label>
            <div class="input-group" id="password">
                <input type="password" class="form-control border-end-0" id="inputPassword" name="password"
                       placeholder="Пароль" required pattern="^[A-Za-z0-9]{2,12}$">
                <a href="javascript:" class="input-group-text"><i class='bx bx-hide'></i></a>
            </div>
            <label for="confirmPassword" class="form-label"></label>
            <div class="input-group" id="confirm_password">
                <input type="password" class="form-control border-end-0" id="confirmPassword" name="passwordConfirm"
                       placeholder="Повторите пароль" required pattern="^[A-Za-z0-9]{2,12}$">
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
