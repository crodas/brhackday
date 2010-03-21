function loadNodeData(node, fnLoadComplete)  {   
    
    //Get the node's label and urlencode it; this is the word/s
    //on which we'll search for related words:
    var nodeLabel = encodeURI(node.label);
    
    //prepare URL for XHR request:
    var sUrl = "ysuggest_proxy.php?query=" + nodeLabel;
    
    //prepare our callback object
    var callback = {
    
        //if our XHR call is successful, we want to make use
        //of the returned data and create child nodes.
        success: function(oResponse) {
            var oResults = eval("(" + oResponse.responseText + ")");
            if((oResults.ResultSet.Result) && (oResults.ResultSet.Result.length)) {
                //Result is an array if more than one result, string otherwise
                if(YAHOO.lang.isArray(oResults.ResultSet.Result)) {
                    for (var i=0, j=oResults.ResultSet.Result.length; i<j; i++) {
                        var tempNode = new YAHOO.widget.TextNode(oResults.ResultSet.Result[i], node, false);
                    }
                } else {
                    //there is only one result; comes as string:
                    var tempNode = new YAHOO.widget.TextNode(oResults.ResultSet.Result, node, false)
                }
            }
                                
            //When we're done creating child nodes, we execute the node's
            //loadComplete callback method which comes in via the argument
            //in the response object (we could also access it at node.loadComplete,
            //if necessary):
            oResponse.argument.fnLoadComplete();
        },
        
        //if our XHR call is not successful, we want to
        //fire the TreeView callback and let the Tree
        //proceed with its business.
        failure: function(oResponse) {
            YAHOO.log("Failed to process XHR transaction.", "info", "example");
            oResponse.argument.fnLoadComplete();
        },
        
        //our handlers for the XHR response will need the same
        //argument information we got to loadNodeData, so
        //we'll pass those along:
        argument: {
            "node": node,
            "fnLoadComplete": fnLoadComplete
        },
        
        //timeout -- if more than 7 seconds go by, we'll abort
        //the transaction and assume there are no children:
        timeout: 7000
    };
    
    //With our callback object ready, it's now time to 
    //make our XHR call using Connection Manager's
    //asyncRequest method:
    YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);
}