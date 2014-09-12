<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tee');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '+JKUJZ~Y433Dld82|t=ht-:r`%90%J-GKQsaS4WmGT+sE*)gp [--anc(Gln8|lh');
define('SECURE_AUTH_KEY',  'cDnZd:3@ }9+o>.UV]NJ-RJc9&+Ugpw#[}wpTVKZKki-]6%4}FBm<WRRC-o|3J;D');
define('LOGGED_IN_KEY',    '-^1O*j<|-LVw!,;6wTw<?r_^+0:3{Ke=|q;,0NhMHvi4SrU^-rv*#<|eH,g9n-%.');
define('NONCE_KEY',        'WF?Q|-&@}1P?%|^:BwBOMQlmJ4T{5C[O&HnwF7B{otg_?s|rs}:+uzTs>y}D|Z?0');
define('AUTH_SALT',        'IS]~K#^i;8hl1~=-$tOh(W30Kfy[f+mwXb!g|y[/]*QL?*sq0$j+;uyC9iP)*RyO');
define('SECURE_AUTH_SALT', '3Afe~Zgr$bsm!AoWLq^K2[45v/qY[xDS[goU88kAOlct4y->R0An_4<*g7`>Z*xI');
define('LOGGED_IN_SALT',   'iS)4Yc|7JW<np;FaBgDY2o?8I-@^%9(B*-mI>Y0!V<`r3-4#)BYc]:LM9~d>Ygj2');
define('NONCE_SALT',       'UFid|wIp^~SYn8TE3-/0MP=[X_[@$P/mq&d|h&y2Y8+z~J}oq8o+MgZ?0sW<~|Xq');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
