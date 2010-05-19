<style type="text/css">
      div.rotator { position: relative;}
      div.r1 {}
      div.r1 p { margin-top: 20px; text-align: center; }
      div.navigation { position: absolute; top: 5px; right: 5px; }
      div.navigation div.current, div.navigation a { width: 12px; height: 12px; margin: 0 8px 0 0; float: left; overflow: hidden; }
      div.navigation a:hover { text-decoration: none; }
      div.navigation div.current { background: #c00; }
      div.navigation a { display: block; background: #ccc; }
    </style>
    <script type="text/javascript" src="./jquery.1.3.2-min.js"></script>
    <script type="text/javascript">
      (function ($) {
        $.fn.fadeTransition = function(options) {
          var options = $.extend({pauseTime: 5000, transitionTime: 2000}, options);
          var transitionObject;

          Trans = function(obj) {
            var timer = null;
            var current = 0;
            var els = $("> *", obj).css("display", "none").css("left", "0").css("top", "0").css("position", "absolute");
            $(obj).css("position", "relative");
            $(els[current]).css("display", "block");

            function transition(next) {
              $(els[current]).fadeOut(options.transitionTime);
              $(els[next]).fadeIn(options.transitionTime);
              current = next;
              cue();
            };

            function cue() {
              if ($("> *", obj).length < 2) return false;
              if (timer) clearTimeout(timer);
              timer = setTimeout(function() { transition((current + 1) % els.length | 0)} , options.pauseTime);
            };
            
            this.showItem = function(item) {
              if (timer) clearTimeout(timer);
              transition(item);
            };

            cue();
          }

          this.showItem = function(item) {
            transitionObject.showItem(item);
          };

          return this.each(function() {
            transitionObject = new Trans(this);
          });
        }

      })(jQuery);
    
      var page = {
        tr: null,
        init: function() {
          page.tr = $(".area").fadeTransition({pauseTime: 10000, transitionTime: 2000});
          $("div.navigation").each(function() {
            $(this).children().each( function(idx) {
              if ($(this).is("a"))
                $(this).click(function() { page.tr.showItem(idx); })
            });
          });
        },

        show: function(idx) {
          if (page.tr.timer) clearTimeout(page.tr.timer);
          page.tr.showItem(idx);
        }
      };

      $(document).ready(page.init);    
    </script>
    
<div class="area">
<?php foreach ($aryNewsList as $aryNews) { ?>
<div class="rotator r1">
<div class="top_new" >
	<div style="height:235px; overflow:hidden"><?php 
if($aryNews['news_image']) {
?>
<a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
<img style="border:#333333 solid 0px;" src="<?=base_url()?>images/news/<?=$aryNews["news_image"]?>" alt="<?=$aryNews['news_title']?>" width="308"/></a>
<?
}
else {
?>
<a title="" href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img style="border:#333333 solid 0px;" src="<?php echo site_url().'images/house_no_im.jpg';?>" alt="<?=$aryNews['news_title']?>" width="308"/></a>
<?}?></a></div>
	<div style="padding-top:5px;">
		<a class="top_new_tile" href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><?=$this->front_lib->cut_string($aryNews["news_title"], 50)?></a>
	</div>
	<div class="top_new_text" >
		<span ><?=$this->front_lib->cut_string($aryNews["intro_content"], 200)?></span>
	</div>
</div>
</div>

<?}?>
</div>
