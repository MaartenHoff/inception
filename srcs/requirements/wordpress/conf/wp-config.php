<?php
define( 'DB_NAME', getenv('DB_NAME'));
define( 'DB_USER', getenv('DB_USER'));
define( 'DB_PASSWORD', getenv('DB_PASSWORD') );
define( 'DB_HOST', getenv('DB_HOST') );
define( 'WP_HOME', getenv('WP_FULL_URL') );
define( 'WP_SITEURL', getenv('WP_FULL_URL') );

define( 'AUTH_KEY',         'OaZ`qaq~CCa8(3,M.||cWU(BK+?L/m^V8yOj4e|9 Vf|=vo!2s.8,13;-+35gX+_' );
define( 'SECURE_AUTH_KEY',  '%,)`jFWUjF}Nm)8Apya)>U)}JhBvT>DR.5RirK%<;0e`Sdl*Ftjjig2-o6t&I`s]' );
define( 'LOGGED_IN_KEY',    'XX:W]vfY^!c0%Kb5#N9L5m60&TwDf``?s`RYuK>yx,]sm+X+:GeQ*f~0$i:p-xZ=' );
define( 'NONCE_KEY',        'f(l::r?RC,+j{kjexX6D onI.sE_mP%Tta1w:ITrx6(I-Pr]2h_PROL8!#R9-hVI' );
define( 'AUTH_SALT',        '9!D2c#3GS//jH7VnABEU/6nQn`(f8hK+j:eEOW4a&1jPk{{arGY[enDf*&J9wp%p' );
define( 'SECURE_AUTH_SALT', ']0r,[^V#*jr{AHoX/CIOMw(N3^eD[rKKMQO|vS5{%XON941JfqgpGZ=k;?l[nL)a' );
define( 'LOGGED_IN_SALT',   'Ns/YJi[+_i<_zz1CGn0`E))#mvy|i1-?+8~k?.7vzdW@x~i0:}RJ-s8rS.&Msc-w' );
define( 'NONCE_SALT',       'WqFFpGa,;K!?lqX:^8fey|ghC7ukL;eO,=r=+J0C%WB?=-K*]~y]D$N41;u=)0}F' );

$table_prefix = 'wp_';

define( 'WP_DEBUG', true );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';

?>
