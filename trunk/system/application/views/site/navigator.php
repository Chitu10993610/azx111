<style type="text/css">

body { 
 background-color: #fff; 
 margin: 10px; 
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 12px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 20px 0 2px 0;
 padding: 5px 0 6px 0;
}

</style>
<? $this->load->helper('url'); ?>
<div class='suckerdiv'><ul id='navigator'><li>ci_properties
                  <ul>
                     <li><a href='<?= site_url('ci_properties'); ?>'>Browse</a></li>
                     <li><a href='<?= site_url('ci_properties' . '/add/'); ?>'>Add New</a></li>
                     <li><a href='<?= site_url('ci_properties' . '/find/'); ?>'>Find (not yet)</a></li>
                  </ul>
                  </li></ul></div>
