<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'trafalgar9');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'trafalgar9');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'supernadia');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'cl1-sql12');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$<4kh=;/iSV2Z^LXG;R>Kx|cx+{+]N7K?0-sITqW[IW|z]L|1/~XA2C-crYS6<Jr');
define('SECURE_AUTH_KEY',  '_pbE9to#|o*lIBa)i}K0W9#]Uvul9+A<^<+n,?gX;QST15@9Fai1Z[fE3AQf$a>W');
define('LOGGED_IN_KEY',    ';!KZ.V;P=cHR(SS6[7+Q%}Fl9+%0sw--l9rkYrKR]TOx6?1RPFm-2=I(tp{eEBy!');
define('NONCE_KEY',        '`{$LOh6|rNN08dEc!3HB#Q||y>-?H#^~>T:& jmzz$F${*SM$m]$uXsP;>ZYHZ-k');
define('AUTH_SALT',        'ocKRS)1-w-0E|2O3F;+o__CPnf;DJ~>wv7.3>(:&kRdimC&Yd7DJxXD6p)TcLJ,[');
define('SECURE_AUTH_SALT', 'iX|oSUrkb^q*-/e>a2@s$d# 9T.^o@f`-fN9=msb|2N4q/(KmlhiL1&+$69T&9-V');
define('LOGGED_IN_SALT',   'M56@S7%h+$,x|c[oJgtwv>-i-`&nM+Llw1$ok,*J /^~<,H%zsUHWL.5g43JQg;t');
define('NONCE_SALT',       '1wLe&(v(NEN9>*GS9e/H$U`|VL~6FKe-CQZ~#4<[lSek^0u|5sV0ZreYXV#q+}|@');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');