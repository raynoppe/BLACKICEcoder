# BLACKICEcoder

## Web IDE / browser code editor modified for Termux and smaller screens.


BLACKICEcoder is a web IDE / browser based code editor, which allows you to develop websites on your Android Device or locally/live on any server running PHP. It uses [Monaco Editor](https://microsoft.github.io/monaco-editor/) (Visual Studio Code) for code editing (includes highlighting, auto complete, code folding), with a mobile friendly IDE wrapped around it to make the whole thing work. 

<img src="https://static1.squarespace.com/static/5a844ad5cf81e008d8b943b8/t/5c35e8f721c67c3150fc0c5b/1547037077315/blackicecoder.jpg" alt="BLACKICEcoder web IDE">

BLACKICEcoder started out as a port of [ICEcoder](https://icecoder.net/) with the CSS adjusted for mobile devices. We have since rebuilt a chunck of it. See the differences below.

### Differences between BLACKICEcoder and ICEcoder

`Please note: Even though this is modified for Termux it works perfectly fine on any server running PHP`

* BLACKICEcoder uses [Monaco Editor](https://microsoft.github.io/monaco-editor/) the editor that powers [VS Code](https://code.visualstudio.com/) instead of CodeMirror
* Adjusted the CSS to be more friendly towards small devices. 
* Changed a few things so it just works out the box on a standard [Termux](https://termux.com/) installation
* Works great in Chrome for Android (I re-coded a lot of the actual editor on my Huawei M5 8)
* Works great in the Kindle Fire HD range (Allows you to have a full Node / PHP / AngularJS / ReactJS dev environment for next to nothing)
* The righthand mini code navigator is off by default and can be enabled per document. This way it saves resources and prevents speed penalties on large files.

### Future changes

* Clean-up the codebase to make it lighter.
* Change the backend from PHP to Node.js (Thoughts?)
* Add a plugin manager to add functionality like lint and Emet.

### Requirements

You can run BLACKICEcoder either online or locally on any Android phone that can run [Termux](https://termux.com/). I strongly recommend installing Hacker's Keyboard or another keyboard that has Ctrl, Shift and Arrow button else you will not be able to select text.

On Linux, Windows or Mac based desktops/laptops. The only requirement is to have PHP 5 available (5.3 recommended). You can have this either as a vanilla installation or via a program such as WAMP or XAMPP (for Windows) or MAMP (for Mac).

### Installation

#### Step 1 (Termux): Get BLACKICEcoder

Either download the zip or clone from Github using:
Make sure you have php installed **(Don't type or copy the $)**
```
$ pkg install php
```
In termux install git if you haven't done so yet
```
$ pkg install git
```
and then run the git clone command in your home folder (~/ or /data/data/com.termux/files/home)
```
$ git clone https://github.com/raynoppe/BLACKICEcoder.git 
```

#### Step 2 (Termux):
Enter your install folder:
```
$ cd blackicecoder
```
Set write permissions on the 'backups', 'lib', 'plugins', 'test' and 'tmp' folders. (Try without doing this first as it doesn't seem to be needed on Termux)
Example: 
```
$ chmod 775 backups/
```
Double check your Termux document root
If your home folder differs in BLACKICE for some strange reason to '/data/data/com.termux/files/home' you need to update the following file 'lib/config__settings.php' using vim or your favourite editor
```
$ cd BLACKICEcoder
$ vim lib/config__settings.php
```
Change the docRoot value to reflect your Termux home folder 
```
"docRoot"		=> '/data/data/com.termux/files/home' 
```
If you want to use BLACKICE to edit your config files as well change the docRoot to 
```
"docRoot"		=> '/data/data/com.termux/files' 
```
Save the file

#### Step 3 (Termux):
Run php in the blackicecoder folder: 
```
php -S 127.0.0.1:1028 -t ~/BLACKICEcoder/
```
## Useing BLACKICE
#### Selecting text
Tap next to the work you want to copy and then press and hold the SHIFT key and use the arrow buttons

#### Code completion
To complete a TAG in HTML and PHP type the first part of the tag and the use Ctrl + Left Arrow to complete.
'&gtdiv' Ctrl → &gtdiv&lt&gt/div&lt

#### Step 1 (Desktops, Servers): Get BLACKICEcoder
```
$ git clone https://github.com/raynoppe/BLACKICEcoder.git 
```

#### Step 2 (Desktops, Servers): Place in your document root (online or local)

* Put in a new sub-dir URL such as yourdomain.com/blackicecoder or localhost/blackicecoder
* Set write permissions (757 or 775 depending on your system) on the 'backups', 'lib', 'plugins', 'test' and 'tmp' folders
* Visit the sub-dir URL in your browser. You will see that no folders and files are loaded in the file browser. This is not an error. Follow next step:

Update your config setting after you have done an initial run.
```
lib/config__settings.php
```
Change the docRoot value to reflect your home folder
```
"docRoot"		=> '/root/to/your/code/folder' 
```
Save the file

*(Note: A small number of web servers give an internal server error here, if you get this, try 755 instead)*

#### Step 3: Start coding

**Now you are all setup, auto-logged in and ready to code!**

Suitable for commercial & non-commercial projects, just let me know if it's useful to you and any cool customisations you make to it. I take no responsibility for anything, your usage is all down to you.

It's fully open source and MIT licensed. I'm happy for you to take it, make it your own and customise to your hearts content and/or contribute to this main repo! :)

Comments, improvements & feedback welcomed!
