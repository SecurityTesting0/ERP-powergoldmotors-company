<?php
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
$pdf->Image('img/logosingle.png',20,10,30,30);
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
$pdf->Cell(180	,10,'Sales Reports',0,1,'C');

//Show Date  
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(65	,8,'From:',0,0,'R');
$pdf->Cell(30	,8,$from,0,0,'L');
$pdf->Cell(10	,8,'To:',0,0,'L');
$pdf->Cell(20	,8,$to,0,1,'L');


 
//head area
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,8,'INV. NO.',1,0,'C',true);
$pdf->Cell(25	,8,'Date',1,0,'C',true);
$pdf->Cell(55	,8,'Distributor Name',1,0,'C',true);
$pdf->Cell(40	,8,'Dues Amount',1,0,'C',true); 
$pdf->Cell(40	,8,'Paid Amount',1,1,'C',true); 


//total purchase product 
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);

$query="SELECT * from invoices where created>='$from' and created<='$to' and reciept_cat=1 order by id DESC"; 
$results=$db->select($query);
$id=0;
	if($results){
		while($rs=$results->fetch_assoc()){
			$id++; 	
		$distid=$rs['distributor_id'];
		
		$pdf->Cell(20	,6,$rs['id'],1,0,'C');
		$pdf->Cell(25	,6,$rs['created'],1,0,'L');
		
		
		$query2="SELECT * from distributor where ac=$distid"; 
		$results2=$db->select($query2);
								
		if($results2){
			while($rs2=$results2->fetch_assoc()){
			$name=$rs2['first_name'].' '.$rs2['last_name']; 
			$pdf->Cell(55	,6,$name,1,0,'L'); 
			}
		}
 
		$pdf->Cell(40	,6,number_format((float)$rs['amount_due'], 2, '.', ','),1,0,'C'); 
		$pdf->Cell(40	,6,number_format((float)$rs['amount_paid'], 2, '.', ','),1,1,'C'); 
	}
	
 }
 	
	$query="SELECT SUM(amount_due) as due, SUM(amount_paid) as paid from invoices where created>='$from' and created<='$to' and reciept_cat=1
	and reciept_cat=1 order by id DESC"; 
	$results=$db->select($query);
	$id=0;
	if($results){
       while($rs=$results->fetch_assoc()){ 
	  $pdf->Cell(100,6,'Total=',1,0,'R',true);
	  $pdf->Cell(40	,6,number_format((float)$rs['due'], 2, '.', ','),1,0,'C',true); 
	  $pdf->Cell(40	,6,number_format((float)$rs['paid'], 2, '.', ','),1,1,'C',true); 
	}
	
 }	
	
	
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(20	,4,'--------------------------',0,0,'L');//end of line
$pdf->Cell(160	,4,'------------------------------------',0,1,'R');//end of line
$pdf->Cell(20	,4,'Signature Cashier',0,0,'L');//end of line
$pdf->Cell(160	,4,'Signature Chairman/M.D',0,0,'R');//end of line

$filename="Summery-ledger";
$pdf->Output($filename,'I');  
?>			 			  
			