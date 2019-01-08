<?php
include("lib/headers.php");
include("lib/settings.php");
$t = $text['index'];

$updateMsg = '';
// Check for updates
if ($ICEcoder["checkUpdates"]) {
	$icv_url = "https://icecoder.net/latest-version?thisVersion=".$ICEcoder["versionNo"];
	$icvData = getData($icv_url,'curl',false,5);
	if ($icvData == "no data") {
		$icvData = "1.0\nICEcoder version placeholder";
	}
	$icvInfo = explode("\n", $icvData);
	$icv = $icvInfo[0];
	$icvI = str_replace('"','\\\'',$icvInfo[1]);
	$thisV = $ICEcoder["versionNo"];
	if (strpos($thisV,"beta")>-1 && !strpos($icv,"beta") && str_replace(" beta","",$thisV) == $icv) {$thisV-=0.1;};
	if ($thisV<$icv) {
		$updateMsg = ";top.ICEcoder.dataMessage('<b>".$t['UPDATE INFO'].":</b> ICEcoder v ".$icv." ".$t['now available'].". (".$t['Your version is']." v ".$ICEcoder["versionNo"].").<br><br><a onclick=\\'top.ICEcoder.update()\\' style=\\'color:#fff; background: #b00; padding: 5px; text-decoration: none; cursor: pointer\\'>".$t['Update now']."</a><br><br>".$icvI."');";
	}
}

$isMac = strpos($_SERVER['HTTP_USER_AGENT'], "Macintosh")>-1 ? true : false;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BLACKICEcoder v <?php echo $ICEcoder["versionNo"];?></title>
  <style>
	#tabsBar.tabsBar .tab { font-size: <?php echo $ICEcoder["fontSize"];?>; }
</style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css?microtime=<?php echo microtime(true);?>" />
  <link rel="stylesheet" type="text/css" href="lib/ice-coder.css?microtime=<?php echo microtime(true);?>">
  <link rel="stylesheet" href="<?php
if ($ICEcoder["theme"]=="default") {echo 'lib/editor.css';} else {echo $ICEcoder["codeMirrorDir"].'/theme/'.$ICEcoder["theme"].'.css';};
echo "?microtime=".microtime(true);
?>">
<link rel="icon" type="image/png" href="favicon.png">
<script>
iceRoot = "<?php echo $ICEcoder['root']; ?>";

window.onbeforeunload = function() {
	// if(top.ICEcoder.autoLogoutTimer < top.ICEcoder.autoLogoutMins*60) {
	// 	for(var i=1;i<=ICEcoder.savedPoints.length;i++) {
	// 		if (ICEcoder.savedPoints[i-1]!=top.ICEcoder.getcMInstance(i).changeGeneration()) {
	// 			return "<?php echo $t['You have some...'];?>.";
	// 		}
	// 	}
	// 	return "<?php echo $t['Are you sure...'];?>";
	// }
}

t = {
<?php
// Load the lang array for what's in the JS file
$t = $text['ice-coder'];
$tOutput = "";
foreach ($t as $key => $value) {
	$tOutput .= '"'.$key.'" : "'.$value.'",'.PHP_EOL;
}
echo rtrim($tOutput,",".PHP_EOL).PHP_EOL;

// Back to the lang array for index
$t = $text['index'];
?>
}
</script>
<script language="JavaScript" src="lib/ice-coder.js?microtime=<?php echo microtime(true);?>"></script>
<!-- <script src="lib/hnl.mobileConsole.js"></script> -->
<script src="lib/mmd.js?microtime=<?php echo microtime(true);?>"></script>
<script src="lib/draggabilly.pkgd.min.js?microtime=<?php echo microtime(true);?>"></script>
<script src="farbtastic/farbtastic.js?microtime=<?php echo microtime(true);?>"></script>
<script src="lib/difflib.js?microtime=<?php echo microtime(true);?>"></script>
<link rel="stylesheet" href="farbtastic/farbtastic.css?microtime=<?php echo microtime(true);?>" type="text/css">

