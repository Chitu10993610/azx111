<div class="menu_2" >
	<ul class="menu_2_ul" >
		<li class="menu_2_li">
			<a class="menu_2_a" href="<?=site_url()?>front/ha_noi">Hà Nội</a>
		</li>
		<li class="menu_2_li">
			<a class="menu_2_a" href="<?=site_url()?>front/ho_chi_minh">HCM</a>
		</li>
		<li class="menu_2_li">
			<a class="menu_2_a"  href="#"  onClick="return overlay(this, 'chooseCity', 'rightbottom')">Tỉnh thành khác</a>
		</li>				
	</ul>
</div>
<div id="vietbai">
	<a class="menu_2_a" href="<?=site_url()?>front/register">Đăng ký</a> | 
	<a class="menu_2_a" href="<?=site_url()?>news/add">Viết bài</a>
</div>
<div class="seo">
	<div class="raovat"><a target="_blank" href="http://tapchithuongmai.net" class="menu_2_a" style=""><img src="<?=site_url()?>images/raovattd.gif"></a></div>
	<form name="search" action="<?=base_url()?>front/search" method="POST">
		<div class="seo_input"><input type="text"  name="keyword" maxlength="50px" id="keyword" /></div> 
		<div class="seo_button" ><input type="image" src="<?=site_url()?>images/timkiem.gif"></div>
	</form>
</div>