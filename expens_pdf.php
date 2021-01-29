<?php
require('pdf/fpdf.php');
include("lib/config.php");
include("lib/database.php");
include("lib/helper.php");
$db = new Database();
$fm = new Formate();


if (isset($_POST['submit'])){
$from 	= $_POST['from'];
$to 	= $_POST['to'];
}else{
echo"No Data Found";
}

//get invoices data
$query = "select * from expens	
where date>= '$from' and date<= '$to'";
$getdata=$db->select($query);
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');// for custome page array(100,150)

$pdf->AddPage();
//set font to arial, bold, 14pt

//set font to arial, regular, 12pt
$pdf->Image('img/logo.png',20,10,30,30);

$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(176,4,4);
$pdf->Cell(85	,10,'Mission Para',0,0,'R'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 
$pdf->SetTextColor(2,112,38);
$pdf->Cell(50	,10,'Jame-E-Masjid',0,1,'C'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 

$pdf->SetFont('Arial','',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(180	,6,'Address: 16/41, MissionPara Road,',0,1,'C'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 
$pdf->Cell(180	,6,'Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 16/41, MissionPara Road,Narayanganj Sadar, Narayanganj',0,1,'C'); //end of line 

$pdf->Cell(180	,10,'',0,1,'C'); 

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(2,112,38);
$pdf->Cell(180	,10,'Expens Ledger',0,1,'C');

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(15	,10,'From:',0,0,'C'); 
$pdf->Cell(30	,10,$from,0,0,'C'); 
$pdf->Cell(10	,10,'To:',0,0,'C'); 
$pdf->Cell(30	,10,$to,0,1,'C'); 
 
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(223,240,216);//sample of the heading with use fill boolean fliped (the 1 after the 'C')
$pdf->Cell(10	,10,'ID',0,0,'C',true);
$pdf->Cell(30	,10,'Date',0,0,'L',true);
$pdf->Cell(55	,10,'Head',0,0,'L',true);
$pdf->Cell(60	,10,'Narration',0,0,'L',true);
$pdf->Cell(35	,10,'Amount',0,1,'L',true);//end of line
$id=0; 

if($getdata==true) {
	while($getres=$getdata->fetch_assoc()){
	$id++; 
	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(243,243,243);
	$pdf->Cell(10	,9,$id,0,0,'C',true);
	$pdf->Cell(30	,9,$getres['date'],0,0,'L',true);
	$pdf->Cell(55	,9,$getres['head'],0,0,'L',true);
	$pdf->Cell(60	,9,$getres['narration'],0,0,'L',true);
	$pdf->Cell(35	,9,number_format((float)$getres['amount'], 2, '.', ','),0,1,'L',true);//end of line	}
	}
}

$query2 = "select sum(amount) as am from expens	
where date>= '$from' and date<= '$to'";
$getdata2=$db->select($query2);

if($getdata==true) {
	while($getres2=$getdata2->fetch_assoc()){
	
	//Cell(width , height , text , border , end line , [align] )
	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(223,240,216);
	$pdf->Cell(10	,10,'',0,0,'L',true);
	$pdf->Cell(30	,10,'',0,0,'L',true);
	$pdf->Cell(55	,10,'',0,0,'L',true);
	$pdf->Cell(60	,10,'Total=',0,0,'R',true);
	$pdf->Cell(35	,10,number_format((float)$getres2['am'], 2, '.', ','),0,1,'L',true);//end of line	}
	}
}

$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(180	,10,'',0,1,'C'); 
$pdf->Cell(20	,4,'--------------------------',0,1,'L');//end of line
$pdf->Cell(20	,4,'Signature Cashier',0,1,'L');//end of line

$pdf->Output();

?>

<?php include('inc/footer.php'); ?>