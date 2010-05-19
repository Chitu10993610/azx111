var bolDisplayToolTip = true; //display tooltip hay ko
var bolUsernameAccepted = false; //username da duoc chap nhan
var bolUsernameChecked = false; //username da duoc kiem tra


var bolErrorUsername 	= false;
var bolAlertUsername 	= false;
var bolErrorPassword 	= false;
var bolErrorPassword2 	= false;
var bolErrorName 		= false;
var bolErrorGender 		= false;
var bolErrorBirthday 	= false;
var bolErrorEmail	 	= false;
var bolErrorEmailRetype	= false;
//var bolErrorLocation	= false;
var bolErrorSecurity	= false;

var strErrorUsername 	= '';
var strErrorPassword 	= '';
var strErrorPassword2 	= '';
var strErrorName 		= '';
var strErrorGender 		= '';
var strErrorBirthday 	= '';
var strErrorEmail	 	= '';
var strErrorEmailRetype	= '';
//var strErrorLocation	= '';
var strErrorSecurity	= '';

/*function DisplayLoading()
{
	document.getElementById("input_username_content").innerHTML = '<img src="http://static.timnhanh.com/passport/images/products/loading_img_56x15.gif" alt="" />';
}*/

function ResetForm()
{
	 bolErrorUsername 	= false;
	 bolAlertUsername 	= false;
	 bolErrorPassword 	= false;
	 bolErrorPassword2 	= false;
	 bolErrorName 		= false;
	 bolErrorGender 		= false;
	 bolErrorBirthday 	= false;
	 bolErrorEmail	 	= false;
	 bolErrorEmailRetype	= false;
	// bolErrorLocation	= false;
	 bolErrorSecurity	= false;
	
	 strErrorUsername 	= '';
	 strErrorPassword 	= '';
	 strErrorPassword2 	= '';
	 strErrorName 		= '';
	 strErrorGender 		= '';
	 strErrorBirthday 	= '';
	 strErrorEmail	 	= '';
	 strErrorEmailRetype	= '';
	// strErrorLocation	= '';
	 strErrorSecurity	= '';
}
 
// pre-submit callback 
/*function showRequest(formData, jqForm, options) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
    alert('About to submit: \n\n' + queryString); 
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
}*/ 
 
// post-submit callback 
function showResponse(responseText, statusText)  { 
	hide_Loading();
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
 
    // if the ajaxSubmit method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
 
    // if the ajaxSubmit method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
 
	if(responseText.error == 1) {
     	if(responseText.aryError.username == 1) {
     		bolErrorUsername = true;
			strErrorUsername = 'Username này đã được đăng ký, xin vui lòng chọn Username khác';	
			a = 2;
	     }
	     else if(responseText.aryError.username == 0) {
	     	bolErrorUsername = false;
	     	strErrorUsername = '';
			a = 1;
	     }
     
	     if(responseText.aryError.email == 1) {
	     	bolErrorEmail = true;
			strErrorEmail = 'Email này đã được đăng ký, xin vui lòng chọn email khác';
			g = 71;
	     }
	     else if(responseText.aryError.email == 0) {
	     	bolErrorEmail = false;
	     	strErrorEmail = '';
			g = 1;
	     }
     
//		     alert(bolErrorSecurity);
	     if(responseText.aryError.code == 1) {
			bolErrorSecurity	= true;
			strErrorSecurity	= 'Bạn cần nhập lại chính xác những ký tự trong hình bên';
			h = 91;
	     }
	     else if(responseText.aryError.code == 0) {
	     	bolErrorSecurity = false;
	     	strErrorSecurity = '';
			h = 1;
	     }
     
	     if ( a == 1 && b == 1 && c == 1 && g == 1 && h == 1 && t == 1 ) {
	     	return true;
	     }
	     else {
	     	setTimeout("TurnOnError();", 500);
			return false;
	     }
	}
	else if(responseText.error == 0) {
		alert(responseText.msg);
		window.location.href=responseText.url;
	}
}


