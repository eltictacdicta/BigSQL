// creates next action url (upload page, or XML response)
function get_url(server,linenumber,fn,foffset,totalqueries,delimiter) 
{
	return "+server+?start="+linenumber+"&fn="+fn+"&foffset="+foffset+"&totalqueries="+totalqueries+"&delimiter="+delimiter+"&ajaxrequest=true";
}