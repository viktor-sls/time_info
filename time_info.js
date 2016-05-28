/*
 * © Viktor Evdokimov, viktor_sls@mail.ru
 */

function get_time_info()
{
	var link_time_info = "time_info.php";
	var http_time_info = createRequestObject();
	
	if( http_time_info )
	{
		http_time_info.open('get', link_time_info);
		http_time_info.onreadystatechange = function ()
		{
			if(http_time_info.readyState == 4)
			{
				document.getElementById('info').innerHTML = http_time_info.responseText;
				setTimeout('get_time_info()', "1000");
			}
		}
		http_time_info.send(null);
	}
	else
	{
		document.location = link_time_info;
	}
}

function createRequestObject()
{
	try {return new XMLHttpRequest() }
	catch(e)
	{
		try { return new ActiveXObject('Msxml2.XMLHTTP') }
		catch(e)
		{
			try { return new ActiveXObject('Microsoft.XMLHTTP') }
			catch(e) 
			{
				return null;
			}
		}
	}
}
