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
define('DB_NAME', 'blog');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'qwerty34');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'RE`Dl^&lvg+&7>P-1Q8D+DldYI|rR- 9D&7.4X__u:CU1QAr1b_v#>O}$@u2JQH5');
define('SECURE_AUTH_KEY',  'p@U`]<|ooY;vq{?0}?2;Z&8Y=c=NxwB^d`Asz2tofnV->lM_cur5>h_-#6_1w4bi');
define('LOGGED_IN_KEY',    '9~k;G5ApcoHDBsN/k9-M5wL@{3-sIP0BF]_7?t~8guZyP/7CEo0J-(Cv4(rIyqxE');
define('NONCE_KEY',        'X}+#Ds-e*ScRXv)f`S`p[P%Vx1T-pkb<lC#|q=-(-z~USsMKxX9|Fl55u1dsAoqL');
define('AUTH_SALT',        'Z(SI  o$IvIZn0.]k%Wb3GVi,eguI]-#$>y&A&I5=X3:}JTj@,sg))B,S-qVqp$X');
define('SECURE_AUTH_SALT', 'JrIQ,o=d]{27oB,+M7?bfJvXH 4@ZM-?lkjEQc<![D3P2p-S=})_i|{4q<!N c5F');
define('LOGGED_IN_SALT',   'ba-XvNl2b> V}ZhBsNvh_vev8g#lG.g3uc=vLenH#{qZt|B*~Qy>}4zwKEgePA*v');
define('NONCE_SALT',       'SG-8+MvEEM0[xbyYk+Bc4%[Lx|~2SIf44k ,)pf3ZiKe%%`D}XyB[&l?F3>qt|E ');
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