function CheckForms(formData, jqForm, options) {
	show_Loading();
	ResetForm();
	$('.alert_box').hide(); // hide box alert khi nhan nut enter submit
	var frm 			= document.frmregis;
	var strusername 	= trim(frm.username.value);
	
	var strpass 		= trim(frm.password.value);
	var strpassverify 	= trim(frm.password2.value);
	var strfullname 	= trim(frm.fullname.value);
//	var strfirstname 	= trim(frm.firstname.value);
/*	for (var i=0; i < frm.gender.length; i++) {
		if (frm.gender[i].checked) {
			var strgender = frm.gender[i].value;
		}
	}*/

//	var strbirth_day	= trim(frm.slday.value);
//	var strbirth_month	= trim(frm.slmonth.value);
//	var strbirth_year	= trim(frm.slyear.value);

	var stremail		= trim(frm.email.value);
	var stremailretype	= trim(frm.email_retype.value);
//	var strcity			= trim(frm.slcity.value);
	var strcaptra 		= trim(frm.security_code.value);	
		
	var email_old 		= '';
	var username_old 	= '';
	
	var a = b = c = d = f = g = h = k = s = 0;

	
	
	//---- Username-------------
	a = CheckUsernameRegister(strusername);
	//---- Username-------------
	
	//---- Pass-------------
	b = CheckPassRegister(strpass);
	//---- Pass-------------
	
	//---- Passverify-------------
	c = CheckPassverifyRegister(strpass, strpassverify);		
	//---- Passverify-------------	
	
	//---- LastFirstname-------------
//	d = CheckLastFirstnameRegister(strfullname, strfirstname);
	d = CheckLastFirstnameRegister(strfullname);
	//---- LastFirstname-------------

	//---- Gender-------------
//	f = CheckGenderRegister(strgender);
	//---- Gender-------------
	
	//---- Email-------------
	g = CheckEmailRegister(stremail);
	//---- Email-------------

	//---- EmailRetype-------------
	t = CheckEmailRetypeRegister(stremailretype,stremail);
	//---- EmailRetype-------------
	
	//---- City-------------
//	s = CheckCityRegister(strcity);
	//---- City-------------	

	//---- Captra-------------
	h = CheckCaptraRegister(strcaptra);
	//---- Captra-------------
	
	//---- Birthday-------------
//	k = CheckBirthdayRegister(strbirth_day,strbirth_month,strbirth_year);
	//---- Birthday-------------
	
	bolDisplayToolTip = false;
	
	//check ajax
	/*if(!bolErrorUsername || !bolErrorEmail || !bolErrorSecurity) {
		$.ajax({
		   type: "POST",
		   dataType: "json",
		   url: "http://localhost/pro-nhanhuy/user/ucheck",
		   data: "username="+strusername+"&email="+stremail+"&code="+strcaptra,
		   success: function(rep){
		     if(!bolErrorUsername) {
		     	if(rep.username == 1) {
		     	bolErrorUsername = true;
				strErrorUsername = 'Username này đã được đăng ký, xin vui lòng chọn Username khác';	
				a = 2;
			     }
			     else if(rep.username == 0) {
			     	bolErrorUsername = false;
			     	strErrorUsername = '';
					a = 1;
			     }
		     }
		     
		     if(!bolErrorEmail) {
			     if(rep.email == 1) {
			     	bolErrorEmail = true;
					strErrorEmail = 'Email này đã được đăng ký, xin vui lòng chọn email khác';
					g = 71;
			     }
			     else if(rep.email == 0) {
			     	bolErrorEmail = false;
			     	strErrorEmail = '';
					g = 1;
			     }
		     }
		     
//		     alert(bolErrorSecurity);
		     if(!bolErrorSecurity) {
			     if(rep.code == 1) {
					bolErrorSecurity	= true;
					strErrorSecurity	= 'Bạn cần nhập lại chính xác những ký tự trong hình bên';
					h = 91;
			     }
			     else if(rep.code == 0) {
			     	bolErrorSecurity = false;
			     	strErrorSecurity = '';
					h = 1;
			     }
		     }
		     
		     if ( a == 1 && b == 1 && c == 1 && g == 1 && h == 1 && t == 1 ) {
		     	return true;
		     }
		     else {
		     	setTimeout("TurnOnError();", 500);
				return false;
		     }
		   }
		});
	}
	
	else*/ if ( a == 1 && b == 1 && c == 1 && g == 1 && h == 1 && t == 1 ) 
	{
		return true;
	}
	else
	{
		hide_Loading();
		setTimeout("TurnOnError();", 500);
		return false;
	}
	
}

