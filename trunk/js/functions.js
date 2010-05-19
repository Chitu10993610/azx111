function trimAll( strValue ) {
var objRegExp = /^(\s*)$/;

    //check for all spaces
    if(objRegExp.test(strValue)) {
       strValue = strValue.replace(objRegExp, '');
       if( strValue.length == 0)
          return strValue;
    }

   //check for leading & trailing spaces
   objRegExp = /^(\s*)([\W\w]*)(\b\s*$)/;
   if(objRegExp.test(strValue)) {
       //remove leading and trailing whitespace characters
       strValue = strValue.replace(objRegExp, '$2');
    }
  return strValue;
}
//change password
function verchangepassword()
{
	document.getElementById('error').style.visibility='hidden';
	document.getElementById('error').innerHTML='Please complete requested fields notated in the color RED.';
	document.getElementById('f2').style.color='';
	document.getElementById('f3').style.color='';
	document.getElementById('f4').style.color='';
	var a,b,c;
	var checkpass = "0123456789-_qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
	a=document.forms[0].elements[0].value;
	b=document.forms[0].elements[1].value;
	alert(b);
	c=document.forms[0].elements[2].value;
	if(trimAll(a)=='' || trimAll(b)=='' || trimAll(c)=='')
	{
	 if(trimAll(c) =='' ) 
	 {
 		document.getElementById('f4').style.color='red';
		document.forms[0].elements[2].focus();
	 }
	 if(trimAll(b) =='' ) 
	 {
 		document.getElementById('f3').style.color='red';
		document.forms[0].elements[1].focus();
	 }
	  if(trimAll(a) =='' ) 
	 {
		 document.getElementById('f2').style.color='red';
		 document.forms[0].elements[0].focus();
	 }
	  document.getElementById('error').style.visibility='visible';
	  return false;
	}
	else
	{
	if(trimAll(b)!='') 
	 		{
					for (i = 0;  i < b.length;  i++)
						{
						ch = b.charAt(i);
						for (j = 0;  j < checkpass.length;  j++)
						if (ch == checkpass.charAt(j))
						break;
						if (j == checkpass.length)
						{	
						document.getElementById("error").innerHTML="The password can't contain spaces or special characters.";
						document.getElementById('f3').style.color='red';
						document.getElementById('error').style.visibility='visible';
		 				document.forms[0].elements[1].focus();
						 return false;
						break;
						}
					}
			}
	if(b.length<7)
	{
		document.getElementById("error").innerHTML="The new password must have at least 7 characters.";
		document.getElementById('f3').style.color='red';
		document.getElementById('error').style.visibility='visible';
		document.forms[0].elements[1].focus();
		 return false;
	}
	if(trimAll(b) != trimAll(c))
		{
	    document.getElementById('error').innerHTML="The new passwords doesn't match.";
		document.getElementById('error').style.visibility='visible';
		document.getElementById('f3').style.color='red';
		document.getElementById('f4').style.color='red';
		document.forms[0].elements[1].focus();
		return false;
		}
	}
document.forms[0].submit();
}
///admin 
function verchangeemail()
{
	document.getElementById('error').style.visibility='hidden';
	document.getElementById('error2').style.visibility='hidden';
	document.getElementById('error2').innerHTML='Please complete Email Address.';
	document.getElementById('f2').style.color='';
	document.getElementById('f3').style.color='';
	document.getElementById('f4').style.color='';
	document.getElementById('f5').style.color='';
	var a;
	a=document.forms[1].elements[0].value;
	 if(trimAll(a) =='' ) 
	 {
 		document.getElementById('f5').style.color='red';
		document.forms[1].elements[0].focus();
		document.getElementById('error2').style.visibility='visible';
	    return false;
	 }
	 if(!check_email(a)) 
		{
		document.getElementById('error2').innerHTML="Please enter a valid email address.";
		document.getElementById('error2').style.visibility='visible';
		document.getElementById('f5').style.color='red';
		document.forms[1].elements[0].focus();
		return false;
		}
		document.forms[1].submit();
}

//check email
	
	function check_email(e) 
{
	ok = "1234567890qwertyuiop[]asdfghjklzxcvbnm.@-_QWERTYUIOPASDFGHJKLZXCVBNM";
	var i=0;
	for(i=0; i < e.length ;i++)
	{
		if(ok.indexOf(e.charAt(i))<0)
		{ 
			return (false);
		}
	} 
		
	if (document.images) 
	{
		re = /(@.*@)|(\.\.)|(^\.)|(^@)|(@$)|(\.$)|(@\.)/;
		re_two = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if (!e.match(re) && e.match(re_two)) 
		{
			return (-1);
		} 
	}	
}

