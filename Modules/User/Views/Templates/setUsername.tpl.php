<div class="text-center">
    <h3 class="">
        <?php echo $this->vars['Title'] ?>
    </h3>
    <?php echo $this->vars['Description'] ?>
</div>

<div class="form-body">
    <form class="row g-3" method="post" action="<?php echo $this->vars['Action'] ?>">
        <div class="col-12">
            <label for="inputUsername" class="form-label"></label>
            <input type="text" class="form-control" id="inputUsername" name="username"
                   placeholder="Имя пользователя" required="required" pattern="^[A-Za-z0-9]{2,12}$">
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-light">Далее</button>
            </div>
        </div>
    </form>
</div>