function TurnOnError()
{
	if(bolErrorUsername)
	{
		document.getElementById('input_username').className = 'error';
		document.getElementById('error_notice_username').innerHTML = strErrorUsername;
	}
	else
	{
		document.getElementById('input_username').className = '';
	}
	
	if(bolErrorPassword)
	{
		document.getElementById('input_password').className = 'error';
		document.getElementById('error_notice_password').innerHTML = strErrorPassword;
	}
	else
	{
		document.getElementById('input_password').className = '';
	}
	
	if(bolErrorPassword2)
	{
		document.getElementById('input_password2').className = 'error';
		document.getElementById('error_notice_password2').innerHTML = strErrorPassword2;
	}
	else
	{
		document.getElementById('input_password2').className = '';
	}
	
	if(bolErrorName)
	{
		document.getElementById('input_name').className = 'error';
		document.getElementById('error_notice_name').innerHTML = strErrorName;
	}
	else
	{
		document.getElementById('input_name').className = '';
	}
	
/*	if(bolErrorGender)
	{
		document.getElementById('input_gender').className = 'error';
		document.getElementById('error_notice_gender').innerHTML = strErrorGender;
	}
	else
	{
		document.getElementById('input_gender').className = '';
	}

	if(bolErrorBirthday)
	{
		document.getElementById('input_birthday').className = 'error';
		document.getElementById('error_notice_birthday').innerHTML = strErrorBirthday;
	}
	else
	{
		document.getElementById('input_birthday').className = '';
	}*/
	
	if(bolErrorEmail)
	{
		document.getElementById('input_email').className = 'error';
		document.getElementById('error_notice_email').innerHTML = strErrorEmail;
	}
	else
	{
		document.getElementById('input_email').className = '';
	}

	if(bolErrorEmailRetype)
	{
		document.getElementById('input_email_retype').className = 'error';
		document.getElementById('error_notice_email_retype').innerHTML = strErrorEmailRetype;
	}
	else
	{
		document.getElementById('input_email_retype').className = '';
	}
	
//	if(bolErrorLocation)
//	{
//		document.getElementById('input_location').className = 'error';
//		document.getElementById('error_notice_location').innerHTML = strErrorLocation;
//	}
//	else
//	{
//		document.getElementById('input_location').className = '';
//	}
	
	if(bolErrorSecurity)
	{
		document.getElementById('input_security').className = 'error';
		document.getElementById('error_notice_security').innerHTML = strErrorSecurity;
	}
	else
	{
		document.getElementById('input_security').className = '';
	}
}


// JavaScript Document
//cat bo hai dau khoang trang
function trim(val)
{ 
	return val.replace(/^\s+|\s+$/g,"");
}

function RefreshCity()
{			
	var f 			= document.frmregis;		
	var listCountry = f.slcountry;
//	var listCity 	= f.slcity;		
	
	var countryID 	= listCountry.options[listCountry.selectedIndex].value;	
	var arrChildren;
	var arrTemp	;
	var i;
	var x = 1;
	listCity.length = 0 ;				
	var strChildCityList = f.city.value;
	arrChildren = strChildCityList.split("|");
	listCity.options[0] = new Option('[Lựa chọn]', 0);	
	for (i = 0; i < arrChildren.length; i++)
	{
		arrTemp = arrChildren[i].split("~");
		if (countryID == arrTemp[0]) 
		{
			listCity.options[x] = new Option(arrTemp[2], arrTemp[1]);
			x++
		}			
	}
}

//cho phep nhung ky tu tu A->Z, a->z, 0->9,va cac ky tu _-
function CheckUsernameChar(stringIn)
{
    
	retval = false
     var i;
     for ( i=0; i <= stringIn.length-1; i++) 
	 {
         if ( ( ( stringIn.charCodeAt(i) >= 48)&&(stringIn.charCodeAt(i) <= 57)) || ((stringIn.charCodeAt(i) > 64)&&(stringIn.charCodeAt(i) <= 90)) || ((stringIn.charCodeAt(i) >= 97)&&(stringIn.charCodeAt(i) <= 122)) || (stringIn.charCodeAt(i) == 95) || (stringIn.charCodeAt(i) == 45) )
		 {
           	retval = true;
         }
		 else
		 {
			retval = false;
			break;
         }
     }
     return retval;
}


