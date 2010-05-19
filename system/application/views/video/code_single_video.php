<script type='text/javascript' src='<?=base_url()?>js/player/swfobject.js'></script>
<div id='mediaspace'></div>

<script type='text/javascript'>
  var so = new SWFObject('<?=base_url()?>js/player/player.swf','ply','480','385','9','#ffffff');
  so.addParam('allowfullscreen','true');
  so.addParam('allowscriptaccess','always');
  so.addParam('wmode','opaque');
  so.addVariable('file','<?=$video_path?>');
  <?php if($image) {?>so.addVariable('image','<?=$image?>');<?}?>
  so.write('mediaspace');
</script>