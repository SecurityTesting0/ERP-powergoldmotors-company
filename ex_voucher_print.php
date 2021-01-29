<?php


error_reporting(0);
function numberTowords($num)
{

$ones = array(
0 =>"ZERO",
1 => "ONE",
2 => "TWO",
3 => "THREE",
4 => "FOUR",
5 => "FIVE",
6 => "SIX",
7 => "SEVEN",
8 => "EIGHT",
9 => "NINE",
10 => "TEN",
11 => "ELEVEN",
12 => "TWELVE",
13 => "THIRTEEN",
14 => "FOURTEEN",
15 => "FIFTEEN",
16 => "SIXTEEN",
17 => "SEVENTEEN",
18 => "EIGHTEEN",
19 => "NINETEEN",
"014" => "FOURTEEN"
);
$tens = array( 
0 => "ZERO",
1 => "TEN",
2 => "TWENTY",
3 => "THIRTY", 
4 => "FORTY", 
5 => "FIFTY", 
6 => "SIXTY", 
7 => "SEVENTY", 
8 => "EIGHTY", 
9 => "NINETY" 
); 
$taka='TK ONLY';
$hundreds = array( 
"HUNDRED", 
"THOUSAND", 
"MILLION", 
"BILLION", 
"TRILLION", 
"QUARDRILLION" 
); /*limit t quadrillion */
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr,1); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){
	
while(substr($i,0,1)=="0")
		$i=substr($i,1,5);
if($i < 20){ 
/* echo "getting:".$i; */
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 

} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
}
} 
if($decnum > 0){
$rettxt .= " and ";
if($decnum < 20){
$rettxt .= $ones[$decnum];
}elseif($decnum < 100){
$rettxt .= $tens[substr($decnum,0,1)];
$rettxt .= " ".$ones[substr($decnum,1,1)];
}
}
return $rettxt;
}


require('pdf/fpdf.php');
include("lib/config.php");
include("lib/database.php");
include("lib/helper.php");
$db = new Database();
$fm = new Formate();


if (empty($_GET['exvid'])){
}elseif(!isset($_GET['exvid']) || $_GET['exvid'] == NULL){
	echo 'Something went to wrong';
}else{
		$tid= $_GET['exvid'];
		$id= preg_replace("/[^0-9a-zA-Z]/", "", $tid);
		$rid = $id;
		}


class PDF extends FPDF {  
	function Footer() {   
		$this->SetY(-15); // Arial italic 8
		$this->SetFont('Arial','I',7);	// Page number
		$this->Cell(130,2,'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,1,'L'); 
		$this->Cell(70,5,'Software Developed By: Ibrahim Ali, +8801916859326',0,0,'L'); 
		$this->Cell(50,5,'Printing Date: '.date("Y-m-d h:i:sa") ,0,0,'R');
		$this->Cell(70,5,'Page '.$this->PageNo().'/{nb}',0,0,'R'); 
	}
}		
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','Letter');// for custome page array(100,150)
$pdf = new pdf();
$pdf->AliasNbPages();
$pdf->AddPage();
//set font to arial, bold, 14pt

//header information 


$comquery="SELECT * from company_info";
$res=$db->select($comquery);
if($res){
	while($comres=$res->fetch_assoc()){ 
	$pdf->Image($comres['logo'],20,10,30,30);
	

$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(115	,10,'',0,1,'R'); //end of line  
$pdf->Cell(97	,5,$comres['company_name_first_part'],0,0,'R'); //end of line  
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50	,5,$comres['comapnay_name_last_part'],0,1,'L'); //end of line  

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(45	,5,'',0,0,'L'); //end of line  
$pdf->Cell(190	,5,$comres['address'],0,1,'L'); //end of line  

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(75	,5,'',0,0,'L'); //end of line  
$pdf->Cell(190	,5,$comres['tag'],0,1,'L'); //end of line  
$pdf->Cell(45	,5,'',0,0,'L'); //end of line  
$pdf->Cell(190	,5,'',0,1,'L'); //end of line  

$pdf->Cell(180	,10,'',0,1,'C'); 

	}
}

//end header information 

//show title 
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(2,112,38);
$pdf->Cell(190	,10,'Payment Voucher',0,1,'C');

if ($rid==true){ 
	$query="SELECT * FROM expens WHERE id='$rid'";
	$results=$db->select($query);
	
if ($results){
	while($rs=$results->fetch_assoc()){ 
	$pdf->SetFont('Arial','B',10);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(20	,7,' ',0,0,'L');
		$pdf->Cell(27	,7,'Voucher No',0,0,'L');
		$pdf->Cell(5	,7,':',0,0,'L');
		$pdf->Cell(3	,7,'PV-',0,0,'C');
		$pdf->Cell(8	,7,$rs['id'],0,1,'C');
		$pdf->Cell(20	,7,' ',0,0,'L');
		$pdf->Cell(27	,7,'Narration',0,0,'L');		
		$pdf->Cell(3	,7,':',0,0,'L');		
		$pdf->Cell(112	,7,$rs['narration'],0,1,'L');  
 	  }
	}
}	
 
//Table Head
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);//Head Color 
$pdf->Cell(20	,7,' ',0,0,'L');
$pdf->Cell(45	,5,'Invoice Date',1,0,'C',true);
$pdf->Cell(65	,5,'Description',1,0,'C',true);
$pdf->Cell(40	,5,'Amount',1,1,'C',true);  

//Table Boday 
 
if ($rid==true){ 
	$query="SELECT * FROM expens WHERE id='$rid'";
	$results=$db->select($query);
if ($results){
	while($rs=$results->fetch_assoc()){ 
		$pdf->Cell(20	,7,' ',0,0,'L');
		$pdf->Cell(45	,20,$rs['date'],1,0,'C');

			$headid=$rs['head_id'];
			$query2="SELECT * FROM expens_head WHERE id='$headid'";
			$results2=$db->select($query2);
			if ($results2){
				while($rs2=$results2->fetch_assoc()){ 
						
						$pdf->Cell(65	,20,$rs2['expense_head'],1,0,'C');
		
					}
			}
		
		
		$pdf->Cell(40	,20,number_format((float)$rs['amount'], 2, '.', ','),1,1,'C');  

 //End Table Boday 
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(20	,7,' ',0,0,'L');
$pdf->SetFillColor(223,240,216);//Head Color 
$pdf->Cell(110	,5,'Total=',1,0,'R',true);
$pdf->Cell(40	,5,number_format((float)$rs['amount'], 2, '.', ','),1,1,'C',true); 

 	$grtotal=$rs['amount'];
	$gr=numberTowords($grtotal);
		
	$pdf->Cell(45	,10,'',0,1,'C');
	$pdf->Cell(20	,10,'',0,0,'C');
	$pdf->Cell(20	,10,'IN WORD:',0,0,'C');
	$pdf->Cell(100	,10,$gr.'TAKA ONLY',0,1,'L');
 	  }
	}
}	
	
$pdf->Cell(180	,8,'',0,1,'C'); 
$pdf->Cell(180	,8,'',0,1,'C'); 
$pdf->Cell(20	,7,' ',0,0,'L');
$pdf->Cell(30	,4,'--------------------------',0,0,'L');//end of line
$pdf->Cell(115	,4,'----------------------------',0,1,'R');//end of line
$pdf->Cell(20	,7,' ',0,0,'L');
$pdf->Cell(30	,4,'Cashier',0,0,'C');//end of line
$pdf->Cell(110	,4,'Chairman/MD',0,0,'R');//end of line

$filename="ec-ledger";
$pdf->Output($filename,'I');  
?>			 			  
			