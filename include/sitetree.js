/* [nodename, id, name, navigationtext, href, isnavigation, childs[], templatename] */

if (typeof(decodeURIComponent) == 'undefined') {
  decodeURIComponent = function(s) {
    return unescape(s);
  }
}

function jdecode(s) {
    s = s.replace(/\+/g, "%20")
    return decodeURIComponent(s);
}

var POS_NODENAME=0;
var POS_ID=1;
var POS_NAME=2;
var POS_NAVIGATIONTEXT=3;
var POS_HREF=4;
var POS_ISNAVIGATION=5;
var POS_CHILDS=6;
var POS_TEMPLATENAME=7;
var POS_TARGET=8;
var theSitetree=[ 
	['PAGE','2701',jdecode('About+Us'),jdecode(''), jdecode('%2F2701.html'), 'true',[],'',''],
	['PAGE','15001',jdecode('Facials%2C+Peels+%26+Microdermabrasion'),jdecode(''), jdecode('%2F15001.html'), 'true',[],'',''],
	['PAGE','16001',jdecode('Medical+Services'),jdecode(''), jdecode('%2F16001.html'), 'true',[],'',''],
	['PAGE','16022',jdecode('Additional+Spa+Services'),jdecode(''), jdecode('%2F16022.html'), 'true',[],'',''],
	['PAGE','6264',jdecode('Products'),jdecode(''), jdecode('%2F6264.html'), 'true',[],'',''],
	['PAGE','29401',jdecode('Our+Staff'),jdecode(''), jdecode('%2F29401.html'), 'true',[],'',''],
	['PAGE','6285',jdecode('Before+%26+After'),jdecode(''), jdecode('%2F6285.html'), 'true',[],'',''],
	['PAGE','14601',jdecode('Contact'),jdecode(''), jdecode('%2F14601.html'), 'true',[],'','']];
var siteelementCount=8;
theSitetree.topTemplateName='Wave';
theSitetree.paletteFamily='6EB058';
theSitetree.keyvisualId='-1';
theSitetree.keyvisualName='keyv.jpg';
theSitetree.fontsetId='16368';
theSitetree.graphicsetId='12119';
theSitetree.contentColor='FFFFFF';
theSitetree.contentBGColor='6EB058';
var localeDef={
  language: 'en',
  country: 'US'
};
var prodDef={
  wl_name: 'grp35-attweb',
  product: 'WSCSYSSSSLY0X9RC'
};
var theTemplate={
				hasFlashNavigation: 'false',
				hasFlashLogo: 	'false',
				hasFlashCompanyname: 'false',
				hasFlashElements: 'false',
				hasCompanyname: 'false',
				name: 			'Wave',
				paletteFamily: 	'6EB058',
				keyvisualId: 	'-1',
				keyvisualName: 	'keyv.jpg',
				fontsetId: 		'16368',
				graphicsetId: 	'12119',
				contentColor: 	'FFFFFF',
				contentBGColor: '6EB058',
				a_color: 		'000000',
				b_color: 		'000000',
				c_color: 		'000000',
				d_color: 		'366B24',
				e_color: 		'366B24',
				f_color: 		'366B24',
				hasCustomLogo: 	'false',
				contentFontFace:'Arial, Helvetica, sans-serif',
				contentFontSize:'12',
				useFavicon:     'false'
			  };
