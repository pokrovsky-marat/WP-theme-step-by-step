<?php
//Хук wp_enqueue_scripts, срабатывает когда подключаются скрипты
add_action("wp_enqueue_scripts", "childhood_scripts");
function childhood_scripts()
{
  wp_enqueue_style("childhood-style", get_stylesheet_uri());
  // Ниже правило позволяющее добавить файл стилей из assets или внешнего cdn
  // wp_enqueue_style("header-style", get_template_directory_uri() . "/assets/styles/main.min.css");
  //Подключаем js, Если наш скрипт зависит от другого скрипта например jquery, то прописываем его в array('jquery')
  wp_enqueue_script('childhood-script', get_template_directory_uri() . '/assets/js/main.min.js', array(), null, true);
}
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');
