<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '4!H#A*$mq<+St%v+l7`k1{GB/=OC-Pwzl_<UOl!);T_U1)n.GZX*~.AdDSp=rKC^' );
define( 'SECURE_AUTH_KEY',  's,kb]rOTcxaI]m*I=ClbpB,xp[URYH=xrq2E*0W?RZ~:%ObujeDzn0Sow#`*nIO7' );
define( 'LOGGED_IN_KEY',    'H>zE# e1jJ$K/U3CLc-S!a!)CV{;T+]{H6$7.H`XZbDzq#u{~To,SoVR.#jdoc1%' );
define( 'NONCE_KEY',        ')58Q,oY/bN1_H#E]_)EOnUkc)uFu;p 3l Pgy}&w&25zP!$ioRaB<H0p,~R;fI M' );
define( 'AUTH_SALT',        '81&8 jQpsJ|uoX{#ML1U+XxAQ/k0aml>pk)Z@=7@69{Eb=tmvxic/Ab=0tmxGRKQ' );
define( 'SECURE_AUTH_SALT', 'D>Ai7IRJG 7oA&R+E$^Vg(}rffJUe|vkL%f7)|9Qa)|%X:)Mrp4?%b0[JZ:fY/GP' );
define( 'LOGGED_IN_SALT',   'Oy!-_%`6FySdnRjh8T!{i`*9?m`Zh8O.bi%(J2Pj.A!V!)A5.+w0PA_GHv]J0{!z' );
define( 'NONCE_SALT',       'uzY-Y{M&l(aQ8hecslDe(8Auag:%OQTeFqeNX06lW9*eI=:19bsi]s f:J_Cv6H)' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
