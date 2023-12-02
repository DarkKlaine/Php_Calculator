<div class="text-center">
    <h3 class="">
        <?php echo $this->vars['Title'] ?>
    </h3><br>
    <h4 class="">
        <?php echo $this->vars['Username'] ?>
    </h4>
    <h6 class="">
        Роль: <?php echo $this->vars['Role'] ?>
    </h6>
    <h6 class="">
        Зарегистрирован: <?php echo $this->vars['Date'] ?>
    </h6><br>
</div>

<div class="col-12">
    <div class="d-grid">
        <a href="<?php echo $this->vars['EditUser'] ?>" class="btn btn-light">Редактировать пользователя</a>
    </div><br>
    <div class="d-grid">
        <a href="<?php echo $this->vars['ShowUsersList'] ?>" class="btn btn-light">Список пользователей</a>
    </div>
</div>
