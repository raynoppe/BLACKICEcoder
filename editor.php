<?php
include("lib/headers.php");
include("lib/settings.php");
$t = $text['editor'];
$getfile = $_REQUEST['getfile'];
$isNew = $_REQUEST['isNew'];
$ext = strtolower(pathinfo($getfile, PATHINFO_EXTENSION));
$fileToOpen = $_SERVER["DOCUMENT_ROOT"].$getfile;
if($isNew == 'false') {
	$loadedFile = getData($fileToOpen);
} else {
	$loadedFile = "// Your amazing ideas here";
}

$uselang = 'text';
switch ($ext) {
	case 'cls':
			$uselang = 'apex';
			break;
	case 'azcli':
			$uselang = 'azcli';
			break;
	case 'bat':
			$uselang = 'bat';
			break;
	case 'c':
			$uselang = 'c';
			break;
	case 'clj':
			$uselang = 'clojure';
			break;
	case 'coffee':
			$uselang = 'coffeescript';
			break;
	case 'cpp':
			$uselang = 'cpp';
			break;
	case 'cs':
			$uselang = 'csharp';
			break;
	case 'csp':
			$uselang = 'csp';
			break;
	case 'css':
			$uselang = 'css';
			break;
	case 'dockerfile':
			$uselang = 'dockerfile';
			break;
	case 'fs':
			$uselang = 'fsharp';
			break;
	case 'go':
			$uselang = 'go';
			break;
	case 'handlebars':
			$uselang = 'handlebars';
			break;
	case 'hbs':
			$uselang = 'handlebars';
			break;
	case 'html':
			$uselang = 'html';
			break;
	case 'htm':
			$uselang = 'html';
			break;
	case 'ini':
			$uselang = 'ini';
			break;
	case 'java':
			$uselang = 'java';
			break;
	case 'js':
			$uselang = 'javascript';
			break;
	case 'json':
			$uselang = 'json';
			break;
	case 'less':
			$uselang = 'less';
			break;
	case 'lua':
			$uselang = 'lua';
			break;
	case 'md':
			$uselang = 'markdown';
			break;
	case 'markdown':
			$uselang = 'markdown';
			break;
	case 'msdax':
			$uselang = 'msdax';
			break;
	case 'mysql':
			$uselang = 'mysql';
			break;
	case 'h':
			$uselang = 'objective-c';
			break;
	case 'mm':
			$uselang = 'objective-c';
			break;
	case 'pl':
			$uselang = 'perl';
			break;
	case 'pgsql':
			$uselang = 'pgsql';
			break;
	case 'php':
			$uselang = 'php';
			break;
	case 'postiats':
			$uselang = 'postiats';
			break;
	case 'powerquery':
			$uselang = 'powerquery';
			break;
	case 'powershell':
			$uselang = 'powershell';
			break;
	case 'pug':
			$uselang = 'pug';
			break;
	case 'py':
			$uselang = 'python';
			break;
	case 'razor':
			$uselang = 'razor';
			break;
	case 'r':
			$uselang = 'r';
			break;
	case 'rdb':
			$uselang = 'redis';
			break;
	case 'redshift':
			$uselang = 'redshift';
			break;
	case 'rb':
			$uselang = 'ruby';
			break;
	case 'rs':
			$uselang = 'rust';
			break;
	case 'sb':
			$uselang = 'sb';
			break;
	case 'ss':
			$uselang = 'scheme';
			break;
	case 'scss':
			$uselang = 'scss';
			break;
	case 'csh':
			$uselang = 'shell';
			break;
	case 'tcsh':
			$uselang = 'shell';
			break;
	case 'bash':
			$uselang = 'shell';
			break;
	case 'sh':
			$uselang = 'shell';
			break;
	case 'sol':
			$uselang = 'sol';
			break;
	case 'sql':
			$uselang = 'sql';
			break;
	case 'st':
			$uselang = 'st';
			break;
	case 'swift':
			$uselang = 'swift';
			break;
	case 'ts':
			$uselang = 'typescript';
			break;
	case 'vb':
			$uselang = 'vb';
			break;
	case 'xml':
			$uselang = 'xml';
			break;
	case 'yml':
			$uselang = 'yaml';
			break;
	default:
		$uselang = 'text';
}

