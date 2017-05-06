// JavaScript Document
<!-- PROPIO DE MARCELO CHAVEZ DURAN
var defaultEmptyOK = false


var digits = "0123456789";
var lowercaseLetters = "abcdefghijklmnopqrstuvwxyz-._";
var uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ-._";
var whitespace = " \t\n\r";

var phoneChars = "()-+ ";

var mMessage = "Error: no puede dejar este espacio vacio"

var pPrompt = "Error: ";
var pAlphanumeric = "ingrese un texto sin espacios que contenga solo letras, numeros y/o estos caracteres especiales: - . _";
var pAlphabetic   = "ingrese un texto que contenga solo letras y/o estos caracteres especiales: - . _";
var pInteger = "ingrese un numero entero sin espacios";
var pNumber = "ingrese un numero sin espacios";
var pPhoneNumber = "ingrese un número de teléfono";
var pEmail = "ingrese una dirección de correo electrónico válida";
var pName = "ingrese un texto que contenga solo letras, numeros, espacios y/o estos caracteres especiales: - . _";

function makeArray(n) {
   for (var i = 1; i <= n; i++) {
      this[i] = 0
   } 
   return this
}
function isEmpty(s)
{   return ((s == null) || (s.length == 0))
}
function isWhitespace (s)
{   var i;
    if (isEmpty(s)) return true;
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (whitespace.indexOf(c) == -1) return false;
    }
    return true;
}
function stripCharsInBag (s, bag)
{   var i;
    var returnString = "";
    
    for (i = 0; i < s.length; i++)
    {   var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }

    return returnString;
}
function stripCharsNotInBag (s, bag)
{   var i;
    var returnString = "";
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (bag.indexOf(c) != -1) returnString += c;
    }

    return returnString;
}
function stripWhitespace (s)
{   return stripCharsInBag (s, whitespace)
}
function charInString (c, s)
{   for (i = 0; i < s.length; i++)
    {   if (s.charAt(i) == c) return true;
    }
    return false
}
function stripInitialWhitespace (s)
{   var i = 0;
    while ((i < s.length) && charInString (s.charAt(i), whitespace))
       i++;
    return s.substring (i, s.length);
}
function isLetter (c)
{
    return( ( uppercaseLetters.indexOf( c ) != -1 ) ||
            ( lowercaseLetters.indexOf( c ) != -1 ) )
}
function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}
function isLetterOrDigit (c)
{   return (isLetter(c) || isDigit(c))
}
function isInteger (s)
{   var i;
    if (isEmpty(s)) 
       if (isInteger.arguments.length == 1) return defaultEmptyOK;
       else return (isInteger.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if (!isDigit(c)) return false;
        } else { 
            if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}
function isNumber (s)
{   var i;
    var dotAppeared;
    dotAppeared = false;
    if (isEmpty(s)) 
       if (isNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isNumber.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c)) return false;
        } else { 
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}
function isAlphabetic (s)
{   var i;

    if (isEmpty(s)) 
       if (isAlphabetic.arguments.length == 1) return defaultEmptyOK;
       else return (isAlphabetic.arguments[1] == true);
    for (i = 0; i < s.length; i++)
    {   

        var c = s.charAt(i);

        if (!isLetter(c))
        return false;
    }
    return true;
}
function isAlphanumeric (s)
{   var i;

    if (isEmpty(s)) 
       if (isAlphanumeric.arguments.length == 1) return defaultEmptyOK;
       else return (isAlphanumeric.arguments[1] == true);

    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (! (isLetter(c) || isDigit(c) ) )
        return false;
    }

    return true;
}
function isName (s)
{
    if (isEmpty(s)) 
       if (isName.arguments.length == 1) return defaultEmptyOK;
       else return (isAlphanumeric.arguments[1] == true);
    
    return( isAlphanumeric( stripCharsInBag( s, whitespace ) ) );
}
function isPhoneNumber (s)
{   var modString;
    if (isEmpty(s)) 
       if (isPhoneNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isPhoneNumber.arguments[1] == true);
    modString = stripCharsInBag( s, phoneChars );
    return (isInteger(modString))
}
function isEmail (s)
{
    if (isEmpty(s)) 
       if (isEmail.arguments.length == 1) return defaultEmptyOK;
       else return (isEmail.arguments[1] == true);
    if (isWhitespace(s)) return false;
    var i = 1;
    var sLength = s.length;
    while ((i < sLength) && (s.charAt(i) != "@"))
    { i++
    }

    if ((i >= sLength) || (s.charAt(i) != "@")) return false;
    else i += 2;

    while ((i < sLength) && (s.charAt(i) != "."))
    { i++
    }

    if ((i >= sLength - 1) || (s.charAt(i) != ".")) return false;
    else return true;
}
function statBar (s)
{   window.status = s
}
function isNull (theField)
{   
if (isEmpty(theField.value)) 
        return warnEmpty(theField);
else return true		
}
function warnEmpty (theField)
{   theField.focus()
    alert(mMessage)
    statBar(mMessage)
    return false
}
function warnInvalid (theField, s)
{   theField.focus()
    theField.select()
    alert(s)
    statBar(pPrompt + s)
    return false
}
function checkField (theField, theFunction, emptyOK, s)
{   
    var msg;
    if (checkField.arguments.length < 3) emptyOK = defaultEmptyOK;
    if (checkField.arguments.length == 4) {
        msg = s;
    } else {
        if( theFunction == isAlphabetic ) msg = pAlphabetic;
        if( theFunction == isAlphanumeric ) msg = pAlphanumeric;
        if( theFunction == isInteger ) msg = pInteger;
        if( theFunction == isNumber ) msg = pNumber;
        if( theFunction == isEmail ) msg = pEmail;
        if( theFunction == isPhoneNumber ) msg = pPhoneNumber;
        if( theFunction == isName ) msg = pName;		
    }
    
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;

    if ((emptyOK == false) && (isEmpty(theField.value))) 
        return warnEmpty(theField);

    if (theFunction(theField.value) == true) 
        return true;
    else
        return warnInvalid(theField,msg);

}
function esDigito(sChr){
var sCod = sChr.charCodeAt(0);
return ((sCod > 47) && (sCod < 58));
}
function valSep(oTxt){
var bOk = false;
bOk = bOk || ((oTxt.value.charAt(2) == "-") && (oTxt.value.charAt(5) == "-"));
bOk = bOk || ((oTxt.value.charAt(2) == "/") && (oTxt.value.charAt(5) == "/"));
return bOk;
}
function finMes(oTxt){
var nMes = parseInt(oTxt.value.substr(3, 2), 10);
var nRes = 0;
switch (nMes){
case 1: nRes = 31; break;
case 2: nRes = 29; break;
case 3: nRes = 31; break;
case 4: nRes = 30; break;
case 5: nRes = 31; break;
case 6: nRes = 30; break;
case 7: nRes = 31; break;
case 8: nRes = 31; break;
case 9: nRes = 30; break;
case 10: nRes = 31; break;
case 11: nRes = 30; break;
case 12: nRes = 31; break;
}
return nRes;
}
function valDia(oTxt){
var bOk = false;
var nDia = parseInt(oTxt.value.substr(0, 2), 10);
bOk = bOk || ((nDia >= 1) && (nDia <= finMes(oTxt)));
return bOk;
}
function valMes(oTxt){
var bOk = false;
var nMes = parseInt(oTxt.value.substr(3, 2), 10);
bOk = bOk || ((nMes >= 1) && (nMes <= 12));
return bOk;
}
function valAno(oTxt){
var bOk = true;
var nAno = oTxt.value.substr(6);
bOk = bOk && (nAno.length == 4);
if (bOk){
for (var i = 0; i < nAno.length; i++){
bOk = bOk && esDigito(nAno.charAt(i));
}
}
return bOk;
}

