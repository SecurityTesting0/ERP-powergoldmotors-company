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
$pdf->Cell(180	,10,'Income and Expenditure Accounts Report',0,1,'C');

//Show Date  
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(65	,8,'From:',0,0,'R');
$pdf->Cell(30	,8,$from,0,0,'L');
$pdf->Cell(10	,8,'To:',0,0,'L');
$pdf->Cell(20	,8,$to,0,1,'L');





//purchase & Stock Area 
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(2,112,38);
$pdf->Cell(180	,10,'Purchase & Stock ',0,1,'C');

//head area
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,8,'S.L',1,0,'C',true);
$pdf->Cell(120	,8,'Particular',1,0,'C',true);
$pdf->Cell(45	,8,'Amount',1,1,'C',true); 


//total purchase product 
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);

$query6="SELECT sum(purchase_total) as ptotal from purches_product where date>='$from' and date<='$to'"; 
$res6=$db->select($query6);
if (!empty($res6)){
	while($rs6=$res6->fetch_assoc()){
		$ptotal=$rs6['ptotal']; 
	}	
		$pdf->Cell(20	,6,'01',1,0,'C');
		$pdf->Cell(120	,6,'Total Product Purchase ',1,0,'L');
		$pdf->Cell(45	,6,number_format((float)$ptotal, 2, '.', ','),1,1,'C'); 
	}else{
		
		$pdf->Cell(20	,6,'01',1,0,'C');
		$pdf->Cell(120	,6,'Total Product Purchase ',1,0,'L');
		$pdf->Cell(45	,6,'0.00',1,1,'C'); 
	}

//total stock with puchase price
$stocktotal=Stock($db,$from,$to); 

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,6,'02',1,0,'C');
$pdf->Cell(120	,6,'Total Stock (Purchase Price)',1,0,'L');
$pdf->Cell(45	,6,number_format((float)$stocktotal, 2, '.', ','),1,1,'C'); 



$stokplis=Stockposibilityincome($db,$from,$to); 
//posibility income
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,6,'03',1,0,'C');
$pdf->Cell(120	,6,'Possiblity Stock Income',1,0,'L');
$pdf->Cell(45	,6,number_format((float)$stokplis, 2, '.', ','),1,1,'C'); 
//End purchase & Stock Area 



//Sales Area 
 
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(2,112,38);
$pdf->Cell(180	,10,'Sales',0,1,'C');

//head area
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,8,'S.L',1,0,'C',true);
$pdf->Cell(120	,8,'Particular',1,0,'C',true);
$pdf->Cell(45	,8,'Amount',1,1,'C',true); 
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216); 

//total sales
$totalsales=TotalSalesSalesPrice($db,$from,$to); 

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,6,'01',1,0,'C');
$pdf->Cell(120	,6,'Total Sales',1,0,'L');
$pdf->Cell(45	,6,number_format((float)$totalsales, 2, '.', ','),1,1,'C'); 

//paid amount with tax
$paidfun=PaidAmount($db,$from,$to);  
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,6,'02',1,0,'C');
$pdf->Cell(120	,6,'Total Paid Amount (With Tax)',1,0,'L');
$pdf->Cell(45	,6,number_format((float)$paidfun, 2, '.', ','),1,1,'C'); 


//total sales
$totalsales=TotalSalesSalesPrice($db,$from,$to); 

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,6,'03',1,0,'C');
$pdf->Cell(120	,6,'Total Sales',1,0,'L');
$pdf->Cell(45	,6,number_format((float)$totalsales, 2, '.', ','),1,1,'C'); 

 
//total sales dues
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,6,'04',1,0,'C');
$pdf->Cell(120	,6,'Total Sales Dues',1,0,'L');
$duesfun=DuesAmount($db,$from,$to);
	if ($duesfun>0){
			$pdf->Cell(45	,6,number_format((float)$duesfun, 2, '.', ','),1,1,'C'); 
	}else{
		$pdf->Cell(45	,6,'0.00',1,1,'C'); 
		
		
	} 
	
//Total Sales Profit
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,6,'05',1,0,'C');
$pdf->Cell(120	,6,'Total Sales Profit',1,0,'L');

		$tpsales=TotalSalesSalesPrice($db,$from,$to); 
		$tppsales=TotalSalesPurchasePrice($db,$from,$to); 
		$totalprofit=$tpsales-$tppsales; 
	if ($totalprofit>0){
			$pdf->Cell(45	,6,number_format((float)$totalprofit, 2, '.', ','),1,1,'C'); 
	}else{
		$pdf->Cell(45	,6,'0.00',1,1,'C'); 
		
		
	} 
 
