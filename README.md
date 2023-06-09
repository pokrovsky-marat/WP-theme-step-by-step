# Create WordPress theme step by step

- Создаем папку с именем нашей темы и добавляем ее в папку themes.
- Добавляем туда 2 файла index.php c версткой из HTML, и style.css куда добавляем название темы.
- Добавляем в index.php функцию wp_head();
- Создаем файл functions.php, прописываем туда добавление файла стилей style.css
- Создаем папку assets, куда переносим все стили, скрипты, шрифты и картинки.
- Переносим стили из assets в style.css, можно подключать и прямо из assets.
- Удаляем ненужное правило подключение стиля из \<head\>
- Подключаем wp_footer(), Удаляем \<script\>
- Подключаем скрипты в functions.php
- Меняем пути для изображений и шрифтов

---

- [underscores.me](https://underscores.me/) Генерация шаблона темы
- Добавляем header.php, footer.php. Вырезаем и вставляем туда верхнюю и нижнюю часть повторяющегося шаблона.

---

## Hooks

```php
<?php
//Хуки событие
function hello(){
  echo "Hello World";
}
add_action("my_hook", "hello");//Цепляем хук
do_action("my_hook");//Вызываем его
// Можно также передавать аргументы, необходимо указывать их кол-во последний аргумент,
//Аргумент "10" это порядок выполнения когда их несколько чем меньше тем раньше.
function greeting($message, $user){
    echo "<br/> " . $message . " " . $user;
}
add_action('greet_hook', 'greeting', 10, 2);
do_action("greet_hook", "Hello dear customer ", "Ivan");

//Хуки фильтр, они должны что-то возвращать.
function my_filter_function($name){
    return "Filtered " . $name;
}
add_filter('my_filter', "my_filter_function");
echo apply_filters('my_filter', " Ivan Bolvan");

//Для удаления хуков используем
remove_filter('my_filter', "my_filter_function");

//Если указывали порядок при добавлении хука, то при его удалении тоже его указываем
remove_action("my_hook", "hello2", 3);
?>
```

## Добавление лого

Чтобы из админки можно было выбирать лого сайта, добавляем в functions.php
`add_theme_support( 'custom-logo' );`
Для кастомной настройки отображения лого,

```php
<a href="<?php echo get_home_url(); ?>" class="header__logo">
<img src="<?php
  $custom_logo__url = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');
  echo $custom_logo__url[0];  ?>" alt=" Мир детства" class="header__logo-img">
</a>
```

Для простых случаев

```php
<div class="header__logo">
<?php the_custom_logo() ?>
</div>
```

## Добавление названия

Название сайта вписываем просто через 
`<title><?php bloginfo('title'); ?></title>`
при изменении в админке оно будет автоматически меняться.

## Кастомные поля ACF
- Необходимо скачать плагин ACF
- При добавлении группы полей указываем условия пост, страница и т.д.
- Синтаксис  для простого текстового поля `<?php the_field("about_description"); ?>`
- Можно использовать так же `get_field("about_description")`
- Синтаксис для изображения, когда возвращаемый формат Image Url `<img src="<?php the_field("about_img"); ?>" alt=""> `
- Синтаксис для изображения, когда возвращаемый формат Image Array
 ```php                    
<?php
  $image = get_field('about_img');
  if (!empty($image)) { ?>
    <img 
      src="<?php echo $image['url']; ?>" 
      alt="<?php echo $image['alt']; ?>"
    >
  <?php } 
?>
```
-Добавляем email, второй аргумент это id страницы, чтобы ссылаться в одно место из разных страниц `<?php the_field('mail', 2)`, чтобы не делать доп настройки в правилах отображения групп полей в ACF.