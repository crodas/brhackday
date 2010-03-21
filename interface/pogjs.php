<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Metal Archive, the app</title>   
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/fonts/fonts-min.css" />
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/treeview/assets/skins/sam/treeview.css" />
	<link rel="stylesheet" type="text/css" href="treeview-menu.css" />
	<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/connection/connection-min.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/treeview/treeview-min.js"></script>
	<script src="http://yui.yahooapis.com/2.8.0r4/build/element/element-min.js"></script>
	

</head>
<body class="yui-skin-sam">
<style>
body {
	margin:0;
	padding:0;
}
#cloud {
	_height:px;
	background-color:#FFFFFF;
	font-family:Arial; 
	border: 1px solid #FFFFFF; 
	text-align:justify;
	border: 1px solid #DE2159;
}
#cloud a {
	padding-left: 4px;
	padding-right: 4px;
	text-decoration:none;
}
#cloud a.force-1, #cloud a.force-5 {	 
	color: #039FAF;
}
#cloud a.force-2, #cloud a.force-6, #cloud a.force-9 {	
	color: #FF7600;
}
#cloud a.force-3, #cloud a.force-7, #cloud a.force-10 { 
	color: #87A800;
}
#cloud a.force-4,#cloud a.force-8 { 
	color: #DE2159;
}
#cloud a.force-1{font-size: 8px;}
#cloud a.force-2{font-size: 10px;}
#cloud a.force-3 {font-size: 12px;}
#cloud a.force-4 {font-size: 14px;}
#cloud a.force-5 {font-size: 16px;}
#cloud a.force-6 {font-size: 18px;}
#cloud a.force-7 {font-size: 20px;}
#cloud a.force-8 {font-size: 22px;}
#cloud a.force-9 {font-size: 24px;}
#cloud a.force-10 {font-size: 26px;}
#tagleft {
	width:12%; 
	float:left;	
	padding: 2px 4px 2px 10px; 
	border: 1px solid #FF7600;
}
#tagleft FORM INPUT{
	margin: 0;
	margin-top: 2px;
	padding: 0;
}
#newsright {
	margin-left: 13%;
	padding-left: 5px;
}
#newsright h2{
	margin-left: 13px;
}
#newsright .title {
	background-color: #ebeff9;
	margin-left: 4px;
	padding: 2px 4px 2px 10px;
	border: 1px solid #6B90DA;
}
#newsright ul{
	list-style: none;
}
#treeDiv span {
	font-size: 28px;
}
#expandcontractdiv {border:1px dotted #dedede; background-color:#EBE4F2; margin:0 0 .5em 0; padding:0.4em;}
#treeDiv { background: #fff; padding:1em; margin-top:1em; }

</style>
<script type="text/javascript">
var Dom = YAHOO.util.Dom,
	YCM = YAHOO.util.Connect;
