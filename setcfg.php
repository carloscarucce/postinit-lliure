<?php
require_once('conf.php');

switch(@$_GET['action']){
	case 'salvar':
		$confs = '';
		unset($_POST['salvar']);
		$jfxml = new jf_xml('<?xml version="1.0" encoding="ISO-8859-1"?><config/>');
		$jfxml->jf_array2xml($_POST);
		$confs = $jfxml->jf_pretty_xml();
		$f = fopen(dirname(__FILE__).'/configs.xml','w');
		fwrite($f, $confs);
		fclose($f);
		
		ll_alert('Alteraçõeks salvas com sucesso');
		
		header('Location: '.$llAppHome.'&p=setcfg');
	break;
	
	default:
		?>
		<div style="width: 300px; margin: 0 auto;">
			<form class="form" method="post" action="<?php echo $llAppOnServer,'&p=setcfg&action=salvar'; ?>">
				<fieldset>
					<legend>PostinIT - Configurações</legend>
					<div>
						<label>Editor avançado de texto</label>
						<select name="advancedEditor">
							<option value="true" <?php if($advancedEditor){ echo 'selected="selected"'; } ?>>Sim</option>
							<option value="false" <?php if(!$advancedEditor){ echo 'selected="selected"'; } ?>>Não</option>
						</select>
					</div>
					<div>
						<label>Registros por página (Listagem)</label>
						<input name="regPerPage" value="<?php echo $regPerPage; ?>"/>
					</div>
				</fieldset>
				
				<div class="botoes">
					<button type="submit" name="salvar" value="1">Salvar</button>
				</div>
			</form>
		</div>
		<?php
	break;
}
?>


