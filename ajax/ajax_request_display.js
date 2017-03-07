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
function getItemPawn()
{
	if(XMLHttpRequestObject)
	{
		
			XMLHttpRequestObject.open("POST", "get-pawn-items-function.php");
		
		
		XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
			{
				var returnedData = XMLHttpRequestObject.responseText;
				var addedItems = document.getElementById('displayItems');
				
				
				addedItems.innerHTML = returnedData;
				
				sumLoan();
				$('#loading_image').css('display', 'none');
				
				
			}
		}
		var customer_id = document.getElementById('selectCustomer').value;

		XMLHttpRequestObject.send("data="  + customer_id);
		
		$('#loading_image').css('display', 'inline');
		
	}
	return false;
}

function getItemPending()
{
	if(XMLHttpRequestObject)
	{
		
			XMLHttpRequestObject.open("POST", "get-pawn-items-function.php");
		
		
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

		XMLHttpRequestObject.send("data="  + customer_id);
		
		$('#loading_image').css('display', 'inline');
		
	}
	return false;
}


function getOutrightItem()
{
	if(XMLHttpRequestObject)
	{
		XMLHttpRequestObject.open("POST", "get-outright-items-function.php");
		
		XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
			{
				var returnedData = XMLHttpRequestObject.responseText;
				var addedItems = document.getElementById('displayItems');
				
				
				addedItems.innerHTML = returnedData;
				
				sumLoan();
				$('#loading_image').css('display', 'none');
				
				
			}
		}
		var customer_id = document.getElementById('selectCustomer').value;

		XMLHttpRequestObject.send("data="  + customer_id);
		
		$('#loading_image').css('display', 'inline');
		
	}
	return false;
}

function getCustomerIdPoint()
{
	
	if(XMLHttpRequestObject)
	{
		
		XMLHttpRequestObject.open("POST", "get-customerId-point.php");
		
		XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
			{
				var returnedData = XMLHttpRequestObject.responseText;
				var r_id = document.getElementById('customer_id_ref');
				r_id.value = returnedData
				getCustomerInfo();
				
				
				$('#loading_image').css('display', 'none');
				
				
			}
		}
		var customer_id = document.getElementById('customer_name').value;

		XMLHttpRequestObject.send("data="  + customer_id);
		
		$('#loading_image').css('display', 'inline');
		
	}
	return false;
}





function getCustomerInfo()
{
	
	if(XMLHttpRequestObject)
	{
		
		XMLHttpRequestObject.open("POST", "get_customer_info.php");
		
		XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
			{
				var returnedData = XMLHttpRequestObject.responseText;
				var id = document.getElementById('display_info');

					id.innerHTML = returnedData;
					

			}
		}
		var customer_id = document.getElementById('customer_name').value;

		XMLHttpRequestObject.send("data="  + customer_id);
		
	}
	return false;
}



function getViewCustomerInfo()
{

    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get_view_customer_info.php");

        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var id = document.getElementById('display_info');

                id.innerHTML = returnedData;



                $('#loading_image').css('display', 'none');


            }
        }
        var customer_id = document.getElementById('customer_name').value;

        XMLHttpRequestObject.send("data="  + customer_id);

        $('#loading_image').css('display', 'inline');

    }
    return false;
}


function getCustomerInfoIdPawend()
{
	
	if(XMLHttpRequestObject)
	{
		
		XMLHttpRequestObject.open("POST", "get-customerId-point.php");
		
		XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
			{

				var returnedData = XMLHttpRequestObject.responseText;
				var r_id = document.getElementById('customer_id_ref');
				r_id.value = returnedData
				getCustomerInfo();
				
				setTimeout(function() {
					getCustomerPawnedItems();

				},2000);
                setTimeout(function() {
                    getCustomerPawnedItemsTitle();
                },3000);

				
				$('#loading_image').css('display', 'none');
				
				
			}
		}
		var customer_id = document.getElementById('customer_name').value;

		XMLHttpRequestObject.send("data="  + customer_id);
		
		$('#loading_image').css('display', 'inline');
		
	}
	return false;
}


