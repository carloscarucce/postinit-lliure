<?php
require_once('conf.php');

$sql = "select * from ".$pluginTable." order by id desc";
$pager= new ResultPager($sql);
$pager->rows = $regPerPage;
$qry = $pager->doQuery();
$nr = mysql_num_rows($qry);

echo "<div class='boxCenter900'><table class='table' style='margin-bottom: 20px;'>";
echo 
	"<tr>
		<th>ID</th>
		<th style='width: 132px'>Data</th>
		<th>Autor</th>
		<th>Mensagem</th>
		<th class='ico'></th>
		<th class='ico'></th>
	</tr>";
while ($rs = mysql_fetch_assoc($qry)){
	echo 
	"<tr>
		<td>".$rs['id']."</td>
		<td>".date('d/m/Y H:i:s', strtotime($rs['date']))."</td>
		<td>".$rs['author']."</td>
		<td>".substr($rs['post'], 0, 30)."...</td>
		<td><a href='".$llAppHome."&p=form&action=edit&amp;id=".$rs['id']."'><img src='".$plgIcones."pencil.png'></a></td>
		<td><a href='".$llAppOnServer."&p=action&action=delete&amp;id=".$rs['id']."' onclick='return confirm(\"Esta certo disso?\")'><img src='".$plgIcones."trash.png'></a></td>
	</tr>";
}

if($nr < 1)
	echo '<tr><td colspan="6">Nenhum registro encontrado.</td></tr>';
echo "</table>";

/* Configuração dos links */
$pager->textNext = '>';
$pager->textLast = '>>';
$pager->textPrevious = '<';
$pager->textFirst = '<<';

/* Estilos da lista */
$pager->loadStyles();
$pager->listClass = 'theme-grey-inverse opt-pos-center opt-round opt-size';
$pager->generateList();
echo "</div>";
?>
