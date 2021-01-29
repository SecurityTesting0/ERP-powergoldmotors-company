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


	if (isset($_POST['submit'])){
		$from 			= $_POST['from'];
		$to 			= $_POST['to'];
	} else{
		echo"No Data Found";
	}
						
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

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


	}
}

//end header information 

//show title 
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(2,112,38);
$pdf->Cell(190	,10,'Expense Ledger',0,1,'C');

//Show Date  
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(10	,7,'',0,0,'L');
$pdf->Cell(17	,7,'Duration:',0,0,'L');
$pdf->Cell(12	,7,'From:',0,0,'L');
$pdf->Cell(25	,7,$from,0,0,'L');
$pdf->Cell(8	,7,'To:',0,0,'L');
$pdf->Cell(20	,7,$to,0,1,'L');

 
 
//Table Head
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);//Head Color 
$pdf->Cell(10	,7,'',0,0,'L');
$pdf->Cell(10	,10,'S.L',1,0,'C',true);
$pdf->Cell(25	,10,'Invoice Date',1,0,'C',true);
$pdf->Cell(40	,10,'Head',1,0,'C',true);
$pdf->Cell(65	,10,'Narration',1,0,'C',true);
$pdf->Cell(40	,10,'Amount',1,1,'C',true);//end of line


//Table Boday 
$query="SELECT * FROM `expens` where date>= '$from' and date<= '$to' ";						
	$results=$db->select($query);
	$id=0; 
if ($results){	
	while($rs=$results->fetch_assoc()){
	$id++;
				 
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10	,7,'',0,0,'L');
$pdf->Cell(10	,6,$id,1,0,'C');
$pdf->Cell(25	,6,$rs['date'],1,0,'C');
//head check 
	$cxid=$rs['head_id'];
	$queryh="SELECT * FROM expens_head where id='$cxid'";
	$ctres=$db->select($queryh);
	if ($ctres==true){
		while($catres=$ctres->fetch_assoc()){
			$pdf->Cell(40	,6,$catres['expense_head'],1,0,'C');
		}
	}else{
		echo "";
	}
//head check 

$pdf->Cell(65	,6,$rs['narration'],1,0,'C');							
$pdf->Cell(40	,6,number_format((float)$rs['amount'], 2, '.', ','),1,1,'C');//end of line

	}
}


//End Table Boday 

$querysum="SELECT SUM(amount) AS amount from `expens` where date>= '$from' and date<= '$to'";
						
$ressum=$db->select($querysum);
	if ($ressum){	
		while($rssu=$ressum->fetch_assoc()){
			$pdf->SetFont('Arial','B',10);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(223,240,216);//Head Color 
			$pdf->Cell(10	,7,'',0,0,'L');
			$pdf->Cell(140	,10,'Total=',1,0,'R',true);
			$pdf->Cell(40	,10,number_format((float)$rssu['amount'], 2, '.', ','),1,1,'C',true);//end of line
			
	$grtotal=$rssu['amount'];			
	$gr=numberTowords($grtotal);
		
	$pdf->Cell(25	,10,'',0,1,'C');
	$pdf->Cell(10	,10,'',0,0,'C');
	$pdf->Cell(20	,10,'IN WORD:',0,0,'C');
	$pdf->Cell(100	,10,$gr.'TAKA ONLY',0,1,'L');
	
	}
}
	
	
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(10	,10,'',0,0,'C');
$pdf->Cell(20	,4,'------------------',0,0,'L');//end of line
$pdf->Cell(160	,4,'----------------------------',0,1,'R');//end of line
$pdf->Cell(10	,10,'',0,0,'C');
$pdf->Cell(20	,4,'Cashier',0,0,'C');//end of line
$pdf->Cell(155	,4,'Chairman/MD',0,0,'R');//end of line


$filename="ec-ledger";
$pdf->Output($filename,'I');  
?>			 			  
			