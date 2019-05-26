<form class="form container" action="login.php" method="post"> <!-- form--invalid -->
  <h2>Вход</h2>
  <div class="form__item <? if(isset($error['email'])) : print "form__item--invalid"; endif;?>"> 
    <label for="email">E-mail <sup>*</sup></label>
    <input id="email" type="text" name="login[email]" value="<?=$_POST['login']['email']?>" placeholder="Введите e-mail">
    <span class="form__error">Введите e-mail</span>
  </div>
  <div class="form__item form__item--last <? if(isset($error['password'])) : print "form__item--invalid"; endif;?>">
    <label for="password">Пароль <sup>*</sup></label>
    <input id="password" type="password" name="login[password]" value="<?=$_POST['login']['password']?>" placeholder="Введите пароль">
    <span class="form__error">Введите пароль</span>
  </div>
  <button type="submit" class="button">Войти</button>
</form>