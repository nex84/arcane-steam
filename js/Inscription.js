function checkMail()
{
	var box_1 = document.getElementById('mail');
	var box_2 = document.getElementById('verif_mail');
	
	if (box_1.value != box_2.value || box_1.value == "")
	{
		box_1.style.border = "solid #FF9999 1px";
		box_2.style.border = "solid #FF9999 1px";
		return false;
	}
	else
	{
		box_1.style.border = "solid #99FF99 1px";
		box_2.style.border = "solid #99FF99 1px";
		if (verifMail(box_1.value))
			return true;
		else
		{
			box_1.style.border = "solid #FF9999 1px";
			box_2.style.border = "solid #FF9999 1px";
			return false;
		}
	}
}

function checkPass()
{
	var box_1 = document.getElementById('passwd');
	var box_2 = document.getElementById('verif_passwd');
	
	if (box_1.value != box_2.value  || (box_1.value == "" || box_2.value == ""))
	{
		box_1.style.border = "solid #FF9999 1px";
		box_2.style.border = "solid #FF9999 1px";
		return false;
	}
	else
	{
		box_1.style.border = "solid #99FF99 1px";
		box_2.style.border = "solid #99FF99 1px";
		return true;
	}
}

function checkAccess_Phase2()
{
	var box_1 = document.getElementById('btn_send');
	if(checkMail() && checkPass())
	{
		box_1.disabled = false;
	}
	else
	{
		box_1.disabled = true;
	}
}

function YouFailedMeForTheLastTime(id1,id2,box)
{
	var box_send = document.getElementById(box);
	
	var box_1 = document.getElementById(id1);
	var box_2 = document.getElementById(id2);
	
	if (box_1.value != box_2.value  || (box_1.value == "" || box_2.value == ""))
	{
		box_1.style.border = "solid #FF9999 1px";
		box_2.style.border = "solid #FF9999 1px";
		box_send.disabled = true;
	}
	else
	{
		if(verifMail(box_1.value) && verifMail(box_2.value))
		{
			box_1.style.border = "solid #99FF99 1px";
			box_2.style.border = "solid #99FF99 1px";
			box_send.disabled = false;
		}
		else
		{
		box_1.style.border = "solid #FF9999 1px";
		box_2.style.border = "solid #FF9999 1px";
		box_send.disabled = true;
		}
	}

}


function ImYourFather(id1,id2,box)
{
	var box_send = document.getElementById(box);
	
	var box_1 = document.getElementById(id1);
	var box_2 = document.getElementById(id2);
	
	if (box_1.value != box_2.value  || (box_1.value == "" || box_2.value == ""))
	{
		box_1.style.border = "solid #FF9999 1px";
		box_2.style.border = "solid #FF9999 1px";
		box_send.disabled = true;
	}
	else
	{
		if(box_1.value == box_2.value)
		{
			box_1.style.border = "solid #99FF99 1px";
			box_2.style.border = "solid #99FF99 1px";
			box_send.disabled = false;
		}
		else
		{
		box_1.style.border = "solid #FF9999 1px";
		box_2.style.border = "solid #FF9999 1px";
		box_send.disabled = true;
		}
	}

}


function verifMail(a)
{
testm = false ;

 for (var j=1 ; j<(a.length) ; j++) {

  if (a.charAt(j)=='@') {

   if (j<(a.length-4)){

    for (var k=j ; k<(a.length-2) ; k++) {
     if (a.charAt(k)=='.') testm = true;

    }
   }
  }
 }
return testm ;

}