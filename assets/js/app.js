// creates next action url (upload page, or XML response)
function get_url(server,linenumber,fn,foffset,totalqueries,delimiter) 
{
	return server+"?start="+linenumber+"&fn="+fn+"&foffset="+foffset+"&totalqueries="+totalqueries+"&delimiter="+delimiter+"&ajaxrequest=true";
}

// extracts text from XML element (itemname must be unique)
function get_xml_data(itemname,xmld) 
{
	return xmld.getElementsByTagName(itemname).item(0).firstChild.data;
}


function makeRequest(url) {
        http_request = false;
        if (window.XMLHttpRequest) { 
        // Mozilla etc.
                http_request = new XMLHttpRequest();
                if (http_request.overrideMimeType) {
                        http_request.overrideMimeType("text/xml");
                }
        } else if (window.ActiveXObject) { 
        // IE
                try {
                        http_request = new ActiveXObject("Msxml2.XMLHTTP");
                } catch(e) {
                        try {
                                http_request = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch(e) {}
                }
        }
        if (!http_request) {
                        alert("Cannot create an XMLHTTP instance");
                        return false;
        }
        http_request.onreadystatechange = server_response();
        http_request.open("GET", url, true);
        http_request.send(null);
}