///first page
function verlogin()
{
	var str = 'Xin mời nhập đầy đủ username và password.';
	
	if((trimAll(document.getElementById('username').value)=='')||(trimAll(document.getElementById('password').value)=='')) {
		if(document.getElementById('error') != null) {
//			document.getElementById('error').style.visibility='hidden';
			document.getElementById('error').style.visibility='visible';
			document.getElementById('error').innerHTML='Xin mời nhập đầy đủ username và password.';
		}
		else {
			alert(str);
		}
		
		return false;
	} 
//document.forms[0].submit();
	return true;
}

function addField(area,field,limit) 
{
	if(!document.getElementById) return; //Prevent older browsers from getting any further.
	if(trimAll(document.manualsend.toname.value)=='') 
		{
		document.getElementById('error').innerHTML='Friend name is required.';
		document.getElementById('error').style.visibility='visible';
		document.manualsend.toname.focus();
		return false;
		}
		if(!check_email(document.manualsend.toemail.value)) 
		{
		document.getElementById('error').innerHTML='Please insert a valid email address.';
		document.getElementById('error').style.visibility='visible';
		document.manualsend.toemail.focus();
		return false;
		}
		
		
	var field_area = document.getElementById(area);
	var all_inputs = field_area.getElementsByTagName("input"); 

	var last_item = all_inputs.length - 1;
	var last = all_inputs[last_item].id;
	var count = Number(last.split("_")[1]) + 1;
	if(count > limit && limit > 0) return;
 	
	if(document.createElement) 
		{ 
		var p = document.createElement("p");
		//var input = document.createElement("input");
		//input.id = field+count;
		//input.name = field+count;
		//input.type = "hidden"; 
		//p.appendChild(input);
        p.innerHTML ='<input type="hidden" name="contacts['+document.manualsend.toemail.value+']" id="'+field+count+'"> ';
        p.innerHTML +=document.manualsend.toname.value+' - '+document.manualsend.toemail.value;
		p.innerHTML +='<a href="javascript:;" class="slink" onClick="document.manualsend.totalnumberemails.value=parseInt(document.manualsend.totalnumberemails.value)-1;this.parentNode.parentNode.removeChild(this.parentNode);" ><b>[Remove this email]</b></a>';
		field_area.appendChild(p);
//		document.getElementById(field+count).value=document.manualsend.toemail.value+','+document.manualsend.toname.value;
		document.getElementById(field+count).value=document.manualsend.toname.value;
		document.manualsend.toemail.value='';
		document.manualsend.toname.value='';
		document.manualsend.nrofemails.value=parseInt(document.manualsend.nrofemails.value)+1;
		document.manualsend.totalnumberemails.value=parseInt(document.manualsend.totalnumberemails.value)+1;
		
	 	} 
	else 
	{ 
		field_area.innerHTML += "<input name='"+(field+count)+"' id='"+(field+count)+"' type='text' /> <a onclick='this.parentNode.parentNode.removeChild(this.parentNode);'>Remove Field</a><br>";
	}
}

function verimport()
{
    document.getElementById('message').style.visibility='hidden';
	if(trimAll(document.massimport.elements[0].value)=='')
	{
	document.getElementById('message').style.visibility='visible';
	document.massimport.elements[0].focus();
	document.getElementById('message').innerHTML='Please Complete Email Address.';
	return false;
	} 
	if(trimAll(document.massimport.elements[2].value)=='')
	{
	document.getElementById('message').style.visibility='visible';
	document.getElementById('message').innerHTML='Please Complete Password.';
	document.massimport.elements[2].focus();
	return false;
	} 
		if(trimAll(document.massimport.elements[3].value)=='')
	{
	document.getElementById('message').style.visibility='visible';
	document.getElementById('message').innerHTML='Please Complete Your Name.';
	document.massimport.elements[3].focus();
	return false;
	} 
		document.getElementById('message').style.visibility='visible';
	document.getElementById('message').innerHTML="<img src='images/loader.gif' border=0 hspace=0 vspace=0>";
	document.massimport.masssubmit.value='Please wait...';
	document.massimport.masssubmit.disabled=true;
	document.getElementById('errorlabel').style.padding='0';
	window.setTimeout("document.massimport.submit()",1000);

}

