<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'CharletBookingEngine');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '%ELI3Z_vq`Y)rETbXbfO8y&{=4)H6 Y6H.$*!1]X EaoF[br3m+ ,!xg>r{sV6vQ');
define('SECURE_AUTH_KEY',  '0hj5MRxCcewF9kWn{@Lk:SC=)hqX2LltQbowY0Y}q<L~n<Ymkg_U><~5@[RHB%X4');
define('LOGGED_IN_KEY',    'B%]@TtYk+.1Q)M!Q39{@<oX>L!PY#CMkM=w/OhD(KBARnPnv@KkP_[0.IaL2+]ru');
define('NONCE_KEY',        '3Zx,U-EayY~)f;,Txa$&}jD#&ic?0FH_I%~i(QB*j3_$~8PS6H*8v?R#t?IN=B]W');
define('AUTH_SALT',        'OFNCRuL&F6v=;hfLsz)4,0l3y&Qm`g3g2q#9l@<y?9MLYH*c1040,Ii?_ZvA1(~P');
define('SECURE_AUTH_SALT', '7^7%IJ5;PquD5%u1h*7-3wv^#:ki[q#*rmp_i41[Rpv#Z.d&QQI2{^Mc.]XnDy(/');
define('LOGGED_IN_SALT',   '>[%dL{W$ZI:W01:_ k^x+R|(oK9_&,y2Lj3_N3Z}[$|cwar)x%F@C07a/tRP.4GK');
define('NONCE_SALT',       'vV2_E~3C&w;lpC%2p9e]kEz$)-M.p-:P*20<wC<%ECfQtkp;Yh/]Gx~W8xe2+EcY');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'CBE_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
