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
    <?php echo $this->vars['Description'] ?>
</div>

<div class="col-12">
    <div class="d-grid">
        <form class="row g-0" method="post" action="<?php echo $this->vars['DeleteUser'] ?>">
            <input type="hidden" name="username" value="<?php echo $this->vars['Username'] ?>">
            <input type="hidden" name="operation" value="Delete">
            <button type="submit" class="btn btn-light"><span style="color: red;">У Д А Л И Т Ь</span></button>
        </form>
        <br>
        <a href="<?php echo $this->vars['ShowUsersList'] ?>" class="btn btn-light row g-0">Отмена</a>
    </div>
</div>
