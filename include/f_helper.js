	//defining position of javascript source code and loading
	/*
	 * 0) insideWSC							:Im WSC und nicht deployed
	 * Es gibt 3 verschiedene Modi im WSC:
	 * 1) locParams.gloPre							:Ansicht in Designauswahl
	 * 2) !locParams.gloPre && !locParams.ediWin	:Vorschau im Editor inline
	 * 3) locParams.ediWin							:Vorschau im Editor neues Fenster

	 * 4) veröffentlicht
	 */

	/*here everythng is defined to decide where the sources and the context the page is shown*/
	var locParams = function() {
	}

	/*here everythng is defined needed for the html elements*/
	var elemParams = function() {
	}
	elemParams.CONTENTIFRAME	= "myiframe";
	elemParams.SHOP_IFRAME		= "shopIframe";
	elemParams.OBJECTMENU		= "objFlashMenue";
	elemParams.divList			= new Array();
	elemParams.totalWidth		= 760;

	elemParams.menueHeight      = 500;
	elemParams.menueOffsetTop   = 50;
	elemParams.mainbuttonHeight = 25;
	elemParams.subbuttonHeight  = 25;
	elemParams.scrollContent	= -1;

	/*this values are choosen in the design selection context, when no user sitetree is choosen for content*/
	elemParams.n_main           = 4;
	elemParams.n_sub            = 4;

	var pollMain = -1;
	var pollSub = -1;
	var pollMainOld = -1;
	var pollSubOld = -1;

	if (typeof(decodeURIComponent) == "undefined") {
		elemParams.decodeURIComponent = function(s) {
			return unescape(s);
		}
	} else {
		elemParams.decodeURIComponent = decodeURIComponent;
	}

	elemParams.jdecode = function(s) {
		var re = /\+/g;
		s = s.replace(re, "%20");
		return elemParams.decodeURIComponent(s);
	}

	locParams.url		 = new URL(document.location.href);
	locParams.srcUrl	 = new URL(URL.jdecode(locParams.url.getParameter("src", "")));
	locParams.insWSC	 = document.location.href.indexOf("/servlet/CMServeRES") >= 0;
	locParams.preview2	 = (locParams.srcUrl.getParameter("show", "") == "Preview2");
	locParams.pathprefix = locParams.insWSC ? "/servlet/CMServeRES" : ".";

	locParams.gloPre	 = document.location.href.indexOf("globalPreview") >= 0;
	locParams.ediWin	 = parent.document.location.href.indexOf(jencode("/servlet/Show")) >= 0;

	locParams.prefix	 = locParams.insWSC ? "/servlet/CMServeRES/" : "./";
	locParams.prefixSrc	 = locParams.gloPre ? jdecode(locParams.url.getParameter("srcPrefix")) : "";
	locParams.dataSrc	 = locParams.gloPre ? locParams.prefixSrc+".js" : locParams.prefix + "include/sitetree.js";

	locParams.stdImgDir	 = "";
	locParams.palDir	 = "";
	locParams.imgDir	 = locParams.prefix;

	/*
	 * in sitetree.js ist der sitetree und neuerdings auch einige Template-Eigenschaften definiert
	 */
	document.write('<SCRIPT src="' + locParams.dataSrc + '"></' + 'SCRIPT>');

	if (locParams.gloPre) {
		var idx = document.location.href.indexOf("?");
		var orig = document.location.href.substring(0, idx)
		idx = orig.lastIndexOf("/");
		orig = orig.substring(idx+1);
	}

	/*********************************************************************************/
	function setLocParams() {
		locParams.stdImgDir	= "./templates/" + theTemplate.name +"/img/";
		locParams.palDir	= "./" + theSitetree.paletteFamily + "/";
		locParams.imgDir	+= locParams.stdImgDir + locParams.palDir;
	}

	function setSizeParams(totalWidth) {
		elemParams.totalWidth		= totalWidth;
	}

	function setSitetreeParams(top, mainbutton, subbutton) {
		elemParams.menueOffsetTop   = top;
		elemParams.mainbuttonHeight = mainbutton;
		elemParams.subbuttonHeight  = subbutton;

		elemParams.n_main           = theSitetree.length;
		for (var i = 0; i < theSitetree.length; i++) {
			if (theSitetree[i][POS_CHILDS].length > elemParams.n_sub) {
				elemParams.n_sub = theSitetree[i][POS_CHILDS].length;
			}
		}

		elemParams.menueHeight = elemParams.menueOffsetTop + elemParams.mainbuttonHeight * elemParams.n_main + elemParams.subbuttonHeight * elemParams.n_sub;
	}

	function getTotalWidth() {
		return elemParams.totalWidth;
	}

	function getCompanyName() {
		if(locParams.insWSC && !locParams.preview2){
			var user = getUser();
			
			if (user != null) {
				return user.getCompanyname();
			}
		}
		
		return (typeof(companyName)!="undefined" ? companyName : "");
	}

	function getUser() { 
		var topWindow = getAccessibleTopWindow();
		
		if (topWindow.user) {
			return topWindow.user;
		} else 
		if (topWindow.opener && topWindow.opener.top && topWindow.opener.top.user) {
			return topWindow.opener.top.user;
		} else {
			return null;
		}
	}
	
	function getAccessibleTopWindow() {
		var topWindow = window.top;
		try {
			// provokes an access violation if we cannot access window.top from here
			var tryToAccess = topWindow.location.href;
		} catch (AccessViolation) { 
			topWindow = null;
		}
		
		if (topWindow) {
			return topWindow;
		} else {
			return getTopWindow();
		}
	}

	function writeHTMLTitle() {
		var _htmlTitle = "design layout";
		if (locParams.insWSC && !locParams.preview2) {
			var user = getUser();
			if (user != null) {
				_htmlTitle = user.getHtmlTitle();
			}
		} else if (typeof htmlTitle != "undefined") {
			_htmlTitle = elemParams.jdecode(htmlTitle);
		}
		document.title = _htmlTitle;
	}
	
	function writeMetaTags() {
		var _metaKeywords = "";
		var _metaContents = "";
		if (locParams.insWSC && !locParams.preview2) {
			var user = getUser();
			if (user != null) {
				_metaKeywords = user.getMetaKeywords();
				_metaContents = user.getMetaContents();
			}
		} else {
			if (typeof(metaKeywords) != "undefined") {
				_metaKeywords = elemParams.jdecode(metaKeywords);
			}
			if (typeof(metaContents) != "undefined") {
				_metaContents = elemParams.jdecode(metaContents);
			}
		}

		if (_metaKeywords != "") {
			document.write("<META name='keywords' content='" + _metaKeywords + "'>");
		}
		if (_metaContents != "") {
			document.write("<META name='description' content='" + _metaContents + "'>");
			document.write("<META name='abstract' content='" + _metaContents + "'>");
		}
		if (theTemplate && theTemplate.useFavicon == "true") {
			document.write('<link rel="shortcut icon" href="'+locParams.pathprefix+'/include/favicon.ico" type="image/ico">');
		}
	}
	
	/*
	 * showPage wechselt den Content im IFRAME
	 * Allerdings nur in der deployten Variante
	 */
	function showPage(href, id) {
		if (locParams.gloPre) {
			return;
		}
		if (locParams.insWSC) {
			href = "/servlet/Show?show=" + (locParams.preview2 ? "Preview2" : "Preview1") + "&document=" + id;
		} else {
			href = "." + href;
		}
		
		replaceContentIframe( href, id );
	}
	
	function replaceContentIframe( href, id ) {
		if( shopHasSSL( id )) {
			// hide iframe for non ssl content
			var contentIframe = document.getElementById( elemParams.CONTENTIFRAME );
			contentIframe.style.display = "none";
			
			// create iframe for shop ssl content
			var shopIframe = createShopIframe( href, contentIframe.style.width );
			contentIframe.parentNode.insertBefore( shopIframe, contentIframe );
			
			shopIframe.src = href;
		} else {
			// remove shop iframe
			var shopIframe = document.getElementById( elemParams.SHOP_IFRAME );
			if( null != shopIframe ) {
				shopIframe.parentNode.removeChild( shopIframe );
			}

			// show iframe for non ssl content
			refreshContentIframe(href);
		}	
	}
	
	function refreshContentIframe(href) {
		// google chrome does not repaint changing iframe correctly, so we remove and reinsert the iframe ...
	
		var iframeId = elemParams.CONTENTIFRAME;
		
		var parent = removeContentIframe(iframeId);
 		addContentIframe(parent, iframeId, href);
	}
	
	function removeContentIframe(iframeId) {
		var contentIframe = document.getElementById(iframeId);
 		
 		var parent = contentIframe.parentNode;
 		parent.removeChild(contentIframe);
 		
 		return parent;
	}
	
	function addContentIframe(parent, iframeId, href) {
 		var mytemplate = document.getElementById("mytemplate");
 		
 		contentIframe = mytemplate.cloneNode(false);
 		
 		contentIframe.name = "main";
 		contentIframe.id = iframeId;
 		contentIframe.style.display = "block";
 		contentIframe.src = href;
 		
 		parent.appendChild(contentIframe);
	}
	
	/*
	 * Startseite anzeigen
	 */
	function showMain() {
		var mainSrc;
		var src;
		if (locParams.gloPre) {
			mainSrc = locParams.prefixSrc + ".html";
		} else if ((src = locParams.url.getParameter("src"))) {
			mainSrc  = jdecode(src).replace(/http[s]?:\/\/[^\/]*/, "");
			// security: no other hosts!
			if (mainSrc.substring(0, 1) != "/") {
				mainSrc = "/" + mainSrc; 
			} 
		} else {
			mainSrc = "." + theSitetree[0][POS_HREF];
		}
		window.frames.main.document.location.href = mainSrc;
	}

	/*
	 * Diese Methode wird vom Totop-Anchor aufgerufen
	 */
	function scrollBack() {
		if (elemParams.scrollContent > 0) {
			/*the content iframe is scrolled*/
			iFrameScrollBack();
		} else {
			/*the page is scrolled complete*/
			window.document.body.scrollTop = 0;
		}
	}

    function iFrameScrollBack() {
        var elem = window.document.getElementById(elemParams.CONTENTIFRAME);
        if (elem) {
                var wnd = elem.contentWindow;
                if (wnd) {
                        wnd.document.body.scrollTop = 0;
                }
        }
    }
    
	/*
	 * Diese Methode wird nicht mehr direkt vom FlashMenu aufgerufen, sondern ueber doPoll getriggert
	 */
	function handleFlashMenu(main, sub) {
		elemParams.currentPage = 0;

		if (locParams.gloPre) {
			return;
		}
		
		main = main-1;
		for (var i = 0; i < theSitetree.length && i <= main; i++) {
			if (theSitetree[i][POS_ISNAVIGATION] == 'false')
				main++;
		}
		if (theSitetree && main < theSitetree.length) {

			elemParams.currentPage = main;

			if (sub == 0) {
				// Kein Untermenu ausgewaehlt
				internalShowPage(theSitetree[main]);
			} else {
				sub = sub-1;
				var childpages = theSitetree[main][POS_CHILDS];
				//no more existing sub page
				if ( sub >= childpages.length) {
                                	handleNonExistingPage();
                                }

				for (var j = 0; j < childpages.length && j <= sub; j++) {
					if (childpages[j][POS_ISNAVIGATION] == 'false')
						sub++;
				}

				internalShowPage(childpages[sub]);
			}
		} else {
			handleNonExistingPage();
		}
	}

	function internalShowPage(siteElem) {
		if (siteElem[POS_NODENAME] == "ITEM") {
			document.location.hash = pollMainOld + "," + pollSubOld;
			
			if( siteElem[ POS_TARGET ].length != "" ) {
				window.open(siteElem[POS_HREF]);
			} else {
				document.location.href = siteElem[ POS_HREF ];
			}
		} else {
			if (pollMain != pollMainOld || pollSub != pollSubOld) {
				pollMainOld = pollMain;
				pollSubOld = pollSub;
				showPage(siteElem[POS_HREF], siteElem[POS_ID]);
			}
		}
	}

	function handleNonExistingPage() {
		document.location.replace(document.location.href.replace(/#.*/g, ""));
	}

	/*
	 * onLoad-Handler
	 */
	function initMain(bgcolor) {
		if (elemParams.scrollContent < 0) {
			document.body.scroll="auto";
		} else {
			document.body.style.overflow = "hidden";
		}

		if (typeof(bgcolor) == "undefined") {
			bgcolor = ((typeof(theTemplate) != 'undefined' && theTemplate.body_bg_color) ? theTemplate.body_bg_color : "FFFFFF");
		}
		/*this is temporary**********/
		bgcolor = theSitetree.contentBGColor;
		/****************************/
		document.body.style.backgroundColor = bgcolor;

		var divList = document.getElementsByTagName("DIV");
		for (var i = 0; i < divList.length; i++) {
			var elem = divList[i];
			if (elem.style && elem.style.position == "absolute") {
				elem.initialLeft = parseInt(elem.style.left);
				elemParams.divList.push(elem);
			}
		}
		if (typeof(initMainTemplate)=="function") {
			initMainTemplate();
		}
		showMain();
		doPoll();
	}

	/*
	 * Das ist eine Hilfsfunktion, um ein Flash zu plazieren
	*/
	function insertObjectFlash(src,strID,iWidth,iHeight,sScale,sSalign) {
		src = locParams.imgDir + src;
		_insertObjectFlash(src,strID,iWidth,iHeight,sScale,sSalign);
	}

	function _insertObjectFlash(src,strID,iWidth,iHeight,sScale,sSalign) {
		var strOut="";
		strOut 	= "<OBJECT "
				+ " style='z-index:2;'"
				+ "	id='"+strID+"'"
				+ "	width='"+iWidth+"'"
				+ "	height='"+iHeight+"'"
				+ "	style='cursor:default; vertical-align:top;'"
				+ " type='application/x-shockwave-flash'"
				+ "	swlivecontent='true'"
				+ "	data='" + src + "'";
				
		var topWindow = getAccessibleTopWindow();		
		if (topWindow.g_clientCheck && topWindow.g_clientCheck.isIE4up)
			strOut+= " codebase='https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,42,0'";
		else if(topWindow.g_clientCheck && topWindow.g_clientCheck.isMoz1up)
			strOut += " pluginspage='https://www.macromedia.com/go/getflashplayer'";
		strOut +=">";
		strOut 	+= "<PARAM name='wmode' value='Transparent'></PARAM>"
				+ "<PARAM name='movie' value='" + src + "' ></PARAM>"
				+ "<PARAM name='menu' value='false' ></PARAM>";
		if (sScale) strOut+= "<PARAM name='scale' value='"+sScale+"'></PARAM>";
		if (sSalign) strOut+="<PARAM name='salign' value='"+sSalign+"'></PARAM>";
		strOut  += "<PARAM name='bgcolor' value='#" + theSitetree.contentBGColor + "'></PARAM>"
				+ "</OBJECT>";
		document.write(strOut);
	}

	/*
	 * Das ist eine Hilfsfunktion, um ein Image zu plazieren
	 */
	function writeImg(src,xSize,ySize) {
		var s="";
		src = locParams.imgDir + src;
		s+="<IMG border='0' src='" + src+"'";
		if (xSize) s += " width='"+xSize+"'";
		if (ySize) s += " height='"+ySize+"'";
		s+=">";
		document.write(s);
	}

	function writeSpacer(xSize, ySize) {
		writeImg("spacer.gif",xSize, ySize);
	}
	
	/*
	 * Das ist eine Hilfsfunktion, um ein TD mit BackgroundImage zu plazieren (offenes TD)
	 */
	function writeBackgroundTd(src,tdWidth,tdHeight,params,col,row,align,userAttrib) {
		if (typeof(params)=="undefined") {
			params = {};
		}
		src = locParams.imgDir + src;

		var s="";
		s	+= "<TD background='"+src+"'"
			+  (tdWidth ? " width='"+tdWidth+"'" : "")
			+  (tdHeight ? " height='"+tdHeight+"'" : "")
			+ (params.cols ? " colspan='"+params.cols+"'" : "")
			+ (params.rows ? " rowspan='"+params.rows+"'" : "")
			+ (params.align ? " valign='"+params.align+"'" : "")
			+ (params.userAttrib ? params.userAttrib : "")
			+ ">"
		;
		document.write(s);
	}

	/*
	 * Das ist eine Hilfsfunktion, um das Logo zu plazieren
	 */
	function insertLogo(xSize,ySize) {
		var s="";
		var	src = locParams.imgDir + "logo.gif";
		if (locParams.insWSC)
			src="/servlet/CMGetDyn/logo_name?foo=" + Math.random();
		else if (typeof(theTemplate.hasCustomLogo) != 'undefined' && theTemplate.hasCustomLogo == 'true') {
			src = locParams.stdImgDir + "logo.gif";
		}

		s+="<IMG border='0' src='" + src+"'";
		if (xSize) s += " width='"+xSize+"'";
		if (ySize) s += " height='"+ySize+"'";
		s+=">";
		document.write(s);
	}

	/*
	 * Das ist eine Hilfsfunktion, um das Flashmenu zu plazieren
	 */
	function insertMenue(xSize) {
		var data = getMainAndSub();

		//var src= locParams.prefix + "flash/menu.swf";
		var url = new URL(locParams.prefix + "flash/menu.swf", true, true);

		if (data[0] != -1 && data[1] != -1) {
			url.setParameter("main", data[0], true);
			url.setParameter("sub", data[1], true);
		}

		if (url.path.indexOf("/servlet/CMServeRES") > -1)
			url.setParameter("foo", Math.random(), true);

		if (locParams.gloPre)
			url = new URL(locParams.prefixSrc + ".swf", true, true);


		_insertObjectFlash(url.toString(),elemParams.OBJECTMENU,xSize,elemParams.menueHeight,"noscale","t");
	}

	/*
	 * Das ist eine Hilfsfunktion, um das image mit Company name zu plazieren
	*/
	function insertCompanyName(xSize,ySize) {
		var src;
		if (locParams.insWSC) {
			src = "/servlet/CMGetDyn/company_name";
		} else {
			src = locParams.stdImgDir + "company_name.gif";
		}
		document.write("<IMG src='" + src + "' width='"+xSize+"' height='"+ySize+"'>");
	}
	
	/*
	 * Das ist eine Hilfsfunktion, um den contentIFrame zu plazieren
	 */
	function insertContentIFrame(width) {
		if (typeof(width)=="undefined") {
			width = "100%";
		}

		var s = "";
		
		s += createIframeHtml("main", elemParams.CONTENTIFRAME, "block", width);
		s += createIframeHtml("mytemplate", "mytemplate", "none", width);

		document.write(s);
	}

	function createIframeHtml(IFRAMENAME, IFRAMEID, DISPLAYSTYLE, WIDTH) {	
		var noScrollContent = (elemParams.scrollContent < 0);
		
		var scrolling = noScrollContent ? "no" : ""; 
		var overflow = noScrollContent ? "overflow:hidden;" : "";
		
		var onloadHandler = noScrollContent ? "onload='resizeMyHeight(this);'" : "";
		
		var includeDir = locParams.insWSC ? "/res/common/" : "include/";
	
		var html = 
			"<IFRAME "
			  + " scrolling=" + quoteAttribute(scrolling)
			  + " name=" + quoteAttribute(IFRAMENAME)
			  + " frameborder='0'"
			  + " id=" + quoteAttribute(IFRAMEID)
			  + " style="
			  	+ quoteAttribute(
			  		"background-color:transparent; "
			  		+ " " + overflow
			  		+ " width: " + WIDTH + ";"
			  		+ " height: " + elemParams.menueHeight + "px;"
			  		+ " display: " + DISPLAYSTYLE + ";"
			  	)
			  + " allowtransparency "
			  + " src=" + quoteAttribute(includeDir + "blank.html")
			  + " " + onloadHandler
		  	+  ">"
		  	+  "</IFRAME>"
		  	;
		
		return html;
	}
	
	function quoteAttribute(attribute) {
		return "'" + attribute + "'";
	}

	/*
	 * Das ist eine Hilfsfunktion, um den scrollback anchor samt image zu plazieren
	 */
	function insertTotop(xSize,ySize,params) {
		if (typeof(params)=="undefined") {
			params = {};
		}
		var image = params.image ? params.image : "totop.gif";
		var str = "";

		str += "<A href='javascript:;'"
			+  " onclick='" + (params.onClick ? params.onClick : "scrollBack()")+"'"
			+  " onfocus='this.blur()'>"
		;
		document.write(str);
		writeImg(image,xSize,ySize);
		document.write("</A>");
	}
	
	function getScrollHeight(elem) {
		var scrollHeight = 0; 
		try {
			if (elem.contentDocument && 
				elem.contentDocument.body && 
				elem.contentDocument.body.offsetHeight) {

				scrollHeight = elem.contentDocument.body.offsetHeight;
			} else 
			if (elem.contentWindow &&
				elem.contentWindow.document &&
				elem.contentWindow.document.body &&
				elem.contentWindow.document.body.scrollHeight) {

				scrollHeight = elem.contentWindow.document.body.scrollHeight;
			}
		} catch (e) { 
			// Access denied accessing http content from https iframe on same domain
			// => use fallback data
			var body = document.body;
			if (body.offsetHeight) {
				scrollHeight = body.offsetHeight
			} else
			if (body.scrollHeight) {
				scrollHeight = body.scrollHeight;
			}
		}

		return scrollHeight;
	}

	/*
	 * Diese function resized die iframe height wechsel des content
	 */
	function resizeMyHeight(elem) {
		var scrollHeight = getScrollHeight(elem);
		var	newHeight = Math.max(scrollHeight, elemParams.menueHeight);
		
		elem.style.height = newHeight + "px";
 	}	

	/*
	 * Diese function resized den iframe beim wechsel des content
	 */
	function resizeMe(elem) {
		resizeMyHeight(elem);
		
		var newWidth = null;
		try {
			newWidth = elem.contentWindow.document.body.scrollWidth;
		} catch( e ) { 
			// Access denied accessing http content from https iframe on same domain
			newWidth = null;
		}
		
		if (newWidth)
			elem.style.width = newWidth;
		
		try {
			document.title = elem.contentWindow.document.title;
		} catch( e ) { 
			// Access denied accessing http content from https iframe on same domain
			// no alternative here
		}
	}

	/*
	 * Diese function resized den iframe, falls dieser den scrollbalken haben soll (elemParams.scrollContent > -1)
	 */
	function resizeMainFrame() {
		var isIE = navigator.userAgent.toLowerCase().indexOf("msie") > -1;
		var iframe = document.getElementById(elemParams.CONTENTIFRAME);
		var bodyHeight = (isIE ? document.body.clientHeight : window.innerHeight);
		var newHeight = bodyHeight - (elemParams.scrollContent < 0 ? 0 : elemParams.scrollContent);

		iframe.style.height = newHeight + "px";
	}

	/*not in use yet*/
	function scrollMenue() {
		var div = document.getElementById("LayerMenueFlash");
		div.style.top = Math.max(118,document.body.scrollTop + 21) + "px";
	}

	/*
	 * onload und onresize handler
	 */
	function doPosition() {
		if (!(elemParams.scrollContent < 0)){
			resizeMainFrame();
		}

		if (locParams.gloPre) return;

		var elem = document.body;
		var x = Math.floor((elem.offsetWidth - elemParams.totalWidth)/2);
		if (elem.offsetWidth < elemParams.totalWidth)
			x = 0;
		for (var i = 0; i < elemParams.divList.length; i++) {
			var divElem = elemParams.divList[i];
			divElem.style.left = divElem.initialLeft + x;
		}
	}

	function helperInit(xMax, top, mainbutton, subbutton, scroll) {
		//window.onscroll = function(){scrollMenue();}

		if (typeof(scroll) != "undefined"){
			elemParams.scrollContent = scroll;
		}
		setSizeParams(xMax);
		setLocParams();
		setSitetreeParams(top, mainbutton, subbutton);
		writeHTMLTitle();
		writeMetaTags();
	}

	// ------------------------------------------------------------------------------------------------------------------------------------------------
	function doPoll() {
		var data = getMainAndSub();
		var _main = data[0];
		var _sub = data[1];

		if (_main != -1 && _sub != -1) {

			if (_main != pollMain || _sub != pollSub) {
				pollMain = _main;
				pollSub = _sub;
				handleFlashMenu(_main, _sub);
			}
		}

		setTimeout(doPoll, 20);
	}

	function getMainAndSub() {
		var data = document.location.hash.replace(/#/g, "").split(",");
		if (data
		 && data[0]
		 && data[1]
		 && String(Number(data[0])) != "NaN"
		 && String(Number(data[1])) != "NaN")
		{
			return [ Number(data[0]), Number(data[1]) ];
		}
		
		return [-1,-1];
	}
	
	// --- BEGIN SSL shop specific stuff ---
	
	function getClientHeight() {
		if( typeof( window.innerHeight ) != "undefined" ) {
	 		return window.innerHeight;
	 	} else
		if( typeof( document.body.offsetHeight ) != "undefined" ) {
	 		return document.body.offsetHeight;
	 	} else {
	 		return -1;
		}
	} // method	

	function shopHasSSL( id ) {	
		// get current webapp id, if displayed content is a webapp
		var webapp = null;
		if( typeof( webappMappings ) != "undefined" ) {
			for( var app in webappMappings ) {
				if( webappMappings[app].documentId == id ) {
					webApp = webappMappings[app].webappId;
				}
			}
		} 
		
		// is it the shop webapp
		if(( "4001" == webapp )) {
			
			// check for ssl flag in custom field
			var data = webappMappings[ '4001' ].customField;
			var nvPairs = data.split( ';' );
			for( var i = 0; i < nvPairs.length; i++ ) {
				var nv = nvPairs[ i ].split( ':' );
		
				if( nv.length == 2 && "ssl" == nv[ 0 ]) {
					return "true" == nv[ 1 ];
				}
			} // for
		}
		
		return false;
	}

	function ContentIframe_onload( e ) {
		var contentIframe = document.getElementById( elemParams.CONTENTIFRAME );
		resizeMe( contentIframe );
	} 
	
	function createShopIframe( href, width ) {	
		var newFrame = window.document.createElement( "iframe" );
		
		newFrame.name = "main"; 
		newFrame.setAttribute( "frameborder", "0" );
		newFrame.frameborder = "0";
		newFrame.id = elemParams.SHOP_IFRAME;
		
		newFrame.style.backgroundColor = "transparent"; 
		newFrame.style.overflow = "auto";
		newFrame.style.border = "none";
		// nur für IE?
		newFrame.scrolling = "auto";

		newFrame.style.width = width;
		
		var height = getClientHeight();
		if( height > 0 ) {
			newFrame.style.height = height + "px";
		}
			
		newFrame.setAttribute( "allowtransparency", "allowtransparency" );
		
		if( elemParams.scrollContent < 0 ) {
			newFrame.onload = ContentIframe_onload;
		}
		
		return newFrame;
	}

	// --- END SSL shop specific stuff ---
