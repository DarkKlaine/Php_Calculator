<div class="text-center">
    <h3 class="">
        <?php
        echo $this->vars['Title'] ?>
    </h3><br>
</div>

<div class="col-12">
    <div class="d-grid">
        <a href="<?php echo $this->vars['ShowUsersList'] ?>" class="btn btn-light">Список пользователей</a>
    </div>
    <br>
    <div class="d-grid">
        <a href="<?php echo $this->vars['SetUsername'] ?>" class="btn btn-light">Добавить нового пользователя</a>
    </div>
</div>
