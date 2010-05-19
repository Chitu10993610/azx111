<html>
<head>
<title>Code Crafter <?= isset($field1)?$field1:''; ?> - V0.3- Created by DataCraft Software</title>
<?= isset($field2)?$field2:''; ?>
<!-- ----------------------------------------------------------------------- -->
<!-- The following code extract is for the site navigator. Renove it if you  -->
<!-- ...are using your own navigation system.                                -->
<!-- ----------------------------------------------------------------------- -->
<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.suckerdiv ul{
margin: 0;
padding: 0;
list-style-type: none;
width: 130px; /* Width of Menu Items */
border-bottom: 1px solid #ccc;
}
	
.suckerdiv ul li{
position: relative;
border: 1px solid #ccc;
}
	
/*1st level sub menu style */
.suckerdiv ul li ul{
left: 129px; /* Parent menu width - 1*/
position: absolute;
width: 140px; /*sub menu width*/
top: 0;
display: none;
background-color: white;
}

/*All subsequent sub menu levels offset */
.suckerdiv ul li ul li ul{ 
left: 139px; /* Parent menu width - 1*/
border: 1px solid #ccc;
}

/* menu links style */
.suckerdiv ul li a{
display: block;
color: black;
text-decoration: none;
background: #fff;
padding: 1px 5px;
border: 1px solid #ccc;
border-bottom: 0;
}

.suckerdiv ul li a:visited{
color: black;
}

.suckerdiv ul li a:hover{
background-color: yellow;
}

.suckerdiv .subfolderstyle{
background: url(media/arrow-list.gif) no-repeat center right;
}

	
/* Holly Hack for IE \*/
* html .suckerdiv ul li { float: left; height: 1%; }
* html .suckerdiv ul li a { height: 1%; }
/* End */

</style>

<script type="text/javascript">

//SuckerTree Vertical Menu (Aug 4th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["navigator"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
    ultags[t].parentNode.getElementsByTagName("a")[0].className="subfolderstyle"
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.display="block"
    }
    ultags[t].parentNode.onmouseout=function(){
    this.getElementsByTagName("ul")[0].style.display="none"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus)

</script>
<!-- ----------------------------------------------------------------------- -->
<!--                               END OF EXTRACT                            -->
<!-- ----------------------------------------------------------------------- -->


</head>
<BODY>
