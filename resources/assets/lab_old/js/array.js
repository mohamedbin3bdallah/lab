var fruits,price, text, fLen, i, count = 0;

fruits = [];
price = [];
//price = [320,240,660,280,100,120,140,260];

function hide_list()
{
	document.getElementById("browsers").innerHTML = '';	
}

function show_list()
{
	document.getElementById("browsers").innerHTML = document.getElementById("data").innerHTML;
}

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
  
 text = "<ul>";
for (i = 0; i < fLen; i++) {
  count = count + parseInt(price[i]);
  text += "<li> <a href='#' style='color:red;' onclick='removelistitem(" + i + ")'>&#9747;  </a>" + fruits[i] + "  " + price[i] + " LE<input type='hidden' name='tests[]' value='"+document.getElementById(fruits[i]+"-"+price[i]).value+"'></li>";
}
text += "<hr /><br />total " + count + " LE <input type='hidden' name='total' value='"+count+"'></ul>";

document.getElementById("demo").innerHTML = text;

count = 0;
}

function removelistitem(x){
fruits.splice(x, 1); 
price.splice(x, 1); 

fLen = fruits.length;

text = "<ul>";
for (i = 0; i < fLen; i++) {
count = count + parseInt(price[i]);
  text += "<li> <a href='#' style='color:red;' onclick='removelistitem(" + i + ")'>&#9747;  </a>" + fruits[i] + "  " + price[i] + " LE<input type='hidden' name='tests[]' value='"+document.getElementById(fruits[i]+"-"+price[i]).value+"'></li>";
}
text += "<hr /><br />total " + count + " LE <input type='hidden' name='total' value='"+count+"'></ul>";
document.getElementById("demo").innerHTML = text;
count = 0;
}