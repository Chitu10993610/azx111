<?

/**
 * MODULE NAME   : layout.php
 *
 * DESCRIPTION   : Layout library
 *                 - Extends the function of the view.
 *                 - Combines the page that must be displayed with global headers
 *                   and footers and places them into a atandard layout template.
 *
 * MODIFICATION HISTORY
 *   V1.0   [[creation_date]]   - [[gen_programmer]]     - Created
 *
 * Compliments of George - alias glemigh
 *
 * @package             [[component]]
 * @subpackage          Layout library
 * @author              [[gen_programmer]]
 * @copyright           [[gen_copyright]]
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

/* =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- *\
| NOTE: If you are using a version of CodeIgniter that requries init code for  |
| NOTE: ...libararies, you can use this code                                   |
+ -----------------------------------------------------------------------------|
| if (!defined('BASEPATH')) exit('Direct access not permitted!');              |
|                                                                              |
| if (! class_exists('Layout')){                                               |
|  include_once(APPPATH.'libraries/layout'.EXT);                               |
| }                                                                            |
|                                                                              |
| $obj =& get_instance();                                                      |
| $obj->layout = new Layout();                                                 |
| $obj->ci_is_loaded[] = 'layout';                                             |
|                                                                              |
/* =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- */

class Layout {

var $layout_view;
var $header_view;
var $main_view;
var $footer_view;
// var $skin;

   // Class constructor
   function Layout() {
      // ///////////////////////////////////////////////////////////////////////
      // Set the location of the site layout view segments.
      // ///////////////////////////////////////////////////////////////////////

      // ///////////////////////////////////////////////////////////////////////
      // If you want to use "skins" then process the preferred skin here. The
      // ...views refer to the skin as in the following example:
      // ...<link href="< ?= $skin; ? >/css/mystyle.css" rel="stylesheet" type="text/css">
      // ...(NOTE: Remove the spaces in the PHP tags in the code above)
      // ///////////////////////////////////////////////////////////////////////
//       // Get the configured skin. or use the default
//        $this->skin = $obj->config->item('skin');
//
//        if ( $this->skin  == '' ) {
//           $this->skin  = 'default';
//        }


      // NOTE: I like the idea of getting this form a custom config file. See the skins
      // NOTE: ...example to get an idea of how to do it here.
      $this->layout_view   = 'site/layout';
      $this->header_view   = 'site/header';
      $this->main_view     = 'site/main';
      $this->footer_view   = 'site/footer';

   }

    function render_page($segment_view, $data) {
        $obj =& get_instance();


      $header_data   = array();
      $main_data     = array();
      $footer_data   = array();

      // ///////////////////////////////////////////////////////////////////////
      // Build the page header. and add to the page
      // ///////////////////////////////////////////////////////////////////////
      // Populate the dynamic header items entries. eg.
      // $header_data['skin'] = $this-<skin;
      // $header_data['field1'] = 'some_value';
      // $header_data['field2'] = 'some_other_value';
      $layout_components['header'] = $obj->load->view($this->header_view, $header_data, true);

      // ///////////////////////////////////////////////////////////////////////
      // Build the page contents. and add to the page
      // ///////////////////////////////////////////////////////////////////////
      $main_data['page_contents'] = $obj->load->view("$segment_view", $data, true);
      // If you need to set other variables not passed from controller, do that here
      // $main_data['leftmenuitems'] = 'Some value here';
      // $main_data['module'] = 'Some value here';

      $layout_components['contents'] = $obj->load->view($this->main_view, $main_data, true);

      // ///////////////////////////////////////////////////////////////////////
      // Build the page footer. and add to the page
      // ///////////////////////////////////////////////////////////////////////
      // $footer_data['copyright'] = 'Some value here';
      $layout_components['footer'] =  $obj->load->view($this->footer_view , $footer_data, true);

      // ///////////////////////////////////////////////////////////////////////
      // Finally, send all the layout components to the layout
      // ///////////////////////////////////////////////////////////////////////
      $obj->load->view($this->layout_view, $layout_components);

   }

}

?>