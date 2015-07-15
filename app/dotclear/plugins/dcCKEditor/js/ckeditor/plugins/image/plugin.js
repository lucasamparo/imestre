
﻿
(function(){CKEDITOR.plugins.add('image',{requires:'dialog',lang:'af,ar,bg,bn,bs,ca,cs,cy,da,de,el,en,en-au,en-ca,en-gb,eo,es,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,ug,uk,vi,zh,zh-cn',icons:'image',hidpi:true,init:function(editor){var pluginName='image';CKEDITOR.dialog.add(pluginName,this.path+'dialogs/image.js');var allowed='img[alt,!src]{border-style,border-width,float,height,margin,margin-bottom,margin-left,margin-right,margin-top,width}',required='img[alt,src]';if(CKEDITOR.dialog.isTabEnabled(editor,pluginName,'advanced'))
allowed='img[alt,dir,id,lang,longdesc,!src,title]{*}(*)';editor.addCommand(pluginName,new CKEDITOR.dialogCommand(pluginName,{allowedContent:allowed,requiredContent:required,contentTransformations:[['img{width}: sizeToStyle','img[width]: sizeToAttribute'],['img{float}: alignmentToStyle','img[align]: alignmentToAttribute']]}));editor.ui.addButton&&editor.ui.addButton('Image',{label:editor.lang.common.image,command:pluginName,toolbar:'insert,10'});editor.on('doubleclick',function(evt){var element=evt.data.element;if(element.is('img')&&!element.data('cke-realelement')&&!element.isReadOnly())
evt.data.dialog='image';});if(editor.addMenuItems){editor.addMenuItems({image:{label:editor.lang.image.menu,command:'image',group:'image'}});}
if(editor.contextMenu){editor.contextMenu.addListener(function(element,selection){if(getSelectedImage(editor,element))
return{image:CKEDITOR.TRISTATE_OFF};});}},afterInit:function(editor){setupAlignCommand('left');setupAlignCommand('right');setupAlignCommand('center');setupAlignCommand('block');function setupAlignCommand(value){var command=editor.getCommand('justify'+value);if(command){if(value=='left'||value=='right'){command.on('exec',function(evt){var img=getSelectedImage(editor),align;if(img){align=getImageAlignment(img);if(align==value){img.removeStyle('float');if(value==getImageAlignment(img))
img.removeAttribute('align');}else
img.setStyle('float',value);evt.cancel();}});}
command.on('refresh',function(evt){var img=getSelectedImage(editor),align;if(img){align=getImageAlignment(img);this.setState((align==value)?CKEDITOR.TRISTATE_ON:(value=='right'||value=='left')?CKEDITOR.TRISTATE_OFF:CKEDITOR.TRISTATE_DISABLED);evt.cancel();}});}}}});function getSelectedImage(editor,element){if(!element){var sel=editor.getSelection();element=sel.getSelectedElement();}
if(element&&element.is('img')&&!element.data('cke-realelement')&&!element.isReadOnly())
return element;}
function getImageAlignment(element){var align=element.getStyle('float');if(align=='inherit'||align=='none')
align=0;if(!align)
align=element.getAttribute('align');return align;}})();CKEDITOR.config.image_removeLinkByEmptyURL=true;