//End Sales Area 



//bank deposit Area 
 
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(2,112,38);
$pdf->Cell(180	,10,'Bank Deposit',0,1,'C');

//head area
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,8,'S.L',1,0,'C',true);
$pdf->Cell(120	,8,'Particular',1,0,'C',true);
$pdf->Cell(45	,8,'Amount',1,1,'C',true); 
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216); 
 
//total sales
$bankdeposit=bankdeposit($db,$from,$to); 
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,6,'01',1,0,'C');
$pdf->Cell(120	,6,'All Bank Deposit Amount',1,0,'L');
$pdf->Cell(45	,6,number_format((float)$bankdeposit, 2, '.', ','),1,1,'C');  
//end  bank deposit area

//show title 
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(2,112,38);
$pdf->Cell(180	,10,'Expendetures',0,1,'C');

//income table 
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);
$pdf->Cell(20	,8,'S.L',1,0,'C',true);
$pdf->Cell(120	,8,'Particular',1,0,'C',true);
$pdf->Cell(45	,8,'Amount',1,1,'C',true); 





/* $query2="SELECT SUM(salary_amount) as amount FROM `salary_payment` where
	invoice_date>= '$from' and invoice_date<= '$to' ";						
	$sares=$db->select($query2); 
	if ($sares){ 
		while($srs=$sares->fetch_assoc()){
	$pdf->SetFont('Arial','',10);
	$pdf->SetFillColor(223,240,216);
	$pdf->Cell(20	,6,'1',1,0,'C');
	$pdf->Cell(120	,6,'Employee Salary',1,0,'L');
	$pdf->Cell(45	,6,number_format((float)$srs['amount'], 2, '.', ','),1,1,'C');
	}
} */

$chk="SELECT * FROM expens_head";
$check=$db->select($chk);
$id=0; 
if($check){
	while ($chrs=$check->fetch_assoc()){
	$id++;
	$head_id=$chrs['id'];
		
	$query3="SELECT SUM(amount) as amount FROM `expens` where head_id=$head_id 
	and date>= '$from' and date<= '$to' ";						
	$results3=$db->select($query3);

	if ($results3){	
	 
	while($rsw=$results3->fetch_assoc()){
	$pdf->SetFont('Arial','',10);
	$pdf->SetFillColor(223,240,216);
	$pdf->Cell(20	,6,'0'.$id.'',1,0,'C');
	$pdf->Cell(120	,6,$chrs['expense_head'],1,0,'L');
	$pdf->Cell(45	,6,number_format((float)$rsw['amount'], 2, '.', ','),1,1,'C'); 
		
		
}}}}


	$pdf->SetFont('Arial','',10);
	$pdf->SetFillColor(223,240,216); 
	$pdf->Cell(140	,6,'Total Expense=',1,0,'R');
	$ex=expnes($db,$from,$to);
	$pdf->Cell(45	,6,number_format((float)$ex, 2, '.', ','),1,1,'C');
	
	$pdf->Cell(110	,10,' ',0,1,'R');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(223,240,216); 
	$pdf->Cell(90	,6,' ',0,0,'R');
	$ex=expnes($db,$from,$to);
	$pdf->Cell(50	,6,'Total Sales Profit=',1,0,'R');
	$pdf->Cell(45	,6,number_format((float)$totalprofit, 2, '.', ','),1,1,'C',true);
	
	$loseprofit	= $totalprofit-$ex;
	$pdf->Cell(90	,6,' ',0,0,'R');
	$pdf->Cell(50	,6,'Lose or Profit This Preiod=',1,0,'R');
	$pdf->Cell(45	,6,number_format((float)$loseprofit, 2, '.', ','),1,1,'C',true);
	$loseprofit	= $totalprofit-$ex;
	
	$pdf->Cell(90	,6,' ',0,0,'R');
	$pdf->Cell(50	,6,'Hard Cash=',1,0,'R'); 
	$loseprofit	= $totalprofit-$ex;
		$bankdeposit=bankdeposit($db,$from,$to); 
		$hardcash=$loseprofit-$bankdeposit; 
	if($hardcash>0){
		$pdf->Cell(45	,6,number_format((float)$hardcash, 2, '.', ','),1,1,'C',true);  
		}else{
	 
			$pdf->Cell(45	,6,'0.00',1,1,'C',true); 
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
			