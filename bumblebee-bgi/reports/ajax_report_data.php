<?php  header("Content-Type: text/html; charset=ISO-8859-1");
  define("_VALID_PHP", true);
  require_once("../../admin-panel-bgi/init.php");
  $url = '//' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
  if (!$user->levelCheck("2,9"))
      redirect_to("index.php");
      
?> 
<?php
require('adhoc-generate_new.php');

?>

    <?php if ($user->levelCheck("2,9")) { ?>
   
    <?php
        if(isset($resultData) && (!empty($resultData))){
            foreach($resultData as $row){
                echo '<tr>';
                foreach($row as $column){
                    echo '<td>'.$column.'</td>';
                }  
                echo '</tr>';                                                  
            }
        } else {
            echo '<tr class="no-record"><td>No Record Found</td></tr>';
        }
    ?>
    <?php } 
    ?>                                  
<!-- <div id="data-container" style="display:none"></div>
<div id="pagination-container"></div> -->


<div class="center pagi-wrap">
  <div class="pagination">
    <a href="?page=1&sect=<?=$_REQUEST['sect']?>">First</a>
    <?php
        $lastpage = ceil($totalRecords/10);
        if($page <= 4){
            $pagi_start = 1;
            $page_end = 5;
        }
        else if($page > 4 && $page < $lastpage - 2){
            $pagi_start = $page - 2;
            $page_end = $page + 2;
        } else {
            $pagi_start = $lastpage - 4;
            $page_end = $lastpage;
        }
        if($page != 1)
         echo '<a href="?page='.($page-1).'&sect='.$_REQUEST["sect"].'">Prev</a>';
        for($i = $pagi_start; $i <= $page_end; $i++){
            if($i < $page-3) continue;
            if ($i > $page+3) break;
            $active = ($page == $i) ? 'active':'';
            echo '<a class="'.$active.'" href="?page='.$i.'&sect='.$_REQUEST["sect"].'">'.$i.'</a>';
        }

        if($page != $lastpage)
            echo '<a href="?page='.($page+1).'">Next</a>';
    ?>
    <a href="?page=<?=$lastpage?>&sect=<?=$_REQUEST['sect']?>">Last</a>
  </div>
</div>
