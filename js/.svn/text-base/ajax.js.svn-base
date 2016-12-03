function Results(http_request, id)
	{
		try
		{
			if (http_request.readyState == 4) 
			{
				if (http_request.status == 200)
				{
					html = http_request.responseText;
					document.getElementById(id).innerHTML = html;
				}
				else
				{
					document.getElementById(id).innerHTML = 'Erreur : ' + http_request.status;
				}
			}
		}
		catch ( e )
		{
			document.getElementById(id).innerHTML = "Une exception s'est produite : " + e.description + "\n<br />id = "+id;
		}
	}
		
	
	function ajax(arg, action_page, destination_element_id)
	{
		if (window.XMLHttpRequest)
		{ // Mozilla, Safari, ...
			var http_request = new XMLHttpRequest();
		}
		else if (window.ActiveXObject)
		{ // IE
			var http_request = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		http_request.onreadystatechange = function() { Results(http_request, destination_element_id); };
		http_request.open('POST', action_page, true);
		http_request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		http_request.send(arg);
	}