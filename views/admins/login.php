<?php
    $this->Title = 'вхід в адміна';
?>

<form method = "POST">
  <?php if(!empty($error_message)) : ?>
    <div class="alert alert-danger" role="alert">
      <?= $error_message ?>
    </div>
  <?php endif; ?>  
  <div class="mb-3">
    <label for="inputEmail" class="form-label">Пошта \ Логін</label>
    <input name="login" class="form-control" id="inputEmail">
  </div>
  <div class="mb-3">
    <label for="inputPassword" class="form-label">Пароль</label>
    <input name="password" type="password" class="form-control" id="inputPassword">
  </div>
  <button type="submit" class="btn btn-primary">Увійти</button>
</form>