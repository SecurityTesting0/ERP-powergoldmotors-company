function getAddress(str) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("address").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "get_inv_address.php?id="+str, true);
  xhttp.send();
}




function getqty(str) { 
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("total").innerHTML = this.responseText;
    }
  };
  
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("price").innerHTML = this.responseText;
    }
  };
  
  xhttp.open("GET", "get_qty_total.php?id="+str, true);
  xhttp.send();
}

 

