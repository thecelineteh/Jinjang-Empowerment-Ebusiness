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
define('DB_NAME', 'Jinjang-Empowerment-Ebusiness');

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
define('AUTH_KEY',         'G5_v^PW5&}x^rvENP05DAP_{ELE&&7oo+R;];`Bp%gKY~yDP~(7YpCEoz;l+GTHG');
define('SECURE_AUTH_KEY',  'epQTE)I(bk LYuWRKd0Ivfrc[@6TblELD-SfZ_pt]TzAfS@0N3C}MaS RhQpb?;u');
define('LOGGED_IN_KEY',    'w*(,sZ2]J{rW?U`hU}g*<[HZ#fHp95P=1:X}H4.|SmyR96(rKIW0Mj|omq1unHR8');
define('NONCE_KEY',        'OP T(p`G7c+D3Dt_e%mk&cCxqi:5oy2V*]>%[hMuVr/ojmM&O`svMSsYd*TI6#vw');
define('AUTH_SALT',        'Z/pqLMNFykqmn.7L!{;2cPGE`xNjWJ:/QA]=c-:zkp&{z^=xw2e`KK1dM^xUcQKf');
define('SECURE_AUTH_SALT', ';gqq@N`^g.]L!)l@ cgPI,3qR~J%._FM& xVs2t+D-Pl2dg=rmr1{%l/Mvjdw}2H');
define('LOGGED_IN_SALT',   'czE(rnsq9lL}8JZ^mfIY[QMn<l{a!{DF_SLZY/*1qoze}0619ySD(<QtJk4`Gk4a');
define('NONCE_SALT',       '@xZ;QZ.H.?#L=ip3(:p6@]*-XwkD P8ApTeD#6jJaf2}=m#NuL:r7HXpt~DT4}_=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
