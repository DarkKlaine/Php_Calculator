<div class="text-center">
    <h3 class="">Список модулей</h3><br>
</div>

<div class="col-12">
    <div class="d-grid">
        <a href="/calculator" class="btn btn-light">Калькулятор</a>
    </div>
    <br>
    <div class="d-grid">
        <a href="/user" class="btn btn-light">Управление пользователями</a>
    </div>
    <br>
    <?php if ($this->vars['IsAuthorized']) { ?>
    <form class="row g-0" method="post" action="">
        <input type="hidden" name="operation" value="Logout">
        <button type="submit" class="btn btn-light">Выйти</button>
    </form>
    <?php } else { ?>
    <div class="d-grid">
        <a href="/login" class="btn btn-light">Войти</a>
    </div>
    <?php } ?>
</div>
