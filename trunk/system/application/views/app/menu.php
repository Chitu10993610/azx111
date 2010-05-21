<?php $this->lang->load('miniapp', $this->session->userdata('ua_language')); ?>
<div id="sidebar"> 
        <ul>
<!--		// Quan lý tin tuc-->
        <?php if(access(VIEW_LIST_NEWS)) {
        ?> <h2>Quản lý tin tức</h2>
        <?}?>
		  <?php
		  if(access(ADD_NEWS)) {
		  	echo '<li>'.anchor('news/add', 'Viết bài').'</li>';
          }
		  if(access(VIEW_LIST_NEWS) || access(VIEW_ALL_NEWS)) {
		  	echo '<li>'.anchor('quan-ly-tin', 'Danh Sách bài viết').'</li>'; 
		  }
		  if(access(VIEW_LIST_CATEGORY)) {
			  echo '<li>'.anchor('news_cat', 'Quản Lý Chuyên Mục').'</li>'; 
		  }
		  ?>	         
<!--		// Quan lý tin roa -->
		  <?php if(access(VIEW_LIST_ADS)) {
        ?><h2>Quản lý tin rao</h2>
        <?}?>  
		  <?php
		  if(access(ADD_ADS)) {
		  	echo '<li>'.anchor('properties/add', 'Đăng Tin Rao').'</li>';
          }
		  if(access(VIEW_LIST_ADS) || access(VIEW_ALL_ADS)) {
		  	echo '<li>'.anchor('quan-ly-tin-rv', 'Danh Sách Tin Rao').'</li>'; 
		  }
		  if(access(VIEW_LIST_CATEGORY)) {
			  echo '<li>'.anchor('cat', 'Loại tin rao').'</li>'; 
		  }
		  ?>
<!--		// Quan ly cau hinh-->
		  <?php if(access(VIEW_LIST_MENU) || access(VIEW_LIST_PROMO) || access(LIST_VIDEO) || access(VIEW_LIST_CONTACT)) {
        ?><h2>Quản lý nội dung khác</h2>
        <?}?>    
		  <?php
		  if(access(VIEW_LIST_MENU)) {
		  	echo '<li>'.anchor('menu', 'Quản Lý Menu').'</li>';
		  }
		  if(access(VIEW_LIST_PROMO)) {
		  	echo '<li>'.anchor('ads', 'Quản Lý Quảng Cáo').'</li>';
		  }
		  if(access(LIST_VIDEO)) {
		  	echo '<li>'.anchor('upload_video', 'Quản Lý Video').'</li>';
          }
          if(access(VIEW_LIST_CONTACT)) {
		  	echo '<li>'.anchor('contact/browse/contact', 'Quản Lý Liên Hệ').'</li>';
          }
		  echo '<li>'.anchor('my-info', 'Thông Tin Cá Nhân').'</li>'; 
		  ?>
		  <?php if(access(CONFIG)) {
        ?><h2>Quản lý hệ thống</h2>
        <?}?>
		  <?php 
		  if(access(CONFIG)) {
		  	echo '<li>'.anchor('cau-hinh', 'Cấu Hình Hệ Thống').'</li>';
          }
          if(access(LIST_USER)) {
		  	echo '<li>'.anchor('admin/usergroups/index', 'Quản Lý Quản Trị Viên').'</li>';
          }
          if(access(LIST_USER)) {
		  	echo '<li>'. anchor('admin/usergroups/index/3', 'Quản Lý thành viên').'</li>';
          }
          if(access(LIST_GROUP)) {
		  	echo '<li>'.anchor('admin/usergroups/listgroup', 'Quản lý nhóm').'</li>';
          }if(access(ASSIGN_GROUP)) {
		  	echo '<li>'.anchor('admin/usergroups/assignGroups', 'Quản trị người dùng/nhóm').'</li>';
          }
          if(access(PERMISSION)) {
		  	echo '<li>'.anchor('admin/usergroups/perm', 'Phân quyền').'</li>';
          }?>
		   </ul>
</div>