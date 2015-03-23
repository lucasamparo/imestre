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

function wsGeral(pagina, parametros){
	//fazer depois
}