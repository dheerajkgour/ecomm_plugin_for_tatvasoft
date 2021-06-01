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
define( 'DB_NAME', 'ts_db' );

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
define( 'AUTH_KEY',         'Qp<P8GgaBz{hn9pW9aCbGu g]F7U2e:YWYhxft0;2e,%jRbhMhRxi>47|e]7U=m2' );
define( 'SECURE_AUTH_KEY',  '>5]-c /0zm3R6;,cw*ud(D,oSU^@h!n_cfAJDe9&I+iFD_&CsL2m:^!,F-ZIb+g+' );
define( 'LOGGED_IN_KEY',    'zGk_g64qp IaqW 2)=LHEvUECl4F]bAPeLbP1uX2H#CWUBCC!e|O4fCfPA0BFMp(' );
define( 'NONCE_KEY',        'VB3$B0Uq&=00I@$*FS_z%Ncc31-~?ZF;E%2a`Tfp7>f-P%3bFU5Chv]_zG5KxJ{r' );
define( 'AUTH_SALT',        '2,p 8 ?B?i;kMiaQYf?n94<bT4UVEiPK;HM!zaZ i);vTrIjDc#|^3#[0A^fQnwP' );
define( 'SECURE_AUTH_SALT', '-w~ZIaSJTu-Z GJQ><2H{w6n8G:$5$2_gjh|*lYjQ0 W`6D^/a8Gji~P `W-nOGF' );
define( 'LOGGED_IN_SALT',   '}]J~V.PaNdQo3Y|C4LMyzaUD^qvF09{Vo?+%F`C#?./i6-7ew:e)~Z:06?eoVc?E' );
define( 'NONCE_SALT',       '7]BVO[jx>_Vwj8;vMn&aLynD1w~cTB`X2<Qxm)<@|*cz=Yd}@XN.JTyYrZjT=ZtG' );

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
