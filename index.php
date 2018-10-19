<?php
/**
 * index.php
 * @package WP Cronbase
 * @version 0.1
 */
/*
  Plugin Name: WP Cronbase
  Description: Demo de un cronjob en Wordpress
  Author: Daniel Huidobro
  Version: 0.1
  Author URI: https://rebootproject.mx
 */

// Registramos una tarea nueva
register_activation_hook(__FILE__, 'wp_cronbase_task');

/**
 * wp_cronbase_task
 * @version 0.1
 * Verifica si existe la tarea en la cola de cronjobs de wp o la agrega cada hora
 */
function wp_cronbase_task() {
    if (!wp_next_scheduled('wp_cronbase_task')) {
        wp_schedule_event(current_time('timestamp'), 'hourly', 'wp_cronbase_task');
    }
}

// Hook de la tarea
add_action('wp_cronbase_task', 'task_cronbase');

/**
 * task_cronbase
 * @version 0.1
 * @todo Eliminar el contenido y sustituir por tu funcionalidad
 * Tarea del cronjob
 */
function task_cronbase() {

  $file = fopen(plugin_dir_path( __FILE__ )."wp_cronbase.log","a");
  echo fwrite($file, "\n" . date('Y-m-d h:i:s') . " :: Escrito por WP Cronbase");
  fclose($file);
}
