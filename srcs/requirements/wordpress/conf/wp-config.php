<?php
define( 'DB_NAME', "thedatabase");
define( 'DB_USER', "theuser");
define( 'DB_PASSWORD', "abc" );
define( 'DB_HOST', "mariadb" );
define( 'WP_HOME', "https://login.42.fr" );
define( 'WP_SITEURL', "https://login.42.fr" );

$table_prefix = 'wp_';

define( 'WP_DEBUG', true );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';

?>