<!-- <script>
				if (!mobileConsole.status.initialized) {
            mobileConsole.init();
        }
        function traceThis() {
            var variable = 'string';
            function bar() {
                console.trace();
            }
            function foo() {
                bar(variable);
            }
            foo();
        }

        var testObject = { 'test' : 'one', 'func' : function() {return 'Hello world'; },'array' : [1,2,3,4,5, [1,2,3]], 'emptyArray' : [], 'object' : {'anotherObject' : 'Why not', 'emptyObject' : {}}, 'finalkey' : 'finalvalue'}
    </script> -->
</head>
<body onLoad="<?php
	echo "top.ICEcoder.versionNo = '".$ICEcoder["versionNo"]."';".
		'top.ICEcoder.previousFiles = [';
		if ($ICEcoder["previousFiles"]!="") {
			$openFilesArray = explode(",",$ICEcoder["previousFiles"]);
			echo "'".implode("','",$openFilesArray)."'";
		}
	echo "];";
	echo "top.ICEcoder.theme = '".($ICEcoder["theme"]=="default" ? 'icecoder' : $ICEcoder["theme"])."';".
		"top.ICEcoder.autoLogoutMins = ".$ICEcoder["autoLogoutMins"].";".
		"top.ICEcoder.fontSize = '".$ICEcoder["fontSize"]."';".
		"top.ICEcoder.openLastFiles = ".($ICEcoder["openLastFiles"] ? 'true' : 'false').";".
		"top.ICEcoder.updateDiffOnSave = ".($ICEcoder["updateDiffOnSave"] ? 'true' : 'false').";".
		"top.ICEcoder.languageUser = '".$ICEcoder["languageUser"]."';".
		"top.ICEcoder.codeAssist = ".($ICEcoder["codeAssist"] ? 'true' : 'false').";".
		"top.ICEcoder.lockedNav = ".($ICEcoder["lockedNav"] ? 'true' : 'false').";".
		"top.ICEcoder.lineWrapping = ".($ICEcoder["lineWrapping"] ? 'true' : 'false').";".
		"top.ICEcoder.lineNumbers = ".($ICEcoder["lineNumbers"] ? 'true' : 'false').";".
		"top.ICEcoder.showTrailingSpace = ".($ICEcoder["showTrailingSpace"] ? 'true' : 'false').";".
		"top.ICEcoder.matchBrackets = ".($ICEcoder["matchBrackets"] ? 'true' : 'false').";".
		"top.ICEcoder.autoCloseTags = ".($ICEcoder["autoCloseTags"] ? 'true' : 'false').";".
		"top.ICEcoder.autoCloseBrackets = ".($ICEcoder["autoCloseBrackets"] ? 'true' : 'false').";".
		"top.ICEcoder.indentWithTabs = ".($ICEcoder["indentWithTabs"] ? 'true' : 'false').";".
		"top.ICEcoder.indentAuto = ".($ICEcoder["indentAuto"] ? 'true' : 'false').";".
		"top.ICEcoder.indentSize = ".$ICEcoder["indentSize"].";".
		"top.ICEcoder.demoMode = ".($ICEcoder["demoMode"] ? 'true' : 'false').";".
		"top.ICEcoder.tagWrapperCommand = '".$ICEcoder["tagWrapperCommand"]."';".
		"top.ICEcoder.autoComplete = '".$ICEcoder["autoComplete"]."';".
		"top.ICEcoder.bugFilePaths = ['".implode("','",$ICEcoder["bugFilePaths"])."'];".
		"top.ICEcoder.bugFileCheckTimer = ".$ICEcoder["bugFileCheckTimer"].";".
		"top.ICEcoder.bugFileMaxLines = ".$ICEcoder["bugFileMaxLines"].";".
		"top.ICEcoder.fileDirResOutput = '".$ICEcoder["fileDirResOutput"]."';".
		"top.ICEcoder.newDirPerms = ".$ICEcoder["newDirPerms"].";".
		"top.ICEcoder.newFilePerms = ".$ICEcoder["newFilePerms"].";";
		if($ICEcoder["githubAuthToken"] != "") {
			$_SESSION['githubAuthToken'] = $ICEcoder["githubAuthToken"];
			echo "top.ICEcoder.githubAuthTokenSet = true;";
		}
		echo "top.ICEcoder.csrf = '".$_SESSION["csrf"]."';";
