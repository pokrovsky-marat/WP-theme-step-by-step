<?php
//Хук wp_enqueue_scripts, срабатывает когда подключаются скрипты
add_action("wp_enqueue_scripts", "childhood_scripts");
function childhood_scripts()
{
  wp_enqueue_style("childhood-style", get_stylesheet_uri());
}
