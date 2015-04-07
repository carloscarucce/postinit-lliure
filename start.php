<?php
$pluginHome = $llAppHome;
$pluginPasta = $_ll['app']['pasta'];

$botoes = array(
		array('href' => $backReal, 'img' => $plgIcones.'br_prev.png', 'title' => $backNome),
		array('href' => $llAppHome, 'img' => $plgIcones.'home.png', 'title' => 'Home'),
		array('href' => $llAppHome.'&p=form&action=new', 'img' => $plgIcones.'sun.png', 'title' => 'Novo'),
		array('href' => $llAppHome.'&p=setcfg', 'img' => $plgIcones.'wrench.png', 'title' => 'Configurações'),
	);
	
echo app_bar('PostinIT 2', $botoes);

require_once(( isset($_GET['p']) ? $_GET['p'] : 'home' ).".php");
?>