// kiem tra xem user nhap vao username co tren 3 ky tu va duoi 20 ky tu khong?
function CheckStatus()
{
	var frm 	= document.frmregis;
	var struser = frm.username.value;
	
	if ( struser != '' && ( struser.length >= 3 && struser.length <= 20 ) )
	{
//		document.getElementById('btCheck').disabled	= false;
		document.getElementById('input_username').className="";
		bolUsernameChecked = false;
		return true;
			
	}
	else
	{
//		document.getElementById('btCheck').disabled	= true;
		return false;
	}
	
}

//kiem tra unicode cho password
function Checkchar1(stringIn)
{
    
	retval = false
     var i;
     for (i=0;i<=stringIn.length-1;i++) 
	 {
         if (((stringIn.charCodeAt(i) >= 8)&&(stringIn.charCodeAt(i) <= 127)) && (stringIn.charCodeAt(i)!=34) && (stringIn.charCodeAt(i)!=39) && (stringIn.charCodeAt(i)!=32))
		 {
           	retval = true;
         }
		 else
		 {
			retval = false;
			break;
         }
     }
     return retval;
}

//kiem tra cac ky tu dat biet @,<,>,!,$,%,(,),=,#,{,},[,],",^,~,`,,/,\,|,*,.,+,: cho fullname
function CheckChar(stringIn) 
{

	if ((stringIn.indexOf("@") >= 0)||(stringIn.indexOf("<") >= 0)||(stringIn.indexOf(">") >= 0)||(stringIn.indexOf("!") >= 0)||(stringIn.indexOf("$") >= 0)||(stringIn.indexOf("%") >= 0)||(stringIn.indexOf("(") >= 0)||(stringIn.indexOf(")") >= 0)||(stringIn.indexOf("=") >= 0)||(stringIn.indexOf("#") >= 0)||(stringIn.indexOf("{") >= 0)||(stringIn.indexOf("}") >= 0)||(stringIn.indexOf("[") >= 0)||(stringIn.indexOf("]") >= 0)||(stringIn.indexOf("|") >= 0)||(stringIn.indexOf('"') >= 0) ||(stringIn.indexOf(".") >= 0) ||(stringIn.indexOf(";") >= 0) ||(stringIn.indexOf("?") >= 0) ||(stringIn.indexOf(",") >= 0) ||(stringIn.indexOf("+") >= 0) ||(stringIn.indexOf("&") >= 0) ||(stringIn.indexOf(":") >= 0) ||(stringIn.indexOf("\\") >= 0) ||(stringIn.indexOf("/") >= 0) ||(stringIn.indexOf("*") >= 0) ||(stringIn.indexOf("`") >= 0) ||(stringIn.indexOf("~") >= 0) ||(stringIn.indexOf("^") >= 0) ||(stringIn.indexOf("-") >= 0)||(stringIn.indexOf("_") >= 0))
	{
		return false;
	}
	return true;
}

// kiem tra co dung la dia chi email.
function CheckEmail(stringIn)
{
	var re = /^([A-Za-z0-9\_\-]+\.)*[A-Za-z0-9\_\-]+@[A-Za-z0-9\_\-]+(\.[A-Za-z0-9\_\-]+)+$/;
	if ( stringIn.search(re) == -1 )
	{
		return false;
	}
	else
	{
		return true;
	}
}

