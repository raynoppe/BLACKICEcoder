<?php
// ICEcoder system settings
$ICEcoderSettings = array(
	"versionNo"		=> "6.0",
	"codeMirrorDir"		=> "CodeMirror",
	"docRoot"		=> $_SERVER['DOCUMENT_ROOT'],	// $_SERVER['DOCUMENT_ROOT'] Set absolute path of another location if needed /data/data/com.termux/files/home/
	"demoMode"		=> false,
	"devMode"		=> true,
	"fileDirResOutput"	=> "none",			// Can be none, raw, object, both (all but 'none' output to console)
	"loginRequired"		=> false,
	"multiUser"		=> false,
	"languageBase"		=> "english.php",
	"lineEnding"		=> "\n",
	"newDirPerms"		=> 755,
	"newFilePerms"		=> 644,
	"enableRegistration"	=> false
);
?>