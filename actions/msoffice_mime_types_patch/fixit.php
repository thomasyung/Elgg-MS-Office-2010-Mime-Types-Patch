<?php
$files = elgg_get_entities(array(
	'types' => 'object',
	'subtypes' => 'file',
	'limit' => 0,
));
$mapping = array(
	'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	'doc' => 'application/msword',
	'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
	'ppt' => 'application/vnd.ms-powerpoint',
	'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
	'xls' => 'application/vnd.ms-excel',
	'pages' => 'application/x-iwork-pages-sffpages',
);
foreach($files as $file){
	$extension = pathinfo($file->originalfilename, PATHINFO_EXTENSION);
	if ($mapping[$extension]) {
		if ($file->getMimeType() != $mapping[$extension]) {
			$file->setMimeType($mapping[$extension]);
		}
	}
}
system_message("Documents and files with incorrect mime types have been fixed.");
forward(REFERER);
?>