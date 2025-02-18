<?php

/** O nome da base de dados*/
define('DB_NAME', 'gestao_atividades');
/** Utilizador da base de dados MySQL */
define('DB_USER', 'root');
/** Password da base de dados MySQL */
define('DB_PASSWORD', '');
/** nome do host do MySQL */
define('DB_HOST', 'localhost');
/** caminho absoluto para a pasta do sistema **/
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');
/** caminho do server para o sistema **/
if (!defined('BASEURL'))
    define('BASEURL', '/projatividades_crud_bootstrap_php/');
/** caminho do ficheiro da base de dados **/
if (!defined('DBAPI'))
    define('DBAPI', ABSPATH . 'inc/database.php');
/** caminhos dos templates de header e footer **/
define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');
