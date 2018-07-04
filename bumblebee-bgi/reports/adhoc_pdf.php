<?php

	require('adhoc-generate.php');
 
	require('../dompdf/fpdf.php');

	function unichr($u) {
    	return mb_convert_encoding('&#' . intval($u) . ';', 'UTF-8', 'HTML-ENTITIES');
	}


$dataArray = [];
$previousRow = [];

foreach($resultData as $key=>$row){
 $previousRow[$key]=$row;
  if(isset($previousRow[$key-1]) && $previousRow[$key-1]['Id']==$row['Id']){
    foreach($row as $key_in=>$val){
       if($previousRow[$key-1][$key_in]==$val){
          $row[$key_in] = '//';
       }
  }
}
  

    array_push($dataArray, $row);
  //echo isset($row['FROM_GH']) ? 'set' :'not set';
 //print_r($row);exit;
} // end of foreach
	$size = array(count($columns)*73, 1008);
	$pdf = new FPDF('P', 'mm',$size);
	$pdf->AddPage('P', $size, 0); 
	$pdf->SetFont('Arial','B',12);	
	//$pdf->AddFont('FontAwesome','','fontawesome-webfont.php');	
	
	//$pdf->SetDisplayMode('fullpage', 'two');	
	//$pdf->Cell(count($columns)*72,12,'Ad-hoc Report',1);
	if(isset($_SESSION['reportName']) && !empty($_SESSION['reportName'])) {
		$reportName = $_SESSION['reportName'];
	} else {
		$reportName = 'Ad-hoc Report';
	}
	$pdf->Cell(count($columns)*72,12, $reportName, 0, 0, 'L');
	$pdf->Ln();
	foreach($columns as $heading) {
		$pdf->Cell(70,12,$heading,1);
	}
$totalLine = 1;
	foreach($dataArray as $row) {
		$pdf->SetFont('Arial','',12);
		if(isset($row['FROM_GH']) ){
			//$pdf->SetFont('FontAwesome','',12);	
			$row['FROM_GH'] = unichr(10004);
		}else{
			$pdf->SetFont('Arial','',12);
		}

		$pdf->Ln();
		$maxlen = 0;
		foreach($row as $column){
			$len = strlen($column);
			if($len > $maxlen){
				$maxlen = $len;
			}
		}
		$charPerLine = 24;
		$totalLine = ceil($maxlen/$charPerLine);
		
		foreach($row as $column){
			$colLength = strlen($column);
			if($colLength > $charPerLine) { // if text length exceeds from 35 characters, then wrap it
				$lines = ceil($colLength/$charPerLine);
				for($i=1; $i<=$lines; $i++){
					$column = substr_replace($column, "\n", $charPerLine*$i, 0);
				} // end of for
			}
			//echo $column.'<br>';
			//$pdf->Cell(70,12*$totalLine,$column,1);
			$x = $pdf->GetX();
			$y = $pdf->GetY();
			if ($y >= 900) {
			    $pdf->AddPage();
			    $y = 10; // should be your top margin
			}
			if($colLength>$charPerLine) 
				$height = 12;
			else $height = 12*$totalLine;
			$pdf->MultiCell(70,$height,$column,1,1);
			$x = $x + 70;
			$pdf->SetXY($x, $y);
		}
		//exit;
	}
	$pdf->Output();
 ?>