//===== Username ===========
function CheckUsernameRegister(strusername)
{
	if ( strusername.length == 0 )
	{
		bolErrorUsername = true;
		strErrorUsername = 'Username không được để trống, xin vui lòng nhập Username';
		return 2;
	}
	else
	{	
		if ( strusername.indexOf("<")!= '-1' || strusername.indexOf(">") != '-1' )
		{
			bolErrorUsername = true;
			strErrorUsername = 'Username không được sử dụng ký tự Unicode, xin vui lòng kiểm tra lại';			
			return 2;
		}
		else
		{		
			if ( strusername.length < 3 || strusername.length > 20 )
			{
				bolErrorUsername = true;
				strErrorUsername = 'Username phải có độ dài lớn hơn 3 ký tự và nhỏ hơn 20 ký tự';				
				return 2;
			}
			else
			{	
				if ( !CheckUsernameChar( strusername ) )
				{
					bolErrorUsername = true;
					strErrorUsername = 'Username không được sử dụng ký tự Unicode, xin vui lòng kiểm tra lại';		
					return 2;
				}
/*				else
				{
					if(bolUsernameChecked)//neu da nhan nut check
					{
						if ( !bolUsernameAccepted )
						{
							bolErrorUsername = true;
							strErrorUsername = 'Username này đã được đăng ký, xin vui lòng chọn Username khác';	
							return 2;
						}
						else
						{
							bolErrorUsername = false;
							return 1;
						}
					}
					else
					{
						bolErrorUsername = false;
						return 1;
					}

				}*/
			}
		}
	}
	return 1;
}
//===== Username ===========

//===== Pass ===========
function CheckPassRegister(strpass)
{
	if ( strpass.length == 0 )
	{
		bolErrorPassword = true;
		strErrorPassword = 'Password không được để trống, xin vui lòng nhập password';
		return 31;
	}
	else
	{
		if ( strpass.indexOf("<") != '-1' || strpass.indexOf(">") != '-1' )
		{
			bolErrorPassword = true;
			strErrorPassword = 'Password không được sử dụng ký tự Unicode, xin vui lòng kiểm tra lại';
			return 32;
		}
		else
		{		
			if ( strpass.length < 3 || strpass.length > 30 )
			{
				bolErrorPassword = true;
				strErrorPassword = 'Password phải có độ dài lớn hơn 3 ký tự và nhỏ hơn 30 ký tự';
				return 33;
			}
			else
			{	
				if ( !Checkchar1( strpass ) )
				{
					bolErrorPassword = true;
					strErrorPassword = 'Password không được sử dụng ký tự Unicode, xin vui lòng kiểm tra lại';		
					return 34;
				}
				else
				{										
					bolErrorPassword = false;
					return 1;
				}
			}
		}	
	}
	return 1;
}
//===== Pass ===========

//===== Passverify ===========
function CheckPassverifyRegister(strpass, strpassverify)
{
	if ( strpassverify.length == 0 )
	{
		bolErrorPassword2 = true;
		strErrorPassword2 = 'Xin vui lòng nhập chính xác Password ở trên';
		return 41;
	}
	else
	{
		if ( strpassverify.indexOf("<")!= '-1' || strpassverify.indexOf(">") != '-1' )
		{
			bolErrorPassword2 = true;
			strErrorPassword2 = 'Xin vui lòng nhập chính xác Password ở trên';
			return 42;
		}
		else
		{		
			if ( strpassverify.length < 3 || strpassverify.length > 30 )
			{
				bolErrorPassword2 = true;
				strErrorPassword2 = 'Xin vui lòng nhập chính xác Password ở trên';
				return 43;
			}
			else
			{	
				if ( !Checkchar1( strpassverify ) )
				{
					bolErrorPassword2 = true;
					strErrorPassword2 = 'Xin vui lòng nhập chính xác Password ở trên';
					return 44;
				}
				else
				{										
					if ( strpassverify != strpass )
					{
						bolErrorPassword2 = true;
						strErrorPassword2 = 'Xin vui lòng nhập chính xác Password ở trên';		
						return 45;
					}
					else
					{	
						bolErrorPassword2 = false;
						return 1;
					}
				}
			}
		}
	}
	return 1;
}
//===== Passverify ===========

