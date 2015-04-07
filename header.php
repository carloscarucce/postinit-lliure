<?php
$aplicativo = new ll_app();
$aplicativo->setNome('result-pager')
			->setCaminho($_ll['app']['pasta'].'result-pager/result-pager.class.php')
			->addApp();
			
lliure::inicia('result-pager');
?>
