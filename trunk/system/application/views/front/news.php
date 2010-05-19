<div id="content" class="narrowcolumn">
<style>
h1 {
	font-weight: normal;
	font-size: 19px;
	padding-bottom: 1em;
	color: #1b518c;
	}

h3 {
	font-weight: bold;
	font-size: 14px;
	padding: 2em 0 1em;
	}

hr {
	border: 0;
	color: #e8e8e8;
	background-color: #e8e8e8;
	height: 1px;
	margin: 0.5em 0 1em;
	display:block;
	}

#articles p.edit_links {
	float: none;
	margin: 5px 96px 0 0;
	background: transparent url(../images/common/page-edit-icon.png) no-repeat 0 0;
	padding-left: 19px;
	color: #333;
	font-weight: bold;
	font-size: 11px;
	padding-bottom: 1em;
	}
#articles p.edit_links a, #articles p.edit_links a:visited {
	color: #036;
	}
#articles p.edit_links a:hover, #articles p.edit_links a:visited:hover {
	color: #69c;
	text-decoration: none;
	}
#articles h1, 
#articles h3 {
	padding-bottom: 0;
	}

#container  {
	padding:20px 40px;
	}
</style>
	<div id="container">
       
	      <h1>Housing News</h1>
	      <div id="articles">
	<?php foreach($aryNews as $news) {?>
	 <h3><a href="<?=$news['link']?>" target="_blank"><?=$news['title']?></a></h3>
	         <p class="body">
	            <?=$news['desc']?>
					&nbsp;<a href="<?=$news['link']?>" title="<?=$news['title']?>">more>></a>
	         </p>
	          <hr>
	<?php }?>
		</div>
	</div>
</div>