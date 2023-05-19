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