<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Iht_Common {

	// ACL variables
	var $allowed_users = array();	// Allowed Groups and users
	var $denied_users = array();	// Denied Groups and users
	var $allowed_set = FALSE;		// Has set_allowed() been used
	var $denied_set = FALSE;		// Has set_denied() been used
	var $allow = FALSE;				// Cuurent status of permission

	function Iht_Common()
	{
		$this->obj =& get_instance();
	}

		//resize image
	function create_thumb($img_src, $width, $height = 0, $creat_thumb = true, $thumb_src='', $thumb_marker = '') {
		$this->obj->load->library('image_lib');
		$this->obj->image_lib->clear();
		
		if(!$creat_thumb) {
			$imgSize = getimagesize($img_src);
			if($imgSize[0] <= $width && $imgSize[1] <= $width) return;
		}
		else if($creat_thumb && !$thumb_src) { //create thumb name
			$ary_path = pathinfo($img_src);
			$thumb_src = $ary_path['dirname'].'/.thumbs/.'.$ary_path['filename'].'.'.$ary_path['extension'];
			$config['new_image'] = $thumb_src;
		}
	
		$config['source_image'] = $img_src;
		$config['quality'] = '100%';
		$config['create_thumb'] = $creat_thumb;
		$config['thumb_marker'] = $thumb_marker;
		$config['width'] = $width;
		$config['height'] = ($height)? $height : $width;
		
		$this->obj->image_lib->initialize($config); 
		
		if (!$this->obj->image_lib->resize()) {
			$this->obj->image_lib->clear();
		    return $this->obj->image_lib->display_errors();
		}
	}
	
	   /**
    * upload image
    *
    * @param unknown_type $data
    * @param unknown_type $file_name
    * @param unknown_type $field_name
    * @param unknown_type $old_file
    */
    public function upload(&$data, $file_name, $field_name, $old_file, $upload_path) {
   	 	if($file_name != '') {
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|png|swf';
			$config['max_size']	= '5000';
			$config['max_width']  = '11024';
			$config['max_height']  = '11768';
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload($field_name)) {
				$error = $this->upload->display_errors('<div class="error">','</div>');
			}
			else {
				$upload_data = $this->upload->data();
				$data[$field_name] = $upload_data['file_name'];
				@unlink($config['upload_path'].'/'.$old_file);
			}
		}
		else {
			unset($data[$field_name]);
		}
   }
   
   //make water mark
   function water_mark($img_src, $overlay = true, $overlay_path ='') {
		$config['source_image']	= $img_src;
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = $overlay_path;
		$config['wm_opacity'] = '30';
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'left';
		$config['wm_hor_offset'] = '5';
		$config['wm_vrt_offset'] = '5';
		
		$this->obj->image_lib->initialize($config); 
		
		$this->obj->image_lib->watermark();
   }
   
      /**
    * create category list for select
    *
    * @param array $data
    */
   function build_cat(&$data, $filter = '') {
   		$this->obj->load->model('nny_catmodel');
		$aryCatList = array();
		$filter .= " AND cat_type = 'news'";
		$this->obj->nny_catmodel->getCategoryTree($aryCatList, 0, 0, array(), $filter);
		$data['aryCatList'] = $aryCatList;
   }      
   
   /**
    * create category list for select
    *
    * @param array $data
    */
   function build_album_option(&$data, $filter = '') {
   		$this->obj->load->model('nny_albummodel');
		$aryAlbumList = array();
		$this->obj->nny_albummodel->getAlbumTree($aryAlbumList, 0, 0, array(), $filter);
		
		$data['aryAlbumList'] = $aryAlbumList;
   }
   
   	//getthumb
	function get_thumb($images_names, $subfix='_thumb') {
		$path_parts = pathinfo($images_names);
		$dirname = ($path_parts['dirname'] != '.') ? $path_parts['dirname'].'/' : '';
 
 		return $dirname.$path_parts['filename'].$subfix.'.'.$path_parts['extension'];
	}
}

?>