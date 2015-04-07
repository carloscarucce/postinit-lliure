<?php 
require_once('api/fileup/inicio.php');
$pluginTable = PREFIXO."postinit";

$appCfg = simplexml_load_file(dirname(__FILE__).'/configs.xml');

$advancedEditor = strtolower($appCfg->advancedEditor)=='true'? true:false;
$regPerPage = @intval($appCfg->regPerPage);
?>
