<?php $this->lang->load('miniapp', $this->session->userdata('ua_language')); ?>
<div id="sidebar"> 
        <ul>
<!--		// Quan lý tin tuc-->
        <h2>Quản lý tin tức</h2>  
        <li><?php
		  echo anchor('news/add', 'Đăng Tin'); 
		  ?></li>
		  <li><?php
		  echo anchor('news/browse', 'Danh Sách Tin'); 
		  ?></li>
 		  <li><?php
		  echo anchor('news_cat', 'Quản Lý Loại Tin'); 
		  ?></li>	         
<!--		// Quan lý tin roa -->
		  <h2>Quản lý tin rao</h2>  
		  <li><?php
		  echo anchor('quan-ly-tin-rv', 'Danh Sách Tin Rao'); 
		  ?></li>
		  <li><?php
		  echo anchor('properties/add', 'Đăng Tin Rao'); 
		  ?></li> 
		   <li><?php
		  echo anchor('cat', 'Loại tin rao'); 
		  ?></li> 
		   <li><?php
		  echo anchor('iht_district', 'Quản Lý Tỉnh Thành'); 
		  ?></li>	
<!--		// Quan ly cau hinh-->
		  <h2>Quản lý nội dung khác</h2>  
		  <?php if($this->session->userdata('userid')==1 || $this->session->userdata('groupid') == 2 || $this->session->userdata('groupid') == 1) {?>
		  <li><?php
		  echo anchor('menu', 'Quản Lý Menu'); 
		  ?></li>
		  <li><?php
		  echo anchor('ads', 'Quản Lý Quảng Cáo'); 
		  ?></li>
		  <?php if(access(LIST_VIDEO)) {
		  	echo '<li>'.anchor('upload_video', 'Quản Lý Video').'</li>';
          }?>
		  <li><?php
		  echo anchor('contact/browse/contact', 'Quản Lý Liên Hệ'); 
		  ?></li>
		  <li><?php
		  echo anchor('my-info', 'Thông Tin Cá Nhân'); 
		  ?></li>
		  <?php 
		  }
		  ?>
		  <h2>Quản lý hệ thống</h2>
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