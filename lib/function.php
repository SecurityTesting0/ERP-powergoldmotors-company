<?php 

//monthly report TOTAL Stock 
function Stock($db,$from,$to){
		$querystock="select Sum(purches_price) as Rate, Sum(stock_quantity) as Qty, 
		Sum(purches_price*stock_quantity) as Result from 
		stock_product where date>='$from' and date<='$to'"; 
		$resstock=$db->select($querystock);
		if (!empty($resstock)){
			while($stock=$resstock->fetch_assoc()){
				$stockpr=$stock['Result'];
			return $stockpr;  
		}
	}
}

//monthly report TOTAL posibolity income 
function Stockposibilityincome($db,$from,$to){
		$querystock="select Sum(price) as Rate, Sum(stock_quantity) as Qty, 
		Sum(price*stock_quantity) as Result from stock_product where date>='$from' and date<='$to'"; 
		$resstock=$db->select($querystock);
		if (!empty($resstock)){
			while($stock=$resstock->fetch_assoc()){
				$results=$stock['Result']; 
		return $results;  
		}
	}
}


//monthly report TOTAL purchase
function TotalPurchas($db,$from,$to){
		$query6="SELECT sum(purchase_total) as ptotal from purches_product where date>='$from' and date<='$to'"; 
		$res6=$db->select($query6);
		if (!empty($res6)){
			while($rs6=$res6->fetch_assoc()){
				$ptotal=$rs6['ptotal']; 	
			return $ptotal;  
		}
	}
}
 

//monthly report dues function 

function ColectSum($db,$from,$to){
		$query3="SELECT SUM(amount_paid) as rec_amount from invoices
		where reciept_cat='2' and created>='$from' and created<='$to'"; 
		$res3=$db->select($query3);
		if (!empty($res3)){
			while($rs3=$res3->fetch_assoc()){				
			$rec_amount=$rs3['rec_amount'];
			return $rec_amount;  
		}
	}
}

/* function AllDues($db,$from,$to){
		$query3="SELECT SUM(amount_due) as dues from invoices"; 
		$res3=$db->select($query3);
		if (!empty($res3)){
			while($rs3=$res3->fetch_assoc()){				
			$dues=$rs3['dues'];
			return $dues;  
		}
	}
}
 */


function DuesAmount($db,$from,$to){
		$query3="SELECT SUM(amount_paid) as paid, SUM(amount_paid) as due from invoices
		where created>='$from' and created<='$to'"; 
		$res3=$db->select($query3);
		if (!empty($res3)){
			while($rs3=$res3->fetch_assoc()){
				
			$paid=$rs3['paid'];
			$due=$rs3['due'];
			$total=$paid-$due;
			return $total;  
		}
	}
}

//end  dues function


//monthly report paid amount function 
function PaidAmount($db,$from,$to){
	$paid_amount="SELECT SUM(amount_paid) as paid_amount from invoices
	where created>='$from' and created<='$to'"; 
	$paidr=$db->select($paid_amount);
	if (!empty($paidr)){
		while($pr=$paidr->fetch_assoc()){ 
		$paid=$pr['paid_amount'];
			return $paid;  
		}
	}
}

//monthly income tax amount 
function IncomeTax($db,$from,$to){
	$paid_amount="SELECT SUM(tax_amount) as tax from invoices
	where created>='$from' and created<='$to'"; 
	$paidr=$db->select($paid_amount);
	if (!empty($paidr)){
		while($pr=$paidr->fetch_assoc()){ 
		$tax=$pr['tax'];
			return $tax;  
		}
	}
}

//monthly report total seles with sales price function 
function TotalSalesSalesPrice($db,$from,$to){
	$slsp="select Sum(quantity) as Rate, Sum(price) as Qty, Sum(price*quantity) 
			as salest from invoice_details where date>='$from' and date<='$to'";  
			//$slsp="SELECT SUM(price) as sales_price, SUM(purchase_price) as p_price 
			//from invoice_details where date>='$from' and date<='$to'"; 
	$slsr=$db->select($slsp);
	if (!empty($slsr)){
		while($sls=$slsr->fetch_assoc()){
				
		$salesptotal=$sls['salest'];
		return $salesptotal;
	 
		}
		
	}
}



//monthly report total seles purches price function 
function TotalSalesPurchasePrice($db,$from,$to){
	$slspp="select Sum(quantity) as Rate, Sum(purchase_price) as Qty, Sum(purchase_price*quantity) 
			as salespurchs from invoice_details where date>='$from' and date<='$to'";  
			//$slsp="SELECT SUM(price) as sales_price, SUM(purchase_price) as p_price 
			//from invoice_details where date>='$from' and date<='$to'"; 
	$slspr=$db->select($slspp);
	if (!empty($slspr)){
		while($slsp=$slspr->fetch_assoc()){
				
		$salspurchasepricetotal=$slsp['salespurchs'];
		return $salspurchasepricetotal;
	 
		}
		
	}
}


//monthly Bank Deposit information function grand total 
function bankdeposit($db,$from,$to){
	 $querybac="SELECT SUM(amount_credit) as deamount FROM bank_details 
	 where date>= '$from' and date<= '$to' ";						
	 $resultsbac=$db->select($querybac); 
	 if ($resultsbac){	 
	 while($rsbac=$resultsbac->fetch_assoc()){
		 $depositamount=$rsbac['deamount'];
		return $depositamount; 
		} 
	}
}


//monthly report total expense function 
function expnes($db,$from,$to){
	$query="SELECT (SELECT SUM(amount) AS amount from `expens` 
	where date>= '$from' and date<= '$to') as expense,
	(SELECT SUM(salary_amount) as amount FROM `salary_payment` where
	 invoice_date>= '$from' and invoice_date<= '$to' ) as salary";
	$results = $db->select($query);
	if ($results){
		while ($row=$results->fetch_assoc()) { 
			$subtotal=$row['expense']+$row['salary'];
			return $subtotal; 
		} 
	}
}

//sales quantity total 
function invoicesubtotal($invoice){
	$totalquery="select SUM(total) as qtytotal
	FROM temp_invoice_details where invoice_id='$invoice'";
	$totalRes=$db->select($totalquery);						
	if ($totalRes){	
		while($qtytotal=$totalRes->fetch_assoc()){				
			$qtytotalshow=$qtytotal['qtytotal'];
		}
	}
}
?> 