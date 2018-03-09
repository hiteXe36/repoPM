<?php

if (!defined('CMSIMPLE_VERSION') || preg_match('#/meta_tags/index.php#i',$_SERVER['SCRIPT_NAME'])) 
{
    die('no direct access');
}

if(!defined('PLUGINLOADER')) {
	die('Plugin '. basename(dirname(__FILE__)) . ' requires a newer version of the Pluginloader. No direct access.');
}


// convert content to h1only splitting

if ($adm && isset($_GET['convert_content_to_h1only']) && !strstr(file_get_contents('./content/content.php'),'class="_level1_page_"'))
{
	$contemp = file_get_contents('./content/content.php');

	// clean h1-6 tags
	$contemp = preg_replace('/<h1.*?>/i','<h1>',$contemp);
	$contemp = preg_replace('/<h2.*?>/i','<h2>',$contemp);
	$contemp = preg_replace('/<h3.*?>/i','<h3>',$contemp);
	$contemp = preg_replace('/<h4.*?>/i','<h4>',$contemp);
	$contemp = preg_replace('/<h5.*?>/i','<h5>',$contemp);
	$contemp = preg_replace('/<h6.*?>/i','<h6>',$contemp);
		
	// create CMSimple 5 headings
	if($cf['menu']['levels'] == '6')
	{
		$contemp = str_ireplace('<h1>','<h1 class="_level1_page_">',$contemp);
		$contemp = str_ireplace('<h2>','<h1 class="_level2_page_">',$contemp);
		$contemp = str_ireplace('</h2>','</h1>',$contemp);
		$contemp = str_ireplace('<h3>','<h1 class="_level3_page_">',$contemp);
		$contemp = str_ireplace('</h3>','</h1>',$contemp);
		$contemp = str_ireplace('<h4>','<h1 class="_level4_page_">',$contemp);
		$contemp = str_ireplace('</h4>','</h1>',$contemp);
		$contemp = str_ireplace('<h5>','<h1 class="_level5_page_">',$contemp);
		$contemp = str_ireplace('</h5>','</h1>',$contemp);
		$contemp = str_ireplace('<h6>','<h1 class="_level6_page_">',$contemp);
		$contemp = str_ireplace('</h6>','</h1>',$contemp);
	}
	
	if($cf['menu']['levels'] == '5')
	{
		$contemp = str_ireplace('<h1>','<h1 class="_level1_page_">',$contemp);
		$contemp = str_ireplace('<h2>','<h1 class="_level2_page_">',$contemp);
		$contemp = str_ireplace('</h2>','</h1>',$contemp);
		$contemp = str_ireplace('<h3>','<h1 class="_level3_page_">',$contemp);
		$contemp = str_ireplace('</h3>','</h1>',$contemp);
		$contemp = str_ireplace('<h4>','<h1 class="_level4_page_">',$contemp);
		$contemp = str_ireplace('</h4>','</h1>',$contemp);
		$contemp = str_ireplace('<h5>','<h1 class="_level5_page_">',$contemp);
		$contemp = str_ireplace('</h5>','</h1>',$contemp);
	}
	
	if($cf['menu']['levels'] == '4')
	{
		$contemp = str_ireplace('<h1>','<h1 class="_level1_page_">',$contemp);
		$contemp = str_ireplace('<h2>','<h1 class="_level2_page_">',$contemp);
		$contemp = str_ireplace('</h2>','</h1>',$contemp);
		$contemp = str_ireplace('<h3>','<h1 class="_level3_page_">',$contemp);
		$contemp = str_ireplace('</h3>','</h1>',$contemp);
		$contemp = str_ireplace('<h4>','<h1 class="_level4_page_">',$contemp);
		$contemp = str_ireplace('</h4>','</h1>',$contemp);
	}
	
	if($cf['menu']['levels'] == '3')
	{
		$contemp = str_ireplace('<h1>','<h1 class="_level1_page_">',$contemp);
		$contemp = str_ireplace('<h2>','<h1 class="_level2_page_">',$contemp);
		$contemp = str_ireplace('</h2>','</h1>',$contemp);
		$contemp = str_ireplace('<h3>','<h1 class="_level3_page_">',$contemp);
		$contemp = str_ireplace('</h3>','</h1>',$contemp);
	}
	
	if($cf['menu']['levels'] == '2')
	{
		$contemp = str_ireplace('<h1>','<h1 class="_level1_page_">',$contemp);
		$contemp = str_ireplace('<h2>','<h1 class="_level2_page_">',$contemp);
		$contemp = str_ireplace('</h2>','</h1>',$contemp);
	}
	
	if($cf['menu']['levels'] == '1')
	{
		$contemp = str_ireplace('<h1>','<h1 class="_level1_page_">',$contemp);
	}
	
	$content4 = $contemp;
	
	
	// write content.php
	$h1only_convertContentHandle = './content/content.php';
	
	$content4handle = fopen($h1only_convertContentHandle, "w+");
	fwrite($content4handle,$content4);
	fclose($content4handle);
	
	header('Location: ./?converted_content_to_h1only');
}



// plugin output

if($adm && $cf['use']['h1only_pagesplitting'] == 'true' && !strstr(file_get_contents('./content/content.php'),'class="_level1_page_"'))
{
	$o.= '<div class="cch1s_container">';

	$o.= '
<p><b>' . $plugin_tx['convert_content']['headline_plugin'] . '</b></p>



<p>' . $plugin_tx['convert_content']['text_config_changed'] . '</p>

<p>' . $plugin_tx['convert_content']['text_plugin_description'] . '</p>
<p class="cmsimplecore_warning" style="text-align: center; padding: 12px;"><b>' . $plugin_tx['convert_content']['text_usage_hint'] . '<br>
' . $plugin_tx['convert_content']['text_backup_hint'] . '</b></p>
';
	$o.= '<p><a href="./?convert_content_to_h1only"><b>' . $plugin_tx['convert_content']['text_convert_content'] . ' h1only_splitting &raquo;</b></a></p>';
	$o.= '</div>';
}

if(isset($_GET['converted_content_to_h1only']))
{
	$o.= '<p class="cch1s_done">' . $plugin_tx['convert_content']['text_conversion_complete'] . '</p>';
}

?>