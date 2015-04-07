<?php 
/**
 * ResultPager Class for PHP and MySQL
 * 
 * @Version/Versão: 1.5
 * @Author/Autor: Carlos Alberto Bertholdo Carucce <carloscarucce@gmail.com>
 * @LICENSE/LICENÇA: http://opensource.org/licenses/LGPL-3.0 GNU Lesser General Public License, version 3.0+
 * 
 * *** Tested using PHP 5.2.X and MySQL 5.0.7 ***
*/
class ResultPager{
    public  $connection,
            $query,
            $rows,
            $page,
            $paginationRange,
            $linkFormat,
            $listClass,
            $textFirst,
            $textLast,
			$textPrevious,
			$textNext;
    
    public function doQuery(){
        $qry = $this->prepQuery();
		
		if($this->connection != null){
			return mysql_query($qry,$this->connection);
		}else{
			return mysql_query($qry);
		}
    }
    
    public function prepQuery(){
		$this->checkErrors();
        $start = ($this->rows*$this->page)-$this->rows;
        $end = $this->rows;
		
		return 'SELECT * FROM ('.$this->query.') AS rp_tmp LIMIT '.$start.','.$end;
	}
    
    public function generateLinks(){
        $links = array();
        
        $this->checkErrors();
        
        $result = null;
		if($this->connection != null){
			$result = mysql_query($this->query,$this->connection);
		}else{
			$result = mysql_query($this->query);
		}
        $max = mysql_num_rows($result);
        $max = ceil($max/$this->rows);
        
        if($max > 0 && $this->page != 1){ 
            $links[]= '<a href="'.$this->makeURL(1).'" class="page-link">'.$this->textFirst.'</a>'; 
			$links[]= '<a href="'.$this->makeURL($this->page-1).'" class="page-link">'.$this->textPrevious.'</a>';
        }
        
        for($i = $this->page - $this->paginationRange; $i <= $this->page + $this->paginationRange; $i++){
            if($i>0 && $i<=$max){
                if($i != $this->page)
					$links[] = '<a href="'.$this->makeURL($i).'" class="page-link">'.$i.'</a>';
				else
					$links[] = '<span class="page-link current">'.$i.'</span>';
            }
        }
        
        if($max > 0 && $this->page != $max){ 
			$links[]= '<a href="'.$this->makeURL($this->page+1).'" class="page-link">'.$this->textNext.'</a>';
            $links[]= '<a href="'.$this->makeURL($max).'" class="page-link">'.$this->textLast.'</a>';
        }
        
        return $links;
    }
    
    public function generateList(){
        $links = $this->generateLinks();
        
        if(count($links) > 1){
			echo '<ul class="rp-pagination '.$this->listClass.'">';
			foreach($links as $link){
				echo '<li>'.$link.'</li>';
			}
			echo '</ul>';
		}
    }

    public function __construct($query = null) {
        //Basic
        $this->connection = null;
        $this->query = $query;
        $this->rows = 10;
        
        //Link list
        $this->paginationRange = 3;
        $this->listClass = 'pagination';
        $this->textFirst = 'First';
        $this->textLast = 'Last';
		$this->textPrevious = 'Previous';
		$this->textNext = 'Next';
        
        //Link URLs
        $this->makeLinkFormat();
        $this->page = !empty($_GET['page'])? $_GET['page']:1;
    }
	
	public function loadStyles(){
		$styles = file_get_contents(dirname(__FILE__).'/result-pager.style.css');
		echo '<style>'.$styles.'</style>';
	}

    private function checkErrors(){
        if($this->page <= 0)
            $this->stop('Incorrect value given on "page" parameter.<br/>Value given is: '.$this->page);
        //Put possible checks here
    }
    
    private function makeURL($pageNumber){
        return ($pageNumber != $this->page)? str_replace('%page', $pageNumber, $this->linkFormat): '#';
    }
    
    private function makeLinkFormat(){
        $theProtocol = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) ? 'http' : 'https';
        $thePath = $theProtocol.'://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
        $theParams = array();
        
        $gts = $_GET;
        $gts['page'] = '%page';
        foreach($gts as $k=>$v){
            $theParams[] = $k.'='.$v;
        }
        $theParams = implode('&', $theParams);
        $this->linkFormat = $thePath.'?'.$theParams;
    }

    private function stop($message){
        die($message);
    }
}
?>
