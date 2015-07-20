function arrumaMenu(nome){
	$('#'+nome).bind('click', false);
	$('#'+nome).css('color', 'darkgrey');
}


function validaEmail(email){
    var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
    var check=/@[\w\-]+\./;
    var checkend=/\.[a-zA-Z]{2,3}$/;
    if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
    else {return true;}
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

function abrirJanela(url, largura, altura, topo, recuo){
	window.open(url,'janela', 'width='+largura+', height='+altura+','+
					'top='+topo+', left='+recuo+', scrollbars=yes, status=no,'+
					'toolbar=no, location=no, directories=no, menubar=no, resizable=no,'+
					'fullscreen=no');
}

function print_r( input, _indent ) {
	// Recuo
	 
	var indent = ( typeof( _indent ) == 'string' ) ? _indent + '    ' : '    '
	var parent_indent = ( typeof( _indent ) == 'string' ) ? _indent : '';
	var output = '';
	 
	// Tipo de Elemento do Array
	switch( typeof( input ) ) {
	case 'string':
	     output = "'" + input + "'n";
	     break;
	case 'number':
	     output = input + "n";
	     break;
	case 'boolean':
	     output = ( input ? 'true' : 'false' ) + "n";
	     break;
	case 'object':
	     output = ( ( input.reverse ) ? 'Array' : 'Object' ) + "n";
	     output += parent_indent + "(n";
	     for( var i in input ) {
	          output += indent + '[' + i + '] => ' + print_r( input[ i ], indent );
	     }
	     output += parent_indent + ")n"
	     break;
	  }
	return output;
}