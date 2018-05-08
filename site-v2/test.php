<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html> 
<head> 
<title>test menu deroulant</title> 
<meta http-equiv= "Content-Type" content="text/html; charset=iso-8859-1"> 
<script language="javascript"> 
var d=new Date(); 
var monthname=new Array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"); 
var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear(); 


function selbte1(id,pos) { 


var x=document.getElementById("eq3"); 
txt=document.getElementById(id).value; 
x.options[pos] = new Option(txt,txt); 
//x.options[1] = new Option("TEST2", "B"); 
} 


</script> 
<style type="text/css"> 
<!-- 
.style1 { 
 font-size: 12px; 
 font-weight: bold; 
} 
--> 
</style> 
</head> 


<form name="prequipe" action="frmprequipe.php" method="post"> 
CONFÉRENCE EST 

Votre première équipe 


 Votre équipe: 
 <select id ="eq1" name= "eq1" onChange="selbte1('eq1',1)"> 
 <option value="-1">????????????</option> 
 <option value="Buffalo">Buffalo</option> 
 <option value="NY Islanders">NY Islanders</option> 
 <option value="Montréal">Montréal</option> 
 </select>, 
&nbsp; 

<HR> 
CONFÉRENCE OUEST 


Votre deuxième équipe 
 Votre équipe: 
 <select id ="eq2" name= "eq2" onChange="selbte1('eq2',2)"> 
 <option value="-1">????????????</option> 
 <option value="Détroit">Détroit</option> 
 <option value="Calgary">Calgary</option> 
 <option value="San Jose">San Jose</option> 
 </select>, 
&nbsp; 

<HR> 
VOTRE ÉQUIPE GAGNANTE 
Choisir votre équipe gagnante de la coupe stanley 
  ---- 

      Votre &eacute;quipe: 
  <select id ="eq3" name="eq3"> 
  <option value="-1">????????????</option> 
  <option value="bbbb">bbbb</option> 
  <option value="cccc">cccc</option> 
  </select>, 
  &nbsp;, 
  

</form> 

</html> 

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

