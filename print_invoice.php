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

if (empty($_GET['inv'])){
}elseif(!isset($_GET['inv']) || $_GET['inv'] == NULL){
	echo 'Something went to wrong';
}else{
		$tid= $_GET['inv'];
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

//distributor info
$query1="SELECT * FROM `invoices` where invoice_no=$rid";	 				
$results1=$db->select($query1);
 
if ($results1){	
	while($rs1=$results1->fetch_assoc()){
		$year=date('Y');
		$pdf->Cell(10	,7,' ',0,0,'L');
		$pdf->cell(38, 7,'Invoice No:PGML/'.$year.'/',0,0,'L'); 
		$pdf->Cell(105	,7,$rs1['invoice_no'].' ',0,0,'L');
		$pdf->cell( 10, 7,'Date:',0,0,'L');
		$pdf->cell( 30, 7,$rs1['created'],0,1,'L');
 
	}
}



//show title 
$pdf->SetFont('Arial','',20);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(190	,4,'INVOICE',0,1,'C');
$pdf->Cell(190	,3,'------------',0,1,'C');

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);//Head Color 
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(190	,5,'',0,1,'L'); //end of line  
$pdf->Cell(10	,7,' ',0,0,'L');

//distributor info
$query2="SELECT * FROM `invoices` where invoice_no=$rid";	 				
$results2=$db->select($query2);
$id3=0; 
if ($results2){	
	while($rs2=$results2->fetch_assoc()){
	$id3++;	
		$pdf->cell( 37, 7,'Distributor Name',0,0,'L');
		$pdf->cell( 5, 7,':',0,0,'L');
		
			$discode=$rs2['distributor_id'];
			
				$dis="SELECT * FROM `distributor` where ac=$discode";	 				
				$disn=$db->select($dis);
				if($disn){
				while($disr=$disn->fetch_assoc()){ 
				$pdf->Cell(10	,7,$disr['first_name'].' '.$disr['last_name'],0,1,'L');
				$pdf->Cell(10	,7,' ',0,0,'L');
				$pdf->cell( 37, 7,'Shop Name',0,0,'L');
				$pdf->cell( 5, 7,':',0,0,'L');
				$pdf->cell( 50, 5,$disr['store_name'],0,1,'L');
				$pdf->Cell(10	,7,' ',0,0,'L');
				$pdf->cell( 37, 7,'Address',0,0,'L');
				$pdf->cell( 5, 7,':',0,0,'L');
				$pdf->cell( 50, 7,$disr['Address'],0,1,'L');
				}
			}

		}
}

$pdf->Cell(190	,5,'',0,1,'L'); //end of line  


  
//Table Head
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);//Head Color 
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(10	,7,'S.L',1,0,'C',true);
$pdf->Cell(50	,7,'Item Name',1,0,'C',true);
$pdf->Cell(40	,7,'Quantity',1,0,'C',true);
$pdf->Cell(40	,7,'Unite Price',1,0,'C',true);
$pdf->Cell(35	,7,'Total Price',1,1,'C',true);

//Table Boday 
$query3="SELECT * FROM `invoice_details` where invoice_id=$rid";	 				
$results3=$db->select($query3);
$id3=0; 
if ($results3){	
	while($rs3=$results3->fetch_assoc()){
	$id3++;		 
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(10	,7,$id3,1,0,'C');
			$prcode=$rs3['product_id'];
			$query4="SELECT * FROM `product_table` where product_code=$prcode";	 				
			$results4=$db->select($query4);
			if ($results4){	
				while($rs4=$results4->fetch_assoc()){
					$pdf->Cell(50	,7,$rs4['product_name'],1,0,'C');
				}
			}

$pdf->Cell(40	,7,number_format((float)$rs3['quantity'], 2, '.', ','),1,0,'C');
$pdf->Cell(40	,7,number_format((float)$rs3['price'], 2, '.', ','),1,0,'C');


			$price	=$rs3['price'];
			$qty 	=$rs3['quantity'];
			$total	=$qty*$price;
			
$pdf->Cell(35	,7,number_format((float)$total, 2, '.', ','),1,1,'C');

	}
}

//End Table Boday 

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);//Head Color  


$totalcal="SELECT * FROM `invoices` where invoice_no=$rid";	 				
$invres=$db->select($totalcal);

if ($invres){	
	while($inv=$invres->fetch_assoc()){

$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(140	,7,'Total=',1,0,'R',true);
$pdf->Cell(35	,7,number_format((float)$inv['invoice_subtotal'], 2, '.', ','),1,1,'C',true);
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(140	,7,'Tax % =',1,0,'R',true);
$pdf->Cell(35	,7,$inv['tax'],1,1,'C',true);
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(140	,7,'Tax Amount=',1,0,'R',true);
$pdf->Cell(35	,7,number_format((float)$inv['tax_amount'], 2, '.', ','),1,1,'C',true);
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(140	,7,'Discount=',1,0,'R',true);
$pdf->Cell(35	,7,number_format((float)$inv['discount'], 2, '.', ','),1,1,'C',true);
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(140	,7,'Discount Amount=',1,0,'R',true);
$pdf->Cell(35	,7,number_format((float)$inv['discount_amount'], 2, '.', ','),1,1,'C',true);
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(140	,7,'Paid Amount=',1,0,'R',true);
$pdf->Cell(35	,7,number_format((float)$inv['amount_paid'], 2, '.', ','),1,1,'C',true);
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(140	,7,'Due Amount=',1,0,'R',true);
$pdf->Cell(35	,7,number_format((float)$inv['amount_due'], 2, '.', ','),1,1,'C',true);
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(140	,7,'Grand Total=',1,0,'R',true);
$pdf->Cell(35	,7,number_format((float)$inv['invoice_total'], 2, '.', ','),1,1,'C',true);
	
	$grtotal=$inv['invoice_total'];
	$gr=numberTowords($grtotal);
	
$pdf->Cell(35	,10,'',0,1,'C');
$pdf->Cell(10	,10,'',0,0,'C');
$pdf->Cell(20	,10,'In Word:',0,0,'C');
$pdf->Cell(100	,10,$gr.' TAKA ONLY',0,1,'L');

	}
}



	
	
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(20	,4,'------------------------------',0,0,'L');//end of line
$pdf->Cell(155	,4,'---------------------------',0,1,'R');//end of line
$pdf->Cell(10	,7,' ',0,0,'L');
$pdf->Cell(20	,4,'Customer Signature',0,0,'L');//end of line
$pdf->Cell(152	,4,'Seller Signature',0,0,'R');//end of line


$filename="Distributore Ledger";
$pdf->Output($filename,'I');  
?>			 			  
			