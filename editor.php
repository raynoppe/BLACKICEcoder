<?php
include("lib/headers.php");
include("lib/settings.php");
$t = $text['editor'];
$getfile = $_REQUEST['getfile'];
$isNew = $_REQUEST['isNew'];
$ext = strtolower(pathinfo($getfile, PATHINFO_EXTENSION));
$fileToOpen = $docRoot.$getfile;
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
			border-radius: 5px 5px 5px 5px;
			text-align: center;
		}
		.editorfoot {
			display: flex;
			height: 35px;
			justify-content: left;
			background-color: #333;
		}
		.imgbuttons {
			padding: 3px 8px;
			border: 0px solid #fff;
			margin: 3px;
			border-radius: 3px;
			background-color: #333;
			margin-right: 8px;
		}
	</style>
</head>
<body>

<div class="editorcontainer">
	<div class="editorfoot">
		<a id="ssave" href="javascript:savefile()" class="imgbuttons"><img src="/images/425-floppy.png" width="20" height="20" /></a>
		<a id="sfind" href="javascript:showfind()" class="imgbuttons"><img src="/images/404-magnifying-glass.png" width="20" height="20" /></a>
		<a id="scont" href="javascript:showContext()" class="imgbuttons"><img src="/images/list_nested_16x14.png" width="20" height="20" /></a>
		<a id="minmap" href="javascript:showHideCN()" class="imgbuttons"><img src="/images/259-paper-map.png" width="20" height="20" /></a>
	</div>
	<div class="monacocontainer" id="container"></div>
	<div class="editoralert" id="editoralert">-- loading --</div>