function getCustomerPawnedItems()
{
	
	if(XMLHttpRequestObject)
	{
		
		XMLHttpRequestObject.open("POST", "get-customer-pawned-to-bail-items.php");
		
		XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
			{
				var returnedData = XMLHttpRequestObject.responseText;
				var items = document.getElementById('displayItemsPawn');
				
				
				
				items.innerHTML = returnedData;
					
				
				
				$('#loading_image').css('display', 'none');
				
				
			}
		}
		var customer_id = document.getElementById('selectCustomer').value;
        var pawn = 'pawn';
		XMLHttpRequestObject.send("data="  + customer_id + "|" + pawn);
		
		$('#loading_image').css('display', 'inline');
		
	}
	return false;
}

function getCustomerPawnedItemsTitle()
{

    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-customer-pawned-to-bail-items-title.php");

        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var items = document.getElementById('displayItemsPawnTitle');



                items.innerHTML = returnedData;



                $('#loading_image').css('display', 'none');


            }
        }
        var customer_id = document.getElementById('selectCustomer').value;
        var title = 'title';
        XMLHttpRequestObject.send("data="  + customer_id + "|" + title);

        $('#loading_image').css('display', 'inline');

    }
    return false;
}

function getAddParts()
{
    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-add-parts-function.php");


        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var addedItems = document.getElementById('displayItems');


                addedItems.innerHTML = returnedData;

                sumTotal();
                $('#loading_image').css('display', 'none');


            }
        }
        var customer_id = document.getElementById('selectCustomer').value;

        XMLHttpRequestObject.send("data="  + customer_id);

        $('#loading_image').css('display', 'inline');

    }
    return false;
}


function getCustomerByNumber(){

    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-customerId-number.php");

        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var cp_no = document.getElementById('customer_cp_number');
                cp_no.value = returnedData;



                $('#loading_image').css('display', 'none');


            }
        }
        var customer_id = document.getElementById('customer_name').value;

        XMLHttpRequestObject.send("data="  + customer_id);

        $('#loading_image').css('display', 'inline');

    }
    return false;
}


function getCustomerInfoByNumber()
{

    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get_customer_info.php");

        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var id = document.getElementById('display_info');

                id.innerHTML = returnedData;



                $('#loading_image').css('display', 'none');


            }
        }
        var customer_id = document.getElementById('customer_id_ref').value;

        XMLHttpRequestObject.send("data= x-"  + customer_id);

        $('#loading_image').css('display', 'inline');

    }
    return false;
}


function getCustomerRTO(){

    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-customer-rto.php");

        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var rto = document.getElementById('displayRTO');
                rto.innerHTML = returnedData;



                $('#loading_image').css('display', 'none');


            }
        }
        var customer_id = document.getElementById('customer_name').value;

        XMLHttpRequestObject.send("data="  + customer_id);

        $('#loading_image').css('display', 'inline');

    }
    return false;
}

function getScrapItem()
{
    if(XMLHttpRequestObject)
    {
        XMLHttpRequestObject.open("POST", "get-scrap-items-function.php");

        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var addedItems = document.getElementById('displayItems');


                addedItems.innerHTML = returnedData;

                sumLoan();
                $('#loading_image').css('display', 'none');


            }
        }
        var customer_id = document.getElementById('selectCustomer').value;

        XMLHttpRequestObject.send("data="  + customer_id);

        $('#loading_image').css('display', 'inline');

    }
    return false;
}


function getCustomerLayaway(){

    if(XMLHttpRequestObject)
    {

        XMLHttpRequestObject.open("POST", "get-customer-layaway.php");

        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
            {
                var returnedData = XMLHttpRequestObject.responseText;
                var display = document.getElementById('displayLayaway');
                display.innerHTML = returnedData;



                $('#loading_image').css('display', 'none');


            }
        }
        var customer_id = document.getElementById('customer_name').value;

        XMLHttpRequestObject.send("data="  + customer_id);

        $('#loading_image').css('display', 'inline');

    }
    return false;
}