?>
<!DOCTYPE html>
<html style="margin: 0">
<head>
	<title>ICEcoder v <?php echo $ICEcoder["versionNo"];?> editor</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="noindex, nofollow">
	<style type="text/css">
		html,
		body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			overflow: hidden;
			font-family: arial, verdana, helvetica, sans-serif;
		}
		.editorcontainer {
			display: flex;
			flex-direction: column;
			height: 100%;
		}
		.monacocontainer {
			flex-grow: 1;
			flex: 1 1 auto;
			display: flex;
		}
		.editoralert {
			position: absolute;
			right: 5%;
			left: 5%;
			bottom: 35px;
			background-color: grey;
			color: white;
			padding: 8px;
			font-size: 12px;
			border-radius: 5px 5px 0px 0px;
			text-align: center;
		}
		.editorfoot {
			display: flex;
			height: 35px;
			justify-content: center;
		}
		.imgbuttons {
			padding: 3px;
			border: 0px solid #fff;
			margin: 3px;
			border-radius: 3px;
			background-color: #666;
		}
	</style>
</head>
<body>

<div class="editorcontainer">
	<div class="monacocontainer" id="container"></div>
	<div class="editoralert" id="editoralert">-- loading --</div>
	<div class="editorfoot">
		<a href="javascript:showHideCN()" class="imgbuttons"><img src="/images/259-paper-map.png" width="20" height="20" /></a>
		<a href="javascript:showfind()" class="imgbuttons"><img src="/images/404-magnifying-glass.png" width="20" height="20" /></a>
		<a href="javascript:savefile()" class="imgbuttons"><img src="/images/425-floppy.png" width="20" height="20" /></a>
	</div>
</div>
<textarea id="intext" style="display: none;"><?php echo $loadedFile; ?></textarea>
<script src="monaco/min/vs/loader.js"></script>
<script>
	showCodeNav = false;

	var texttoedit = document.getElementById('intext').value;

	require.config({ paths: { 'vs': '/monaco/min/vs' }});

	require(['vs/editor/editor.main'], function() {
		editor = monaco.editor.create(document.getElementById('container'), {
			theme: 'vs-dark',
      value: texttoedit,
			language: '<?php echo $uselang; ?>',
			minimap: {
            enabled: false
        }
		});

		window.onresize = function() {
			editor.layout();
		};
		hideMessage();

	});

	var showHideCN = function() {
		console.log('showCodeNav', showCodeNav);
		
		if (showCodeNav) {
			editor.updateOptions({
        minimap: {
            enabled: false
        }
			});
			showCodeNav = false;
		} else {
			editor.updateOptions({
        minimap: {
            enabled: true
        }
			});
			showCodeNav = true;
		}
	}

	var showfind = function() {
		editor.getAction("actions.find").run();
	}

	// XHR object
	xhrObj = function(){
		try {return new XMLHttpRequest();}catch(e){}
		try {return new ActiveXObject("Msxml3.XMLHTTP");}catch(e){}
		try {return new ActiveXObject("Msxml2.XMLHTTP.6.0");}catch(e){}
		try {return new ActiveXObject("Msxml2.XMLHTTP.3.0");}catch(e){}
		try {return new ActiveXObject("Msxml2.XMLHTTP");}catch(e){}
		try {return new ActiveXObject("Microsoft.XMLHTTP");}catch(e){}
		return null;
	},

	savefile = function() {
		showMessage('alert', 'Saving...',0);
		value = window.editor.getValue();
		saveURL = '<?php echo "lib/save.php?action=save&csrf=".$_GET["csrf"] ?>';
		console.log('saveURL', saveURL);
		var xhr = xhrObj();

		xhr.onreadystatechange=function() {
			if (xhr.readyState==4 && xhr.status==200) {
				/* console.log(xhr.responseText); */
				var statusObj = JSON.parse(xhr.responseText);
				console.log('statusObj', statusObj)
				if (statusObj.status === 'saved') {
					showMessage('success', 'Saved',600);
				} else {
					showMessage('success', 'Error',600);
				}
			}
		};

		xhr.open("POST",saveURL,true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('timeStart=0&file=<?php echo $fileToOpen; ?>&contents='+encodeURIComponent(value));
	}

	showMessage = function(type, message, duration) {
		var mw = document.getElementById('editoralert');
		if(type === 'error') {
			mw.style.backgroundColor = 'red';
		}
		if(type === 'alert') {
			mw.style.backgroundColor = 'grey';
		}
		if(type === 'success') {
			mw.style.backgroundColor = 'green';
		}
		mw.innerHTML = message;
		mw.style.visibility = 'visible';

		if(duration != 0) {
			setTimeout(function(){ 
				hideMessage(); 
			}, 3000);
		}
	}
	hideMessage = function() {
		var mw = document.getElementById('editoralert');
		mw.style.visibility = 'hidden';
	}

</script>
</body>
</html>