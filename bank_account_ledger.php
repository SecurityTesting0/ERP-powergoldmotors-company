<?php
 
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
include("lib/function.php");
$db = new Database();
$fm = new Formate();


if (isset($_POST['submit'])){
	$from 	= $_POST['from'];
	$to 	= $_POST['to'];
	$account=$_POST['account'];
}else{
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

//set font to arial, regular, 12pt

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
$pdf->Cell(180	,10,'Bank Account Ledger',0,1,'C');

//Show Date  
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10	,8,'',0,0,'C' );
$pdf->Cell(15	,8,'From:',0,0,'L');
$pdf->Cell(30	,8,$from,0,0,'L');
$pdf->Cell(10	,8,'To:',0,0,'L');
$pdf->Cell(20	,8,$to,0,1,'L');
$pdf->Cell(10	,8,'',0,0,'C' );
$pdf->Cell(20	,8,'Account:',0,0,'L');
$pdf->Cell(50	,8,$account,0,0,'L');
$pdf->Cell(27	,8,'Bank Name:',0,0,'L');

$query="SELECT * From bank_details where date>='$from' and date<='$to'
and account=$account limit 1";
$results=$db->select($query);
if($results==true){
	while($rs=$results->fetch_assoc()){
	$code=$rs['account_code'];
		$qr2="SELECT * FROM bank_info where code='$code'";
			$r2=$db->select($qr2); 
			if ($r2==true){	
				while($rs2=$r2->fetch_assoc()){ 

$pdf->Cell(50	,8,$rs2['name'],0,1,'L'); 
 
}}}}



//purchase & Stock Area 
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(2,112,38); 
 
//head area
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(10	,8,'',0,0,'C' );
$pdf->Cell(20	,8,'S.L',1,0,'C',true);
$pdf->Cell(40	,8,'Deposite Date',1,0,'C',true);
$pdf->Cell(70	,8,'Note',1,0,'C',true); 
$pdf->Cell(40	,8,'Amount',1,1,'C',true); 


//total purchase product 
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);

$query3="SELECT * From bank_details where date>='$from' and date<='$to'
and account=$account";
$id=0;
$results3=$db->select($query3);
if($results3==true){
	while($rs3=$results3->fetch_assoc()){
		$id++;
		
	$pdf->Cell(10	,7,'',0,0,'C' );
	$pdf->Cell(20	,7,$id,1,0,'C');
	$pdf->Cell(40	,7,$rs3['date'],1,0,'C');
	$pdf->Cell(70	,7,$rs3['notes'],1,0,'C'); 
	$pdf->Cell(40	,7,number_format((float)$rs3['amount_credit'], 2, '.', ','),1,1,'C'); 
	  
 
 }
}

$query4="SELECT SUM(amount_credit) as total From bank_details where date>='$from' and date<='$to'
and account=$account";
$results4=$db->select($query4);
$id=0; 
if($results4==true){
	while($rs4=$results4->fetch_assoc()){
//total purchase product 

	
	
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFillColor(223,240,216);
	$pdf->Cell(10	,7,'',0,0,'C' ); 
	$pdf->Cell(130	,7,'Total=',1,0,'R',true); 
	$pdf->Cell(40	,7,number_format((float)$rs4['total'], 2, '.', ','),1,1,'C',true); 
	
	
		/* $grtotal=$rs4['total'];
		$gr=numberTowords($grtotal); 
		
		$pdf->Cell(35	,10,'',0,1,'C');
		$pdf->Cell(10	,10,'',0,0,'C');
		$pdf->Cell(20	,10,'In Word:',0,0,'C');
		$pdf->Cell(100	,10,$gr.' TAKA ONLY',0,1,'L'); */
			  
	
}}
 

$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(10	,7,'',0,0,'C' );
$pdf->Cell(20	,4,'--------------------------',0,0,'L');//end of line
$pdf->Cell(150	,4,'------------------------------------',0,1,'R');//end of line
$pdf->Cell(10	,7,'',0,0,'C' );
$pdf->Cell(20	,4,'Signature Cashier',0,0,'L');//end of line
$pdf->Cell(150	,4,'Signature Chairman/M.D',0,0,'R');//end of line

$filename="bank-account-ledger";
$pdf->Output($filename,'I');  
?>			 			  
			