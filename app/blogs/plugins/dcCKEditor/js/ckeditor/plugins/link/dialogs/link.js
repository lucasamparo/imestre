
﻿'use strict';(function(){CKEDITOR.dialog.add('link',function(editor){var plugin=CKEDITOR.plugins.link;var targetChanged=function(){var dialog=this.getDialog(),popupFeatures=dialog.getContentElement('target','popupFeatures'),targetName=dialog.getContentElement('target','linkTargetName'),value=this.getValue();if(!popupFeatures||!targetName)
return;popupFeatures=popupFeatures.getElement();popupFeatures.hide();targetName.setValue('');switch(value){case'frame':targetName.setLabel(editor.lang.link.targetFrameName);targetName.getElement().show();break;case'popup':popupFeatures.show();targetName.setLabel(editor.lang.link.targetPopupName);targetName.getElement().show();break;default:targetName.setValue(value);targetName.getElement().hide();break;}};var linkTypeChanged=function(){var dialog=this.getDialog(),partIds=['urlOptions','anchorOptions','emailOptions'],typeValue=this.getValue(),uploadTab=dialog.definition.getContents('upload'),uploadInitiallyHidden=uploadTab&&uploadTab.hidden;if(typeValue=='url'){if(editor.config.linkShowTargetTab)
dialog.showPage('target');if(!uploadInitiallyHidden)
dialog.showPage('upload');}else{dialog.hidePage('target');if(!uploadInitiallyHidden)
dialog.hidePage('upload');}
for(var i=0;i<partIds.length;i++){var element=dialog.getContentElement('info',partIds[i]);if(!element)
continue;element=element.getElement().getParent().getParent();if(partIds[i]==typeValue+'Options')
element.show();else
element.hide();}
dialog.layout();};var setupParams=function(page,data){if(data[page])
this.setValue(data[page][this.id]||'');};var setupPopupParams=function(data){return setupParams.call(this,'target',data);};var setupAdvParams=function(data){return setupParams.call(this,'advanced',data);};var commitParams=function(page,data){if(!data[page])
data[page]={};data[page][this.id]=this.getValue()||'';};var commitPopupParams=function(data){return commitParams.call(this,'target',data);};var commitAdvParams=function(data){return commitParams.call(this,'advanced',data);};var commonLang=editor.lang.common,linkLang=editor.lang.link,anchors;return{title:linkLang.title,minWidth:350,minHeight:230,contents:[{id:'info',label:linkLang.info,title:linkLang.info,elements:[{id:'linkType',type:'select',label:linkLang.type,'default':'url',items:[[linkLang.toUrl,'url'],[linkLang.toAnchor,'anchor'],[linkLang.toEmail,'email']],onChange:linkTypeChanged,setup:function(data){this.setValue(data.type||'url');},commit:function(data){data.type=this.getValue();}},{type:'vbox',id:'urlOptions',children:[{type:'hbox',widths:['25%','75%'],children:[{id:'protocol',type:'select',label:commonLang.protocol,'default':'http://',items:[['http://\u200E','http://'],['https://\u200E','https://'],['ftp://\u200E','ftp://'],['news://\u200E','news://'],[linkLang.other,'']],setup:function(data){if(data.url)
this.setValue(data.url.protocol||'');},commit:function(data){if(!data.url)
data.url={};data.url.protocol=this.getValue();}},{type:'text',id:'url',label:commonLang.url,required:true,onLoad:function(){this.allowOnChange=true;},onKeyUp:function(){this.allowOnChange=false;var protocolCmb=this.getDialog().getContentElement('info','protocol'),url=this.getValue(),urlOnChangeProtocol=/^(http|https|ftp|news):\/\/(?=.)/i,urlOnChangeTestOther=/^((javascript:)|[#\/\.\?])/i;var protocol=urlOnChangeProtocol.exec(url);if(protocol){this.setValue(url.substr(protocol[0].length));protocolCmb.setValue(protocol[0].toLowerCase());}else if(urlOnChangeTestOther.test(url)){protocolCmb.setValue('');}
this.allowOnChange=true;},onChange:function(){if(this.allowOnChange)
this.onKeyUp();},validate:function(){var dialog=this.getDialog();if(dialog.getContentElement('info','linkType')&&dialog.getValueOf('info','linkType')!='url')
return true;if(!editor.config.linkJavaScriptLinksAllowed&&(/javascript\:/).test(this.getValue())){alert(commonLang.invalidValue);return false;}
if(this.getDialog().fakeObj)
return true;var func=CKEDITOR.dialog.validate.notEmpty(linkLang.noUrl);return func.apply(this);},setup:function(data){this.allowOnChange=false;if(data.url)
this.setValue(data.url.url);this.allowOnChange=true;},commit:function(data){this.onChange();if(!data.url)
data.url={};data.url.url=this.getValue();this.allowOnChange=false;}}],setup:function(){if(!this.getDialog().getContentElement('info','linkType'))
this.getElement().show();}},{type:'button',id:'browse',hidden:'true',filebrowser:'info:url',label:commonLang.browseServer}]},{type:'vbox',id:'anchorOptions',width:260,align:'center',padding:0,children:[{type:'fieldset',id:'selectAnchorText',label:linkLang.selectAnchor,setup:function(){anchors=plugin.getEditorAnchors(editor);this.getElement()[anchors&&anchors.length?'show':'hide']();},children:[{type:'hbox',id:'selectAnchor',children:[{type:'select',id:'anchorName','default':'',label:linkLang.anchorName,style:'width: 100%;',items:[['']],setup:function(data){this.clear();this.add('');if(anchors){for(var i=0;i<anchors.length;i++){if(anchors[i].name)
this.add(anchors[i].name);}}
if(data.anchor)
this.setValue(data.anchor.name);var linkType=this.getDialog().getContentElement('info','linkType');if(linkType&&linkType.getValue()=='email')
this.focus();},commit:function(data){if(!data.anchor)
data.anchor={};data.anchor.name=this.getValue();}},{type:'select',id:'anchorId','default':'',label:linkLang.anchorId,style:'width: 100%;',items:[['']],setup:function(data){this.clear();this.add('');if(anchors){for(var i=0;i<anchors.length;i++){if(anchors[i].id)
this.add(anchors[i].id);}}
if(data.anchor)
this.setValue(data.anchor.id);},commit:function(data){if(!data.anchor)
data.anchor={};data.anchor.id=this.getValue();}}],setup:function(){this.getElement()[anchors&&anchors.length?'show':'hide']();}}]},{type:'html',id:'noAnchors',style:'text-align: center;',html:'<div role="note" tabIndex="-1">'+CKEDITOR.tools.htmlEncode(linkLang.noAnchors)+'</div>',focus:true,setup:function(){this.getElement()[anchors&&anchors.length?'hide':'show']();}}],setup:function(){if(!this.getDialog().getContentElement('info','linkType'))
this.getElement().hide();}},{type:'vbox',id:'emailOptions',padding:1,children:[{type:'text',id:'emailAddress',label:linkLang.emailAddress,required:true,validate:function(){var dialog=this.getDialog();if(!dialog.getContentElement('info','linkType')||dialog.getValueOf('info','linkType')!='email')
return true;var func=CKEDITOR.dialog.validate.notEmpty(linkLang.noEmail);return func.apply(this);},setup:function(data){if(data.email)
this.setValue(data.email.address);var linkType=this.getDialog().getContentElement('info','linkType');if(linkType&&linkType.getValue()=='email')
this.select();},commit:function(data){if(!data.email)
data.email={};data.email.address=this.getValue();}},{type:'text',id:'emailSubject',label:linkLang.emailSubject,setup:function(data){if(data.email)
this.setValue(data.email.subject);},commit:function(data){if(!data.email)
data.email={};data.email.subject=this.getValue();}},{type:'textarea',id:'emailBody',label:linkLang.emailBody,rows:3,'default':'',setup:function(data){if(data.email)
this.setValue(data.email.body);},commit:function(data){if(!data.email)
data.email={};data.email.body=this.getValue();}}],setup:function(){if(!this.getDialog().getContentElement('info','linkType'))
this.getElement().hide();}}]},{id:'target',requiredContent:'a[target]',label:linkLang.target,title:linkLang.target,elements:[{type:'hbox',widths:['50%','50%'],children:[{type:'select',id:'linkTargetType',label:commonLang.target,'default':'notSet',style:'width : 100%;','items':[[commonLang.notSet,'notSet'],[linkLang.targetFrame,'frame'],[linkLang.targetPopup,'popup'],[commonLang.targetNew,'_blank'],[commonLang.targetTop,'_top'],[commonLang.targetSelf,'_self'],[commonLang.targetParent,'_parent']],onChange:targetChanged,setup:function(data){if(data.target)
this.setValue(data.target.type||'notSet');targetChanged.call(this);},commit:function(data){if(!data.target)
data.target={};data.target.type=this.getValue();}},{type:'text',id:'linkTargetName',label:linkLang.targetFrameName,'default':'',setup:function(data){if(data.target)
this.setValue(data.target.name);},commit:function(data){if(!data.target)
data.target={};data.target.name=this.getValue().replace(/\W/gi,'');}}]},{type:'vbox',width:'100%',align:'center',padding:2,id:'popupFeatures',children:[{type:'fieldset',label:linkLang.popupFeatures,children:[{type:'hbox',children:[{type:'checkbox',id:'resizable',label:linkLang.popupResizable,setup:setupPopupParams,commit:commitPopupParams},{type:'checkbox',id:'status',label:linkLang.popupStatusBar,setup:setupPopupParams,commit:commitPopupParams}]},{type:'hbox',children:[{type:'checkbox',id:'location',label:linkLang.popupLocationBar,setup:setupPopupParams,commit:commitPopupParams},{type:'checkbox',id:'toolbar',label:linkLang.popupToolbar,setup:setupPopupParams,commit:commitPopupParams}]},{type:'hbox',children:[{type:'checkbox',id:'menubar',label:linkLang.popupMenuBar,setup:setupPopupParams,commit:commitPopupParams},{type:'checkbox',id:'fullscreen',label:linkLang.popupFullScreen,setup:setupPopupParams,commit:commitPopupParams}]},{type:'hbox',children:[{type:'checkbox',id:'scrollbars',label:linkLang.popupScrollBars,setup:setupPopupParams,commit:commitPopupParams},{type:'checkbox',id:'dependent',label:linkLang.popupDependent,setup:setupPopupParams,commit:commitPopupParams}]},{type:'hbox',children:[{type:'text',widths:['50%','50%'],labelLayout:'horizontal',label:commonLang.width,id:'width',setup:setupPopupParams,commit:commitPopupParams},{type:'text',labelLayout:'horizontal',widths:['50%','50%'],label:linkLang.popupLeft,id:'left',setup:setupPopupParams,commit:commitPopupParams}]},{type:'hbox',children:[{type:'text',labelLayout:'horizontal',widths:['50%','50%'],label:commonLang.height,id:'height',setup:setupPopupParams,commit:commitPopupParams},{type:'text',labelLayout:'horizontal',label:linkLang.popupTop,widths:['50%','50%'],id:'top',setup:setupPopupParams,commit:commitPopupParams}]}]}]}]},{id:'upload',label:linkLang.upload,title:linkLang.upload,hidden:true,filebrowser:'uploadButton',elements:[{type:'file',id:'upload',label:commonLang.upload,style:'height:40px',size:29},{type:'fileButton',id:'uploadButton',label:commonLang.uploadSubmit,filebrowser:'info:url','for':['upload','upload']}]},{id:'advanced',label:linkLang.advanced,title:linkLang.advanced,elements:[{type:'vbox',padding:1,children:[{type:'hbox',widths:['45%','35%','20%'],children:[{type:'text',id:'advId',requiredContent:'a[id]',label:linkLang.id,setup:setupAdvParams,commit:commitAdvParams},{type:'select',id:'advLangDir',requiredContent:'a[dir]',label:linkLang.langDir,'default':'',style:'width:110px',items:[[commonLang.notSet,''],[linkLang.langDirLTR,'ltr'],[linkLang.langDirRTL,'rtl']],setup:setupAdvParams,commit:commitAdvParams},{type:'text',id:'advAccessKey',requiredContent:'a[accesskey]',width:'80px',label:linkLang.acccessKey,maxLength:1,setup:setupAdvParams,commit:commitAdvParams}]},{type:'hbox',widths:['45%','35%','20%'],children:[{type:'text',label:linkLang.name,id:'advName',requiredContent:'a[name]',setup:setupAdvParams,commit:commitAdvParams},{type:'text',label:linkLang.langCode,id:'advLangCode',requiredContent:'a[lang]',width:'110px','default':'',setup:setupAdvParams,commit:commitAdvParams},{type:'text',label:linkLang.tabIndex,id:'advTabIndex',requiredContent:'a[tabindex]',width:'80px',maxLength:5,setup:setupAdvParams,commit:commitAdvParams}]}]},{type:'vbox',padding:1,children:[{type:'hbox',widths:['45%','55%'],children:[{type:'text',label:linkLang.advisoryTitle,requiredContent:'a[title]','default':'',id:'advTitle',setup:setupAdvParams,commit:commitAdvParams},{type:'text',label:linkLang.advisoryContentType,requiredContent:'a[type]','default':'',id:'advContentType',setup:setupAdvParams,commit:commitAdvParams}]},{type:'hbox',widths:['45%','55%'],children:[{type:'text',label:linkLang.cssClasses,requiredContent:'a(cke-xyz)','default':'',id:'advCSSClasses',setup:setupAdvParams,commit:commitAdvParams},{type:'text',label:linkLang.charset,requiredContent:'a[charset]','default':'',id:'advCharset',setup:setupAdvParams,commit:commitAdvParams}]},{type:'hbox',widths:['45%','55%'],children:[{type:'text',label:linkLang.rel,requiredContent:'a[rel]','default':'',id:'advRel',setup:setupAdvParams,commit:commitAdvParams},{type:'text',label:linkLang.styles,requiredContent:'a{cke-xyz}','default':'',id:'advStyles',validate:CKEDITOR.dialog.validate.inlineStyle(editor.lang.common.invalidInlineStyle),setup:setupAdvParams,commit:commitAdvParams}]}]}]}],onShow:function(){var editor=this.getParentEditor(),selection=editor.getSelection(),element=null;if((element=plugin.getSelectedLink(editor))&&element.hasAttribute('href')){if(!selection.getSelectedElement())
selection.selectElement(element);}else{element=null;}
var data=plugin.parseLinkAttributes(editor,element);this._.selectedElement=element;this.setupContent(data);},onOk:function(){var data={};this.commitContent(data);var selection=editor.getSelection(),attributes=plugin.getLinkAttributes(editor,data);if(!this._.selectedElement){var range=selection.getRanges()[0];if(range.collapsed){var text=new CKEDITOR.dom.text(data.type=='email'?data.email.address:attributes.set['data-cke-saved-href'],editor.document);range.insertNode(text);range.selectNodeContents(text);}
var style=new CKEDITOR.style({element:'a',attributes:attributes.set});style.type=CKEDITOR.STYLE_INLINE;style.applyToRange(range,editor);range.select();}else{var element=this._.selectedElement,href=element.data('cke-saved-href'),textView=element.getHtml();element.setAttributes(attributes.set);element.removeAttributes(attributes.removed);if(href==textView||data.type=='email'&&textView.indexOf('@')!=-1){element.setHtml(data.type=='email'?data.email.address:attributes.set['data-cke-saved-href']);selection.selectElement(element);}
delete this._.selectedElement;}},onLoad:function(){if(!editor.config.linkShowAdvancedTab)
this.hidePage('advanced');if(!editor.config.linkShowTargetTab)
this.hidePage('target');},onFocus:function(){var linkType=this.getContentElement('info','linkType'),urlField;if(linkType&&linkType.getValue()=='url'){urlField=this.getContentElement('info','url');urlField.select();}}};});})();