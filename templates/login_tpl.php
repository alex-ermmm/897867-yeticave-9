<form class="form container" action="login.php" method="post">
  <h2>Вход</h2>
  <div class="form__item <?php if(isset($error['email'])) : print "form__item--invalid"; endif;?>"> 
    <label for="email">E-mail <sup>*</sup></label>
    <input id="email" type="text" name="login[email]" value="<?php if(isset($_POST['login']['email'])) print $_POST['login']['email'];?>" placeholder="Введите e-mail">
    <span class="form__error">Введите e-mail</span>
  </div>
  <div class="form__item form__item--last <?php if(isset($error['password'])) : print "form__item--invalid"; endif;?>">
    <label for="password">Пароль <sup>*</sup></label>
    <input id="password" type="password" name="login[password]" value="<?php if(isset($_POST['login']['password'])) print $_POST['login']['password'];?>" placeholder="Введите пароль">
    <span class="form__error">Введите пароль</span>
  </div>
  <button type="submit" class="button">Войти</button>
</form>