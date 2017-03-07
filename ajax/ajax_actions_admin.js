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
function updateAllowPartial(id, state, type)
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "update-allow-partial-function.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {

            }
        }
        var id = id;
        var state = state;
        var type = type;

        XMLHttpRequestObject.send("data="  + id + '|' + state + '|' + type);



    }
    return false;


}