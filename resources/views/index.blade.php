<!DOCTYPE html><html lang="en"><!-- Basic -->
<head><meta charset="utf-8"/>
<script data-ezscrex='false' data-cfasync='false' data-pagespeed-no-defer>var __ez=__ez||{};__ez.stms=Date.now();__ez.evt={};__ez.script={};__ez.ck=__ez.ck||{};__ez.template={};__ez.template.isOrig=true;__ez.queue=(function(){var count=0,incr=0,items=[],timeDelayFired=false,hpItems=[],lpItems=[],allowLoad=true;var obj={func:function(name,funcName,parameters,isBlock,blockedBy,deleteWhenComplete,proceedIfError){var self=this;this.name=name;this.funcName=funcName;this.parameters=parameters===null?null:(parameters instanceof Array)?parameters:[parameters];this.isBlock=isBlock;this.blockedBy=blockedBy;this.deleteWhenComplete=deleteWhenComplete;this.isError=false;this.isComplete=false;this.isInitialized=false;this.proceedIfError=proceedIfError;this.isTimeDelay=false;this.process=function(){log("... func = "+name);self.isInitialized=true;self.isComplete=true;log("... func.apply: "+name);var funcs=self.funcName.split('.');var func=null;if(funcs.length>3){}else if(funcs.length===3){func=window[funcs[0]][funcs[1]][funcs[2]];}else if(funcs.length===2){func=window[funcs[0]][funcs[1]];}else{func=window[self.funcName];}
if(typeof func!=='undefined'&&func!==null){func.apply(null,this.parameters);}
if(self.deleteWhenComplete===true)delete items[name];if(self.isBlock===true){log("----- F'D: "+self.name);processAll();}}},file:function(name,path,isBlock,blockedBy,async,defer,proceedIfError){var self=this;this.name=name;this.path=path;this.async=async;this.defer=defer;this.isBlock=isBlock;this.blockedBy=blockedBy;this.isInitialized=false;this.isError=false;this.isComplete=false;this.proceedIfError=proceedIfError;this.isTimeDelay=false;this.process=function(){self.isInitialized=true;log("... file = "+name);var scr=document.createElement('script');scr.src=path;if(async===true)scr.async=true;else if(defer===true)scr.defer=true;scr.onerror=function(){log("----- ERR'D: "+self.name);self.isError=true;if(self.isBlock===true){processAll();}};scr.onreadystatechange=scr.onload=function(){var state=scr.readyState;log("----- F'D: "+self.name);if((!state||/loaded|complete/.test(state))){self.isComplete=true;if(self.isBlock===true){processAll();}}};document.getElementsByTagName('head')[0].appendChild(scr);}},fileLoaded:function(name,isComplete){this.name=name;this.path="";this.async=false;this.defer=false;this.isBlock=false;this.blockedBy=[];this.isInitialized=true;this.isError=false;this.isComplete=isComplete;this.proceedIfError=false;this.isTimeDelay=false;this.process=function(){};}};function init(){window.addEventListener("load",function(){setTimeout(function(){timeDelayFired=true;log('TDELAY -----');processAll();},5000);},false);}
function addFile(name,path,isBlock,blockedBy,async,defer,proceedIfError,priority){var item=new obj.file(name,path,isBlock,blockedBy,async,defer,proceedIfError);if(priority===true){hpItems[name]=item}else{lpItems[name]=item}
items[name]=item;checkIfBlocked(item);}
function setallowLoad(settobool){allowLoad=settobool}
function addFunc(name,func,parameters,isBlock,blockedBy,autoInc,deleteWhenComplete,proceedIfError,priority){if(autoInc===true)name=name+"_"+incr++;var item=new obj.func(name,func,parameters,isBlock,blockedBy,deleteWhenComplete,proceedIfError);if(priority===true){hpItems[name]=item}else{lpItems[name]=item}
items[name]=item;checkIfBlocked(item);}
function addTimeDelayFile(name,path){var item=new obj.file(name,path,false,[],false,false,true);item.isTimeDelay=true;log(name+' ... '+' FILE! TDELAY');lpItems[name]=item;items[name]=item;checkIfBlocked(item);}
function addTimeDelayFunc(name,func,parameters){var item=new obj.func(name,func,parameters,false,[],true,true);item.isTimeDelay=true;log(name+' ... '+' FUNCTION! TDELAY');lpItems[name]=item;items[name]=item;checkIfBlocked(item);}
function checkIfBlocked(item){if(isBlocked(item)===true||allowLoad==false)return;item.process();}
function isBlocked(item){if(item.isTimeDelay===true&&timeDelayFired===false){log(item.name+" blocked = TIME DELAY!");return true;}
if(item.blockedBy instanceof Array){for(var i=0;i<item.blockedBy.length;i++){var block=item.blockedBy[i];if(items.hasOwnProperty(block)===false){log(item.name+" blocked = "+block);return true;}else if(item.proceedIfError===true&&items[block].isError===true){return false;}else if(items[block].isComplete===false){log(item.name+" blocked = "+block);return true;}}}
return false;}
function markLoaded(filename){if(!filename||0===filename.length){return;}
if(filename in items){var item=items[filename];if(item.isComplete===true){log(item.name+' '+filename+': error loaded duplicate')}else{item.isComplete=true;item.isInitialized=true;}}else{items[filename]=new obj.fileLoaded(filename,true);}
log("markLoaded dummyfile: "+items[filename].name);}
function logWhatsBlocked(){for(var i in items){if(items.hasOwnProperty(i)===false)continue;var item=items[i];isBlocked(item)}}
function log(msg){var href=window.location.href;var reg=new RegExp('[?&]ezq=([^&#]*)','i');var string=reg.exec(href);var res=string?string[1]:null;if(res==="1")console.debug(msg);}
function processAll(){count++;if(count>200)return;log("let's go");processItems(hpItems);processItems(lpItems);}
function processItems(list){for(var i in list){if(list.hasOwnProperty(i)===false)continue;var item=list[i];if(item.isComplete===true||isBlocked(item)||item.isInitialized===true||item.isError===true){if(item.isError===true){log(item.name+': error')}else if(item.isComplete===true){log(item.name+': complete already')}else if(item.isInitialized===true){log(item.name+': initialized already')}}else{item.process();}}}
init();return{addFile:addFile,addDelayFile:addTimeDelayFile,addFunc:addFunc,addDelayFunc:addTimeDelayFunc,items:items,processAll:processAll,setallowLoad:setallowLoad,markLoaded:markLoaded,logWhatsBlocked:logWhatsBlocked,};})();__ez.evt.add=function(e,t,n){e.addEventListener?e.addEventListener(t,n,!1):e.attachEvent?e.attachEvent("on"+t,n):e["on"+t]=n()},__ez.evt.remove=function(e,t,n){e.removeEventListener?e.removeEventListener(t,n,!1):e.detachEvent?e.detachEvent("on"+t,n):delete e["on"+t]};__ez.script.add=function(e){var t=document.createElement("script");t.src=e,t.async=!0,t.type="text/javascript",document.getElementsByTagName("head")[0].appendChild(t)};__ez.dot={};__ez.queue.addFile('../../detroitchicago/boise.js', '../../detroitchicago/boise7697.js?gcb=195-0&amp;cb=1', false, [], true, false, true, false);__ez.queue.addFile('../../detroitchicago/memphis.js', '../../detroitchicago/memphis1dcc.js?gcb=195-0&amp;cb=14', false, [], true, false, true, false);__ez.queue.addFile('../../detroitchicago/minneapolis.js', '../../detroitchicago/minneapolis42b7.js?gcb=195-0&amp;cb=3', false, [], true, false, true, false);__ez.queue.addFile('../../detroitchicago/rochester.js', '../../detroitchicago/rochester0d65.js?gcb=195-0&amp;cb=12', false, ['/detroitchicago/memphis.js','/detroitchicago/minneapolis.js'], true, false, true, false);__ez.vep=(function(){var pixels=[],pxURL="../../detroitchicago/grapefruit.gif";function AddPixel(vID,pixelData){if(__ez.dot.isDefined(vID)&&__ez.dot.isValid(pixelData)){pixels.push({type:'video',video_impression_id:vID,domain_id:__ez.dot.getDID(),t_epoch:__ez.dot.getEpoch(0),data:__ez.dot.dataToStr(pixelData)});}}
function Fire(){if(typeof document.visibilityState!=='undefined'&&document.visibilityState==="prerender"){return;}
if(__ez.dot.isDefined(pixels)&&pixels.length>0){while(pixels.length>0){var j=5;if(j>pixels.length){j=pixels.length;}
var pushPixels=pixels.splice(0,j);var pixelURL=__ez.dot.getURL(pxURL)+"?orig="+(__ez.template.isOrig===true?1:0)+"&v="+btoa(JSON.stringify(pushPixels));__ez.dot.Fire(pixelURL);}}
pixels=[];}
return{Add:AddPixel,Fire:Fire};})();</script><script data-ezscrex='false' data-cfasync='false' data-pagespeed-no-defer>__ez.pel=(function(){var pixels=[],pxURL="../../porpoiseant/army.gif";function AddAndFirePixel(adSlot,pixelData){AddPixel(adSlot,pixelData,0,0,0,0,0);Fire();}
function AddAndFireOrigPixel(adSlot,pixelData){AddPixel(adSlot,pixelData,0,0,0,0,0,true);Fire();}
function GetCurrentPixels(){return pixels;}
function AddPixel(adSlot,pixelData,revenue,est_revenue,bid_floor_filled,bid_floor_prev,stat_source_id,isOrig){if(!__ez.dot.isDefined(adSlot)||__ez.dot.isAnyDefined(adSlot.getSlotElementId,adSlot.ElementId)==false){return;}
var ad_position_id=parseInt(__ez.dot.getTargeting(adSlot,'ap'));var impId=__ez.dot.getSlotIID(adSlot),adUnit=__ez.dot.getAdUnit(adSlot,isOrig);var compId=parseInt(__ez.dot.getTargeting(adSlot,"compid"));var lineItemId=0;var creativeId=0;var ezimData=getEzimData(adSlot);if(typeof ezimData=='object'){if(ezimData.creative_id!==undefined){creativeId=ezimData.creative_id;}
if(ezimData.line_item_id!==undefined){lineItemId=ezimData.line_item_id;}}
if(__ez.dot.isDefined(impId,adUnit)&&__ez.dot.isValid(pixelData)){pixels.push({type:"impression",impression_id:impId,domain_id:__ez.dot.getDID(),unit:adUnit,t_epoch:__ez.dot.getEpoch(0),revenue:revenue,est_revenue:est_revenue,ad_position:ad_position_id,ad_size:"",bid_floor_filled:bid_floor_filled,bid_floor_prev:bid_floor_prev,stat_source_id:stat_source_id,country_code:__ez.dot.getCC(),pageview_id:__ez.dot.getPageviewId(),comp_id:compId,line_item_id:lineItemId,creative_id:creativeId,data:__ez.dot.dataToStr(pixelData),is_orig:isOrig||__ez.template.isOrig,});}}
function AddPixelById(impFullId,pixelData,isOrig){var vals=impFullId.split('https://html.design/');if(__ez.dot.isDefined(impFullId)&&vals.length===3&&__ez.dot.isValid(pixelData)){var adUnit=vals[0],impId=vals[2];pixels.push({type:"impression",impression_id:impId,domain_id:__ez.dot.getDID(),unit:adUnit,t_epoch:__ez.dot.getEpoch(0),pageview_id:__ez.dot.getPageviewId(),data:__ez.dot.dataToStr(pixelData),is_orig:isOrig||__ez.template.isOrig});}}
function Fire(){if(typeof document.visibilityState!=='undefined'&&document.visibilityState==="prerender")return;if(__ez.dot.isDefined(pixels)&&pixels.length>0){var allPixels=[pixels.filter(function(pixel){return pixel.is_orig}),pixels.filter(function(pixel){return!pixel.is_orig})];allPixels.forEach(function(pixels){while(pixels.length>0){var isOrig=pixels[0].is_orig||false;var j=5;if(j>pixels.length){j=pixels.length;}
var pushPixels=pixels.splice(0,j);var pixelURL=__ez.dot.getURL(pxURL)+"?orig="+(isOrig===true?1:0)+"&sts="+btoa(JSON.stringify(pushPixels));if(typeof window.isAmp!=='undefined'&&isAmp&&typeof window._ezaq!=='undefined'&&_ezaq.hasOwnProperty("domain_id")){pixelURL+="&visit_uuid="+_ezaq['visit_uuid'];}
__ez.dot.Fire(pixelURL);}})}
pixels=[];}
function getEzimData(adSlot){if(typeof _ezim_d=="undefined"){return false}
var adUnitName=__ez.dot.getAdUnitPath(adSlot).split('https://html.design/').pop();if(typeof _ezim_d==='object'&&_ezim_d.hasOwnProperty(adUnitName)){return _ezim_d[adUnitName];}
for(var ezimKey in _ezim_d){if(ezimKey.split('https://html.design/').pop()===adUnitName){return _ezim_d[ezimKey];}}
return false;}
return{Add:AddPixel,AddAndFire:AddAndFirePixel,AddAndFireOrig:AddAndFireOrigPixel,AddById:AddPixelById,Fire:Fire,GetPixels:GetCurrentPixels,};})();__ez.queue.addFile('../../detroitchicago/raleigh.js', '../../detroitchicago/raleigh45f7.js?gcb=195-0&amp;cb=5', false, [], true, false, true, false);__ez.queue.addFile('../../detroitchicago/tampa.js', '../../detroitchicago/tampa453e.js?gcb=195-0&amp;cb=4', false, [], true, false, true, false);</script>
<script data-ezscrex="false" data-cfasync="false">(function(){if("function"===typeof window.CustomEvent)return!1;window.CustomEvent=function(c,a){a=a||{bubbles:!1,cancelable:!1,detail:null};var b=document.createEvent("CustomEvent");b.initCustomEvent(c,a.bubbles,a.cancelable,a.detail);return b}})();</script><script data-ezscrex="false" data-cfasync="false">__ez.queue.addFile('../../detroitchicago/tulsa.js', '../../detroitchicago/tulsa45f7.js?gcb=195-0&amp;cb=5', false, [], true, false, true, false);</script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
 
     <!-- Site Metas -->
    <title>MP {{config('app.name')}} - Mumias West Constituency</title>  
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <!-- Site Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="images/favicon.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css"/>
    <!-- Colors CSS -->
    
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="css/versions.css"/>
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css"/>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel='canonical' href='index.html' />
<script type="text/javascript">var ezouid = "1";</script><base ><script type='text/javascript'>
var ezoTemplate = 'old_site_noads';
if(typeof ezouid == 'undefined')
{
    var ezouid = 'none';
}
var ezoFormfactor = '1';
var ezo_elements_to_check = Array();
</script><!-- START EZHEAD -->
<script data-ezscrex="false" type='text/javascript'>
var soc_app_id = '0';
var did = 317139;
var ezdomain = 'html.design';
var ezoicSearchable = 1;
</script>
<!--{jquery}-->
<!-- END EZHEAD -->
<script data-ezscrex="false" type="text/javascript" data-cfasync="false">var _ezaq = {"ad_cache_level":0,"ad_lazyload_version":0,"ad_load_version":0,"city":"Nairobi","country":"KE","days_since_last_visit":-1,"domain_id":317139,"engaged_time_visit":0,"ezcache_level":2,"ezcache_skip_code":0,"form_factor_id":1,"framework_id":1,"is_return_visitor":false,"is_sitespeed":0,"last_page_load":"","last_pageview_id":"","lt_cache_level":0,"metro_code":0,"page_ad_positions":"","page_view_count":0,"page_view_id":"d5167543-c10d-4519-5222-a398c81a9003","position_selection_id":0,"postal_code":"","pv_event_count":0,"response_size_orig":31567,"response_time_orig":2,"serverid":"3.6.88.150:25295","state":"30","t_epoch":1642250907,"template_id":120,"time_on_site_visit":0,"url":"https://html.design/demo/elpolitic/index.html","user_id":0,"weather_precipitation":0,"weather_summary":"","weather_temperature":0,"word_count":954,"worst_bad_word_level":1};var _ezExtraQueries = "&ez_orig=1";</script>
<script data-ezscrex='false' data-pagespeed-no-defer data-cfasync='false'>
function create_ezolpl(pvID, rv) {
    var d = new Date();
    d.setTime(d.getTime() + (365*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    __ez.ck.setByCat("ezux_lpl_317139=" + new Date().getTime() + "|" + pvID + "|" + rv + "; " + expires, 3);
}
function attach_ezolpl(pvID, rv) {
    if (document.readyState === "complete") {
        create_ezolpl(pvID, rv);
    }
    if(window.attachEvent) {
        window.attachEvent("onload", create_ezolpl, pvID, rv);
    } else {
        if(window.onload) {
            var curronload = window.onload;
            var newonload = function(evt) {
                curronload(evt);
                create_ezolpl(pvID, rv);
            };
            window.onload = newonload;
        } else {
            window.onload = create_ezolpl.bind(null, pvID, rv);
        }
    }
}

__ez.queue.addFunc("attach_ezolpl", "attach_ezolpl", ["d5167543-c10d-4519-5222-a398c81a9003", "false"], false, ['/detroitchicago/boise.js'], true, false, false, false);
</script>
</head>
<body class="politics_version">

    <!-- LOADER -->
    <div id="preloader">
        <div id="main-ld">
			<div id="loader"><img src="images/logos/logo.png" alt="image"/></div>  
		</div>
    </div><!-- end loader -->
    <!-- END LOADER -->

    <div class="topbar text-center hidden-xs">
        <p>Mumias West Constituency - MP {{config('app.name')}}.
             <!-- <a href="#">Find out more here &gt;</a> -->
            </p>
    </div>

    <header class="header header_style_01">
        <nav class="megamenu navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="images/logos/logo.png" alt="image"/></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a data-scroll-nav="0" href="#main-banner" class="active">Home</a></li>
                        <li><a data-scroll-nav="1" href="#about">About</a></li>
                        <li><a data-scroll-nav="2" href="#issues">Campaign Issues</a></li>
                        @if($events = null)
                        @elseif($events != null)
                        <li><a data-scroll-nav="3" href="#event">Events</a></li>
                        @endif
						<li><a data-scroll-nav="4" href="#gallery">Gallery</a></li>
                        @if($news = null)
                        @elseif($news != null)
                        <li><a data-scroll-nav="5" href="#media">News</a></li>
                        @endif
						<!-- <li><a data-scroll-nav="6" href="#blog">Blog</a></li> -->
                        <!-- <li><a data-scroll-nav="7" href="#contact">Contact</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>
	
	<div id="main-banner" class="banner-one" data-scroll-index="0">
        @foreach($slides as $slide)
		<div data-src="uploads/{{$slide->photo}}">
			<div class="camera_caption">
				<div class="container">
					<h1 class="wow fadeInUp animated">{{$slide->title}}</h1>
					<p class="wow fadeInUp animated" data-wow-delay="0.2s">{{$slide->tagline}}
                    </p>
					<a data-scroll="" href="#donate" class="btn btn-light btn-radius btn-brd grd1">CONTRIBUTE</a>
				</div> <!-- /.container -->
			</div> <!-- /.camera_caption -->
		</div>
        @endforeach
	</div> <!-- /#theme-main-banner -->


    <div id="about" data-scroll-index="1" class="section wb">
        <div class="container">
            <div class="row">
                @foreach($abouts as $about)
                <div class="col-md-6">
                    <div class="message-box">
                        <h4>Welcome to {{config('app.name')}}  </h4>
                        <h2>My Mission & Values</h2>
                        <blockquote class="lead">{{$about->mission}}</blockquote>

                        <p> {{$about->introduction}} </p>

                        <a href="#blog" data-scroll="" class="btn btn-light btn-radius btn-brd grd1">Know More</a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->

                <div class="col-md-6">
                    <div class="post-media wow fadeIn">
                        <img src="uploads/MP project.png" alt="" class="img-responsive img-rounded"/>
                        <a href="{{$about->media}}" data-rel="prettyPhoto[gal]" class="playbutton"><i class="flaticon-play-button"></i></a>
                    </div><!-- end media -->
                </div><!-- end col -->
                @endforeach
            </div><!-- end row -->

            <hr class="hr1"/> 

	<div id="blog" data-scroll-index="6" class="section lb">
		<div class="container">
			<div class="section-title text-center">
            <span>Know more about</span>
                <h3>{{config('app.name')}}</h3>
                <p class="lead">Hon. {{config('app.name')}} graduated from Masinde Muliro University of Science and Technology (MMUST) with a Bachelor of
                     Science(Business Management). She worked as a Business Development Officer (BDO) at Kenya Women Finance Trust (KWFT)
                      and later took charge of Western Region as a Financial Advisor for Faulu where she learnt about mobilization of women,
                      training them and capacity to assess business that can be financed. Currently in the county assembly she is the vice chairperson of the catering and health club committee
                    , a member of the health and sanitation committee and also member of the public service and administration 
                    committee.
                </p>
            </div>
			
			<div class="row">
                @foreach($moreabouts as $about)
				<div class="col-md-4 col-sm-6 col-lg-4" style="margin-bottom:50px;">
					<div class="post-box">
						<!-- <div class="post-thumb">
							<img src="uploads/{{$about->photo}}" class="img-responsive" alt="post-img"/>
							<div class="date">
								<span>{{$about->text}}</span>
							</div>
						</div> -->
						<div class="post-info">
							<h4>{{$about->attribute}}</h4>

							<p>{{$about->description}}</p>
						</div>
					</div>
				</div>
                @endforeach
				<div class="col-md-4 col-sm-6 col-lg-4">
					<div class="post-box">
						<div class="post-thumb">
                        <img src="uploads/church2.jpg" class="img-responsive" alt="post-img"/>
							<div class="date">
								<span>I submit to GOD</span>
							</div>
						</div>
						<div class="post-info">
							<h4>GOD and Better LEADERSHIP</h4>

							<p>I trust in GOD and strongly hold that he has the answers to our prayers.
                                 YOU, my people, hold the key to success, you lead the way as I serve you.
                                  And as long as GOD is on our side, count on success.</p>
						</div>
					</div>
				</div>   
                
                <div class="col-md-4 col-sm-6 col-lg-4">
					<div class="post-box">
						<div class="post-thumb">
                        <img src="uploads/together.jpg" class="img-responsive" alt="post-img"/>
							<div class="date">
								<span>Pamoja</span>
							</div>
						</div>
						<div class="post-info">
							<h4>Together We Can Do More</h4>

							<p>Working together creates a tenfold energy; synergy. Working together
                                 taps into positive energy with spar our growth. We generate better
                                  ideas together, we plan better together, we accomplish projects better
                                   together, and we celebrate success better together.</p>
						</div>
					</div>
				</div>   

                <div class="col-md-4 col-sm-6 col-lg-4">
					<div class="post-box">
						<div class="post-thumb">
							<img src="uploads/all.jpg" class="img-responsive" alt="post-img"/>
							<div class="date">
								<span>Inclusivity</span>
							</div>
						</div>
						<div class="post-info">
							<h4>Empowerment</h4>

							<p>All our youth, women, and men ask for is empowerment. I hear you. Just make your vote count. 
                                I will ensure all are served equally, East to West, North to South.</p>
						</div>
					</div>
				</div>   
			</div>
			
		</div>
	</div>

        </div><!-- end container -->
    </div><!-- end section -->

    <div class="section nopad">
        <img src="uploads/index.html" alt="" class="img-responsive"/>
    </div>

    <div id="issues" data-scroll-index="2" class="section lb">
        <div class="container">
            <div class="section-title text-left">
                <h3>Issues &amp; Plans</h3>
                <p class="lead">{{config('app.name')}} has a well-laid out plan regarding her political agenda within Mumias West constituency.<br/> Her key areas to address are clearly outlined.</p>
            </div><!-- end title -->

            <div class="row">
                @foreach($pledge as $pleg)
				<div class="col-md-5">
                    <div class="issuse-wrap2 clearfix">
                        <img src="uploads/{{$pleg->photo}}" alt="" class="img-responsive img-rounded"/>
                        <!-- <h4>"{{$pleg->pledge}}"</h4>
                        <p>{{$pleg->details}}</p> -->
                    </div><!-- end issue -->
                </div>
                @endforeach
                <!-- end col -->
                <div class="col-md-7">
                    @foreach($pledge as $pledge)
                    <div class="issuse-wrap2 clearfix">
                        <h4>"{{$pleg->pledge}}"</h4>
                        <p>{{$pleg->details}}</p>
                    </div><!-- end issue -->
                    @endforeach
                    @foreach($issues as $issue)
                    <div class="issuse-wrap clearfix">
                        <img src="uploads/{{$issue->photo}}" alt="" class="img-responsive img-rounded alignleft"/>
                        <h4 style="text-transform:uppercase;">{{$issue->name}}</h4>
                        <p>{{$issue->details}}</p>
                    </div><!-- end issue -->
                    @endforeach
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    @if($events = null)
    @elseif($events != null)
    <div id="event" data-scroll-index="3" class="section wb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Latest Events</h3>
                <p class="lead">Follow Hon. {{config('app.name')}} as she embarks on the journey to bettering her community.
                </br> Stay updated on the upcoming or latest events. 
                </p>
            </div><!-- end title -->

            <div class="row">
                @foreach($events as $event)
                <div class="col-md-4">
                    <div class="participate-wrap">
                        <small>{{$event->category}}</small>
						<figure>
							<img src="uploads/{{$event->photo}}" alt="" class="img-responsive"/>
							<figcaption><a href="#" class="global-radius"> <i class="flaticon-unlink"></i> </a></figcaption>
						</figure>
						<div class="event_dit">
							<h4>{{$event->title}}</h4>
							<ul>
								<li> <a href="#"> <i class="fa fa-calendar"></i> {{$event->date}} </a> </li>
								<li> <a href="#"> <i class="fa fa-clock-o"></i> {{$event->start_time}} to {{$event->end_time}} </a>  </li>
								<li> <a href="#"> <i class="fa fa-map-marker"></i> {{$event->venue}} </a> </li>
							</ul>
							<p>{{$event->details}}</p>
							<a href="event-detail.html" class="btn btn-light btn-radius btn-brd grd1">Detail</a>
						</div>
                    </div><!-- end participate -->
                </div><!-- end col -->
                @endforeach

            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
    @endif
	
	<div id="gallery" data-scroll-index="4" class="section lb">
		<div class="container">
			<div class="section-title text-center">
                <h3>Gallery</h3>
                <p class="lead">Wish to join our political cause? Take a virtual tour now, <br/> 
                See for yourself.</p>
            </div>
			
			<div class="gallery-menu row">
				<div class="col-md-12">
					<div class="button-group filter-button-group text-center">
						<button class="active" data-filter=".gal_0">All</button>
						<button data-filter=".gal_a">Meeting</button>
						<button data-filter=".gal_b">Events</button>
						<button data-filter=".gal_c">Campaign</button>
						<button data-filter=".gal_d">Agenda</button>
					</div>
				</div>
			</div>
			
			<div class="gallery-list row">
                @foreach($photos as $photo)
                @if(count($photos))
				<div class="col-md-4 col-sm-6 gallery-grid gal_0">
					<div class="gallery-single fix">
						<img src="uploads/{{$photo->photo}}" class="img-responsive" alt="Image"/>
						<div class="img-overlay">
							<a href="uploads/{{$photo->photo}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><img src="images/logos/logo.png" alt="image"/></a>
						</div>
					</div>
				</div>
                @endif
                @endforeach
				
                @foreach($photos as $photo)
                @if($photo->category == 'Meeting')
				<div class="col-md-4 col-sm-6 gallery-grid gal_a">
					<div class="gallery-single fix">
						<img src="uploads/{{$photo->photo}}" class="img-responsive" alt="Image"/>
						<div class="img-overlay">
                            <a href="uploads/{{$photo->photo}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><img src="images/logos/logo.png" alt="image"/></a>
						</div>
					</div>
				</div>
                @endif
				@endforeach

                @foreach($photos as $photo)
                @if($photo->category == 'Event')
				<div class="col-md-4 col-sm-6 gallery-grid gal_b">
					<div class="gallery-single fix">
						<img src="uploads/{{$photo->photo}}" class="img-responsive" alt="Image"/>
						<div class="img-overlay">
                            <a href="uploads/{{$photo->photo}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><img src="images/logos/logo.png" alt="image"/></a>
						</div>
					</div>
				</div>
				@endif
                @endforeach

                @foreach($photos as $photo)
                @if($photo->category == 'Politics')
				<div class="col-md-4 col-sm-6 gallery-grid gal_c">
					<div class="gallery-single fix">
						<img src="uploads/{{$photo->photo}}" class="img-responsive" alt="Image"/>
						<div class="img-overlay">
                            <a href="uploads/{{$photo->photo}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><img src="images/logos/logo.png" alt="image"/></a>
						</div>
					</div>
				</div>
				@endif
                @endforeach

                @foreach($photos as $photo)
                @if($photo->category == 'Agenda')
				<div class="col-md-4 col-sm-6 gallery-grid gal_d">
					<div class="gallery-single fix">
						<img src="uploads/{{$photo->photo}}" class="img-responsive" alt="Image"/>
						<div class="img-overlay">
                            <a href="uploads/{{$photo->photo}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><img src="images/logos/logo.png" alt="image"/></a>
						</div>
					</div>
				</div>
                @endif
                @endforeach
				
			</div>
			</div>
		</div>
	
    @if($news = null)
    @elseif($news != null)    
        <div id="media" data-scroll-index="5" class="section wb">
        <div class="container">
            <div class="section-title text-center">
                <h3>News & Media</h3>
                <p class="lead">Together we can be involved in the coming Elections in August 2022 .<br/> Tujiandikishe leo.</p>
            </div>

            <div class="row">
                @foreach($news as $new)
                <div class="col-md-4">
                    <div class="issuse-wrap2 clearfix">
                        <div class="post-media wow fadeIn">
                            <img src="uploads/news/{{$new->photo}}" alt="" class="img-responsive img-rounded"/>
                            <a href="{{$new->slug}}" data-rel="prettyPhoto[gal]" class="playbutton"><i class="flaticon-play-button"></i></a>
                        </div>
                        <h4>{{$new->headline}}</h4>
                        <p>{{$new->details}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!--end section-->
	


    <div id="donate" data-scroll-index="7" class="section db">
        <div class="container">
            <div class="section-title text-center">
                <h3>Contribute</h3>
                <p class="lead">If you believe in our mission, help us change our community.<br/> Be part of the change.</p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="contact_form">
                        <div id="message"></div>
                        <form id="contactform" class="row">
                        {{csrf_field()}}
                            <fieldset class="row-fluid">
                                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name"/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name"/>
                                </div> -->
                                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email"/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="phone_number" id="phone" class="form-control" placeholder="Your Phone"/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="sr-only">Select Service</label>
                                    <select name="recepient" id="select_service" class="selectpicker form-control" data-style="btn-white">
                                        <option value="12">Contribute For?</option>
                                        <option value="For Politician">For {{config('app.name')}}</option>
                                        <option value="Political Party">Political Party</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount"/>
                                </div>  -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control" readonly="readonly" name="reason" id="comments" rows="6" placeholder="Why you are contributing?(optional)">
                                        Campaign Account No. Paybill 222111
                                        Family Bank Mumias Branch Account No. 081000025848 
                                    </textarea>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center">
                                    <button class="btn btn-light btn-radius btn-brd grd1 btn-block">'Mama Power' - #IpoSiku</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-left">
                    <p class="footer-links">
                        <a href="#main-banner">Home</a>
                        <a href="#">Contact Us</a>
                    </p>
                    <p class="footer-company-name">Copyright. © 2022 <a href="#">MP {{config('app.name')}}</a> 
                    <!-- Design By : 
					<a href="#" title="Bluewave Company">Bluewave Company Limited</a> -->
                    </p>
                </div>

                <div class="footer-right">
                    <!-- <form method="get" action="#">
                        <input placeholder="Subscribe our newsletter.." name="search"/>
                        <i class="fa fa-envelope-o"></i>
                    </form> -->
                    <p class="footer-company-name">Powered by MP {{config('app.name')}}.</p>
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
	<!-- Camera Slider -->
	<script src="js/jquery.mobile.customized.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script> 
	<script src="js/camera.min.js"></script>
	<script src="js/scrollIt.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
    <script src="js/jquery.vide.js"></script>


<include id="includedContent"></include>
  <!-- <script>
  $(function(){
      $("#includedContent").load("https://html.design/demo/htmlads.html"); 
    });
  </script> -->

 
<script type='text/javascript' style='display:none;' async>
__ez.queue.addFile('/detroitchicago/edmonton.webp', '/detroitchicago/edmonton.webp?a=a&cb=0&shcb=34', true, ['/detroitchicago/minneapolis.js'], true, false, false, false);
__ez.queue.addFile('/porpoiseant/jellyfish.webp', '/porpoiseant/jellyfish.webp?a=a&cb=0&shcb=34', false, [], true, false, false, false);
</script>

<script>var _audins_dom="html_design",_audins_did=317139;__ez.queue.addDelayFunc("audins.js","__ez.script.add", "../../../go.ezoic.net/detroitchicago/audins0d9f.js?cb=195-0");</script><noscript><div style="display:none;"><img src="../../../pixel.quantserve.com/pixel/p-31iz6hfFutd16d537.gif?labels=Domain.html_design,DomainId.317139" border="0" height="1" width="1" alt="Quantcast"/></div></noscript>
<script type="text/javascript" data-cfasync="false"></script>
<script>__ez.queue.addFile('../../tardisrocinante/vitals.js', '../../tardisrocinante/vitals5038.js?gcb=0&amp;cb=3', false, ['/detroitchicago/minneapolis.js'], true, false, true, false);</script></body>
</html>