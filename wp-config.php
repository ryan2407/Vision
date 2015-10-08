<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'vision');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '136pedro');

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
define('AUTH_KEY',         '~V{|WS0FGv3{|v+bF`ADDx-BpPBG`NSN%JF9exwtEHXS=<8Wu;kTX;>-C#?T,{aZ');
define('SECURE_AUTH_KEY',  'C8_YE}8,<weSP!IZ;_j#l:qK5^,5w#7s3b.]o)t>Aroc3:<:d<J**pd`M2vfB6+$');
define('LOGGED_IN_KEY',    'IkoNpJ@$Z<9)=_vzYu;`KCA9SGj5-6O o^lqG,F3]#-?x4k.<58UE-wD&SN]+g<6');
define('NONCE_KEY',        'c}Go]=-dEw7+-y+BTLiah>kX8!Y?,&A.OY;4RA.9p6(+)[4_HVY7K+TT%6{pWsI=');
define('AUTH_SALT',        '1;1+:t-}X)gsQh8_pw+Lc+7d^gm@K]`buv5r3_#-KxQ=>+<ec->?rf,biJYfWH+B');
define('SECURE_AUTH_SALT', 'BqayLd4%BN;~>!cvKER89$) ]$i*UgCp.)4gc%BD%u/(R*Pq#<6X#2.Jk+O1EVPx');
define('LOGGED_IN_SALT',   '|NAvV+([$ 2F4*T9mw.^zZB3Lj6w;r88bvif:ocS]1$BS1&,#az:7~&szbV*#ury');
define('NONCE_SALT',       '(T3_SnF~=4|7_-d Id-T%p_K;cX#: :#-)u|<Y[HQlA|NS;;dK0$|E 69m nkYdB');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sup2_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('PI_CRON_DEBUG', true);
define('WP_DEBUG', true);
define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', '159.203.93.119');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
