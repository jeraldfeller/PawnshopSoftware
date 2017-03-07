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
function removeItems(item_id, image_name, page)
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "remove-items-function.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var addedItems = document.getElementById('displayItems');


                addedItems.innerHTML = returnedData;

                $('#loading_image').css('display', 'none');


            }
        }
        var customer_id = document.getElementById('selectCustomer').value;
        var image_name = image_name;
        var item_id = item_id;
        var page = page;

        XMLHttpRequestObject.send("data="  + item_id + '|' + image_name + '|' + customer_id + '|' + page);

        $('#loading_image').css('display', 'inline');

    }
    return false;
}

function getPastDuePawns()
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-past-due-date-pawns.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var addedItems = document.getElementById('displayItems');


                addedItems.innerHTML = returnedData;

                $('#loading_image').css('display', 'none');


            }
        }

        var data = "p";

        XMLHttpRequestObject.send("data="  + data);

    }
    return false;
}

function getPastDueTitlePawns()
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-past-due-date-pawns.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var addedItems = document.getElementById('displayItemsTitle');


                addedItems.innerHTML = returnedData;

                $('#loading_image').css('display', 'none');


            }
        }

        var data = "t";

        XMLHttpRequestObject.send("data="  + data);

    }
    return false;
}

function getPastDueTitlePawnsRepo()
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-past-due-date-pawns.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var addedItems = document.getElementById('displayItemsTitle');


                addedItems.innerHTML = returnedData;

                $('#loading_image').css('display', 'none');


            }
        }

        var data = "r";

        XMLHttpRequestObject.send("data="  + data);

    }
    return false;
}


function closePawn(loan_id)
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "close-pawn-function.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {

                $('#loading_image').css('display', 'none');
                refreshTablePawns();


            }
        }

        var data = loan_id;
        var general = "pawn";
        XMLHttpRequestObject.send("data="  + data + "|" + general);

    }
    return false;
}

function closeTitlePawn(loan_id)
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "close-pawn-function.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {

                $('#loading_image').css('display', 'none');
                refreshTableTitlePawns();


            }
        }

        var data = loan_id;
        var title = "title";
        XMLHttpRequestObject.send("data="  + data + "|" + title);

    }
    return false;
}


function updateTransactionStatus(id, state, type, cid, reason)
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "update-transaction-function.php?type=transaction");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var addedItems = document.getElementById('dump');


                addedItems.innerHTML = returnedData;


            }
        }
        var id = id;
        var state = state;
        var type = type;
        var cid = cid;
        var reason = reason;

        XMLHttpRequestObject.send("data="  + id + '|' + state + '|' + type + '|' + cid + '|' + reason);



    }
    return false;


}

function updateTransactionStatusPayment(id, state, type, cid, reason, amount, interest, transaction_type, tid, due)
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "update-transaction-function.php?type=payment");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var addedItems = document.getElementById('dump');


                addedItems.innerHTML = returnedData;


            }
        }
        var id = id;
        var state = state;
        var type = type;
        var cid = cid;
        var reason = reason;
        var amount = amount;
        var interest = interest;
        var transaction_type = transaction_type;
        var tid = tid;
        var due = due;
        XMLHttpRequestObject.send("data="  + id + '|' + state + '|' + type + '|' + cid + '|' + reason + '|' + amount + '|' + interest + '|' + transaction_type + '|' + tid + '|' + due);



    }
    return false;


}

function getUnredeemedTitlePawns()
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-unredeemed-title-pawns.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var addedItems = document.getElementById('displayUnredeemedPawns');


                addedItems.innerHTML = returnedData;

                $('#loading_image').css('display', 'none');


            }
        }

        var data = "t";

        XMLHttpRequestObject.send("data="  + data);

    }
    return false;
}

function repoTitlePawn(loan_id, status)
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "repo-pawn-function.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {

                $('#loading_image').css('display', 'none');




            }
        }

        var data = loan_id;
        var status = status;
        XMLHttpRequestObject.send("data="  + data + "|" + status);

    }
    return false;
}


function getPettyCashLedger(from, to)
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-petty-cash-ledger.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var display = document.getElementById('displayPettyCash');


                display.innerHTML = returnedData;

                $('#loading_image').css('display', 'none');


            }
        }

        var from = from;
        var to = to;

        XMLHttpRequestObject.send("data="  + from + "|" + to);

    }
    return false;
}


function displayScrapItems()
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-scrap-item.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var display = document.getElementById('displayScrapItems');


                display.innerHTML = returnedData;

                $('#loading_image').css('display', 'none');


            }
        }


        XMLHttpRequestObject.send("data=hold");

    }
    return false;
}

function updateScrapStatus(id, status)
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "update-scrap-status.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var display = document.getElementById('displayScrapItems');


                display.innerHTML = returnedData;

                $('#loading_image').css('display', 'none');


            }
        }


        XMLHttpRequestObject.send("data="  + id + "|" + status);

    }
    return false;
}

