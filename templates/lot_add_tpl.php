<form class="form form--add-lot container form--invalid" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
      <h2>Добавление лота</h2>
      <div class="form__container-two">
        <div class="form__item <? if(isset($error['title'])) : print "form__item--invalid"; endif;?>"> 
          <label for="lot-name">Наименование <sup>*</sup></label>
          <input type="text" name="lot[title]" id="name" value="<?if(isset($_POST['lot']['title'])) print $_POST['lot']['title'];?>" placeholder="Введите наименование лота">
          <? if(isset($error['title'])) : print "<span class='form__error'> ".$error['title']." </span>"; endif;?>
        </div>
        <div class="form__item <?  if($error['category_id']) : print "form__item--invalid"; endif;?>">
          <label for="category">Категория <sup>*</sup></label>
          <select id="category" name="lot[category_id]">

            <option value="0">Выберите категорию</option>

            <?php  foreach ($category as $categories) {?>      
                <option value="<?=$categories['category_id']?>" 
                  <?if((isset($_POST['lot']['category_id'])) and ($_POST['lot']['category_id']) === $categories['category_id'] ): echo "selected"; endif;?> ><?=$categories['name']?></option>
            <?php } ?>
          </select>
          <? if(isset($error['category_id'])) print "<span class='form__error'>Выберите категорию</span>";?>
        </div>
      </div>
      <div class="form__item form__item--wide <? if(isset($error['description'])) : print "form__item--invalid"; endif;?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea name="lot[description]" id="description" placeholder="Напишите описание лота"><?php if(isset($_POST['lot']['description'])) print $_POST['lot']['description'];?></textarea>
        <?php if(isset($error['description'])) : print "<span class='form__error'>Напишите описание лота</span>"; endif;?>
      </div>
      <div class="form__item form__item--file <? if(isset($error['no_file'])) : print "form__item--invalid"; endif;?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
          <a href="<?if(isset($_FILES['image']['tmp_name'])) print $_FILES['image']['tmp_name'];?>"><?if(isset($_FILES['image']['name'])) print $_FILES['image']['name']?></a>
          <input class="visually-hidden" type="file" name="image" id="image" value="<?if(isset($_FILES['lot']['image'])) print $_FILES['lot']['image'];?>">
          <label for="image">
            Добавить
          </label>
          <?if(isset($error['no_file'])) : print "<span class='form__error'>Добавте изображение</span>"; endif;?>
        </div>
      </div>
      <div class="form__container-three">
        <div class="form__item form__item--small <? if(isset($error['start_price'])) : print "form__item--invalid"; endif;?>">
          <label for="lot-rate">Начальная цена <sup>*</sup></label>
          <input type="text" name="lot[start_price]" id="lot-rate" value="<?if(isset($_POST['lot']['start_price'])) print $_POST['lot']['start_price'];?>" placeholder="0">          
          <? if(isset($error['start_price'])) : print "<span class='form__error'>".$error['start_price']."</span>"; endif;?>
        </div>
        <div class="form__item form__item--small <? if(isset($error['step_lot'])) : print "form__item--invalid"; endif;?>">
          <label for="lot-step">Шаг ставки <sup>*</sup></label>
          <input type="text" name="lot[step_lot]" id="step_lot" value="<?if(isset($_POST['lot']['step_lot'])) print $_POST['lot']['step_lot'];?>" placeholder="0">
          <? if(isset($error['step_lot'])) : print "<span class='form__error'>".$error['step_lot']."</span>"; endif;?>
        </div>
        <div class="form__item <? if(isset($error['date_finish'])) : print "form__item--invalid"; endif;?>">
          <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
          <input class="form__input-date" id="lot-date" type="text" name="lot[date_finish]"  value="<?if(isset($_POST['lot']['date_finish'])) print $_POST['lot']['date_finish'];?>"  placeholder="Введите дату в формате ГГГГ-ММ-ДД">          
          <? if(isset($error['date_finish'])) : print "<span class='form__error'>Введите дату завершения торгов</span>"; endif;?>
        </div>
      </div>     
      <?php 
      if(isset($error)): ?>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <ul>
          <?php foreach($error as $err => $val): ?>
          <li><strong><?=$dict[$err];?>:</strong> <?=$val;?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
        <button type="submit" class="button">Добавить лот</button>
      </form>