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
define('DB_NAME', 'jee');

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
define('AUTH_KEY',         'fw1NX)bK$/tKbsyP3tt_=V0d8`rSrP4a)Wz^y>wiH2_MT|eo`p`[Y/-0a RR4HF,');
define('SECURE_AUTH_KEY',  '9Jm WShS!AC%v=wd=Z@@PM=1$!ax/`$&TN+n~(ukK=ngXzv/t+hrD5iMaxtY-<Vp');
define('LOGGED_IN_KEY',    ',,oWQJANV{Y]q66Ho)q{e=~kKaO+6X)xz*PX21S4fRzer=7yev3kG|KMl?I*@hKM');
define('NONCE_KEY',        'Smx*z7GAT)I<~FHVF6)j$E1d;,*3;g1 #!98]WV6wUZ|@d*&),Wv.[9[6|,<vZ:w');
define('AUTH_SALT',        'O :FS)U,pddla6)6VgMPX5c-f1iOdad1p]k+{jq@7K$E&APbMwkJ+.Yw>Fy|@a ;');
define('SECURE_AUTH_SALT', 'XI,+(qro4~*<|cWjx?d}=`&[tCdXO?EqvIpO0teYB?2#QgxTZt=,;:4o.OzhhMw&');
define('LOGGED_IN_SALT',   '0,%XC^lk>Hm#BZg2=r`MS@=|)^z%u$9KvC9PO[oe^TeAXFW`h>UFrG2?BCPTZtWx');
define('NONCE_SALT',       '|fRr1^|L|GZA*j6T#z[,HkcAi{_;1G`zFd$(O1vP}-GiM,p;OO8P4Mnt4>qn-!9R');

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
