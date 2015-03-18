function arrumaMenu(nome){
	$('#'+nome).bind('click', false);
	$('#'+nome).css('color', 'darkgrey');
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
	  if ((new Date().getTime() - start) > milliseconds){
		  break;
	  }
  }
}

function wsGeral(pagina){
	var xmlhttp;
	var retorno;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			return xmlhttp.responseText;
	    }
	}
	xmlhttp.open("GET",pagina,true);
	xmlhttp.send();
	sleep(5000);
	alert(retorno);
	return retorno;
}