//===== Ho ten ===========
function CheckLastFirstnameRegister(strfullname)
{
//	if ( strfullname.length == 0 || strfullname == '[Họ và tên đệm (lót)]' || strfirstname.length == 0 || strfirstname == '[Tên]' )
	if ( strfullname.length == 0)
	{
		bolErrorName = true;
		strErrorName = 'Xin vui lòng nhập đầy đủ họ và tên';
		return 51;
	}
	else
	{	
		if ( strfullname.indexOf("<") != '-1' || strfullname.indexOf(">") != '-1' || !CheckChar( strfullname ) )
		{
			bolErrorName = true;
			strErrorName = 'Họ, tên không được chứa ký tự đặc biệt';		
			return 52;
		}
		else
		{		
			if ( strfullname.length > 50 )
			{
				bolErrorName = true;
				strErrorName = 'Họ và tên của bạn phải có độ dài nhỏ hơn 50 ký tự';				
				return 53;
			}
			/*else
			{	
				if ( strfirstname.length == 0 || ( strfirstname.length == 5 && strfirstname == '[Tên]' ) )
				{
					bolErrorName = true;
					strErrorName = 'Xin vui lòng nhập đầy đủ họ và tên';			
					return 54;
				}
				else
				{	
					if ( strfirstname.indexOf("<") != '-1' || strfirstname.indexOf(">") != '-1' )
					{
						bolErrorName = true;
						strErrorName = 'Họ, tên không được chứa ký tự đặc biệt';
						return 55;
					}
					else
					{		
						if ( strfirstname.length > 10 )
						{
							bolErrorName = true;
							strErrorName = 'Tên của bạn phải có độ dài nhỏ hơn 10 ký tự';
							return 56;
						}
						else
						{		
							if ( !CheckChar( strfirstname ) )
							{
								bolErrorName = true;
								strErrorName = 'Họ, tên không được chứa ký tự đặc biệt';
								return 57;
							}
							else
							{
								if ( strfirstname.indexOf(" ") != '-1' )
								{
									bolErrorName = true;
									strErrorName = 'Tên không được có khoảng trắng';
									return 58;
								}
								else
								{
								
									bolErrorName = false;
									return 1;
								}
							}
						}
					}
				}
			}*/
		}
	}
	return 1;
}
//===== Ho ten ===========

//===== Gender ===========
function CheckGenderRegister(strgender)
{
	if ( !strgender || strgender=='undefined' )
	{
		bolErrorGender = true;
		strErrorGender = 'Bạn cần chọn giới tính';
		return 61;
	}
	bolErrorGender = false;
	return 1;
}
//===== Gender ===========

//===== Birthday ===========
function CheckBirthdayRegister(intDay, intMonth, intYear)
{
	if ( intDay == 0 || intMonth == 0 || intYear == 0)
	{
		bolErrorBirthday = true;
		strErrorBirthday = 'Xin vui lòng chọn ngày sinh của bạn.';
		return 101;
	}
	else
	{
		bolErrorBirthday = false;
		return 1;
	}
	return 1;
}
//===== Birthday ===========

//===== Email ===========
function CheckEmailRegister(stremail)
{
	if ( stremail.length == 0 )
	{
		bolErrorEmail = true;
		strErrorEmail = '<span class="conerr">Xin vui lòng nhập địa chỉ email của bạn</span>';
		return 71;
	}
	else
	{
		if ( stremail.indexOf("<") != '-1' || stremail.indexOf(">") != '-1' )
		{
			bolErrorEmail = true;
			strErrorEmail = '<span class="conerr">Địa chỉ email không đúng định dạng, xin vui lòng kiểm tra lại</span>';
			return 72;
		}
		else
		{		
			if ( !CheckEmail( stremail ) )
			{
				bolErrorEmail = true;
				strErrorEmail = '<span class="conerr">Địa chỉ email không đúng định dạng, xin vui lòng kiểm tra lại</span>';
				return 73;
			}
			else
			{	
				bolErrorEmail = false;
				return 1;
			}
		}
	}
	return 1;
}
//===== Email ===========

//===== Email Retype ===========
function CheckEmailRetypeRegister(stremailretype,stremail)
{
	if ( stremailretype.length == 0 )
	{
		bolErrorEmailRetype = true;
		strErrorEmailRetype = '<span class="conerr">Xin vui lòng nhập chính xác địa chỉ email ở trên</span>';
		return 771;
	}
	else
	{
		if ( stremail!=stremailretype )
		{
			bolErrorEmailRetype = true;
			strErrorEmailRetype = '<span class="conerr">Xin vui lòng nhập chính xác địa chỉ email ở trên</span>';
			return 772;
		}
		else
		{		
			bolErrorEmailRetype = false;
			return 1;
		}
	}
	return 1;
}
//===== EmailRetype ===========


