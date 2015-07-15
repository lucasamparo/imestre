
﻿
(function(){var fragmentPrototype=CKEDITOR.htmlParser.fragment.prototype,elementPrototype=CKEDITOR.htmlParser.element.prototype;fragmentPrototype.onlyChild=elementPrototype.onlyChild=function(){var children=this.children,count=children.length,firstChild=(count==1)&&children[0];return firstChild||null;};elementPrototype.removeAnyChildWithName=function(tagName){var children=this.children,childs=[],child;for(var i=0;i<children.length;i++){child=children[i];if(!child.name)
continue;if(child.name==tagName){childs.push(child);children.splice(i--,1);}
childs=childs.concat(child.removeAnyChildWithName(tagName));}
return childs;};elementPrototype.getAncestor=function(tagNameRegex){var parent=this.parent;while(parent&&!(parent.name&&parent.name.match(tagNameRegex)))
parent=parent.parent;return parent;};fragmentPrototype.firstChild=elementPrototype.firstChild=function(evaluator){var child;for(var i=0;i<this.children.length;i++){child=this.children[i];if(evaluator(child))
return child;else if(child.name){child=child.firstChild(evaluator);if(child)
return child;}}
return null;};elementPrototype.addStyle=function(name,value,isPrepend){var styleText,addingStyleText='';if(typeof value=='string')
addingStyleText+=name+':'+value+';';else{if(typeof name=='object'){for(var style in name){if(name.hasOwnProperty(style))
addingStyleText+=style+':'+name[style]+';';}}
else
addingStyleText+=name;isPrepend=value;}
if(!this.attributes)
this.attributes={};styleText=this.attributes.style||'';styleText=(isPrepend?[addingStyleText,styleText]:[styleText,addingStyleText]).join(';');this.attributes.style=styleText.replace(/^;|;(?=;)/,'');};elementPrototype.getStyle=function(name){var styles=this.attributes.style;if(styles){styles=CKEDITOR.tools.parseCssText(styles,1);return styles[name];}};CKEDITOR.dtd.parentOf=function(tagName){var result={};for(var tag in this){if(tag.indexOf('$')==-1&&this[tag][tagName])
result[tag]=1;}
return result;};function postProcessList(list){var children=list.children,child,attrs,count=list.children.length,match,mergeStyle,styleTypeRegexp=/list-style-type:(.*?)(?:;|$)/,stylesFilter=CKEDITOR.plugins.pastefromword.filters.stylesFilter;attrs=list.attributes;if(styleTypeRegexp.exec(attrs.style))
return;for(var i=0;i<count;i++){child=children[i];if(child.attributes.value&&Number(child.attributes.value)==i+1)
delete child.attributes.value;match=styleTypeRegexp.exec(child.attributes.style);if(match){if(match[1]==mergeStyle||!mergeStyle)
mergeStyle=match[1];else{mergeStyle=null;break;}}}
if(mergeStyle){for(i=0;i<count;i++){attrs=children[i].attributes;attrs.style&&(attrs.style=stylesFilter([['list-style-type']])(attrs.style)||'');}
list.addStyle('list-style-type',mergeStyle);}}
var cssLengthRelativeUnit=/^([.\d]*)+(em|ex|px|gd|rem|vw|vh|vm|ch|mm|cm|in|pt|pc|deg|rad|ms|s|hz|khz){1}?/i;var emptyMarginRegex=/^(?:\b0[^\s]*\s*){1,4}$/;var romanLiternalPattern='^m{0,4}(cm|cd|d?c{0,3})(xc|xl|l?x{0,3})(ix|iv|v?i{0,3})$',lowerRomanLiteralRegex=new RegExp(romanLiternalPattern),upperRomanLiteralRegex=new RegExp(romanLiternalPattern.toUpperCase());var orderedPatterns={'decimal':/\d+/,'lower-roman':lowerRomanLiteralRegex,'upper-roman':upperRomanLiteralRegex,'lower-alpha':/^[a-z]+$/,'upper-alpha':/^[A-Z]+$/},unorderedPatterns={'disc':/[l\u00B7\u2002]/,'circle':/[\u006F\u00D8]/,'square':/[\u006E\u25C6]/},listMarkerPatterns={'ol':orderedPatterns,'ul':unorderedPatterns},romans=[[1000,'M'],[900,'CM'],[500,'D'],[400,'CD'],[100,'C'],[90,'XC'],[50,'L'],[40,'XL'],[10,'X'],[9,'IX'],[5,'V'],[4,'IV'],[1,'I']],alpahbets="ABCDEFGHIJKLMNOPQRSTUVWXYZ";function fromRoman(str){str=str.toUpperCase();var l=romans.length,retVal=0;for(var i=0;i<l;++i){for(var j=romans[i],k=j[1].length;str.substr(0,k)==j[1];str=str.substr(k))
retVal+=j[0];}
return retVal;}
function fromAlphabet(str){str=str.toUpperCase();var l=alpahbets.length,retVal=1;for(var x=1;str.length>0;x*=l){retVal+=alpahbets.indexOf(str.charAt(str.length-1))*x;str=str.substr(0,str.length-1);}
return retVal;}
var listBaseIndent=0,previousListItemMargin=null,previousListId;var plugin=(CKEDITOR.plugins.pastefromword={utils:{createListBulletMarker:function(bullet,bulletText){var marker=new CKEDITOR.htmlParser.element('cke:listbullet');marker.attributes={'cke:listsymbol':bullet[0]};marker.add(new CKEDITOR.htmlParser.text(bulletText));return marker;},isListBulletIndicator:function(element){var styleText=element.attributes&&element.attributes.style;if(/mso-list\s*:\s*Ignore/i.test(styleText))
return true;},isContainingOnlySpaces:function(element){var text;return((text=element.onlyChild())&&(/^(:?\s|&nbsp;)+$/).test(text.value));},resolveList:function(element){var attrs=element.attributes,listMarker;if((listMarker=element.removeAnyChildWithName('cke:listbullet'))&&listMarker.length&&(listMarker=listMarker[0])){element.name='cke:li';if(attrs.style){attrs.style=plugin.filters.stylesFilter([['text-indent'],['line-height'],[(/^margin(:?-left)?$/),null,function(margin){var values=margin.split(' ');margin=CKEDITOR.tools.convertToPx(values[3]||values[1]||values[0]);if(!listBaseIndent&&previousListItemMargin!==null&&margin>previousListItemMargin)
listBaseIndent=margin-previousListItemMargin;previousListItemMargin=margin;attrs['cke:indent']=listBaseIndent&&(Math.ceil(margin/listBaseIndent)+1)||1;}],[(/^mso-list$/),null,function(val){val=val.split(' ');var listId=Number(val[0].match(/\d+/)),indent=Number(val[1].match(/\d+/));if(indent==1){listId!==previousListId&&(attrs['cke:reset']=1);previousListId=listId;}
attrs['cke:indent']=indent;}]])(attrs.style,element)||'';}
if(!attrs['cke:indent']){previousListItemMargin=0;attrs['cke:indent']=1;}
CKEDITOR.tools.extend(attrs,listMarker.attributes);return true;}
else
previousListId=previousListItemMargin=listBaseIndent=null;return false;},getStyleComponents:(function(){var calculator=CKEDITOR.dom.element.createFromHtml('<div style="position:absolute;left:-9999px;top:-9999px;"></div>',CKEDITOR.document);CKEDITOR.document.getBody().append(calculator);return function(name,styleValue,fetchList){calculator.setStyle(name,styleValue);var styles={},count=fetchList.length;for(var i=0;i<count;i++)
styles[fetchList[i]]=calculator.getStyle(fetchList[i]);return styles;};})(),listDtdParents:CKEDITOR.dtd.parentOf('ol')},filters:{flattenList:function(element,level){level=typeof level=='number'?level:1;var attrs=element.attributes,listStyleType;switch(attrs.type){case'a':listStyleType='lower-alpha';break;case'1':listStyleType='decimal';break;}
var children=element.children,child;for(var i=0;i<children.length;i++){child=children[i];if(child.name in CKEDITOR.dtd.$listItem){var attributes=child.attributes,listItemChildren=child.children,count=listItemChildren.length,last=listItemChildren[count-1];if(last.name in CKEDITOR.dtd.$list){element.add(last,i+1);if(!--listItemChildren.length)
children.splice(i--,1);}
child.name='cke:li';attrs.start&&!i&&(attributes.value=attrs.start);plugin.filters.stylesFilter([['tab-stops',null,function(val){var margin=val.split(' ')[1].match(cssLengthRelativeUnit);margin&&(previousListItemMargin=CKEDITOR.tools.convertToPx(margin[0]));}],(level==1?['mso-list',null,function(val){val=val.split(' ');var listId=Number(val[0].match(/\d+/));listId!==previousListId&&(attributes['cke:reset']=1);previousListId=listId;}]:null)])(attributes.style);attributes['cke:indent']=level;attributes['cke:listtype']=element.name;attributes['cke:list-style-type']=listStyleType;}
else if(child.name in CKEDITOR.dtd.$list){arguments.callee.apply(this,[child,level+1]);children=children.slice(0,i).concat(child.children).concat(children.slice(i+1));element.children=[];for(var j=0,num=children.length;j<num;j++)
element.add(children[j]);children=element.children;}}
delete element.name;attrs['cke:list']=1;},assembleList:function(element){var children=element.children,child,listItem,listItemAttrs,listItemIndent,lastIndent,lastListItem,list,openedLists=[],previousListStyleType,previousListType;var bullet,listType,listStyleType,itemNumeric;for(var i=0;i<children.length;i++){child=children[i];if('cke:li'==child.name){child.name='li';listItem=child;listItemAttrs=listItem.attributes;bullet=listItemAttrs['cke:listsymbol'];bullet=bullet&&bullet.match(/^(?:[(]?)([^\s]+?)([.)]?)$/);listType=listStyleType=itemNumeric=null;if(listItemAttrs['cke:ignored']){children.splice(i--,1);continue;}
listItemAttrs['cke:reset']&&(list=lastIndent=lastListItem=null);listItemIndent=Number(listItemAttrs['cke:indent']);if(listItemIndent!=lastIndent)
previousListType=previousListStyleType=null;if(!bullet){listType=listItemAttrs['cke:listtype']||'ol';listStyleType=listItemAttrs['cke:list-style-type'];}else{if(previousListType&&listMarkerPatterns[previousListType][previousListStyleType].test(bullet[1])){listType=previousListType;listStyleType=previousListStyleType;}else{for(var type in listMarkerPatterns){for(var style in listMarkerPatterns[type]){if(listMarkerPatterns[type][style].test(bullet[1])){if(type=='ol'&&(/alpha|roman/).test(style)){var num=/roman/.test(style)?fromRoman(bullet[1]):fromAlphabet(bullet[1]);if(!itemNumeric||num<itemNumeric){itemNumeric=num;listType=type;listStyleType=style;}}else{listType=type;listStyleType=style;break;}}}}}!listType&&(listType=bullet[2]?'ol':'ul');}
previousListType=listType;previousListStyleType=listStyleType||(listType=='ol'?'decimal':'disc');if(listStyleType&&listStyleType!=(listType=='ol'?'decimal':'disc'))
listItem.addStyle('list-style-type',listStyleType);if(listType=='ol'&&bullet){switch(listStyleType){case'decimal':itemNumeric=Number(bullet[1]);break;case'lower-roman':case'upper-roman':itemNumeric=fromRoman(bullet[1]);break;case'lower-alpha':case'upper-alpha':itemNumeric=fromAlphabet(bullet[1]);break;}
listItem.attributes.value=itemNumeric;}
if(!list){openedLists.push(list=new CKEDITOR.htmlParser.element(listType));list.add(listItem);children[i]=list;}else{if(listItemIndent>lastIndent){openedLists.push(list=new CKEDITOR.htmlParser.element(listType));list.add(listItem);lastListItem.add(list);}else if(listItemIndent<lastIndent){var diff=lastIndent-listItemIndent,parent;while(diff--&&(parent=list.parent))
list=parent.parent;list.add(listItem);}else
list.add(listItem);children.splice(i--,1);}
lastListItem=listItem;lastIndent=listItemIndent;}else if(list)
list=lastIndent=lastListItem=null;}
for(i=0;i<openedLists.length;i++)
postProcessList(openedLists[i]);list=lastIndent=lastListItem=previousListId=previousListItemMargin=listBaseIndent=null;},falsyFilter:function(value){return false;},stylesFilter:function(styles,whitelist){return function(styleText,element){var rules=[];(styleText||'').replace(/&quot;/g,'"').replace(/\s*([^ :;]+)\s*:\s*([^;]+)\s*(?=;|$)/g,function(match,name,value){name=name.toLowerCase();name=='font-family'&&(value=value.replace(/["']/g,''));var namePattern,valuePattern,newValue,newName;for(var i=0;i<styles.length;i++){if(styles[i]){namePattern=styles[i][0];valuePattern=styles[i][1];newValue=styles[i][2];newName=styles[i][3];if(name.match(namePattern)&&(!valuePattern||value.match(valuePattern))){name=newName||name;whitelist&&(newValue=newValue||value);if(typeof newValue=='function')
newValue=newValue(value,element,name);if(newValue&&newValue.push)
name=newValue[0],newValue=newValue[1];if(typeof newValue=='string')
rules.push([name,newValue]);return;}}}!whitelist&&rules.push([name,value]);});for(var i=0;i<rules.length;i++)
rules[i]=rules[i].join(':');return rules.length?(rules.join(';')+';'):false;};},elementMigrateFilter:function(styleDefinition,variables){return styleDefinition?function(element){var styleDef=variables?new CKEDITOR.style(styleDefinition,variables)._.definition:styleDefinition;element.name=styleDef.element;CKEDITOR.tools.extend(element.attributes,CKEDITOR.tools.clone(styleDef.attributes));element.addStyle(CKEDITOR.style.getStyleText(styleDef));}:function(){};},styleMigrateFilter:function(styleDefinition,variableName){var elementMigrateFilter=this.elementMigrateFilter;return styleDefinition?function(value,element){var styleElement=new CKEDITOR.htmlParser.element(null),variables={};variables[variableName]=value;elementMigrateFilter(styleDefinition,variables)(styleElement);styleElement.children=element.children;element.children=[styleElement];styleElement.filter=function(){};styleElement.parent=element;}:function(){};},bogusAttrFilter:function(value,element){if(element.name.indexOf('cke:')==-1)
return false;},applyStyleFilter:null},getRules:function(editor,filter){var dtd=CKEDITOR.dtd,blockLike=CKEDITOR.tools.extend({},dtd.$block,dtd.$listItem,dtd.$tableContent),config=editor.config,filters=this.filters,falsyFilter=filters.falsyFilter,stylesFilter=filters.stylesFilter,elementMigrateFilter=filters.elementMigrateFilter,styleMigrateFilter=CKEDITOR.tools.bind(this.filters.styleMigrateFilter,this.filters),createListBulletMarker=this.utils.createListBulletMarker,flattenList=filters.flattenList,assembleList=filters.assembleList,isListBulletIndicator=this.utils.isListBulletIndicator,containsNothingButSpaces=this.utils.isContainingOnlySpaces,resolveListItem=this.utils.resolveList,convertToPx=function(value){value=CKEDITOR.tools.convertToPx(value);return isNaN(value)?value:value+'px';},getStyleComponents=this.utils.getStyleComponents,listDtdParents=this.utils.listDtdParents,removeFontStyles=config.pasteFromWordRemoveFontStyles!==false,removeStyles=config.pasteFromWordRemoveStyles!==false;return{elementNames:[[(/meta|link|script/),'']],root:function(element){element.filterChildren(filter);assembleList(element);},elements:{'^':function(element){var applyStyleFilter;if(CKEDITOR.env.gecko&&(applyStyleFilter=filters.applyStyleFilter))
applyStyleFilter(element);},$:function(element){var tagName=element.name||'',attrs=element.attributes;if(tagName in blockLike&&attrs.style){attrs.style=stylesFilter([[(/^(:?width|height)$/),null,convertToPx]])(attrs.style)||'';}
if(tagName.match(/h\d/)){element.filterChildren(filter);if(resolveListItem(element))
return;elementMigrateFilter(config['format_'+tagName])(element);}
else if(tagName in dtd.$inline){element.filterChildren(filter);if(containsNothingButSpaces(element))
delete element.name;}
else if(tagName.indexOf(':')!=-1&&tagName.indexOf('cke')==-1){element.filterChildren(filter);if(tagName=='v:imagedata'){var href=element.attributes['o:href'];if(href)
element.attributes.src=href;element.name='img';return;}
delete element.name;}
if(tagName in listDtdParents){element.filterChildren(filter);assembleList(element);}},'style':function(element){if(CKEDITOR.env.gecko){var styleDefSection=element.onlyChild().value.match(/\/\* Style Definitions \*\/([\s\S]*?)\/\*/),styleDefText=styleDefSection&&styleDefSection[1],rules={};if(styleDefText){styleDefText.replace(/[\n\r]/g,'').replace(/(.+?)\{(.+?)\}/g,function(rule,selectors,styleBlock){selectors=selectors.split(',');var length=selectors.length,selector;for(var i=0;i<length;i++){CKEDITOR.tools.trim(selectors[i]).replace(/^(\w+)(\.[\w-]+)?$/g,function(match,tagName,className){tagName=tagName||'*';className=className.substring(1,className.length);if(className.match(/MsoNormal/))
return;if(!rules[tagName])
rules[tagName]={};if(className)
rules[tagName][className]=styleBlock;else
rules[tagName]=styleBlock;});}});filters.applyStyleFilter=function(element){var name=rules['*']?'*':element.name,className=element.attributes&&element.attributes['class'],style;if(name in rules){style=rules[name];if(typeof style=='object')
style=style[className];style&&element.addStyle(style,true);}};}}
return false;},'p':function(element){if((/MsoListParagraph/i).exec(element.attributes['class'])||element.getStyle('mso-list')){var bulletText=element.firstChild(function(node){return node.type==CKEDITOR.NODE_TEXT&&!containsNothingButSpaces(node.parent);});var bullet=bulletText&&bulletText.parent;if(bullet){bullet.addStyle('mso-list','Ignore');}}
element.filterChildren(filter);if(resolveListItem(element))
return;if(config.enterMode==CKEDITOR.ENTER_BR){delete element.name;element.add(new CKEDITOR.htmlParser.element('br'));}else
elementMigrateFilter(config['format_'+(config.enterMode==CKEDITOR.ENTER_P?'p':'div')])(element);},'div':function(element){var singleChild=element.onlyChild();if(singleChild&&singleChild.name=='table'){var attrs=element.attributes;singleChild.attributes=CKEDITOR.tools.extend(singleChild.attributes,attrs);attrs.style&&singleChild.addStyle(attrs.style);var clearFloatDiv=new CKEDITOR.htmlParser.element('div');clearFloatDiv.addStyle('clear','both');element.add(clearFloatDiv);delete element.name;}},'td':function(element){if(element.getAncestor('thead'))
element.name='th';},'ol':flattenList,'ul':flattenList,'dl':flattenList,'font':function(element){if(isListBulletIndicator(element.parent)){delete element.name;return;}
element.filterChildren(filter);var attrs=element.attributes,styleText=attrs.style,parent=element.parent;if('font'==parent.name)
{CKEDITOR.tools.extend(parent.attributes,element.attributes);styleText&&parent.addStyle(styleText);delete element.name;}
else{styleText=styleText||'';if(attrs.color){attrs.color!='#000000'&&(styleText+='color:'+attrs.color+';');delete attrs.color;}
if(attrs.face){styleText+='font-family:'+attrs.face+';';delete attrs.face;}
if(attrs.size){styleText+='font-size:'+
(attrs.size>3?'large':(attrs.size<3?'small':'medium'))+';';delete attrs.size;}
element.name='span';element.addStyle(styleText);}},'span':function(element){if(isListBulletIndicator(element.parent))
return false;element.filterChildren(filter);if(containsNothingButSpaces(element)){delete element.name;return null;}
if(isListBulletIndicator(element)){var listSymbolNode=element.firstChild(function(node){return node.value||node.name=='img';});var listSymbol=listSymbolNode&&(listSymbolNode.value||'l.'),listType=listSymbol&&listSymbol.match(/^(?:[(]?)([^\s]+?)([.)]?)$/);if(listType){var marker=createListBulletMarker(listType,listSymbol);var ancestor=element.getAncestor('span');if(ancestor&&(/ mso-hide:\s*all|display:\s*none /).test(ancestor.attributes.style))
marker.attributes['cke:ignored']=1;return marker;}}
var children=element.children,attrs=element.attributes,styleText=attrs&&attrs.style,firstChild=children&&children[0];if(styleText){attrs.style=stylesFilter([['line-height'],[(/^font-family$/),null,!removeFontStyles?styleMigrateFilter(config['font_style'],'family'):null],[(/^font-size$/),null,!removeFontStyles?styleMigrateFilter(config['fontSize_style'],'size'):null],[(/^color$/),null,!removeFontStyles?styleMigrateFilter(config['colorButton_foreStyle'],'color'):null],[(/^background-color$/),null,!removeFontStyles?styleMigrateFilter(config['colorButton_backStyle'],'color'):null]])(styleText,element)||'';}
if(!attrs.style)
delete attrs.style;if(CKEDITOR.tools.isEmpty(attrs))
delete element.name;return null;},b:elementMigrateFilter(config['coreStyles_bold']),i:elementMigrateFilter(config['coreStyles_italic']),u:elementMigrateFilter(config['coreStyles_underline']),s:elementMigrateFilter(config['coreStyles_strike']),sup:elementMigrateFilter(config['coreStyles_superscript']),sub:elementMigrateFilter(config['coreStyles_subscript']),a:function(element){var attrs=element.attributes;if(attrs.href&&attrs.href.match(/^file:\/\/\/[\S]+#/i))
attrs.href=attrs.href.replace(/^file:\/\/\/[^#]+/i,'');},'cke:listbullet':function(element){if(element.getAncestor(/h\d/)&&!config.pasteFromWordNumberedHeadingToList)
delete element.name;}},attributeNames:[[(/^onmouse(:?out|over)/),''],[(/^onload$/),''],[(/(?:v|o):\w+/),''],[(/^lang/),'']],attributes:{'style':stylesFilter(removeStyles?[[(/^list-style-type$/),null],[(/^margin$|^margin-(?!bottom|top)/),null,function(value,element,name){if(element.name in{p:1,div:1}){var indentStyleName=config.contentsLangDirection=='ltr'?'margin-left':'margin-right';if(name=='margin'){value=getStyleComponents(name,value,[indentStyleName])[indentStyleName];}else if(name!=indentStyleName)
return null;if(value&&!emptyMarginRegex.test(value))
return[indentStyleName,value];}
return null;}],[(/^clear$/)],[(/^border.*|margin.*|vertical-align|float$/),null,function(value,element){if(element.name=='img')
return value;}],[(/^width|height$/),null,function(value,element){if(element.name in{table:1,td:1,th:1,img:1})
return value;}]]:[[(/^mso-/)],[(/-color$/),null,function(value){if(value=='transparent')
return false;if(CKEDITOR.env.gecko)
return value.replace(/-moz-use-text-color/g,'transparent');}],[(/^margin$/),emptyMarginRegex],['text-indent','0cm'],['page-break-before'],['tab-stops'],['display','none'],removeFontStyles?[(/font-?/)]:null],removeStyles),'width':function(value,element){if(element.name in dtd.$tableContent)
return false;},'border':function(value,element){if(element.name in dtd.$tableContent)
return false;},'class':falsyFilter,'bgcolor':falsyFilter,'valign':removeStyles?falsyFilter:function(value,element){element.addStyle('vertical-align',value);return false;}},comment:!CKEDITOR.env.ie?function(value,node){var imageInfo=value.match(/<img.*?>/),listInfo=value.match(/^\[if !supportLists\]([\s\S]*?)\[endif\]$/);if(listInfo){var listSymbol=listInfo[1]||(imageInfo&&'l.'),listType=listSymbol&&listSymbol.match(/>(?:[(]?)([^\s]+?)([.)]?)</);return createListBulletMarker(listType,listSymbol);}
if(CKEDITOR.env.gecko&&imageInfo){var img=CKEDITOR.htmlParser.fragment.fromHtml(imageInfo[0]).children[0],previousComment=node.previous,imgSrcInfo=previousComment&&previousComment.value.match(/<v:imagedata[^>]*o:href=['"](.*?)['"]/),imgSrc=imgSrcInfo&&imgSrcInfo[1];imgSrc&&(img.attributes.src=imgSrc);return img;}
return false;}:falsyFilter};}});var pasteProcessor=function(){this.dataFilter=new CKEDITOR.htmlParser.filter();};pasteProcessor.prototype={toHtml:function(data){var fragment=CKEDITOR.htmlParser.fragment.fromHtml(data),writer=new CKEDITOR.htmlParser.basicWriter();fragment.writeHtml(writer,this.dataFilter);return writer.getHtml(true);}};CKEDITOR.cleanWord=function(data,editor){if(CKEDITOR.env.gecko)
data=data.replace(/(<!--\[if[^<]*?\])-->([\S\s]*?)<!--(\[endif\]-->)/gi,'$1$2$3');if(CKEDITOR.env.webkit){data=data.replace(/(class="MsoListParagraph[^>]+><!--\[if !supportLists\]-->)([^<]+<span[^<]+<\/span>)(<!--\[endif\]-->)/gi,'$1<span>$2</span>$3');}
var dataProcessor=new pasteProcessor(),dataFilter=dataProcessor.dataFilter;dataFilter.addRules(CKEDITOR.plugins.pastefromword.getRules(editor,dataFilter));editor.fire('beforeCleanWord',{filter:dataFilter});try{data=dataProcessor.toHtml(data);}catch(e){alert(editor.lang.pastefromword.error);}
data=data.replace(/cke:.*?".*?"/g,'');data=data.replace(/style=""/g,'');data=data.replace(/<span>/g,'');return data;};})();