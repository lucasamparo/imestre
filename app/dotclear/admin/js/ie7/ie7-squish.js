
if(IE7.loaded&&IE7.appVersion<7){IE7.CSS.addFix(/(float\s*:\s*(left|right))/,"display:inline;$1");if(IE7.appVersion>=6)IE7.CSS.addRecalc("float","(left|right)",function(element){IE7.Layout.boxSizing(element.parentElement);element.style.display="inline";});IE7.CSS.addRecalc("position","absolute|fixed",function(element){if(element.offsetParent&&element.offsetParent.currentStyle.position=="relative")
IE7.Layout.boxSizing(element.offsetParent);});}