?>ICEcoder.init()<?php echo $updateMsg.$onLoadExtras;?>;<?php if(isset($_GET["display"]) && $_GET["display"] == "updated") {echo "top.ICEcoder.updated();";};?>" onKeyDown="return ICEcoder.interceptKeys('coder',event);" onKeyUp="parent.ICEcoder.resetKeys(event);" onBlur="parent.ICEcoder.resetKeys(event);">
  <div id="blackMask" class="blackMask" onClick="if (!ICEcoder.overPopup) {ICEcoder.showHide('hide',this)}" onContextMenu="return false">
    <div class="popupVCenter">
      <div class="popup" id="mediaContainer"></div>
    </div>
    <div class="floatingContainer" id="floatingContainer"></div>
  </div>

  <div id="loadingMask" class="blackMask" style="visibility: hidden" onContextMenu="return false">
    <div class="popupVCenter">
      <div class="popup">
        <div class="spinner"></div>
        <?php echo $t['working'];?>...
      </div>
    </div>
  </div>

  <div id="plugins" class="plugins" style="<?php echo $ICEcoder["pluginPanelAligned"];?>: 0" onMouseOver="top.ICEcoder.showHidePlugins('show')" onMouseOut="top.ICEcoder.showHidePlugins('hide')" onClick="top.ICEcoder.showHidePlugins('hide')">
	<div style="padding: 15px">
		<a nohref onClick="top.ICEcoder.showColorPicker(top.document.getElementById('color') ? top.document.getElementById('color').value : '#123456')" title="Farbtastic
    <?php echo $t['Color picker'];?>"><img src="images/color-picker.png" style="cursor: pointer" alt="Color Picker"></a><br><br>
		<div id="pluginsOptional"><?php echo $pluginsDisplay; ?></div>
		<a nohref onclick="top.ICEcoder.pluginsManager()" title="<?php echo $t['Plugins Manager'];?>" style="color: #fff; cursor: pointer">+ / -</a>
	</div>