var webappMappings = {};
webappMappings['5000']=webappMappings['5000-']={
webappId:    '5000',
documentId:  '2701',
internalId:  '',
customField: '20100801-154147'
};
webappMappings['5000']=webappMappings['5000-']={
webappId:    '5000',
documentId:  '6285',
internalId:  '',
customField: '20100709-221657'
};
webappMappings['5000']=webappMappings['5000-']={
webappId:    '5000',
documentId:  '15001',
internalId:  '',
customField: '20100731-141758'
};
webappMappings['5000']=webappMappings['5000-']={
webappId:    '5000',
documentId:  '6264',
internalId:  '',
customField: '20100725-195127'
};
webappMappings['5000']=webappMappings['5000-']={
webappId:    '5000',
documentId:  '16001',
internalId:  '',
customField: '20100725-185050'
};
webappMappings['5000']=webappMappings['5000-']={
webappId:    '5000',
documentId:  '14601',
internalId:  '',
customField: '20100731-151036'
};
webappMappings['5000']=webappMappings['5000-']={
webappId:    '5000',
documentId:  '16022',
internalId:  '',
customField: '20100725-194956'
};
webappMappings['1006']=webappMappings['1006-1006']={
webappId:    '1006',
documentId:  '2701',
internalId:  '1006',
customField: '1006'
};
var webAppHostname = 'diycgi.cluster.stngva01.us.diy-servers.net:80';
var canonHostname = 'diywk02.verio.stngva01.us.diy-servers.net';
var accountId     = 'AVF340I7C24E';
var companyName   = 'C+l+i+n+i+c+a+l+++A+e+s+t+h+e+t+i+c+s';
var htmlTitle	  = 'Clinical+Aesthetics+Villa+Park%2C+CA';
var metaKeywords  = 'Botox%2C+Dysport%2C+Perlane%2C+Restylane%2C+Juvederm+Ultra%2C+Latisse%2C+Facial%2C+Peel%2C+Micro-+Peel%2C+Micro-Peel+Plus%2C+Chemical+Peel%2C+Diamond+Skin%2C+Microdermabrasion%2C+Jan+Marini%2C+NeoStrata%2C+La+Roche+Posay%2C+Waxing%2C+Electrolysis%2C+Villa+Park%2C+Orange%2C+Anaheim%2C+Irvine%2C+Newport%2C+%0A';
var metaContents  = 'Clinical+Aesthetics+is+a+Medical+Spa+serving+the+Villa+Park%2C+CA+area+with+exceptional+services+to+exceed+the+most+demanding+standards%21+++You%27ll+love+our+secluded+location+where+we%27ve+created+a+relaxing+and+mellow+environment+just+for+you.+Take+your+mind+off+the+stresses+of+life+and+treat+yourself+to+a+pleasant+and+calming+experience.+++We+offer+ample+parking+and+a+convenient+location+in+the+heart+of+Villa+Park.+';
theSitetree.getById = function(id, ar) {
	if (typeof(ar) == 'undefined'){
		ar = this;
	}
	for (var i=0; i < ar.length; i++) {
		if (ar[i][POS_ID] == id){
			return ar[i];
		}
		if (ar[i][POS_CHILDS].length > 0) {
			var result=this.getById(id, ar[i][POS_CHILDS]);
			if (result != null){
				return result;
			}
		}
	}
	return null;
};

theSitetree.getParentById = function(id, ar) {
	if (typeof(ar) == 'undefined'){
		ar = this;
	}
	for (var i=0; i < ar.length; i++) {
		for (var j = 0; j < ar[i][POS_CHILDS].length; j++) {
			if (ar[i][POS_CHILDS][j][POS_ID] == id) {
				// child found
				return ar[i];
			}
			var result=this.getParentById(id, ar[i][POS_CHILDS]);
			if (result != null){
				return result;
			}
		}
	}
	return null;
};

theSitetree.getName = function(id) {
	var elem = this.getById(id);
	if (elem != null){
		return elem[POS_NAME];
	}
	return null;
};

theSitetree.getNavigationText = function(id) {
	var elem = this.getById(id);
	if (elem != null){
		return elem[POS_NAVIGATIONTEXT];
	}
	return null;
};

theSitetree.getHREF = function(id) {
	var elem = this.getById(id);
	if (elem != null){
		return elem[POS_HREF];
	}
	return null;
};

theSitetree.getIsNavigation = function(id) {
	var elem = this.getById(id);
	if (elem != null){
		return elem[POS_ISNAVIGATION];
	}
	return null;
};

theSitetree.getTemplateName = function(id, lastTemplateName, ar) {
	if (typeof(lastTemplateName) == 'undefined'){
		lastTemplateName = this.topTemplateName;
	}
	if (typeof(ar) == 'undefined'){
		ar = this;
	}
	for (var i=0; i < ar.length; i++) {
		var actTemplateName = ar[i][POS_TEMPLATENAME];
		if (actTemplateName == ''){
			actTemplateName = lastTemplateName;
		}
		if (ar[i][POS_ID] == id) {
			return actTemplateName;
		}
		if (ar[i][POS_CHILDS].length > 0) {
			var result=this.getTemplateName(id, actTemplateName, ar[i][POS_CHILDS]);
			if (result != null){
				return result;
			}
		}
	}
	return null;
};

theSitetree.getByXx = function(lookup, xx, ar) {
    if (typeof(ar) == 'undefined'){
    	ar = this;
    }
    for (var i=0; i < ar.length; i++) {
        if (ar[i][xx] == lookup){
        	return ar[i];
        }
        if (ar[i][POS_CHILDS].length > 0) {
        	var result=this.getByXx(lookup, xx, ar[i][POS_CHILDS]);
            if (result != null){
                return result;
               }
        }
    }
    return null;
};

function gotoPage(lookup) {
	if(__path_prefix__ == "/servlet/CMServeRES" && typeof (changePage) == 'function'){
		changePage(lookup);
		return;
	}
	var page = theSitetree.getHREF(lookup);
	if (!page) {
		var testFor = [ POS_NAME, POS_NAVIGATIONTEXT ];
		for (var i=0 ; i < testFor.length ; i++) {
			var p = theSitetree.getByXx(lookup, testFor[i]);
			if (p != null) {
				page = p[POS_HREF];
				break;
			}
		}
	}
	document.location.href = (new URL(__path_prefix__ + page, true, true)).toString();
};