</div>
<textarea id="intext" style="display: none;"><?php echo $loadedFile; ?></textarea>
<script src="monaco/min/vs/loader.js"></script>
<script>
	showCodeNav = false;

	var texttoedit = document.getElementById('intext').value;

	require.config({ paths: { 'vs': '/monaco/min/vs' }});

	require(['vs/editor/editor.main'], function() {
		// monaco.languages.registerCompletionItemProvider('<?php echo $uselang; ?>', {});
		editor = monaco.editor.create(document.getElementById('container'), {
			theme: 'vs-dark',
      		value: texttoedit,
			language: '<?php echo $uselang; ?>',
			contextmenu: false,
			minimap: {
            	enabled: false
        	}
		});

		editor.addAction({
			// An unique identifier of the contributed action.
			id: 'my-unique-id',

			// A label of the action that will be presented to the user.
			label: 'Code complete',

			// An optional array of keybindings for the action.
			keybindings: [
				monaco.KeyMod.CtrlCmd | monaco.KeyCode.RightArrow
			],

			// A precondition for this action.
			precondition: null,

			// A rule to evaluate on top of the precondition in order to dispatch the keybindings.
			keybindingContext: null,

			contextMenuGroupId: 'navigation',

			contextMenuOrder: 1.5,

			// Method that will be executed when the action is triggered.
			// @param editor The editor instance is passed in as a convinience
			run: function(ed) {
				// const atpos = ed.getPosition();
				const atpos = ed.getSelection();
				console.log(atpos, atpos.endLineNumber, atpos.endColumn);
				var model = editor.getModel();
				var partOfTheText = model.getValueInRange({
					startLineNumber: atpos.endLineNumber,
					startColumn: 1,

					endLineNumber: atpos.endLineNumber,
					endColumn: atpos.endColumn,
				});
				var uselang = '<?php echo $uselang; ?>';
				var preStr = '';
				if (uselang === 'html' || uselang === 'php') {
					var getlast = partOfTheText.lastIndexOf('<');
					if(getlast !== -1) {
						var tag = partOfTheText.substring(getlast + 1, atpos.endColumn);
						var checkSpace = tag.indexOf(' ');
						if ( checkSpace !== -1 ) {
							tag = tag.substring(0, checkSpace);
						}
						var endPos = atpos.endColumn;
						var checkflag = tag.indexOf('-');
						if ( checkflag !== -1) {
							var chunk1 = tag.split('-');
							var flagsraw = chunk1[1];
							var flaglength = flagsraw.length + 1;
							endPos -= flaglength;
							console.log('flags', flagsraw, flaglength);
							tag = tag.substring(0, checkflag);
							var flags = flagsraw.split(',');
							for ( var flagin of flags ) {
								console.log( 'flagin', flagin );
								var flagval = '';
								var checkcond = flagin.indexOf(':');
								if ( checkcond !== -1 ) {
									var flagsplit = flagin.split(':');
									flag = flagsplit[0];
									flagval = flagsplit[1];
								} else {
									flag = flagin;
								}
								switch (flag) {
									case 'i':
										preStr += ` id="${flagval}"`;
										break;
									case 'c':
										preStr += ` class="${flagval}"`;
										break;
									case 's':
										preStr += ` style="${flagval}"`;
										break;
									case 'h':
										preStr += ` height="${flagval}"`;
										break;
									case 'w':
										preStr += ` width="${flagval}"`;
										break;
									case 'hr':
										preStr += ` href="${flagval}"`;
										break;
									case 'src':
										preStr += ` src="${flagval}"`;
										break;
									case 'js':
										preStr += ` language="javascript" type="text/javascript"`;
										if ( flagval !== '' ) {
											preStr += ` src="${flagval}"`;
										}
										break;
									case 'css':
										preStr += ` rel="stylesheet" type="text/css" media="screen" href="${flagval}"`;
										break;
								
									default:
										preStr += ` ${flag}="${flagval}"`;
										break;
								}
								
								
							}
						}
						var startPos = atpos.endLineNumber;
						var id = { major: 1, minor: 1 }; 
						var mvc = true;
						var changeLine = -1;
						var changeCol = -1;
						var tgl = 0;
						switch (tag) {
							case 'img':
								mvc = false;
								var text = `${preStr}/>`;
								break;
							case '?php':
								tgl = 3;
								var text = `${preStr}  ?>`;
								break;
							case 'br':
								mvc = false;
								var text = `${preStr}/>`;
								break;
							case 'htmlstart':
								endPos -= 9;
								changeLine = 8;
								changeCol = 4;
								var text = '<!DOCTYPE html>\n<html>\n<head>\n\t<meta charset="utf-8" />\n\t<title>Page Title</title>\n</head>\n<body>\n\t\n</body>\n</html>\n';
								break;
							default:
								tgl = tag.length + 3;
								var text = `${preStr}></${tag}>`;
								break;
						}        
						var range = new monaco.Range(startPos, endPos, startPos, atpos.endColumn);
						var op = {identifier: id, range: range, text: text, forceMoveMarkers: true};
						editor.executeEdits("my-source", [op]);
						// move cursor
						if ( mvc ) {
							var newpos = ed.getSelection();
							console.log('newpos', newpos);
							console.log('tgl', tgl);
							var newLine = newpos.endLineNumber;
							if ( changeLine !== -1 ) { newLine = changeLine; }
							var newCPos = newpos.endColumn - tgl;
							if ( changeCol !== -1 ) { newCPos = changeCol; }
							ed.setPosition({ lineNumber: newLine, column: newCPos });
						}
					}
				}
				
				
				
				
				// alert("i'm running => " + atpos);

				return null;
			}
		});

		window.onresize = function() {
			editor.layout();
		};
		hideMessage();

	});

	var showHideCN = function() {
		if (showCodeNav) {
			editor.updateOptions({ minimap: { enabled: false } });
			showCodeNav = false;
			document.getElementById('minmap').style.backgroundColor = '#333';
		} else {
			editor.updateOptions({ minimap: { enabled: true } });
			showCodeNav = true;
			document.getElementById('minmap').style.backgroundColor = 'red';
		}
	}

	var context = false;

	var showContext = function () {
		if ( context === true ) {
			editor.updateOptions({ contextmenu: false });
			context = false;
			document.getElementById('scont').style.backgroundColor = '#333';
		} else {
			editor.updateOptions({ contextmenu: true });
			context = true;
			document.getElementById('scont').style.backgroundColor = 'red';
		}
		
	}
	var findshow = false;
	var showfind = function() {
		if(findshow) {
			editor.getContribution('editor.contrib.findController').closeFindWidget();
			findshow = false;
			document.getElementById('sfind').style.backgroundColor = '#333';
		} else {
			editor.getAction("actions.find").run();
			findshow = true;
			document.getElementById('sfind').style.backgroundColor = 'red';
		}
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