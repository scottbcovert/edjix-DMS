/*
 Copyright (c) 2010, Yahoo! Inc. All rights reserved.
 Code licensed under the BSD License:
 http://developer.yahoo.com/yui/license.html
 version: 3.3.0
 build: 3167
 */
YUI.add('history-base',function(Y){var Lang=Y.Lang,Obj=Y.Object,GlobalEnv=YUI.namespace('Env.History'),YArray=Y.Array,doc=Y.config.doc,docMode=doc.documentMode,win=Y.config.win,DEFAULT_OPTIONS={merge:true},EVT_CHANGE='change',SRC_ADD='add',SRC_REPLACE='replace';function HistoryBase(){this._init.apply(this,arguments);}
Y.augment(HistoryBase,Y.EventTarget,null,null,{emitFacade:true,prefix:'history',preventable:false,queueable:true});if(!GlobalEnv._state){GlobalEnv._state={};}
function _isSimpleObject(value){return Lang.type(value)==='object';}
HistoryBase.NAME='historyBase';HistoryBase.SRC_ADD=SRC_ADD;HistoryBase.SRC_REPLACE=SRC_REPLACE;HistoryBase.html5=!!(win.history&&win.history.pushState&&win.history.replaceState&&('onpopstate'in win||Y.UA.gecko>=2));HistoryBase.nativeHashChange=('onhashchange'in win||'onhashchange'in doc)&&(!docMode||docMode>7);Y.mix(HistoryBase.prototype,{_init:function(config){var initialState;config=this._config=config||{};initialState=this._initialState=this._initialState||config.initialState||null;this.publish(EVT_CHANGE,{broadcast:2,defaultFn:this._defChangeFn});if(initialState){this.add(initialState);}},add:function(){var args=YArray(arguments,0,true);args.unshift(SRC_ADD);return this._change.apply(this,args);},addValue:function(key,value,options){var state={};state[key]=value;return this._change(SRC_ADD,state,options);},get:function(key){var state=GlobalEnv._state,isObject=_isSimpleObject(state);if(key){return isObject&&Obj.owns(state,key)?state[key]:undefined;}else{return isObject?Y.mix({},state,true):state;}},replace:function(){var args=YArray(arguments,0,true);args.unshift(SRC_REPLACE);return this._change.apply(this,args);},replaceValue:function(key,value,options){var state={};state[key]=value;return this._change(SRC_REPLACE,state,options);},_change:function(src,state,options){options=options?Y.merge(DEFAULT_OPTIONS,options):DEFAULT_OPTIONS;if(options.merge&&_isSimpleObject(state)&&_isSimpleObject(GlobalEnv._state)){state=Y.merge(GlobalEnv._state,state);}
this._resolveChanges(src,state,options);return this;},_fireEvents:function(src,changes,options){this.fire(EVT_CHANGE,{_options:options,changed:changes.changed,newVal:changes.newState,prevVal:changes.prevState,removed:changes.removed,src:src});Obj.each(changes.changed,function(value,key){this._fireChangeEvent(src,key,value);},this);Obj.each(changes.removed,function(value,key){this._fireRemoveEvent(src,key,value);},this);},_fireChangeEvent:function(src,key,value){this.fire(key+'Change',{newVal:value.newVal,prevVal:value.prevVal,src:src});},_fireRemoveEvent:function(src,key,value){this.fire(key+'Remove',{prevVal:value,src:src});},_resolveChanges:function(src,newState,options){var changed={},isChanged,prevState=GlobalEnv._state,removed={};if(!newState){newState={};}
if(!options){options={};}
if(_isSimpleObject(newState)&&_isSimpleObject(prevState)){Obj.each(newState,function(newVal,key){var prevVal=prevState[key];if(newVal!==prevVal){changed[key]={newVal:newVal,prevVal:prevVal};isChanged=true;}},this);Obj.each(prevState,function(prevVal,key){if(!Obj.owns(newState,key)||newState[key]===null){delete newState[key];removed[key]=prevVal;isChanged=true;}},this);}else{isChanged=newState!==prevState;}
if(isChanged){this._fireEvents(src,{changed:changed,newState:newState,prevState:prevState,removed:removed},options);}},_storeState:function(src,newState){GlobalEnv._state=newState||{};},_defChangeFn:function(e){this._storeState(e.src,e.newVal,e._options);}},true);Y.HistoryBase=HistoryBase;},'3.3.0',{requires:['event-custom-complex']});YUI.add('history-hash',function(Y){var HistoryBase=Y.HistoryBase,Lang=Y.Lang,YArray=Y.Array,YObject=Y.Object,GlobalEnv=YUI.namespace('Env.HistoryHash'),SRC_HASH='hash',hashNotifiers,oldHash,oldUrl,win=Y.config.win,location=win.location,useHistoryHTML5=Y.config.useHistoryHTML5;function HistoryHash(){HistoryHash.superclass.constructor.apply(this,arguments);}
Y.extend(HistoryHash,HistoryBase,{_init:function(config){var bookmarkedState=HistoryHash.parseHash();config=config||{};this._initialState=config.initialState?Y.merge(config.initialState,bookmarkedState):bookmarkedState;Y.after('hashchange',Y.bind(this._afterHashChange,this),win);HistoryHash.superclass._init.apply(this,arguments);},_change:function(src,state,options){YObject.each(state,function(value,key){if(Lang.isValue(value)){state[key]=value.toString();}});return HistoryHash.superclass._change.call(this,src,state,options);},_storeState:function(src,newState){var decode=HistoryHash.decode,newHash=HistoryHash.createHash(newState);HistoryHash.superclass._storeState.apply(this,arguments);if(src!==SRC_HASH&&decode(HistoryHash.getHash())!==decode(newHash)){HistoryHash[src===HistoryBase.SRC_REPLACE?'replaceHash':'setHash'](newHash);}},_afterHashChange:function(e){this._resolveChanges(SRC_HASH,HistoryHash.parseHash(e.newHash),{});}},{NAME:'historyHash',SRC_HASH:SRC_HASH,hashPrefix:'',_REGEX_HASH:/([^\?#&]+)=([^&]+)/g,createHash:function(params){var encode=HistoryHash.encode,hash=[];YObject.each(params,function(value,key){if(Lang.isValue(value)){hash.push(encode(key)+'='+encode(value));}});return hash.join('&');},decode:function(string){return decodeURIComponent(string.replace(/\+/g,' '));},encode:function(string){return encodeURIComponent(string).replace(/%20/g,'+');},getHash:(Y.UA.gecko?function(){var matches=/#(.*)$/.exec(location.href),hash=matches&&matches[1]||'',prefix=HistoryHash.hashPrefix;return prefix&&hash.indexOf(prefix)===0?hash.replace(prefix,''):hash;}:function(){var hash=location.hash.substr(1),prefix=HistoryHash.hashPrefix;return prefix&&hash.indexOf(prefix)===0?hash.replace(prefix,''):hash;}),getUrl:function(){return location.href;},parseHash:function(hash){var decode=HistoryHash.decode,i,len,matches,param,params={},prefix=HistoryHash.hashPrefix,prefixIndex;hash=Lang.isValue(hash)?hash:HistoryHash.getHash();if(prefix){prefixIndex=hash.indexOf(prefix);if(prefixIndex===0||(prefixIndex===1&&hash.charAt(0)==='#')){hash=hash.replace(prefix,'');}}
matches=hash.match(HistoryHash._REGEX_HASH)||[];for(i=0,len=matches.length;i<len;++i){param=matches[i].split('=');params[decode(param[0])]=decode(param[1]);}
return params;},replaceHash:function(hash){if(hash.charAt(0)==='#'){hash=hash.substr(1);}
location.replace('#'+(HistoryHash.hashPrefix||'')+hash);},setHash:function(hash){if(hash.charAt(0)==='#'){hash=hash.substr(1);}
location.hash=(HistoryHash.hashPrefix||'')+hash;}});hashNotifiers=GlobalEnv._notifiers;if(!hashNotifiers){hashNotifiers=GlobalEnv._notifiers=[];}
Y.Event.define('hashchange',{on:function(node,subscriber,notifier){if(node.compareTo(win)||node.compareTo(Y.config.doc.body)){hashNotifiers.push(notifier);}},detach:function(node,subscriber,notifier){var index=YArray.indexOf(hashNotifiers,notifier);if(index!==-1){hashNotifiers.splice(index,1);}}});oldHash=HistoryHash.getHash();oldUrl=HistoryHash.getUrl();if(HistoryBase.nativeHashChange){Y.Event.attach('hashchange',function(e){var newHash=HistoryHash.getHash(),newUrl=HistoryHash.getUrl();YArray.each(hashNotifiers.concat(),function(notifier){notifier.fire({_event:e,oldHash:oldHash,oldUrl:oldUrl,newHash:newHash,newUrl:newUrl});});oldHash=newHash;oldUrl=newUrl;},win);}else{if(!GlobalEnv._hashPoll){if(Y.UA.webkit&&!Y.UA.chrome&&navigator.vendor.indexOf('Apple')!==-1){Y.on('unload',function(){},win);}
GlobalEnv._hashPoll=Y.later(50,null,function(){var newHash=HistoryHash.getHash(),newUrl;if(oldHash!==newHash){newUrl=HistoryHash.getUrl();YArray.each(hashNotifiers.concat(),function(notifier){notifier.fire({oldHash:oldHash,oldUrl:oldUrl,newHash:newHash,newUrl:newUrl});});oldHash=newHash;oldUrl=newUrl;}},null,true);}}
Y.HistoryHash=HistoryHash;if(useHistoryHTML5===false||(!Y.History&&useHistoryHTML5!==true&&(!HistoryBase.html5||!Y.HistoryHTML5))){Y.History=HistoryHash;}},'3.3.0',{requires:['event-synthetic','history-base','yui-later']});YUI.add('history-hash-ie',function(Y){if(Y.UA.ie&&!Y.HistoryBase.nativeHashChange){var Do=Y.Do,GlobalEnv=YUI.namespace('Env.HistoryHash'),HistoryHash=Y.HistoryHash,iframe=GlobalEnv._iframe,win=Y.config.win,location=win.location,lastUrlHash='';HistoryHash.getIframeHash=function(){if(!iframe||!iframe.contentWindow){return'';}
var prefix=HistoryHash.hashPrefix,hash=iframe.contentWindow.location.hash.substr(1);return prefix&&hash.indexOf(prefix)===0?hash.replace(prefix,''):hash;};HistoryHash._updateIframe=function(hash,replace){var iframeDoc=iframe&&iframe.contentWindow&&iframe.contentWindow.document,iframeLocation=iframeDoc&&iframeDoc.location;if(!iframeDoc||!iframeLocation){return;}
iframeDoc.open().close();if(replace){iframeLocation.replace(hash.charAt(0)==='#'?hash:'#'+hash);}else{iframeLocation.hash=hash;}};Do.after(HistoryHash._updateIframe,HistoryHash,'replaceHash',HistoryHash,true);if(!iframe){Y.on('domready',function(){iframe=GlobalEnv._iframe=Y.Node.getDOMNode(Y.Node.create('<iframe src="javascript:0" style="display:none" height="0" width="0" tabindex="-1" title="empty"/>'));Y.config.doc.documentElement.appendChild(iframe);HistoryHash._updateIframe(HistoryHash.getHash()||'#');Y.on('hashchange',function(e){lastUrlHash=e.newHash;if(HistoryHash.getIframeHash()!==lastUrlHash){HistoryHash._updateIframe(lastUrlHash);}},win);Y.later(50,null,function(){var iframeHash=HistoryHash.getIframeHash();if(iframeHash!==lastUrlHash){HistoryHash.setHash(iframeHash);}},null,true);});}}},'3.3.0',{requires:['history-hash','node-base']});YUI.add('history-html5',function(Y){var HistoryBase=Y.HistoryBase,doc=Y.config.doc,win=Y.config.win,sessionStorage,useHistoryHTML5=Y.config.useHistoryHTML5,JSON=Y.JSON||win.JSON,ENABLE_FALLBACK='enableSessionFallback',SESSION_KEY='YUI_HistoryHTML5_state',SRC_POPSTATE='popstate',SRC_REPLACE=HistoryBase.SRC_REPLACE;function HistoryHTML5(){HistoryHTML5.superclass.constructor.apply(this,arguments);}
Y.extend(HistoryHTML5,HistoryBase,{_init:function(config){Y.on('popstate',this._onPopState,win,this);HistoryHTML5.superclass._init.apply(this,arguments);if(config&&config[ENABLE_FALLBACK]&&YUI.Env.windowLoaded){try{sessionStorage=win.sessionStorage;}catch(ex){}
this._loadSessionState();}},_getSessionKey:function(){return SESSION_KEY+'_'+win.location.pathname;},_loadSessionState:function(){var lastState=JSON&&sessionStorage&&sessionStorage[this._getSessionKey()];if(lastState){try{this._resolveChanges(SRC_POPSTATE,JSON.parse(lastState)||null);}catch(ex){}}},_storeSessionState:function(state){if(this._config[ENABLE_FALLBACK]&&JSON&&sessionStorage){sessionStorage[this._getSessionKey()]=JSON.stringify(state||null);}},_storeState:function(src,newState,options){if(src!==SRC_POPSTATE){win.history[src===SRC_REPLACE?'replaceState':'pushState'](newState,options.title||doc.title||'',options.url||null);}
this._storeSessionState(newState);HistoryHTML5.superclass._storeState.apply(this,arguments);},_onPopState:function(e){var state=e._event.state;this._storeSessionState(state);this._resolveChanges(SRC_POPSTATE,state||null);}},{NAME:'historyhtml5',SRC_POPSTATE:SRC_POPSTATE});if(!Y.Node.DOM_EVENTS.popstate){Y.Node.DOM_EVENTS.popstate=1;}
Y.HistoryHTML5=HistoryHTML5;if(useHistoryHTML5===true||(useHistoryHTML5!==false&&HistoryBase.html5)){Y.History=HistoryHTML5;}},'3.3.0',{optional:['json'],requires:['event-base','history-base','node-base']});YUI.add('history',function(Y){},'3.3.0',{use:['history-base','history-hash','history-hash-ie','history-html5']});