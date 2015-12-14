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

/**
 * Set the server port based on whether the site is being accessed over https
 * Required to manage SSL hosting on the TSOHost cloud
 * See: https://www.tsohost.com/knowledge-base/article/167/ssl-detection-on-the-cloud
 */
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '{{ item.db_name }}');

/** MySQL database username */
define('DB_USER', '{{ item.db_user }}');

/** MySQL database password */
define('DB_PASSWORD', '{{ item.db_password }}');

/** MySQL hostname */
define('DB_HOST', '{{ item.db_host }}');

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
{{ wp_salt.stdout }}

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = '{{ item.table_prefix }}';

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
@ini_set('display_errors', 0);
@ini_set('error_reporting', 30711); // Hide unnecesary notices
define('WP_DEBUG', {{ item.debug }});  // Turn debugging ON
define('WP_DEBUG_DISPLAY', false); // Turn forced display OFF
define('WP_DEBUG_LOG', true);  // Turn logging to wp-content/debug.log ON


/**
 * Spoof the Home and Site URLs
 */
define('WP_HOME', 'http://www.{{ item.hostname }}');
define('WP_SITEURL', 'http://www.{{ item.hostname }}/wp/');


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/* Let WordPress know we've moved our wp-content directory */
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
$root = substr($_SERVER['PHP_SELF'], 0 , strpos($_SERVER['PHP_SELF'], 'wp/') ? strpos($_SERVER['PHP_SELF'], 'wp/') : strrpos($_SERVER['PHP_SELF'], '/'));
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . $root . '/wp-content' );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');