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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '7s?lv.*e`}n#7Vt`h+N4%RKBCH-ZJ@.G9;}cZ<|9r)EPPLMDm(22KZ{L:Ns` `10' );
define( 'SECURE_AUTH_KEY',  '(!^5;<,!O^,&+?RmB&.ol$gQLgnD@Z>Uy{0oRZPLDkQU|uO}71lv0gH&Zav4D23.' );
define( 'LOGGED_IN_KEY',    '7f4/3@t>!.ez;k[WfoU(-$zE0_)`BJ@=TsX<:d4-Oll)pp=0lWGfTUqZ _Svs,;s' );
define( 'NONCE_KEY',        '/ %>SD ?e#(Xdw[2[}8Xmq6TTiqsON}PSRu M*+iAg(VV;UhX@x,Q1>&a%j/Wh:`' );
define( 'AUTH_SALT',        '.g&^^6k.K25M~q@CE@0qbiEqMzIz%]OH,<]^qevsx3|E`+sxhsZ1|z.6kBtH2IT]' );
define( 'SECURE_AUTH_SALT', '_qtxle~k?M`=Op-%WSy+==}%C{eqcR5(w36TJ&&E:?.g{*2)n7u=OhvBG;]NzWbg' );
define( 'LOGGED_IN_SALT',   'I!dsBqUlD#KJ|4YAi}wi/T]3_7ip5y?dxRD+EZEaT/_53{eps7OfK#SB>o($lOF*' );
define( 'NONCE_SALT',       'T2Hj@yRuI+?,<+dHGWpE*AwDyt CigETev>zrGAn>iYDu|[_y^7DH:(iXAVT+U|W' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
