<?php
if(isset($_POST)){
  print_r($_POST);
}
else
 print $_POST."пуст";
?>
<form class="form form--add-lot container form--invalid" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
      <h2>Добавление лота</h2>
      <div class="form__container-two">
        <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
          <label for="lot-name">Наименование <sup>*</sup></label>
          <input type="text" name="lot[title]" id="name" value="" placeholder="Введите наименование лота">
          <span class="form__error">Введите наименование лота</span>
        </div>
        <div class="form__item">
          <label for="category">Категория <sup>*</sup></label>
          <select id="category" name="lot[category]">
            <option>Выберите категорию</option>
            <?php foreach ($category as $categories) { ?>      
                <option value="<?=$categories['category_id']?>"><?=$categories['name']?></option>
            <?php } ?>
          </select>
          <span class="form__error">Выберите категорию</span>
        </div>
      </div>
      <div class="form__item form__item--wide">
        <label for="message">Описание <sup>*</sup></label>
        <textarea name="lot[description]" id="description" placeholder="Напишите описание лота"></textarea>
        <span class="form__error">Напишите описание лота</span>
      </div>
      <div class="form__item form__item--file">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
          <input class="visually-hidden" type="file" name="lot[image]" id="image" value="">
          <label for="image">
            Добавить
          </label>
        </div>
      </div>
      <div class="form__container-three">
        <div class="form__item form__item--small">
          <label for="lot-rate">Начальная цена <sup>*</sup></label>
          <input type="text" name="lot[start_price]" id="lot-rate" value="" placeholder="0">
          <span class="form__error">Введите начальную цену</span>
        </div>
        <div class="form__item form__item--small">
          <label for="lot-step">Шаг ставки <sup>*</sup></label>
          <input type="text" name="lot[step-lot]" id="step-lot" value="" placeholder="0">
          <span class="form__error">Введите шаг ставки</span>
        </div>
        <div class="form__item">
          <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
          <input class="form__input-date" id="lot-date" type="text" name="lot[date-finish]"  value=""  placeholder="Введите дату в формате ГГГГ-ММ-ДД">
          <span class="form__error">Введите дату завершения торгов</span>
        </div>
      </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Добавить лот</button>
    </form>