<?php

/**
 * Extend the FilePluginFile located in mod/file/classes
 * NOTE: This is a temporary fix for the issue reported on: http://trac.elgg.org/ticket/4079.
 * Should be able to remove this temporary fix when Elgg 1.8.5 is released.
 */
class FilePluginFile extends ElggFile {
	
	static function detectMimeType($file = null, $default = null) {
		$msoffice_mimetypes = array(
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => '',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation' => '',
			'application/vnd.ms-powerpoint' => '',
			'application/vnd.ms-excel' => '',
			'application/msword' => '',
			'application/x-iwork-pages-sffpages' => '',
			'application/x-iwork-keynote-sffkey' => '',
			'application/x-iwork-numbers-sffnumbers' => '',
			'application/postscript' => '',
		);
		if (isset($msoffice_mimetypes[$default])){
			$mime_type = $default;
		} else {
			$mime_type = parent::detectMimeType($file, $default);
		}
		//system_message($default . ' | ' . $mime_type);
		return $mime_type;
	}
}
