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
        <form class="row g-0" method="post" action="<?php echo $this->vars['EditUser'] ?>">
            <input type="hidden" name="currentUsername" value="<?php echo $this->vars['Username'] ?>">
            <input type="hidden" name="operation" value="Edit">
            <button type="submit" class="btn btn-light">Редактировать пользователя</button>
        </form>
        <br>
        <a href="<?php echo $this->vars['ShowUsersList'] ?>" class="btn btn-light row g-0">Список пользователей</a>
    </div>
</div>