function vermanualsend()
{
  document.getElementById('error').style.visibility='hidden';
	document.getElementById('error').innerHTML='Your name and email address are required. Please fill in.';
	if((trimAll(document.manualsend.fromemail.value)=='')||(trimAll(document.manualsend.clientname.value)==''))
	{
	document.getElementById('error').style.visibility='visible';
	return false;
	} 
	if(!check_email(document.manualsend.fromemail.value)) 
	{
	document.getElementById('error').innerHTML='Please insert a valid email address.';
	document.getElementById('error').style.visibility='visible';
	document.manualsend.fromemail.focus();
	return false;
	}
	if(document.manualsend.totalnumberemails.value=='0')
	{
	document.getElementById('error').innerHTML='Please add at least one contact.';
	document.getElementById('error').style.visibility='visible';
	document.manualsend.toname.focus();
	return false;
	}
	
document.manualsend.submit();
}

function divToogle(el) {
	$("#"+el).slideToggle(380);
};

function doIt(el, id, nowID) {
	//append to list
	nowID++;
	$("div#"+el).append('<div style="padding:10px;border-top:1px solid #eee;"><span></span>&nbsp;&nbsp;<input type="text" id="'+id+nowID+'" value="" name="neighborhood[]" style="width:388px;" />&nbsp;&nbsp;<a onclick="removeItem('+nowID+',\''+id+'\')" href="javascript:void(0)">X</a></div>');
}
function removeItem(index, id){
	
	$('#'+id+index).parent().remove();
}

function openPopup(url, name)
 {
   	mywindow = window.open (url, name, "location=1,status=1,scrollbars=1,width=630,height=600");
  	mywindow.moveTo(200,100);
 } 

 function isInt16(value) {
	if(isNaN(value)){
		return false;	 
	}
	if(parseInt(value) < 0)	{
		return false;	
	}
	if(value.indexOf('.') >= 0)	{
		return false;
	}
	return true;
}

/*Add option*/
 function addOption(selectbox,text,value ) {
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;
	selectbox.options.add(optn);
}

/*remove option*/
function removeAllOptions(selectbox) {
	var i;
	for(i=selectbox.options.length-1;i>=0;i--) {
		selectbox.remove(i);
	}
}

/*remove selected option*/
function removeOptions(selectbox) {
	var i;
	for(i=selectbox.options.length-1;i>=0;i--) {
		if(selectbox.options[i].selected)
			selectbox.remove(i);
	}
}

//check action to grid
function checkGrid() {
	var alen=document.frmViewNews.elements.length;
	var isChecked=false;
	alen=(alen>2)?document.frmViewNews.chkid.length:0;
	if (alen>0){
		for(var i=0;i<alen;i++)
			if (document.frmViewNews.chkid[i].checked==true)
				isChecked=true;
	}
	else{
		if(document.frmViewNews.chkid.checked==true)
			isChecked=true;
	}
	if(!isChecked)
		alert("Ban phai chon it nhat 1 ban tin.");
	else{
		blnDel=confirm("Ban co chac chan xoa cac tin nay khong?");
		if (blnDel==true)
			isChecked=true;
		else
			isChecked=false;
	}
	return isChecked;
}

function docheck(status,from_){
	var alen=document.frmViewNews.elements.length;
	alen=(alen>2)?document.frmViewNews.chkid.length:0;
	if (alen>0){
		for(var i=0;i<alen;i++)
			document.frmViewNews.chkid[i].checked=status;
	}
	else {
		document.frmViewNews.chkid.checked=status;
	}
	if (from_>0)
		document.frmViewNews.chkall.checked=status;
}

function docheckone(){
	var alen=document.frmViewNews.elements.length;
	var isChecked=true;
	alen=(alen>2)?document.frmViewNews.chkid.length:0;
	if (alen>0){
		for(var i=0;i<alen;i++)
			if (document.frmViewNews.chkid[i].checked==false)
				isChecked=false;
	}
	else{
		if (document.frmViewNews.chkid.checked==false)
			isChecked=false;
	}
	document.frmViewNews.chkall.checked=isChecked;
}
function checkall(){
	if (document.frmViewNews.chkall.checked==true)
		docheck(true,1);
	else
		docheck(false,2);
}
/*end check action to grid */