<div class="text-center">
    <h3 class="">
        <?php echo $this->vars['Title'] ?>
    </h3>
    <?php echo $this->vars['Description'] ?>
    <?php echo $this->vars['ErrorMessage'] ?? '' ?>
</div>

<div class="form-body">
    <form class="row g-3" method="post" action="<?php echo $this->vars['Action'] ?>">
        <input type="hidden" name="operation" value="<?php echo $this->vars['Operation'] ?>">
        <input type="hidden" name="currentUsername" value="<?php echo $this->vars['CurrentUsername'] ?>">
        <div class="col-12">
            <label for="inputUsername" class="form-label"></label>
            <input type="text" class="form-control <?php echo $this->vars['FrameStyle'] ?? '' ?>" onclick="this.select(); this.classList.remove('is-invalid')" id="inputUsername" name="username"
                   value="<?php echo $this->vars['CurrentUsername'] ?>" placeholder="Имя пользователя" <?php echo $this->vars['Required'] ?>pattern="^[A-Za-z0-9]{2,12}$">
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-light">Далее</button>
            </div>
        </div>
    </form>
</div>