function getTheTags() { 
	
	var AjaxObject = {
 
		handleSuccess:function(o) {
			this.processResult(o);
		}, 
		handleFailure:function(o) {
			alert('failure: getTheTags');
		}, 
		processResult:function(o) {			
			response = eval('('+o.responseText+')');				
			loadTagCloud(response);
		}, 
		startRequest:function() {			
	   		var transaction = YCM.asyncRequest('GET', 'json.tags.js', callback);
		}
 
	};
 
	var callback = {
		success:AjaxObject.handleSuccess,
		failure:AjaxObject.handleFailure,
		scope: AjaxObject
	};
 
	// Start the transaction.
	AjaxObject.startRequest();
}
function loadTagCloud(ElTags) {
	
    //var elTags = {"tags":[{'tag':'php','forca':10},{'tag':'sao paulo','forca':6},{'tag':'paulista','forca':8}]}
	var elCloud = document.getElementById('cloud');	
	var oTags = ElTags.tags;
	for(i in oTags) {
		elCloud.appendChild(createTagLink(oTags[i].tag,oTags[i].forca));
	}
}
function createTagLink(tag,force) {
	var elEl = document.createElement("a");
	elEl.setAttribute('class','force-'+force);
	elEl.setAttribute('href','#');
	elEl.innerHTML = tag;
	return elEl;
}
function createTitleNews(title,href) {
	var elTitle = document.createElement("li");
	//elTitle.setAttribute('class','title');
	elTitle.innerHTML = '<h1><a href="'+href+'" rel="nofollow">'+title+'</a></h1>';
	return elTitle;
}
function getTheNews(tag,obj) { 
	
	var AjaxObject = {
 
		handleSuccess:function(o) {
			this.processResult(o);
		}, 
		handleFailure:function(o) {
			alert('failure: getTheNews');
		}, 
		processResult:function(o) {
			elNews = o.argument[0];
			response = eval('('+o.responseText+')');	
			oItem = response.Results;					
			for(i in oItem) {
				elNews.appendChild(createTitleNews(oItem[i].titulo,oItem[i].url));
			}
		}, 
		startRequest:function() {
			//alert('startRequest');
	   		var transaction = YCM.asyncRequest('GET', 'json.news.js?tag='+tag, callback);
		}
 
	};
 
	var callback = {
		success:AjaxObject.handleSuccess,
		failure:AjaxObject.handleFailure,
		scope: AjaxObject,
		argument: [obj,tag]
	};
 
	// Start the transaction.
	AjaxObject.startRequest();
}
function createNews()
{
	//create a new instance of Element wrapping 
	//'new', which isn' yet on the page
	var elNews = new YAHOO.util.Element('newslist');
 
	//add a click event handler to 'foo'
	//elNews.on('click', function(e) { alert('clicked'); });
 	
	elNews.on('contentReady', function() {
    	var items = elNews.getElementsByTagName('li');
    	getTheNews('php',elNews);    	
	});

}
function treeViewWords(tag)
{
	var tree; //will hold our TreeView instance
	
	function treeInit() {		
		//Hand off ot a method that randomly generates tree nodes:
		buildRandomTextNodeTree();
		
		//handler for collapsing all nodes
		YAHOO.util.Event.on("collapse", "click", function(e) {
			tree.collapseAll();
			YAHOO.util.Event.preventDefault(e);
		});
		tree.subscribe("clickEvent",function(oArgs){
			createNews('');
		});
		
	}
	
	//This method will build a TreeView instance and populate it with
	//between 3 and 7 top-level nodes
	function buildRandomTextNodeTree() {
	
		//instantiate the tree:
		tree = new YAHOO.widget.TreeView("treeDiv");		
		//create top-level nodes
		//for (var i = 0; i < Math.floor((Math.random()*4) + 3); i++) {
		//	var tmpNode = new YAHOO.widget.MenuNode("label-" + i, tree.getRoot(), false);
			
			//we'll delegate to another function to build child nodes:
		//	buildRandomTextBranch(tmpNode);
		//}
		var tmpNode = new YAHOO.widget.MenuNode(tag,tree.getRoot(),false);
		
		//once it's all built out, we need to render
		//our TreeView instance:
		tree.draw();
	}

	//This function adds a random number <4 of child nodes to a given
	//node, stopping at a specific node depth:
	function buildRandomTextBranch(node) {
		if (node.depth < 6) {
			//YAHOO.log("buildRandomTextBranch: " + node.index);
			for ( var i = 0; i < Math.floor(Math.random() * 4) ; i++ ) {
				var tmpNode = new YAHOO.widget.MenuNode(node.label + "-" + i, node, false);
				buildRandomTextBranch(tmpNode);
			}
		}
	}
	
	
	//When the DOM is done loading, we can initialize our TreeView
	//instance:
	YAHOO.util.Event.onDOMReady(treeInit);
}

</script>
<div id="doc" class="yui-t7"> 
	   <div id="hd" role="banner"><h1>Metal Archives</h1></div> 
	   <div id="bd" role="main">
	   		<div class="yui-g"> 
	    		<div id="cloud">	    			
	    		</div>
	    	</div> 
		<div class="yui-gd">		 
	    	<div id="tagleft" class="yui-u first"> 
	    		<form id="frmtag" action="#">
	    			<input type="text" id='q' name="t" value="Pesquisar"/>
	    		</form>
	    		<div id="treeDiv"></div> 
	    	</div>
	    	<div id="newsright" class="yui-u"> 
		 		<h2 class="title">Noticias</h2>
		 		<div id="list">
		 			<ul id="newslist"></ul>
		 		</div>
	    	</div> 	    
		</div>	 
	</div> 
	<div id="ft" role="contentinfo"><p>Rodape</p></div> 
</div>
<script type="text/javascript">
	//loadTagCloud();
	getTheTags()	
	YAHOO.util.Event.on("cloud", "click", function(e) { 
    	//YAHOO.log("target: " + e.target.id);
    	elTag = Dom.get(e.target).innerHTML;
    	treeViewWords(elTag);
    	createNews(elTag);
 	});
 	YAHOO.util.Event.on("q","change", function(e){
 		//YAHOO.log("target: " + e.target.id);
    	elTag = Dom.get(e.target).innerHTML;
    	createNews(elTag);
 	});

</script>
</body>
</html>