//===== City ===========
function CheckCityRegister(strcity)
{
	if ( strcity == 0 )
	{
		bolErrorLocation = true;
		strErrorLocation = 'Xin vui lòng chọn tỉnh thành nơi bạn sinh sống';
		return 81;
	}
	else
	{
		bolErrorLocation = false;
		return 1;
	}
	return 1;
}
//===== City ===========


//===== Captra ===========
function CheckCaptraRegister(strcaptra)
{	
	if ( strcaptra.length == 0 )
	{	
		bolErrorSecurity	= true;
		strErrorSecurity	= 'Bạn cần nhập lại chính xác những ký tự trong hình bên';
		return 91;
	}
	else
	{
		if ( strcaptra.indexOf("<") != '-1' || strcaptra.indexOf(">") != '-1' )
		{
			bolErrorSecurity	= true;
			strErrorSecurity	= 'Bạn cần nhập lại chính xác những ký tự trong hình bên';
			return 92;
		}
		else
		{							
			if ( strcaptra.indexOf(' ') != -1 )
			{
				bolErrorSecurity	= true;
				strErrorSecurity	= 'Bạn không cần nhập khoảng trắng';
				return 93;
			}
			else
			{
				bolErrorSecurity	= false;
				return 1;
			}
		}
	}
	return 1;
}
//===== Captra ===========


//======ToolTip===========
/*
 * Show alert box
 * Type:	function
 * Name:	NHYShowAlert
 * Date:	2008/05/26
 * @author:	Tuyen Cao <tuyenck@von-inc.com> 
 * @param object obj: goi chinh no
 * @param int num: so thu tu
 */
var alert_box;
var _num;

function NHYShowAlert(obj,num){	
	if(bolDisplayToolTip)
	{
		$('.alert_box').hide();
		alert_box = $('#'+ $(obj).attr('alt'));
		$(alert_box).fadeIn('slow').removeAttr('style');
		$('#tnpp_main_box li').removeAttr('class');
		$(obj).parent().parent().addClass('alert');	
		_num = num;
		var topBox=$(obj).offset().top - $('.main_box_content').offset().top+'px';
		switch(num){
			case 0:
				$(alert_box).css('top',topBox);
				break;
			case 1:
				$(alert_box).css('top',topBox);
				break;
			case 2:
				$(alert_box).hide();
				$(obj).parent().parent().removeClass('alert').addClass('alert_noarr');
				if((obj).value=='[Họ và tên đệm (lót)]') (obj).value='';
				break;
			case 3:
				$(alert_box).css('top',topBox);
				break;
			case 4:
				$(obj).parent().parent().removeClass('alert').addClass('alert_nobg');	
				$(alert_box).css('bottom','56px');
				break;
			case 5:
				$(alert_box).hide();
				$(obj).parent().parent().removeClass('alert').addClass('alert_noarr');
				if((obj).value=='[Tên]') (obj).value='';
				break;	
		}
	}
	else
	{
		_num = num;
		switch(num){

			case 2:
				if((obj).value=='[Họ và tên đệm (lót)]') (obj).value='';				
				break;
			case 5:
				if((obj).value=='[Tên]') (obj).value='';
				break;	
		}
		
	}
}
$('#tnpp_main_box input').blur(function(){
	if(bolDisplayToolTip)
	{
		//$('#tnpp_main_box li').removeAttr('class'); // show box option typing 
		$('.alert_box').hide();
		var idInput=$(this).attr('id');
		if(_num==2 && idInput=='lastName')
		{
			if($(this).val()=='') ($(this)).val('[Họ và tên đệm (lót)]');
		}
		else if(_num==5 && idInput=='firstName')
		{
			if($(this).val()=='') ($(this)).val('[Tên]');
		}
		else
		{
			$('#tnpp_main_box li').removeAttr('class'); // remove ToolTip
		}
	}
	else
	{
		var idInput=$(this).attr('id');
		if(_num==2 && idInput=='lastName')
		{
			if($(this).val()=='') ($(this)).val('[Họ và tên đệm (lót)]');
		}
		if(_num==5 && idInput=='firstName')
		{
			if($(this).val()=='') ($(this)).val('[Tên]');
		}
	}
});

setTimeout("TurnOnError();", 500);