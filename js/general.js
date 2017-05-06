// JavaScript Document
<!--

/**
 * Try to reload the free download iframe, setting a new active_link
 * 
 * @author Basilio Vera <basi@softonic.com>
 * @param int active_link
 * @return void
 */
 function setPointer(theRow, thePointerColor)
{
    if (thePointerColor == '' || typeof(theRow.style) == 'undefined') {
        return false;
    }
    if (typeof(document.getElementsByTagName) != 'undefined') {
        var theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        var theCells = theRow.cells;
    }
    else {
        return false;
    }

    var rowCellsCnt  = theCells.length;
   for (var c = 0; c < rowCellsCnt; c++) {

       theCells[c].style.backgroundColor = thePointerColor;
	
			 
   }

    return true;
} 
 function setPointer_(theRow, thePointerColor)
{
    if (thePointerColor == '' || typeof(theRow.style) == 'undefined') {
        return false;
    }
    if (typeof(document.getElementsByTagName) != 'undefined') {
        var theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        var theCells = theRow.cells;
    }
    else {
        return false;
    }

    var rowCellsCnt  = theCells.length;
   for (var c = 0; c < rowCellsCnt-1; c++) {

       theCells[c].style.backgroundColor = thePointerColor;
	
			 
   }

    return true;
} 
 function setPointerC(theRow, thePointerColor,whitout_cols)
{
    if (thePointerColor == '' || typeof(theRow.style) == 'undefined') {
        return false;
    }
    if (typeof(document.getElementsByTagName) != 'undefined') {
        var theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        var theCells = theRow.cells;
    }
    else {
        return false;
    }

    var rowCellsCnt  = theCells.length;
   for (var c = 0; c < rowCellsCnt-whitout_cols; c++) {

       theCells[c].style.backgroundColor = thePointerColor;
	
			 
   }

    return true;
} 

function openNewWindow( object, width, height ) 
{
    ventana = window.open( object.href, '','toolbar=0, location=0, directories=0, status=0, menubar=0, scrollbars=1, resizable=1, width=' + width + ', height=' + height );
}
function openNewWindowhtml( object, width, height ) 
{
    ventana = window.open( object.href, '','toolbar=1, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1, width=' + width + ', height=' + height );
}

//campos de texto
function disminuye(vari)
{
var x = document.getElementById(vari);
x.rows -=3;
}
function aumenta(vari)
{
var x = document.getElementById(vari);
x.rows +=3;
}
//-->