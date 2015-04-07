<!--<link rel="stylesheet" href="result-pager.style.css"/>-->
<?php
require_once 'result-pager.class.php';
$con = mysql_connect('localhost','root','vertrigo');
mysql_select_db('synapseshub',$con);

//Init the class object
$pager = new ResultPager('Select * from br_estado');

$pager->loadStyles();
//query with pagination
$qry = $pager->doQuery();

while($rs = mysql_fetch_assoc($qry)){
    echo $rs['nome'],'<br/>';
}

//call pagination links
$pager->listClass = 'theme-yellow opt-pos-right opt-round opt-size-big';
$pager->generateList();

mysql_close($con);
?> 
