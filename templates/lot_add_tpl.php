<form class="form form--add-lot container form--invalid" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
      <h2>Добавление лота</h2>
      <div class="form__container-two">
        <div class="form__item <? if(isset($error['title'])) : print "form__item--invalid"; endif;?>"> 
          <label for="lot-name">Наименование <sup>*</sup></label>
          <input type="text" name="lot[title]" id="name" value="<?=$_POST['lot']['title']?>" placeholder="Введите наименование лота">
          <? if(isset($error['title'])) : print "<span class='form__error'> ".$error['title']." </span>"; endif;?>
        </div>
        <div class="form__item <? if($_POST['lot']['category'] == "Выберите категорию") : print "form__item--invalid"; endif;?>">
          <label for="category">Категория <sup>*</sup></label>
          <select id="category" name="lot[category]">
            <option >Выберите категорию</option>
            <?php foreach ($category as $categories) { ?>      
                <option value="<?=$categories['category_id']?>" 
                  <?if((isset($_POST['lot']['category'])) and ($_POST['lot']['category']) == $categories['category_id'] ): echo "selected"; endif;?> ><?=$categories['name']?></option>
            <?php } ?>
          </select>
          <? if($_POST['lot']['category'] == "Выберите категорию") : print "<span class='form__error'>Выберите категорию</span>"; endif;?>
        </div>
      </div>
      <div class="form__item form__item--wide <? if(isset($error['description'])) : print "form__item--invalid"; endif;?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea name="lot[description]" id="description" placeholder="Напишите описание лота"><?=$_POST['lot']['description']?></textarea>
        <? if(isset($error['description'])) : print "<span class='form__error'>Напишите описание лота</span>"; endif;?>
      </div>
      <div class="form__item form__item--file">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
          <a href="<?=$_FILES['tmp_name']['image']?>"><?=$_FILES['lot']['image']['name']?></a>
          <input class="visually-hidden" type="file" name="image" id="image" value="<?=$_FILES['lot']['image']?>">
          <label for="image">
            Добавить
          </label>
          <? if(isset($error['image'])) : print "<span class='form__error'>Добавте изображение</span>"; endif;?>
        </div>
      </div>
      <div class="form__container-three">
        <div class="form__item form__item--small <? if(isset($error['start_price'])) : print "form__item--invalid"; endif;?>">
          <label for="lot-rate">Начальная цена <sup>*</sup></label>
          <input type="text" name="lot[start_price]" id="lot-rate" value="<?=$_POST['lot']['start_price']?>" placeholder="0">          
          <? if(isset($error['start_price'])) : print "<span class='form__error'>Введите начальную цену</span>"; endif;?>
        </div>
        <div class="form__item form__item--small <? if(isset($error['step-lot'])) : print "form__item--invalid"; endif;?>">
          <label for="lot-step">Шаг ставки <sup>*</sup></label>
          <input type="text" name="lot[step-lot]" id="step-lot" value="<?=$_POST['lot']['step-lot']?>" placeholder="0">
          <? if(isset($error['step-lot'])) : print "<span class='form__error'>Введите шаг ставки</span>"; endif;?>
        </div>
        <div class="form__item <? if(isset($error['date-finish'])) : print "form__item--invalid"; endif;?>">
          <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
          <input class="form__input-date" id="lot-date" type="text" name="lot[date-finish]"  value="<?=$_POST['lot']['date-finish']?>"  placeholder="Введите дату в формате ГГГГ-ММ-ДД">          
          <? if(isset($error['date-finish'])) : print "<span class='form__error'>Введите дату завершения торгов</span>"; endif;?>
        </div>
      </div>     
      <?php 
      if (isset($error)): ?>
      <div class="form__error">
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <ul>
          <?php foreach($error as $err => $val): ?>
          <li><strong><?=$dict[$err];?>:</strong> <?=$val;?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
      <button type="submit" class="button">Добавить лот</button>
    </form>