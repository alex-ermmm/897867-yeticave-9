<form class="form container" action="signup.php" method="post" autocomplete="off"> <!-- form--invalid -->
      <h2>Регистрация нового аккаунта</h2>
      <div class="form__item <?php  if(isset($error['email'])) : print "form__item--invalid"; endif;?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="signup[email]" value="<?php if(isset($_POST['signup']['email'])) print $_POST['signup']['email'];?>" placeholder="Введите e-mail">
        <span class="form__error">Введите e-mail</span>
        <?php  if(isset($error['email'])) : print "<span class='form__error'>".$error['email']."</span>"; endif;?>
      </div>
      <div class="form__item <?php  if(isset($error['password'])) : print "form__item--invalid"; endif;?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="signup[password]" value="<?php if(isset($_POST['signup']['password'])) print $_POST['signup']['password'];?>"  placeholder="Введите пароль">
        <span class="form__error">Введите пароль</span>
        <?php  if(isset($error['password'])) : print "<span class='form__error'>".$error['password']."</span>"; endif;?>
      </div>
      <div class="form__item <?php  if(isset($error['name'])) : print "form__item--invalid"; endif;?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="signup[name]"  value="<?php if(isset($_POST['signup']['name'])) print $_POST['signup']['name'];?>" placeholder="Введите имя">
        <span class="form__error">Введите имя</span>
        <?php  if(isset($error['name'])) : print "<span class='form__error'>".$error['name']."</span>"; endif;?>
      </div>
      <div class="form__item">
        <label for="message">Контактные данные <sup>*</sup></label>
        <textarea id="message" name="signup[message]" placeholder="Напишите как с вами связаться"><?php if(isset($_POST['signup']['message'])) print $_POST['signup']['message'];?></textarea>
        <span class="form__error">Напишите как с вами связаться</span>
      </div>

      <?php if(isset($error)): ?>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <ul>
          <?php foreach($error as $err => $val): ?>
          <li><strong><?=$dict[$err];?>:</strong> <?=$val;?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <button type="submit" class="button">Зарегистрироваться</button>
      <a class="text-link" href="login.php">Уже есть аккаунт</a>
    </form>