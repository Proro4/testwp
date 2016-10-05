<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wordpress');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'N8>lc`dmJ:|BZNA)>x6GWgy]!Lq693 Q(V5G4SrYMNCDDO7 6?}`{rH<5%vj2Kze');
define('SECURE_AUTH_KEY',  'SJW3R0M/wicW$Rc> 8EvGr,8oGviat@Br8>Z/Kz6B2]CVKif<!:~JkZwktz0e5?D');
define('LOGGED_IN_KEY',    '7#w:SnZ4HO_~!o92Rk#Qp9jfJo.!0|<@i}*I;.I(w?2N]>6Uk-Z_k$jT~}h[|GU,');
define('NONCE_KEY',        ',bw~q:f3(vQ;HDk#zTAwA=|/n+a@5r}%)b*KsSV;];3B_otE9)h=nHP=+-b@!,jY');
define('AUTH_SALT',        'EPE4p|fv:Y5_Wzc4[Lln)!3k[MV?Kb]5P0:p=!TMDz^T?s77V?BG-bJ|(d,YsW[b');
define('SECURE_AUTH_SALT', 'WKa)0t<c%!oS6gKIVumG>_l2&SxA;5UXu+ZAlHS)C|r|Ss8Z;kluq*RNAr}px|4M');
define('LOGGED_IN_SALT',   '7g99*2H`tO6:P)TPC<%[?*z.1ycKEbTj/iKR${uIXNT;VwDKfjo3mM5yfWqt2^5|');
define('NONCE_SALT',       'z7[8{=1EEJ6yXgGUx_IuD_YvDtfJL=Sh#WYY;j?jK0Up5K4G!h-(I~7[>5*ozdlG');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
