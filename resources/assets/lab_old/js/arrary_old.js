var fruits,price, text, fLen, i, count = 0;

fruits = [];
price = [];
//price = [320,240,660,280,100,120,140,260];


function myFunction() {
  
  var test_name = document.getElementById("test_name").value;
 
 //var splitstring = test_name.split('-');
    var lastIndex = test_name.lastIndexOf('-');
  //alert(splitstring[0]);
  
  //fruits.push(splitstring[0]);
  fruits.push(test_name.substr(0, lastIndex));
  //price.push(splitstring[1]);
  price.push(test_name.substr(lastIndex+1));
  
  fLen = fruits.length;
  
 text = "<table>";
for (i = 0; i < fLen; i++) {
  count = count + parseInt(price[i]);
  text += "<tr><td> <a href='#' style='color:red;' onclick='removelistitem(" + i + ")'><i class='fa fa-trash' aria-hidden='true'></i>  </a>" + fruits[i] + "</td><td>&nbsp;&nbsp;&nbsp;  " + price[i] + " LE</td></tr>";
}
text += "</table><hr />total &nbsp;&nbsp;&nbsp; " + count + " LE ";

document.getElementById("demo").innerHTML = text;

count = 0;
}

function removelistitem(x){
fruits.splice(x, 1); 
price.splice(x, 1); 

fLen = fruits.length;

text = "<table>";
for (i = 0; i < fLen; i++) {
count = count + parseInt(price[i]);
  text += "<tr><td> <a href='#' style='color:red;' onclick='removelistitem(" + i + ")'><i class='fa fa-trash' aria-hidden='true'></i>  </a>" + fruits[i] + " </td><td>&nbsp;&nbsp;&nbsp; " + price[i] + " LE</td></tr>";
}
text += "</table><hr /><br />total &nbsp;&nbsp;&nbsp; " + count + " LE";

document.getElementById("demo").innerHTML = text;
count = 0;
}