// validar radio button
function validarRB(id, mensaje) {
var marcado = "no";
for ( var i = 0; i < id.length; i++ ) {
if ( id[i].checked ) {
marcado= "si";
break;
}
}

if ( marcado == "si" ){
return true;
}
else {
alert(mensaje);
return false;
}

}
// validar Select
function validarSelect(id,mensaje){
if(id.selectedIndex!='0') { return true; }
else {
alert(mensaje);
id.focus();
return false;
}
}
//-->
function CheckTime(str) 
{ 
hora=str.value 
if (hora=='') {return} 
if (hora.length>5) {alert("Introdujo una cadena mayor a 5 caracteres, recuerde! el formato es HH:MM");str.value="";str.focus();return} 
if (hora.length!=5) {alert("Introducir HH:MM");str.value="";str.focus();return} 
a=hora.charAt(0) //<=2 
b=hora.charAt(1) //<4 
c=hora.charAt(2) //: 
d=hora.charAt(3) //<=5 
//e=hora.charAt(5) //:
//f=hora.charAt(6) //<=5
if ((a==2 && b>3) || (a>2)) {alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23");str.value="";str.focus();return} 
if (d>5) {alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59");str.value="";str.focus();return} 
//if (f>5) {alert("El valor que introdujo en los segundos no corresponde");return} 
if (c!=':') {alert("Introduzca el caracter ':' para separar la hora y los minutos");str.value="";str.focus();return} 
} 
function ValidaHora( id )   
{   
        var er_fh = /^(1|01|2|02|3|03|4|04|5|05|6|06|7|07|8|08|9|09|10|11|12)\:([0-5]0|[0-5][1-9])$/
        if( id.value == "" )   
        {   
                alert("Introduzca la hora.");
				id.focus();
                return false   
        }   
        if ( !(er_fh.test( id.value )) )    
        {    
                alert("El dato en el campo hora no es válido.");
				id.focus();
                return false   
        }              
        return true   
} 