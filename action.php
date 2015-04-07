<?php
require_once('conf.php');


switch($_GET['action']){
case 'new':
	$file = new fileup; 											// incia a classe
	$file->diretorio = '../uploads/postinit/';	// pasta para o upload (lembre-se que o caminho é apartir do arquivo onde estiver sedo execultado)
	$file->up(); // executa a classe
	
	$_POST['date'] = date('Y-m-d h:i:s');
	jf_insert($pluginTable, $_POST);
	$id = $jf_ultimo_id; 
	//$return = $llAppHome.'&p=form&action=edit&id='.$id;
	
	$_SESSION['aviso'] = array('Recado criado com sucesso!');
	
	break;
	
case 'edit':
	$file = new fileup; 											// incia a classe
	$file->diretorio = '../uploads/postinit/';	// pasta para o upload (lembre-se que o caminho é apartir do arquivo onde estiver sedo execultado)
	$file->up(); // executa a classe
	
	if(isset($_POST['date']))
		unset($_POST['date']);
	
	jf_update($pluginTable, $_POST, array('id' => $_GET['id']));
	$id = $_GET['id'];
	//$return = $llAppHome.'&p=form&action=edit&id='.$id;
	
	$_SESSION['aviso'] = array('Recado alterado com sucesso!');
	
	break;
	
case 'delete':
	jf_delete($pluginTable, array('id' => $_GET['id']));	
	$return = $llAppHome;
	break;
	
default: 
	echo "A ação especificada não é valida";
	break;
}

header('location: '.$llAppHome);
?>