</div>

  <div class="container">
    <div class="leftbar" id="leftbar">
      <div class="lefbarMenu" id="fileNav">
        <a nohref onclick="showHideMenu('optionsFile')" id="optionsFileNav"><?php echo $t['File'];?></a>
      </div>
      
      <div id="githubNav" class="githubNav">
        <div class="commit" id="githubNavCommit" onclick="top.ICEcoder.githubAction('commit')">Commit</div>
        <div class="selected" id="githubNavSelectedCount">Selected: 0</div>
        <div class="pull" id="githubNavPull" onclick="top.ICEcoder.githubAction('pull')">Pull</div>
      </div>
      <div id="optionsFile" class="optionsList">
        <ul>
          <li><a nohref onClick="ICEcoder.newFile()"><?php echo $t['New File'];?>...</a></li>
          <li><a nohref onClick="ICEcoder.newFolder()"><?php echo $t['New Folder'];?>...</a></li>
          <li><a nohref onClick="ICEcoder.openPrompt()"><?php echo $t['Open'];?>...</a></li>
          <li><a nohref onClick="ICEcoder.saveFile()"><?php echo $t['Save'];?></a></li>
          <li><a nohref onclick="ICEcoder.saveFile('saveAs')"><?php echo $t['Save As'];?>...</a></li>
          <li><a nohref onclick="ICEcoder.openPreviewWindow()"><?php echo $t['Live Preview'];?></a></li>
          <li><a nohref onclick="ICEcoder.downloadFile(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])"><?php echo $t['Download'];?></a></li>
          <li><a nohref onclick="ICEcoder.copyFiles(top.ICEcoder.selectedFiles)"><?php echo $t['Copy'];?></a></li>
          <li><a nohref onclick="ICEcoder.pasteFiles(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])"><?php echo $t['Paste'];?></a></li>
          <li><a nohref onclick="ICEcoder.deleteFiles(top.ICEcoder.selectedFiles)"><?php echo $t['Delete'];?></a></li>
          <li><a nohref onclick="ICEcoder.duplicateFiles(top.ICEcoder.selectedFiles)"><?php echo $t['Duplicate'];?></a></li>
          <li><a nohref onclick="ICEcoder.renameFile(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])"><?php echo $t['Rename'];?></a></li>
          <li><a nohref onclick="ICEcoder.uploadFilesSelect(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])"><?php echo $t['Upload'];?>...</a></li>
          <li><a nohref onclick="ICEcoder.zipIt(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])"><?php echo $t['Zip'];?></a></li>
          <li><a nohref onclick="ICEcoder.propertiesScreen(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])"><?php echo $t['Properties'];?>...</a></li>
          <li><a nohref onClick="ICEcoder.printCode()"><?php echo $t['Print'];?>...</a></li>
          <li><a nohref onClick="ICEcoder.settingsScreen()"><?php echo $t['Settings'];?></a></li>
        </ul>
      </div>
      <div id="optionsHelp" class="optionsList">
        <ul>
          <li><a nohref onclick="ICEcoder.showManual('<?php echo $ICEcoder["versionNo"];?>')"><?php echo $t['Manual'];?></a></li>
          <li><a nohref onClick="ICEcoder.helpScreen()"><?php echo $t['Shortcuts'];?></a></li>
          <li><a nohref onclick="ICEcoder.searchForSelected()"><?php echo $t['Search for selected'];?></a></li>
          <li><a href="https://icecoder.net" target="_blank">ICEcoder <?php echo $t['website'];?></a></li>
        </ul>
      </div>
      <div class="leftbarFiles" id="files">
      
        <iframe id="filesFrame" class="frame" name="ff" src="files.php" style="opacity: 0" onLoad="this.style.opacity='1';this.contentWindow.onscroll=function(){top.ICEcoder.mouseDown=false; top.ICEcoder.mouseDownInCM=false}"></iframe>
        
      </div>

      <div class="serverMessage" id="serverMessage">Test</div>

      <div id="fileMenu" class="fileMenu" onMouseOver="ICEcoder.changeFilesW('expand')" onMouseOut="ICEcoder.changeFilesW('contract');top.ICEcoder.hideFileMenu()" style="opacity: 0" onContextMenu="return false">
        <span id="folderMenuItems">
          <a href="javascript:top.ICEcoder.newFile()" onMouseOver="ICEcoder.showFileMenu()"><?php echo $t['New File'];?></a>
          <a href="javascript:top.ICEcoder.newFolder()" onMouseOver="ICEcoder.showFileMenu()"><?php echo $t['New Folder'];?></a>
          <div onMouseOver="ICEcoder.showFileMenu()" style="padding: 2px 0"><hr></div>
          <a href="javascript:top.ICEcoder.uploadFilesSelect(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()"><?php echo $t['Upload File(s)'];?></a>
          <div style="display: none">
            <form enctype="multipart/form-data" id="uploadFilesForm" action="lib/file-control-xhr.php?action=upload&file=/uploaded" method="POST" target="fileControl">
              <input type="hidden" name="folder" id="uploadDir" value="/">
              <input type="file" name="filesInput[]" id="fileInput" onchange="top.ICEcoder.uploadFilesSubmit(this)" multiple>
              <input type="submit" value="Upload File">
              <input type="hidden" name="csrf" value="<?php echo $_SESSION["csrf"]; ?>">
            </form>
          </div>
          <a href="javascript:top.ICEcoder.pasteFiles(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()" id="fmMenuPasteOption" style="display: none"><?php echo $t['Paste'];?></a>
          <div onMouseOver="ICEcoder.showFileMenu()" style="padding: 2px 0"><hr></div>
        </span>
        <a href="javascript:top.ICEcoder.openFilesFromList(top.ICEcoder.selectedFiles)" onMouseOver="ICEcoder.showFileMenu()"><?php echo $t['Open'];?></a>
        <a href="javascript:top.ICEcoder.copyFiles(top.ICEcoder.selectedFiles)" onMouseOver="ICEcoder.showFileMenu()"><?php echo $t['Copy'];?></a>
        <a href="javascript:top.ICEcoder.duplicateFiles(top.ICEcoder.selectedFiles)" onMouseOver="ICEcoder.showFileMenu()"><?php echo $t['Duplicate'];?></a>
        <a href="javascript:top.ICEcoder.deleteFiles(top.ICEcoder.selectedFiles)" onMouseOver="ICEcoder.showFileMenu()"><?php echo $t['Delete'];?></a>
        <span id="singleFileMenuItems">
          <a href="javascript:top.ICEcoder.renameFile(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()"><?php echo $t['Rename'];?></a>
          <div onMouseOver="ICEcoder.showFileMenu()" style="padding: 2px 0"><hr></div>
          <a nohref onClick="window.open('//<?php echo $_SERVER['HTTP_HOST'];?>' + iceRoot + top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1].replace(/\|/g,'/'))" onMouseOver="ICEcoder.showFileMenu()" style="cursor: pointer"><?php echo $t['View Webpage'];?></a>
        </span>
        <div onMouseOver="ICEcoder.showFileMenu()" style="padding: 2px 0"><hr></div>
        <?php
        if (file_exists(dirname(__FILE__)."/plugins/zip-it/index.php")) {
          echo '<a href="javascript:top.ICEcoder.zipIt(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()">Zip It!</a>'.PHP_EOL;
        };
        ?>
        <a href="javascript:top.ICEcoder.downloadFile(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()"><?php echo $t['Download'];?></a>
        <div onMouseOver="ICEcoder.showFileMenu()" style="padding: 2px 0"><hr></div>
        <a href="javascript:top.ICEcoder.propertiesScreen(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()"><?php echo $t['Properties'];?></a>
      </div>
    </div>

    <div class="rightbar">
      
      <div class="rightbarTabs" id="tabsBar" onContextMenu="return false">
        <a href="javascript: showHide('leftbar');" ><img src="/images/98-document-storage.png" class="tabbarimg" /></a>
        <div style="display: inline-block;" id="divcontainer"></div>
      </div>

      <div id="rightbarContent" class="rightbarContent">
        
      </div>
      
     
    </div>
  </div>
<script>
  const showHide = function(elem) {
    const x = document.getElementById(elem);
    if (x.style.display === "none") {
      x.style.display = "flex";
    } else {
      x.style.display = "none";
    }
  }
  const showHideMenu = function(elem) {
    var winlist = ['optionsFile'];
    for ( win of winlist ) {
      const x = document.getElementById(win);
      if ( elem === win ) {
        if (x.style.display === "none") {
          x.style.display = "block";
        } else {
          x.style.display = "none";
        }
      } else {
        x.style.display = "none";
      }
    }
  }
</script>
<script>
ICEcoder.initAliases();
// ICEcoder.setLayout('dontSetEditor');
setTimeout(function() {
			console.log('home');
			ICEcoder.setLayout('dontSetEditor');
    },2000);
    
    switchTab = function() {
      console.log('hello');
      top.ICEcoder.switchTab();
    }
</script>
</body>
</html>
