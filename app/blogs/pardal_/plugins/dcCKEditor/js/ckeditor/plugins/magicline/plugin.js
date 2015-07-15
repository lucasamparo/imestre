
﻿'use strict';(function(){CKEDITOR.plugins.add('magicline',{lang:'ar,bg,ca,cs,cy,de,el,en,eo,es,et,eu,fa,fi,fr,fr-ca,gl,he,hr,hu,id,it,ja,km,ko,ku,lv,nb,nl,no,pl,pt,pt-br,ru,si,sk,sl,sq,sv,tr,ug,uk,vi,zh-cn',init:initPlugin});function initPlugin(editor){var config=editor.config,triggerOffset=config.magicline_triggerOffset||30,enterMode=config.enterMode,that={editor:editor,enterMode:enterMode,triggerOffset:triggerOffset,holdDistance:0|triggerOffset*(config.magicline_holdDistance||0.5),boxColor:config.magicline_color||'#ff0000',rtl:config.contentsLangDirection=='rtl',tabuList:['data-cke-hidden-sel'].concat(config.magicline_tabuList||[]),triggers:config.magicline_everywhere?DTD_BLOCK:{table:1,hr:1,div:1,ul:1,ol:1,dl:1,form:1,blockquote:1}},scrollTimeout,checkMouseTimeoutPending,checkMouseTimeout,checkMouseTimer;try{that.debug=window.top.DEBUG;}
catch(e){}
that.debug=that.debug||{groupEnd:function(){},groupStart:function(){},log:function(){},logElements:function(){},logElementsEnd:function(){},logEnd:function(){},mousePos:function(){},showHidden:function(){},showTrigger:function(){},startTimer:function(){},stopTimer:function(){}};that.isRelevant=function(node){return isHtml(node)&&!isLine(that,node)&&!isFlowBreaker(node);};editor.on('contentDom',addListeners,this);function addListeners(){var editable=editor.editable(),doc=editor.document,win=editor.window,listener;extend(that,{editable:editable,inInlineMode:editable.isInline(),doc:doc,win:win,hotNode:null},true);that.boundary=that.inInlineMode?that.editable:that.doc.getDocumentElement();if(editable.is(dtd.$inline))
return;if(that.inInlineMode&&!isPositioned(editable)){editable.setStyles({position:'relative',top:null,left:null});}
initLine.call(this,that);updateWindowSize(that);editable.attachListener(editor,'beforeUndoImage',function(){that.line.detach();});editable.attachListener(editor,'beforeGetData',function(){if(that.line.wrap.getParent()){that.line.detach();editor.once('getData',function(){that.line.attach();},null,null,1000);}},null,null,0);editable.attachListener(that.inInlineMode?doc:doc.getWindow().getFrame(),'mouseout',function(event){if(editor.mode!='wysiwyg')
return;if(that.inInlineMode){var mouse={x:event.data.$.clientX,y:event.data.$.clientY};updateWindowSize(that);updateEditableSize(that,true);var size=that.view.editable,scroll=that.view.scroll;if(!inBetween(mouse.x,size.left-scroll.x,size.right-scroll.x)||!inBetween(mouse.y,size.top-scroll.y,size.bottom-scroll.y)){clearTimeout(checkMouseTimer);checkMouseTimer=null;that.line.detach();}}
else{clearTimeout(checkMouseTimer);checkMouseTimer=null;that.line.detach();}});editable.attachListener(editable,'keyup',function(event){that.hiddenMode=0;that.debug.showHidden(that.hiddenMode);});editable.attachListener(editable,'keydown',function(event){if(editor.mode!='wysiwyg')
return;var keyStroke=event.data.getKeystroke(),selection=editor.getSelection(),selected=selection.getStartElement();switch(keyStroke){case 2228240:case 16:that.hiddenMode=1;that.line.detach();}
that.debug.showHidden(that.hiddenMode);});editable.attachListener(that.inInlineMode?editable:doc,'mousemove',function(event){checkMouseTimeoutPending=true;if(editor.mode!='wysiwyg'||editor.readOnly||checkMouseTimer)
return;var mouse={x:event.data.$.clientX,y:event.data.$.clientY};checkMouseTimer=setTimeout(function(){checkMouse(mouse);},30);});editable.attachListener(win,'scroll',function(event){if(editor.mode!='wysiwyg')
return;that.line.detach();if(env.webkit){that.hiddenMode=1;clearTimeout(scrollTimeout);scrollTimeout=setTimeout(function(){if(!that.mouseDown)
that.hiddenMode=0;that.debug.showHidden(that.hiddenMode);},50);that.debug.showHidden(that.hiddenMode);}});editable.attachListener(env_ie8?doc:win,'mousedown',function(event){if(editor.mode!='wysiwyg')
return;that.line.detach();that.hiddenMode=1;that.mouseDown=1;that.debug.showHidden(that.hiddenMode);});editable.attachListener(env_ie8?doc:win,'mouseup',function(event){that.hiddenMode=0;that.mouseDown=0;that.debug.showHidden(that.hiddenMode);});editor.addCommand('accessPreviousSpace',accessFocusSpaceCmd(that));editor.addCommand('accessNextSpace',accessFocusSpaceCmd(that,true));editor.setKeystroke([[config.magicline_keystrokePrevious,'accessPreviousSpace'],[config.magicline_keystrokeNext,'accessNextSpace']]);editor.on('loadSnapshot',function(event){var elements,element,i;for(var t in{p:1,br:1,div:1}){elements=editor.document.getElementsByTag(t);for(i=elements.count();i--;){if((element=elements.getItem(i)).data('cke-magicline-hot')){that.hotNode=element;that.lastCmdDirection=element.data('cke-magicline-dir')==='true'?true:false;return;}}}});function checkMouse(mouse){that.debug.groupStart('CheckMouse');that.debug.startTimer();that.mouse=mouse;that.trigger=null;checkMouseTimer=null;updateWindowSize(that);if(checkMouseTimeoutPending&&!that.hiddenMode&&editor.focusManager.hasFocus&&!that.line.mouseNear()&&(that.element=elementFromMouse(that,true)))
{if((that.trigger=triggerEditable(that)||triggerEdge(that)||triggerExpand(that))&&!isInTabu(that,that.trigger.upper||that.trigger.lower)){that.line.attach().place();}
else{that.trigger=null;that.line.detach();}
that.debug.showTrigger(that.trigger);that.debug.mousePos(mouse.y,that.element);checkMouseTimeoutPending=false;}
that.debug.stopTimer();that.debug.groupEnd();}
this.backdoor={accessFocusSpace:accessFocusSpace,boxTrigger:boxTrigger,isLine:isLine,getAscendantTrigger:getAscendantTrigger,getNonEmptyNeighbour:getNonEmptyNeighbour,getSize:getSize,that:that,triggerEdge:triggerEdge,triggerEditable:triggerEditable,triggerExpand:triggerExpand};}}
var extend=CKEDITOR.tools.extend,newElement=CKEDITOR.dom.element,newElementFromHtml=newElement.createFromHtml,env=CKEDITOR.env,env_ie8=CKEDITOR.env.ie&&CKEDITOR.env.version<9,dtd=CKEDITOR.dtd,enterElements={},EDGE_TOP=128,EDGE_BOTTOM=64,EDGE_MIDDLE=32,TYPE_EDGE=16,TYPE_EXPAND=8,LOOK_TOP=4,LOOK_BOTTOM=2,LOOK_NORMAL=1,WHITE_SPACE='\u00A0',DTD_LISTITEM=dtd.$listItem,DTD_TABLECONTENT=dtd.$tableContent,DTD_NONACCESSIBLE=extend({},dtd.$nonEditable,dtd.$empty),DTD_BLOCK=dtd.$block,CACHE_TIME=100,CSS_COMMON='width:0px;height:0px;padding:0px;margin:0px;display:block;'+'z-index:9999;color:#fff;position:absolute;font-size: 0px;line-height:0px;',CSS_TRIANGLE=CSS_COMMON+'border-color:transparent;display:block;border-style:solid;',TRIANGLE_HTML='<span>'+WHITE_SPACE+'</span>';enterElements[CKEDITOR.ENTER_BR]='br';enterElements[CKEDITOR.ENTER_P]='p';enterElements[CKEDITOR.ENTER_DIV]='div';function areSiblings(that,upper,lower){return isHtml(upper)&&isHtml(lower)&&lower.equals(upper.getNext(function(node){return!(isEmptyTextNode(node)||isComment(node)||isFlowBreaker(node));}));}
function boxTrigger(triggerSetup){this.upper=triggerSetup[0];this.lower=triggerSetup[1];this.set.apply(this,triggerSetup.slice(2));}
boxTrigger.prototype={set:function(edge,type,look){this.properties=edge+type+(look||LOOK_NORMAL);return this;},is:function(property){return(this.properties&property)==property;}};var elementFromMouse=(function(){function elementFromPoint(doc,mouse){return new CKEDITOR.dom.element(doc.$.elementFromPoint(mouse.x,mouse.y));}
return function(that,ignoreBox,forceMouse){if(!that.mouse)
return null;var doc=that.doc,lineWrap=that.line.wrap,mouse=forceMouse||that.mouse,element=elementFromPoint(doc,mouse);if(ignoreBox&&isLine(that,element)){lineWrap.hide();element=elementFromPoint(doc,mouse);lineWrap.show();}
if(!(element&&element.type==CKEDITOR.NODE_ELEMENT&&element.$)){return null;}
if(env.ie&&env.version<9){if(!(that.boundary.equals(element)||that.boundary.contains(element)))
return null;}
return element;};})();function getAscendantTrigger(that){var node=that.element,trigger;if(node&&isHtml(node)){trigger=node.getAscendant(that.triggers,true);if(trigger&&that.editable.contains(trigger)){var limit=getClosestEditableLimit(trigger,true);if(limit.getAttribute('contenteditable')=='true')
return trigger;else if(limit.is(that.triggers))
return limit;else
return null;return trigger;}else
return null;}
return null;}
function getMidpoint(that,upper,lower){updateSize(that,upper);updateSize(that,lower);var upperSizeBottom=upper.size.bottom,lowerSizeTop=lower.size.top;return upperSizeBottom&&lowerSizeTop?0|(upperSizeBottom+lowerSizeTop)/2:upperSizeBottom||lowerSizeTop;}
function getNonEmptyNeighbour(that,node,goBack){node=node[goBack?'getPrevious':'getNext'](function(node){return(isTextNode(node)&&!isEmptyTextNode(node))||(isHtml(node)&&!isFlowBreaker(node)&&!isLine(that,node));});return node;}
function inBetween(val,lower,upper){return val>lower&&val<upper;}
function getClosestEditableLimit(element,includeSelf){if(element.data('cke-editable'))
return null;if(!includeSelf)
element=element.getParent();while(element){if(element.data('cke-editable'))
return null;if(element.hasAttribute('contenteditable'))
return element;element=element.getParent();}
return null;}
function initLine(that){var doc=that.doc,line=newElementFromHtml('<span contenteditable="false" style="'+CSS_COMMON+'position:absolute;border-top:1px dashed '+that.boxColor+'"></span>',doc),iconPath=this.path+'images/'+(env.hidpi?'hidpi/':'')+'icon.png';extend(line,{attach:function(){if(!this.wrap.getParent())
this.wrap.appendTo(that.editable,true);return this;},lineChildren:[extend(newElementFromHtml('<span title="'+that.editor.lang.magicline.title+'" contenteditable="false">&#8629;</span>',doc),{base:CSS_COMMON+'height:17px;width:17px;'+(that.rtl?'left':'right')+':17px;'
+'background:url('+iconPath+') center no-repeat '+that.boxColor+';cursor:pointer;'
+(env.hc?'font-size: 15px;line-height:14px;border:1px solid #fff;text-align:center;':'')
+(env.hidpi?'background-size: 9px 10px;':''),looks:['top:-8px;'+CKEDITOR.tools.cssVendorPrefix('border-radius','2px',1),'top:-17px;'+CKEDITOR.tools.cssVendorPrefix('border-radius','2px 2px 0px 0px',1),'top:-1px;'+CKEDITOR.tools.cssVendorPrefix('border-radius','0px 0px 2px 2px',1)]}),extend(newElementFromHtml(TRIANGLE_HTML,doc),{base:CSS_TRIANGLE+'left:0px;border-left-color:'+that.boxColor+';',looks:['border-width:8px 0 8px 8px;top:-8px','border-width:8px 0 0 8px;top:-8px','border-width:0 0 8px 8px;top:0px']}),extend(newElementFromHtml(TRIANGLE_HTML,doc),{base:CSS_TRIANGLE+'right:0px;border-right-color:'+that.boxColor+';',looks:['border-width:8px 8px 8px 0;top:-8px','border-width:8px 8px 0 0;top:-8px','border-width:0 8px 8px 0;top:0px']})],detach:function(){if(this.wrap.getParent())
this.wrap.remove();return this;},mouseNear:function(){that.debug.groupStart('mouseNear');updateSize(that,this);var offset=that.holdDistance,size=this.size;if(size&&inBetween(that.mouse.y,size.top-offset,size.bottom+offset)&&inBetween(that.mouse.x,size.left-offset,size.right+offset)){that.debug.logEnd('Mouse is near.');return true;}
that.debug.logEnd('Mouse isn\'t near.');return false;},place:function(){var view=that.view,editable=that.editable,trigger=that.trigger,upper=trigger.upper,lower=trigger.lower,any=upper||lower,parent=any.getParent(),styleSet={};this.trigger=trigger;upper&&updateSize(that,upper,true);lower&&updateSize(that,lower,true);updateSize(that,parent,true);if(that.inInlineMode)
updateEditableSize(that,true);if(parent.equals(editable)){styleSet.left=view.scroll.x;styleSet.right=-view.scroll.x;styleSet.width='';}else{styleSet.left=any.size.left-any.size.margin.left+view.scroll.x-(that.inInlineMode?view.editable.left+view.editable.border.left:0);styleSet.width=any.size.outerWidth+any.size.margin.left+any.size.margin.right+view.scroll.x;styleSet.right='';}
if(upper&&lower){if(upper.size.margin.bottom===lower.size.margin.top)
styleSet.top=0|(upper.size.bottom+upper.size.margin.bottom/2);else{if(upper.size.margin.bottom<lower.size.margin.top)
styleSet.top=upper.size.bottom+upper.size.margin.bottom;else
styleSet.top=upper.size.bottom+upper.size.margin.bottom-lower.size.margin.top;}}
else if(!upper)
styleSet.top=lower.size.top-lower.size.margin.top;else if(!lower)
styleSet.top=upper.size.bottom+upper.size.margin.bottom;if(trigger.is(LOOK_TOP)||inBetween(styleSet.top,view.scroll.y-15,view.scroll.y+5)){styleSet.top=that.inInlineMode?0:view.scroll.y;this.look(LOOK_TOP);}else if(trigger.is(LOOK_BOTTOM)||inBetween(styleSet.top,view.pane.bottom-5,view.pane.bottom+15)){styleSet.top=that.inInlineMode?view.editable.height+view.editable.padding.top+view.editable.padding.bottom:view.pane.bottom-1;this.look(LOOK_BOTTOM);}else{if(that.inInlineMode)
styleSet.top-=view.editable.top+view.editable.border.top;this.look(LOOK_NORMAL);}
if(that.inInlineMode){styleSet.top--;styleSet.top+=view.editable.scroll.top;styleSet.left+=view.editable.scroll.left;}
for(var style in styleSet)
styleSet[style]=CKEDITOR.tools.cssLength(styleSet[style]);this.setStyles(styleSet);},look:function(look){if(this.oldLook==look)
return;for(var i=this.lineChildren.length,child;i--;)
(child=this.lineChildren[i]).setAttribute('style',child.base+child.looks[0|look/2]);this.oldLook=look;},wrap:new newElement('span',that.doc)});for(var i=line.lineChildren.length;i--;)
line.lineChildren[i].appendTo(line);line.look(LOOK_NORMAL);line.appendTo(line.wrap);line.unselectable();line.lineChildren[0].on('mouseup',function(event){line.detach();accessFocusSpace(that,function(accessNode){var trigger=that.line.trigger;accessNode[trigger.is(EDGE_TOP)?'insertBefore':'insertAfter']
(trigger.is(EDGE_TOP)?trigger.lower:trigger.upper);},true);that.editor.focus();if(!env.ie&&that.enterMode!=CKEDITOR.ENTER_BR)
that.hotNode.scrollIntoView();event.data.preventDefault(true);});line.on('mousedown',function(event){event.data.preventDefault(true);});that.line=line;}
function accessFocusSpace(that,insertFunction,doSave){var range=new CKEDITOR.dom.range(that.doc),editor=that.editor,accessNode;if(env.ie&&that.enterMode==CKEDITOR.ENTER_BR)
accessNode=that.doc.createText(WHITE_SPACE);else{var limit=getClosestEditableLimit(that.element,true),enterMode=limit&&limit.data('cke-enter-mode')||that.enterMode;accessNode=new newElement(enterElements[enterMode],that.doc);if(!accessNode.is('br')){var dummy=that.doc.createText(WHITE_SPACE);dummy.appendTo(accessNode);}}
doSave&&editor.fire('saveSnapshot');insertFunction(accessNode);range.moveToPosition(accessNode,CKEDITOR.POSITION_AFTER_START);editor.getSelection().selectRanges([range]);that.hotNode=accessNode;doSave&&editor.fire('saveSnapshot');}
function accessFocusSpaceCmd(that,insertAfter){return{canUndo:true,modes:{wysiwyg:1},exec:(function(){function doAccess(target){var hotNodeChar=(env.ie&&env.version<9?' ':WHITE_SPACE),removeOld=that.hotNode&&that.hotNode.getText()==hotNodeChar&&that.element.equals(that.hotNode)&&that.lastCmdDirection===!!insertAfter;accessFocusSpace(that,function(accessNode){if(removeOld&&that.hotNode)
that.hotNode.remove();accessNode[insertAfter?'insertAfter':'insertBefore'](target);accessNode.setAttributes({'data-cke-magicline-hot':1,'data-cke-magicline-dir':!!insertAfter});that.lastCmdDirection=!!insertAfter;});if(!env.ie&&that.enterMode!=CKEDITOR.ENTER_BR)
that.hotNode.scrollIntoView();that.line.detach();}
return function(editor){var selected=editor.getSelection().getStartElement(),limit;selected=selected.getAscendant(DTD_BLOCK,1);if(isInTabu(that,selected))
return;if(!selected||selected.equals(that.editable)||selected.contains(that.editable))
return;if((limit=getClosestEditableLimit(selected))&&limit.getAttribute('contenteditable')=='false')
selected=limit;that.element=selected;var neighbor=getNonEmptyNeighbour(that,selected,!insertAfter),neighborSibling;if(isHtml(neighbor)&&neighbor.is(that.triggers)&&neighbor.is(DTD_NONACCESSIBLE)&&(!getNonEmptyNeighbour(that,neighbor,!insertAfter)||((neighborSibling=getNonEmptyNeighbour(that,neighbor,!insertAfter))&&isHtml(neighborSibling)&&neighborSibling.is(that.triggers)))){doAccess(neighbor);return;}
var target=getAscendantTrigger(that,selected);if(!isHtml(target))
return;if(!getNonEmptyNeighbour(that,target,!insertAfter)){doAccess(target);return;}
var sibling=getNonEmptyNeighbour(that,target,!insertAfter);if(sibling&&isHtml(sibling)&&sibling.is(that.triggers)){doAccess(target);return;}};})()};}
function isLine(that,node){if(!(node&&node.type==CKEDITOR.NODE_ELEMENT&&node.$))
return false;var line=that.line;return line.wrap.equals(node)||line.wrap.contains(node);}
var isEmptyTextNode=CKEDITOR.dom.walker.whitespaces();function isHtml(node){return node&&node.type==CKEDITOR.NODE_ELEMENT&&node.$;}
function isFloated(element){if(!isHtml(element))
return false;var options={left:1,right:1,center:1};return!!(options[element.getComputedStyle('float')]||options[element.getAttribute('align')]);}
function isFlowBreaker(element){if(!isHtml(element))
return false;return isPositioned(element)||isFloated(element);}
var isComment=CKEDITOR.dom.walker.nodeType(CKEDITOR.NODE_COMMENT);function isPositioned(element){return!!{absolute:1,fixed:1}[element.getComputedStyle('position')];}
function isTextNode(node){return node&&node.type==CKEDITOR.NODE_TEXT;}
function isTrigger(that,element){return isHtml(element)?element.is(that.triggers):null;}
function isInTabu(that,element){if(!element)
return false;var parents=element.getParents(1);for(var i=parents.length;i--;){for(var j=that.tabuList.length;j--;){if(parents[i].hasAttribute(that.tabuList[j]))
return true;}}
return false;}
function isChildBetweenPointerAndEdge(that,parent,edgeBottom){var edgeChild=parent[edgeBottom?'getLast':'getFirst'](function(node){return that.isRelevant(node)&&!node.is(DTD_TABLECONTENT);});if(!edgeChild)
return false;updateSize(that,edgeChild);return edgeBottom?edgeChild.size.top>that.mouse.y:edgeChild.size.bottom<that.mouse.y;}
function triggerEditable(that){that.debug.groupStart('triggerEditable');var editable=that.editable,mouse=that.mouse,view=that.view,triggerOffset=that.triggerOffset,triggerLook;updateEditableSize(that);var bottomTrigger=mouse.y>(that.inInlineMode?view.editable.top+view.editable.height/2:Math.min(view.editable.height,view.pane.height)/2),edgeNode=editable[bottomTrigger?'getLast':'getFirst'](function(node){return!(isEmptyTextNode(node)||isComment(node));});if(!edgeNode){that.debug.logEnd('ABORT. No edge node found.');return null;}
if(isLine(that,edgeNode)){edgeNode=that.line.wrap[bottomTrigger?'getPrevious':'getNext'](function(node){return!(isEmptyTextNode(node)||isComment(node));});}
if(!isHtml(edgeNode)||isFlowBreaker(edgeNode)||!isTrigger(that,edgeNode)){that.debug.logEnd('ABORT. Invalid edge node.');return null;}
updateSize(that,edgeNode);if(!bottomTrigger&&edgeNode.size.top>=0&&inBetween(mouse.y,0,edgeNode.size.top+triggerOffset)){triggerLook=that.inInlineMode||view.scroll.y===0?LOOK_TOP:LOOK_NORMAL;that.debug.logEnd('SUCCESS. Created box trigger. EDGE_TOP.');return new boxTrigger([null,edgeNode,EDGE_TOP,TYPE_EDGE,triggerLook]);}
else if(bottomTrigger&&edgeNode.size.bottom<=view.pane.height&&inBetween(mouse.y,edgeNode.size.bottom-triggerOffset,view.pane.height)){triggerLook=that.inInlineMode||inBetween(edgeNode.size.bottom,view.pane.height-triggerOffset,view.pane.height)?LOOK_BOTTOM:LOOK_NORMAL;that.debug.logEnd('SUCCESS. Created box trigger. EDGE_BOTTOM.');return new boxTrigger([edgeNode,null,EDGE_BOTTOM,TYPE_EDGE,triggerLook]);}
that.debug.logEnd('ABORT. No trigger created.');return null;}
function triggerEdge(that){that.debug.groupStart('triggerEdge');var mouse=that.mouse,view=that.view,triggerOffset=that.triggerOffset;var element=getAscendantTrigger(that);that.debug.logElements([element],['Ascendant trigger'],'First stage');if(!element){that.debug.logEnd('ABORT. No element, element is editable or element contains editable.');return null;}
updateSize(that,element);var fixedOffset=Math.min(triggerOffset,0|(element.size.outerHeight/2)),triggerSetup=[],triggerLook,bottomTrigger;if(inBetween(mouse.y,element.size.top-1,element.size.top+fixedOffset))
bottomTrigger=false;else if(inBetween(mouse.y,element.size.bottom-fixedOffset,element.size.bottom+1))
bottomTrigger=true;else{that.debug.logEnd('ABORT. Not around of any edge.');return null;}
if(isFlowBreaker(element)||isChildBetweenPointerAndEdge(that,element,bottomTrigger)||element.getParent().is(DTD_LISTITEM)){that.debug.logEnd('ABORT. element is wrong',element);return null;}
var elementSibling=getNonEmptyNeighbour(that,element,!bottomTrigger);if(!elementSibling){if(element.equals(that.editable[bottomTrigger?'getLast':'getFirst'](that.isRelevant))){updateEditableSize(that);if(bottomTrigger&&inBetween(mouse.y,element.size.bottom-fixedOffset,view.pane.height)&&inBetween(element.size.bottom,view.pane.height-fixedOffset,view.pane.height)){triggerLook=LOOK_BOTTOM;}
else if(inBetween(mouse.y,0,element.size.top+fixedOffset)){triggerLook=LOOK_TOP;}}
else
triggerLook=LOOK_NORMAL;triggerSetup=[null,element][bottomTrigger?'reverse':'concat']().concat([bottomTrigger?EDGE_BOTTOM:EDGE_TOP,TYPE_EDGE,triggerLook,element.equals(that.editable[bottomTrigger?'getLast':'getFirst'](that.isRelevant))?(bottomTrigger?LOOK_BOTTOM:LOOK_TOP):LOOK_NORMAL]);that.debug.log('Configured edge trigger of '+(bottomTrigger?'EDGE_BOTTOM':'EDGE_TOP'));}
else if(isTextNode(elementSibling)){that.debug.logEnd('ABORT. Sibling is non-empty text element');return null;}
else if(isHtml(elementSibling)){if(isFlowBreaker(elementSibling)||!isTrigger(that,elementSibling)||elementSibling.getParent().is(DTD_LISTITEM)){that.debug.logEnd('ABORT. elementSibling is wrong',elementSibling);return null;}
triggerSetup=[elementSibling,element][bottomTrigger?'reverse':'concat']().concat([EDGE_MIDDLE,TYPE_EDGE]);that.debug.log('Configured edge trigger of EDGE_MIDDLE');}
if(0 in triggerSetup){that.debug.logEnd('SUCCESS. Returning a trigger.');return new boxTrigger(triggerSetup);}
that.debug.logEnd('ABORT. No trigger generated.');return null;}
var triggerExpand=(function(){function expandEngine(that){that.debug.groupStart('expandEngine');var startElement=that.element,upper,lower,trigger;if(!isHtml(startElement)||startElement.contains(that.editable)){that.debug.logEnd('ABORT. No start element, or start element contains editable.');return null;}
if(startElement.isReadOnly())
return null;trigger=verticalSearch(that,function(current,startElement){return!startElement.equals(current);},function(that,mouse){return elementFromMouse(that,true,mouse);},startElement),upper=trigger.upper,lower=trigger.lower;that.debug.logElements([upper,lower],['Upper','Lower'],'Pair found');if(areSiblings(that,upper,lower)){that.debug.logEnd('SUCCESS. Expand trigger created.');return trigger.set(EDGE_MIDDLE,TYPE_EXPAND);}
that.debug.logElements([startElement,upper,lower],['Start','Upper','Lower'],'Post-processing');if(upper&&startElement.contains(upper)){while(!upper.getParent().equals(startElement))
upper=upper.getParent();}else{upper=startElement.getFirst(function(node){return expandSelector(that,node);});}
if(lower&&startElement.contains(lower)){while(!lower.getParent().equals(startElement))
lower=lower.getParent();}else{lower=startElement.getLast(function(node){return expandSelector(that,node);});}
if(!upper||!lower){that.debug.logEnd('ABORT. There is no upper or no lower element.');return null;}
updateSize(that,upper);updateSize(that,lower);if(!checkMouseBetweenElements(that,upper,lower)){that.debug.logEnd('ABORT. Mouse is already above upper or below lower.');return null;}
var minDistance=Number.MAX_VALUE,currentDistance,upperNext,minElement,minElementNext;while(lower&&!lower.equals(upper)){if(!(upperNext=upper.getNext(that.isRelevant)))
break;currentDistance=Math.abs(getMidpoint(that,upper,upperNext)-that.mouse.y);if(currentDistance<minDistance){minDistance=currentDistance;minElement=upper;minElementNext=upperNext;}
upper=upperNext;updateSize(that,upper);}
that.debug.logElements([minElement,minElementNext],['Min','MinNext'],'Post-processing results');if(!minElement||!minElementNext){that.debug.logEnd('ABORT. No Min or MinNext');return null;}
if(!checkMouseBetweenElements(that,minElement,minElementNext)){that.debug.logEnd('ABORT. Mouse is already above minElement or below minElementNext.');return null;}
trigger.upper=minElement;trigger.lower=minElementNext;that.debug.logEnd('SUCCESSFUL post-processing. Trigger created.');return trigger.set(EDGE_MIDDLE,TYPE_EXPAND);}
function expandSelector(that,node){return!(isTextNode(node)||isComment(node)||isFlowBreaker(node)||isLine(that,node)||(node.type==CKEDITOR.NODE_ELEMENT&&node.$&&node.is('br')));}
function checkMouseBetweenElements(that,upper,lower){return inBetween(that.mouse.y,upper.size.top,lower.size.bottom);}
function expandFilter(that,trigger){that.debug.groupStart('expandFilter');var upper=trigger.upper,lower=trigger.lower;if(!upper||!lower||isFlowBreaker(lower)||isFlowBreaker(upper)||lower.equals(upper)||upper.equals(lower)||lower.contains(upper)||upper.contains(lower)){that.debug.logEnd('REJECTED. No upper or no lower or they contain each other.');return false;}
else if(isTrigger(that,upper)&&isTrigger(that,lower)&&areSiblings(that,upper,lower)){that.debug.logElementsEnd([upper,lower],['upper','lower'],'APPROVED EDGE_MIDDLE');return true;}
that.debug.logElementsEnd([upper,lower],['upper','lower'],'Rejected unknown pair');return false;}
return function(that){that.debug.groupStart('triggerExpand');var trigger=expandEngine(that);that.debug.groupEnd();return trigger&&expandFilter(that,trigger)?trigger:null;};})();var sizePrefixes=['top','left','right','bottom'];function getSize(that,element,ignoreScroll,force){var getStyle=(function(){var computed=env.ie?element.$.currentStyle:that.win.$.getComputedStyle(element.$,'');return env.ie?function(propertyName){return computed[CKEDITOR.tools.cssStyleToDomStyle(propertyName)];}:function(propertyName){return computed.getPropertyValue(propertyName);};})(),docPosition=element.getDocumentPosition(),border={},margin={},padding={},box={};for(var i=sizePrefixes.length;i--;){border[sizePrefixes[i]]=parseInt(getStyle('border-'+sizePrefixes[i]+'-width'),10)||0;padding[sizePrefixes[i]]=parseInt(getStyle('padding-'+sizePrefixes[i]),10)||0;margin[sizePrefixes[i]]=parseInt(getStyle('margin-'+sizePrefixes[i]),10)||0;}
if(!ignoreScroll||force)
updateWindowSize(that,force);box.top=docPosition.y-(ignoreScroll?0:that.view.scroll.y),box.left=docPosition.x-(ignoreScroll?0:that.view.scroll.x),box.outerWidth=element.$.offsetWidth,box.outerHeight=element.$.offsetHeight,box.height=box.outerHeight-(padding.top+padding.bottom+border.top+border.bottom),box.width=box.outerWidth-(padding.left+padding.right+border.left+border.right),box.bottom=box.top+box.outerHeight,box.right=box.left+box.outerWidth;if(that.inInlineMode){box.scroll={top:element.$.scrollTop,left:element.$.scrollLeft};}
return extend({border:border,padding:padding,margin:margin,ignoreScroll:ignoreScroll},box,true);}
function updateSize(that,element,ignoreScroll){if(!isHtml(element))
return(element.size=null);if(!element.size)
element.size={};else if(element.size.ignoreScroll==ignoreScroll&&element.size.date>new Date()-CACHE_TIME){that.debug.log('element.size: get from cache');return null;}
that.debug.log('element.size: capture');return extend(element.size,getSize(that,element,ignoreScroll),{date:+new Date()},true);}
function updateEditableSize(that,ignoreScroll){that.view.editable=getSize(that,that.editable,ignoreScroll,true);}
function updateWindowSize(that,force){if(!that.view)
that.view={};var view=that.view;if(!force&&view&&view.date>new Date()-CACHE_TIME){that.debug.log('win.size: get from cache');return;}
that.debug.log('win.size: capturing');var win=that.win,scroll=win.getScrollPosition(),paneSize=win.getViewPaneSize();extend(that.view,{scroll:{x:scroll.x,y:scroll.y,width:that.doc.$.documentElement.scrollWidth-paneSize.width,height:that.doc.$.documentElement.scrollHeight-paneSize.height},pane:{width:paneSize.width,height:paneSize.height,bottom:paneSize.height+scroll.y},date:+new Date()},true);}
function verticalSearch(that,stopCondition,selectCriterion,startElement){var upper=startElement,lower=startElement,mouseStep=0,upperFound=false,lowerFound=false,viewPaneHeight=that.view.pane.height,mouse=that.mouse;while(mouse.y+mouseStep<viewPaneHeight&&mouse.y-mouseStep>0){if(!upperFound)
upperFound=stopCondition(upper,startElement);if(!lowerFound)
lowerFound=stopCondition(lower,startElement);if(!upperFound&&mouse.y-mouseStep>0)
upper=selectCriterion(that,{x:mouse.x,y:mouse.y-mouseStep});if(!lowerFound&&mouse.y+mouseStep<viewPaneHeight)
lower=selectCriterion(that,{x:mouse.x,y:mouse.y+mouseStep});if(upperFound&&lowerFound)
break;mouseStep+=2;}
return new boxTrigger([upper,lower,null,null]);}})();CKEDITOR.config.magicline_keystrokePrevious=CKEDITOR.CTRL+CKEDITOR.SHIFT+51;CKEDITOR.config.magicline_keystrokeNext=CKEDITOR.CTRL+CKEDITOR.SHIFT+52;