<?php

elgg_register_event_handler('init', 'system', 'msoffice_mimetypes_patch_init');

function msoffice_mimetypes_patch_init(){
	elgg_register_page_handler('msoffice_mime_types_patch', 'msoffice_mime_types_patch_handler');
	elgg_register_action('msoffice_mime_types_patch/fixit', elgg_get_plugins_path() . 'msoffice_mime_types_patch/actions/msoffice_mime_types_patch/fixit.php', 'admin');
	elgg_register_menu_item('page', array(
		'name' => 'MS Office Mime Types Patch',
		'href' => 'admin/msoffice_mime_types_patch',
		'text' => elgg_echo('admin:msoffice_mime_types_patch'),
		'context' => 'admin',
		'priority' => 1000,
		'section' => 'administer'
	));
	elgg_register_plugin_hook_handler('file:icon:url','override','msoffice_icons_hook');
}

function msoffice_mime_types_patch_handler($page){
	include elgg_get_plugins_path() . 'msoffice_mime_types_patch/index.php';
}

function msoffice_icons_hook($hook, $type, $returnvalue, $params){
	$file = $params['entity'];
	$size = $params['size'];
	if (elgg_instanceof($file, 'object', 'file')) {
		$mapping = array(
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'excel',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'word',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'ppt',
		);
		$mime = $file->mimetype;
		if (isset($mapping[$mime])){
			$type = $mapping[$mime];
			if ($size == 'large') {
				$ext = '_lrg';
			} else {
				$ext = '';
			}
			$url = "mod/file/graphics/icons/{$type}{$ext}.gif";
		} else {
			$url = $returnvalue;
		}
	}
	return $url;
}
?>