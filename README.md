# BLACKICEcoder

## Web IDE / browser code editor modified for Termux and smaller screens.

This is a port of [ICEcoder](https://icecoder.net/).  

BLACKICEcoder is a web IDE / browser based code editor, which allows you to develop websites on your Andriod Device or locally on any . It uses the brilliant CodeMirror for code highlighting & editing, with a slick IDE wrapped around it to make the whole thing work. 

<img src="https://icecoder.net/images/icecoder-v6-0-browser-code-editor.png" alt="ICEcoder web IDE">

### Differences between BLACKICEcoder and ICEcoder

* Adjusted the CSS to be more friendly towards small devices. 
* Changed a few things so it just works out the box on a standard [Termux](https://termux.com/) installation
* Works well in Chrome for Android (Couple of CSS issues on high res tablets from Huawei and Samsung)
* Works great in the Kindle Fire HD range (Alows you to have a full Node / PHP / AngularJS dev invorment for less next to nothing)
* Disabled the right hand code minimap area to free up space for the editor (Still a few niggles to fix)

### Future changes

* Rewrite the CSS using flexbox so it is more mobile friendly
* Replace CodeMirror with [Monaco Editor](https://microsoft.github.io/monaco-editor/)

### Requirements

You can run ICEcoder either online or locally on any Android phone that can run [Termux](https://termux.com/), on Linux, Windows or Mac based desktops/laptops. The only requirement is to have PHP 5 available (5.3 recommended). You can have this either as a vanilla installation or via a program such as WAMP or XAMPP (for Windows) or MAMP (for Mac).

### Installation

#### Step 1 (Termux): Get BLACKICEcoder

Either download the zip or clone from Github using:
Make sure you have php installed 
```
pkg install php
```
In termux install git if you haven't done so yet
```
pkg install git
```
and then run the git clone command in your home folder (~/ or /data/data/com.termux/files/home)
```
git clone git@gitlab.com:raynoppe/blackicecoder.git
```

#### Step 2 (Termux):
Set write permissions on the 'backups', 'lib', 'plugins', 'test' and 'tmp' folders.
Example: 
```
chmod 775 backups/
```

#### Step 1 (Desktops, Servers): Get BLACKICEcoder
```
$ git clone git@gitlab.com:raynoppe/blackicecoder.git
```

#### Step 2 (Desktops, Servers): Place in your document root (online or local)

* Put in a new sub-dir URL such as yourdomain.com/ICEcoder or localhost/ICEcoder
* Set write permissions (757 or 775 depending on your system) on the 'backups', 'lib', 'plugins', 'test' and 'tmp' folders

*(Note: A small number of web servers give an internal server error here, if you get this, try 755 instead)*

#### Step 3: Start coding

* Visit the sub-dir URL in your browser and enter a password

**Now you're setup, auto-logged in and ready to code!**

Suitable for commercial & non-commercial projects, just let me know if it's useful to you and any cool customisations you make to it. I take no responsibility for anything, your usage is all down to you.

It's fully open source and MIT licensed. I'm happy for you to take it, make it your own and customise to your hearts content and/or contribute to this main repo! :)

Plenty of comments included in the code to assist with understanding, customising etc.

Comments, improvements & feedback welcomed!
