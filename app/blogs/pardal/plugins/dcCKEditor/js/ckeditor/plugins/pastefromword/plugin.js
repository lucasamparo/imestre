
﻿
(function(){CKEDITOR.plugins.add('pastefromword',{requires:'clipboard',lang:'af,ar,bg,bn,bs,ca,cs,cy,da,de,el,en,en-au,en-ca,en-gb,eo,es,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,ug,uk,vi,zh,zh-cn',icons:'pastefromword,pastefromword-rtl',hidpi:true,init:function(editor){var commandName='pastefromword',forceFromWord=0,path=this.path;editor.addCommand(commandName,{canUndo:false,async:true,exec:function(editor){var cmd=this;forceFromWord=1;editor.once('beforePaste',forceHtmlMode);editor.getClipboardData({title:editor.lang.pastefromword.title},function(data){data&&editor.fire('paste',{type:'html',dataValue:data.dataValue});editor.fire('afterCommandExec',{name:commandName,command:cmd,returnValue:!!data});});}});editor.ui.addButton&&editor.ui.addButton('PasteFromWord',{label:editor.lang.pastefromword.toolbar,command:commandName,toolbar:'clipboard,50'});editor.on('pasteState',function(evt){editor.getCommand(commandName).setState(evt.data);});editor.on('paste',function(evt){var data=evt.data,mswordHtml=data.dataValue;if(mswordHtml&&(forceFromWord||(/(class=\"?Mso|style=\"[^\"]*\bmso\-|w:WordDocument)/).test(mswordHtml))){var isLazyLoad=loadFilterRules(editor,path,function(){if(isLazyLoad)
editor.fire('paste',data);else if(!editor.config.pasteFromWordPromptCleanup||(forceFromWord||confirm(editor.lang.pastefromword.confirmCleanup))){data.dataValue=CKEDITOR.cleanWord(mswordHtml,editor);}});isLazyLoad&&evt.cancel();}},null,null,3);function resetFromWord(evt){evt&&evt.removeListener();editor.removeListener('beforePaste',forceHtmlMode);forceFromWord&&setTimeout(function(){forceFromWord=0;},0);}}});function loadFilterRules(editor,path,callback){var isLoaded=CKEDITOR.cleanWord;if(isLoaded)
callback();else{var filterFilePath=CKEDITOR.getUrl(editor.config.pasteFromWordCleanupFile||(path+'filter/default.js'));CKEDITOR.scriptLoader.load(filterFilePath,callback,null,true);}
return!isLoaded;}
function forceHtmlMode(evt){evt.data.type='html';}})();