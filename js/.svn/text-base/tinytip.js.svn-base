
// preload the image for the tip for firefox
preload1= new Image(7,5); 
preload1.src="./src/Jeux/images/tooltip.gif"; 

function CreateToolTip(img,tiptext,y,x) {
	if (!document.getElementById("tip")) { // only one tip should be active at a time
		// create div for text
		var divtip = document.createElement("div")
		divtip.setAttribute('id',"tip")
		document.body.appendChild(divtip)

		// create the tip image
		var tipimg = document.createElement("img")
		tipimg.setAttribute('id',"tipimg")
		tipimg.setAttribute('src',"tooltip.gif")
		document.body.appendChild(tipimg)
		document.getElementById("tipimg").style.position = "absolute"


		var elm_div = document.getElementById("tip") // lets grab the elements we just created
		var elm_img = document.getElementById("tipimg") // grab the pointer image

		// set styles on the tip box	
		elm_div.style.border = "solid 1px black"
		elm_div.innerHTML =  tiptext;
		elm_div.style.position = "absolute";
		elm_div.style.background = "white"

		// position the top of the tool tip			
		elm_img.style.top = x; /*(img.offsetTop - elm_img.height) + 50;*/
		elm_img.src = "go fuck"; 
		elm_img.style.display = "none";
		elm_img.style.padding = "5px 5px 5px 5px";
		
		elm_div.style.top = x;/*(img.offsetTop - elm_img.height - elm_div.offsetHeight +1) +50 + *///x +elm_img.style.height ;
		// position the left side of the tool tip
		if (elm_div.offsetWidth > img.width ) { // image is smaller than the div
			elm_div.style.left = (img.offsetLeft - ((elm_div.offsetWidth - img.width) / 2)) + 275;
			elm_img.style.left = (img.offsetLeft - ((elm_img.width - img.width) / 2)) + 275;
		}
		else if (elm_div.style.width < img.width) { // div is smaller than the image
			elm_div.style.left = (img.offsetLeft + ((img.width - elm_div.offsetWidth)  / 2) ) + 275;
			elm_img.style.left = (img.offsetLeft - ((elm_img.width - img.width) / 2) ) + 275;
		}
		else  // image and tip are same size
		{
			elm_div.style.left =(img.offsetLeft) + 225;
			elm_img.style.left = (img.offsetLeft - ((elm_img.width - img.width) / 2) ) + 275;
		}
	}
}

function RemoveToolTip() {
	// remove the tool tip div and the image associated with it
	if (document.getElementById("tip")) {
		elm = document.getElementById("tip")
		document.body.removeChild(elm)
	}
	if (document.getElementById("tipimg")) {
		elm = document.getElementById("tipimg")
		document.body.removeChild(elm)
	}			
}
