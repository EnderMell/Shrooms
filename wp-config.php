<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'shrooms' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'upg?lsfiNJEH&n#h:Adka~+M#OsGlc>?Ne cpj`4*q0cM(|B@S!&^lLuH/]7ycR;' );
define( 'SECURE_AUTH_KEY',  'por.t!5fiki0(?*aU=Sn:l~TUtQ-$o$mj[E139_-Bqq1}cD@,dK?.i&p0<:!xH`;' );
define( 'LOGGED_IN_KEY',    'PyaW|GO(jFw]h}@3JThqI.Oi!eVoS *Fw3}Qvs6gxjsp~=GoY9MA_UzgDTt`3l$+' );
define( 'NONCE_KEY',        'pf^0P@%~d,?0Ht<wIuB00Kr1b^G1)HqgMeMv._fn*,ZH7NdC4@gDeetqp~SIT2th' );
define( 'AUTH_SALT',        'dLjWT,A0U<)qJWdxZ7=:9@q~Yvd32!iz`E5*#,8&[o3$CG`Jdm=j d[OvTXeOgG5' );
define( 'SECURE_AUTH_SALT', 'p@viHp{3${;B(AdYJc%[ 6+fJ5CuRz%TBUi.tTvVljH+n9;z92h#**/Q k)8k?C[' );
define( 'LOGGED_IN_SALT',   'crL Ceb-(`Jb7aRy5L&xGX~MpnaC>UI)7,^Zf3(!bfec)UMRs!p2ROJ~W{q|8[pC' );
define( 'NONCE_SALT',       'MnK@:A!|JtQ]wdoGee95lB%,a)-GE)bkyc_!vX9ze]o|_lSZhPJxbr#%R>V|V[yi' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
