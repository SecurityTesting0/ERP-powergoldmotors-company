<?php
require('pdf/fpdf.php');
include("lib/config.php");
include("lib/database.php");
include("lib/helper.php");
$db = new Database();
$fm = new Formate();


if (isset($_POST['submit'])){
	$date 	= $_POST['date'];
	}else{
	echo"No Data Found";
	}

//get invoices data
$query = "SELECT * FROM `salary_payment` WHERE `gn_date` LIKE '$date%'";
$getdata=$db->select($query);
$id=0;	
						
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

class PDF extends FPDF {  
	function Footer() {   
		$this->SetY(-15); // Arial italic 8
		$this->SetFont('Arial','I',7);	// Page number
		$this->Cell(250,2,'--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,1,'L'); 
		$this->Cell(70,5,'Software Developed By: Ibrahim Ali, +8801916859326',0,0,'L'); 
		$this->Cell(100,5,'Printing Date: '.date("Y-m-d h:i:sa") ,0,0,'R');
		$this->Cell(80,5,'Page '.$this->PageNo().'/{nb}',0,0,'R'); 
	}
}		
$pdf = new FPDF('L','mm','A4');// for custome page array(100,150)
$pdf = new pdf('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
//set font to arial, bold, 14pt

//set font to arial, regular, 12pt
$pdf->Image('img/logo.png',20,10,30,30);

$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(176,4,4);
$pdf->Cell(90	,10,'',0,1,'R'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 
$pdf->Cell(90	,10,'Missionpara',0,0,'R'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 
$pdf->SetTextColor(2,112,38);
$pdf->Cell(50	,10,'Jame-E-Masjid',0,1,'L'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 

$pdf->SetFont('Arial','',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(45	,6,'',0,0,'L'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 
$pdf->Cell(190	,6,'Address: 16/41, MissionPara Road,',0,1,'L'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 
$pdf->Cell(45	,6,'',0,0,'L'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 
$pdf->Cell(190	,6,'Narayanganj Sadar, Narayanganj',0,1,'L'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 

$pdf->Cell(180	,10,'',0,1,'C'); 

$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(2,112,38);
$pdf->Cell(260	,10,'Salary Sheet',0,1,'C');

$pdf->SetFont('Arial','B',14);
$pdf->Cell(30	,10,'Month of Salary:',0,0,'L');
$pdf->Cell(50	,10,$date,0,1,'C');


$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);//sample of the heading with use fill boolean fliped (the 1 after the 'C')
$pdf->Cell(20	,10,'S.L NO',1,0,'C',true);
$pdf->Cell(30	,10,'Employee_id',1,0,'C',true);
$pdf->Cell(55	,10,'Name',1,0,'C',true);
$pdf->Cell(40	,10,'Desigination',1,0,'C',true);
$pdf->Cell(30	,10,'Amount',1,0,'C',true);//end of line
$pdf->Cell(90	,10,'Employees Signature',1,1,'C',true);//end of line

$id=0; 
if($getdata==true) {
	while($getres=$getdata->fetch_assoc()){
	$id++; 
	$emid=$getres['Employee_id'];
	
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(20	,20,$id,1,0,'C');
	$pdf->Cell(30	,20,$getres['Employee_id'],1,0,'C');
			
		$query3="SELECT * FROM employee";
		$res=$db->select($query3);
		if ($res){
		while($emr=$res->fetch_assoc()){
			$emidcx=$emr['Employee_id'];
			if ($emidcx==$emid) {
				
					$pdf->Cell(55	,20,$emr['First_Name'].' '.$emr['Last_Name'],1,0,'C');
					$pdf->Cell(40	,20,$emr['Desigination'],1,0,'C');
				}
			}
		}
	$pdf->cell(30	,20,number_format((float)$getres['salary_amount'], 2, '.', ','),1,0,'C');	
	$pdf->cell(90	,20,'',1,1,'C');	
	}
}

$query2 = "select sum(salary_amount) as am from salary_payment WHERE gn_date LIKE '$date%'";
$getdata2=$db->select($query2);

if($getdata==true) {
	while($getres2=$getdata2->fetch_assoc()){
	
	
	//Cell(width , height , text , border , end line , [align] )
	
	$pdf->SetFont('Arial','B',12);
	$pdf->SetFillColor(223,240,216);
	$pdf->Cell(145	,10,'Total=',1,0,'R',true);
	$pdf->Cell(30	,10,number_format((float)$getres2['am'], 2, '.', ','),1,0,'C',true);
	$pdf->Cell(90	,10,'',1,1,'C',true); 
	}
}


$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(20	,4,'--------------------------',0,0,'L');//end of line
$pdf->Cell(230	,4,'-------------------------------------------',0,1,'R');//end of line
$pdf->Cell(20	,4,'Signature Cashier',0,0,'L');//end of line
$pdf->Cell(230	,4,'Signature Secratary/President',0,0,'R');//end of line

$filename="Summery-ledger";
$pdf->Output($filename,'I');  
?>

<?php include('inc/footer.php'); ?>