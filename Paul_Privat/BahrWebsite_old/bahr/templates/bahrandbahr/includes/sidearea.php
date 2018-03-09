<?php
function customlastupdate($br, $hour) {
	global $tx, $pth;
	echo $t.date($tx['lastupdate']['dateformat'], filemtime($pth['file']['content'])+(isset($hour)?$hour * 3600:0));
}
function customprintlink() {
	global $f, $search, $file, $sn, $tx;
	$t = amp().'print';
	if ($f == 'search')$t .= amp().'function=search'.amp().'search='.htmlspecialchars(stripslashes($search));
	else if($f == 'file')$t .= amp().'file='.$file;
	else if($f != '' && $f != 'save')$t .= amp().$f;
	else if(sv('QUERY_STRING') != '')$t = str_replace('&','&amp;',sv('QUERY_STRING')).$t;
	return '<a target="_blank" href="'.$sn.'?'.$t.'">'.$tx['menu']['print'].'</a>';
}
?>

<div class="hslice sidemodule" id="news">
<span style="display:none;" class="entry-title"><?php echo sitename();?></span>


</div>

<div class="sidemodule">
<div class="desc"><?php echo $tx['title']['sitemap']?> &amp; <?php echo $tx['menu']['print']?></div>
<div class="mid">

<?php echo customprintlink();?><?php echo tag('br');?>
<?php echo sitemaplink();?><?php echo tag('br');?>
<?php echo mailformlink();?><?php echo tag('br');?>

</div>
</div>

<div class="sidemodule">
<div class="desc"><?php echo $tx['lastupdate']['text']?></div>
<div class="mid">

<?php echo customlastupdate();?>




</div>
</div>