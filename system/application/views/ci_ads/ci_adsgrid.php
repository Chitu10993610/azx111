<div id="content" class="narrowcolumn">
<?
   $this->load->helper('url');
   $modify_url = site_url('ads/modify/');
   $delete_url = site_url('ads/delete/');
   $add_url    = site_url('ads/add/');

?>
<h3><a href="javascript:divToogle('groupsholder');">Ads List</a></h3>
	<div id="groupsholder" style="display:block;">
		<br />
		<table id="group_table" class="stripe">
			<tr>
				<th width="20" align="center">No</th>
				<th align="center" width="40">Status</th>
				<th>Title</th>
				<th>Vị trí</th>
				<th>Url</th>
				<th align="center" width="120">Image</th>
				<th align="center">Edit</th>
				<th align="center">Delete</th>
			</tr>
			<?php 
			$k = 0;
			foreach ($ci_ads_list as $ci_ads) { ?>
			<tr>
			  <td align="center"><?= ++$k; ?></td>
			   <td align="center"><?php if($ci_ads['status_flg']) echo '<img src="'.base_url().'images/check.png" border="0">'; ?></td>
			   <td align="left"><?= $ci_ads['ads_title']; ?></td>
			   <td align="left"><?= ucfirst($ci_ads['position']); ?></td>
			   <td align="left"><span title="<?= $ci_ads['ads_url']; ?>"><?=substr($ci_ads['ads_url'], 0, 30); ?></span></td>
			   <td align="center"><div style="height:60px; width:300px; overflow:hidden;">
			   <?php if($ci_ads['image']) 
	if(preg_match( '#\.swf$#', $ci_ads['image'] )) {
		?>
      <embed height="<?=$ci_ads['ads_height']/2?>" width="<?=$ci_ads['ads_width']/2?>" loop="true" wmode="transparent" play="true" src="<?=base_url().'images/adv/'.$ci_ads['image']?>" type="application/x-shockwave-flash"/>
    <?
	}else {
	?>
	<a href="<?=$ci_ads['ads_url']?>" target="_blank"><img border="0" src="<?=base_url().'images/adv/'.$ci_ads['image']?>" height="60" /></a>
 <? }?>
 </div></td>
				<td class="edit">
				<a href = "<?= $modify_url."/".$ci_ads["id"]; ?>" ><?=img('images/i_edit.gif')?></a>
					</td>
				<td class="delete">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$ci_ads["id"]; ?>" ><?=img('images/i_delete.gif')?></a>
				</td>
			</tr>
			<? } ?>
		</table>
		<div style="float:left;"><?=$page_links?></div>			
		<div style="float:right;"><?= anchor ($add_url, 'Add Ads', array('class' => 'addButton'));?></div>
		</div>
</div>