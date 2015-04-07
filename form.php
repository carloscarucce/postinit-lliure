<?php
require_once('conf.php');
$action = $_GET['action'];
$formItens = array('imagem' => '');

if($action == 'edit' && isset($_GET['id'])){
	$qry = mysql_query('SELECT * FROM '.$pluginTable.' WHERE id='.$_GET['id']);
	$formItens = mysql_fetch_assoc($qry);

}
?>

<div class="boxCenter">
<form action="<?php echo $llAppOnServer.'&p=action&action='.$_GET['action'].(isset($_GET['id']) ? '&id='.$_GET['id'] : '' );?>" enctype="multipart/form-data" method="post" class="form">
	<fieldset>
		<div>
			<table>
				<tr>
					<td>
						<label>Autor</label>
						<input id="author" name="author" value="<?php echo $action == 'edit'?$formItens['author']:""; ?>"/>
					</td>
					<td>
						<label>Data</label>
						<input id="date" name="date" value="<?php echo $action == 'edit'? date('d/m/Y H:i:s',strtotime($formItens['date'])):""; ?>" disabled="disabled"/>
					</td>
				</tr>
			</table>
		</div>

		<div>
			<label>Mensagem</label>
			<textarea id="post" name="post" ><?php echo $action == 'edit'?$formItens['post']:""; ?></textarea>
		</div>
		
		<div>			
			<?php
			$urlImagem = '../uploads/postinit/'.$formItens['imagem'];
			if(!file_exists($urlImagem) || $formItens['imagem'] == ''){
				$urlImagem = $pluginPasta.'/img/sem-foto.jpg';
			}
			?>
			<img src="<?php echo $urlImagem; ?>" width="100" height="100"/>
		</div>
		
		<?php 
		$file = new fileup; 					//inicia a classe
		$file->titulo = 'Foto do Autor'; 				//titulo da Label
		$file->rotulo = 'Selecionar imagem'; 	// texto do botão
		$file->registro = $formItens['imagem'];
		$file->campo = 'imagem'; 				//campo do banco de dados (no retorno no formulario ele irá retornar um $_POST com essa chave, no caso do exemplo $_POST['imagem'])
		$file->extencao = 'png jpg'; 			//extenções permitidas para o upload, se deixar em branco será aceita todas
		$file->form(); 				 			// executa a classe
		?>
		
	</fieldset>

	<div class="botoes">
		<button type="submit">Salvar</button>
	</div>
</form>
</div>

<script type="text/javascript">
	ajustaForm();
	
	<?php if($advancedEditor){ ?>
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "lliure",
		width: '100%',

		plugins : "safari,pagebreak,style,layer,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,preview,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,nonbreaking,xhtmlxtras,template,icode",

		// Theme options
		theme_advanced_buttons1 : "cut,copy,paste,|,formatselect,|,bold,italic,underline,strikethrough,|,bullist,numlist,|,forecolor,backcolor,|,link,|,code,removeformat,fullscreen",
		theme_advanced_buttons2 : "",
		
		theme_advanced_buttons3 : "",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_resizing : true,

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234",
			
		}
	});
	<?php } ?>
</script>
