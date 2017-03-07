/**
 * Created by Grabe Grabe on 4/7/2016.
 */
var XMLHttpRequestObject = false;

if (window.XMLHttpRequest)
{
    XMLHttpRequestObject = new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}

/*
 GET PAWN ITEMS
 */
function displayPawn()
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-display-pawn.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var addedItems = document.getElementById('displayPawn');


                addedItems.innerHTML = returnedData;

            }
        }

        XMLHttpRequestObject.send("data=1");



    }
    return false;
}
