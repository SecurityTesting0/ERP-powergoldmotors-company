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
		$member_code	= $_POST['member_code'];
		$from 			= $_POST['from'];
		$to 			= $_POST['to'];
	} else{
		echo"No Data Found";
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
$pdf->Cell(180	,10,'Distributor Ledger',0,1,'C');

//Show Date  
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(17	,7,'Duration:',0,0,'L');
$pdf->Cell(12	,7,'From:',0,0,'L');
$pdf->Cell(25	,7,$from,0,0,'L');
$pdf->Cell(8	,7,'To:',0,0,'L');
$pdf->Cell(20	,7,$to,0,1,'L');


if ($member_code==true){
 
	$query="SELECT * FROM distributor WHERE ac='$member_code'";
	$results=$db->select($query);
if ($results){
	while($rs=$results->fetch_assoc()){
		//Show Members Name
		$pdf->SetFont('Arial','B',10);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(10	,7,'A/C:',0,0,'L');
		$pdf->Cell(15	,7,$rs['ac'],0,0,'L');
		$pdf->Cell(15	,7,'Name:',0,0,'L');
		$pdf->Cell(70	,7,$rs['first_name'].' '. $rs['last_name'],0,0,'L'); 
		$pdf->Cell(25	,7,'Location:',0,0,'L'); 
			$location=$rs['location_id'];
			$querylo="SELECT * FROM distributor_location WHERE id='$location'";
			$lor=$db->select($querylo);
			if ($lor){
				while($lo=$lor->fetch_assoc()){
			$pdf->Cell(20	,7,$lo['name'],0,1,'L'); 
			}
		}
		
		$pdf->Cell(20	,7,'Address: ',0,0,'L');
		$pdf->Cell(70	,7,$rs['Address'],0,1,'L');
	  }
	}
}	
		


 
 
//Table Head
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);//Head Color 
$pdf->Cell(10	,10,'S.L',1,0,'C',true);
$pdf->Cell(20	,10,'Invoice No',1,0,'C',true);
$pdf->Cell(25	,10,'Invoice Date',1,0,'C',true);
$pdf->Cell(55	,10,'Particular',1,0,'C',true);
$pdf->Cell(25	,10,'Debit',1,0,'C',true);
$pdf->Cell(25	,10,'Credit',1,0,'C',true); 
$pdf->Cell(30	,10,'Balance',1,1,'C',true);//end of line

	
//Opening Balance
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10	,7,'--',1,0,'C');
$pdf->Cell(20	,7,'--',1,0,'C');
$pdf->Cell(25	,7,'--',1,0,'C');
$pdf->Cell(55	,7,'Opening Balance',1,0,'C'); 

$Opquery ="select 
concat(sum(invoice_subtotal-amount_paid)) as opbalance
from invoices 
where created between '2000-01-01' AND date_sub('$from', INTERVAL 1 DAY) 
	AND distributor_id='$member_code' "; 
  
  $getOp=$db->select($Opquery); 
	if ($getOp){
		
		while($oprs=$getOp->fetch_assoc()){ 
	 
		 $balance	=$oprs['opbalance']; 
		  if($balance >=1){
				$pdf->Cell(25	,7,number_format((float)$balance, 2, '.', ','),1,0,'C');
				 
			 }else {
				$pdf->Cell(25	,7,'0',1,0,'C');  
			 }
		if($balance <=0){
			 $pdf->Cell(25	,7,number_format((float)$balance, 2, '.', ','),1,0,'C');
		 }else {
			 $pdf->Cell(25	,7,'0',1,0,'C');
		 }
$pdf->Cell(30	,7,number_format((float)$balance, 2, '.', ','),1,1,'C');//end of line
	}
}
//End Opening Balance

//Table Boday 
$query3="SELECT * FROM `invoices` where distributor_id='$member_code' and created>= '$from' and created<= '$to' ";	 				
$results3=$db->select($query3);
$id3=0; 
if ($results3){	
	while($rs3=$results3->fetch_assoc()){
	$id3++;
	$inv='INV-';				 
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10	,10,$id3,1,0,'C');
$pdf->Cell(20	,10,$inv.$rs3['id'],1,0,'C');
$pdf->Cell(25	,10,$rs3['created'],1,0,'C');
$pdf->Cell(55	,10,$rs3['notes'],1,0,'C');
$pdf->Cell(25	,10,number_format((float)$rs3['amount_due'], 2, '.', ','),1,0,'C');
$pdf->Cell(25	,10,number_format((float)$rs3['amount_paid'], 2, '.', ','),1,0,'C'); 

$debit		=$rs3['invoice_subtotal'];
$credit 	=$rs3['amount_paid'];
$balance	+=$debit-$credit;
								
$pdf->Cell(30	,10,number_format((float)$balance, 2, '.', ','),1,1,'C');//end of line

 
	}
}


//Table foot 
$queryf="SELECT SUM(amount_paid) AS paid, SUM(amount_due) as credit_amount, SUM(amount_due) as due FROM `invoices` where distributor_id='$member_code' and created>= '$from' and created<= '$to'";
$resultsf=$db->select($queryf);
 
if ($resultsf){
	while($rsf=$resultsf->fetch_assoc()){
 
	$inv='INV-';				 
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0); 
$pdf->Cell(110	,10,'Total=',1,0,'R');
$pdf->Cell(25	,10,number_format((float)$rsf['due'], 2, '.', ','),1,0,'C');
$pdf->Cell(25	,10,number_format((float)$rsf['paid'], 2, '.', ','),1,0,'C'); 
 
								
$pdf->Cell(30	,10,'',1,1,'C');//end of line

 
	}
}

//End Table Boday 


	
	
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(20	,4,'--------------------',0,0,'L');//end of line
$pdf->Cell(160	,4,'--------------------------',0,1,'R');//end of line
$pdf->Cell(20	,4,'Cashier',0,0,'L');//end of line
$pdf->Cell(160	,4,'Chairman/M.D',0,0,'R');//end of line


$filename="Distributore Ledger";
$pdf->Output($filename,'I');  
?>			 			  
			