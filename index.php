<?php
if(@parse_url($_SERVER['REQUEST_URI'])['path']=='/process_message.php') {
	require  'process_message.php';
	exit;
	
}
?>
<!doctype html>
<html class="max-h" lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="Description" content="Responsive Web template">
		<meta name="Keywords" content="Web template, responsive template, mobile friendly template">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="/css/styles.css?=1">
		<!-- Bootstrap CSS <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
        
	    <title>Hello World</title>
	 
	</head>
	<body class="max-h rel-pos">
		<script type="text/javascript">
			<!--
			var mob=/(mobi|android)/i.test(navigator.userAgent);//Check if mobile
			//Insert mobile stylesheet with responsive styling if user is on mobile
			(function(d,m){
				if(m){
					var t = d.getElementsByTagName('title')[0],
				    s = d.createElement('link');
				    s.rel = 'stylesheet';
				    s.href = '/css/mobile.css';
				    t.parentNode.insertBefore(s,t);
				}
				String.prototype.capitalize=function(){//Capitalize first letter of string
					return this.charAt(0).toUpperCase() + this.slice(1);
                }
			})(document,mob);
			//-->
		</script>
		<div id="main-container" class="w-bg main-center">
			<div id="nav"></div>
		    <div id="main-content" class="main-pad"></div>
		</div>
		<div id="footer" class="no-overflow main-pad main-center">
			<ul id="social" class="float-right lft10">
				<li class="inline-block"><a href="http://facebook.com" id="fb" class="sprite fb24 social" target="_blank">Facebook</a></li>
				<li class="inline-block"><a href="http://twitter.com" id="tw" class="sprite tw24  lft10 social" target="_blank">Twitter</a></li>
			</ul>
			<div>&copy; <span id="curYr"></span></div></div>
		<script type="text/javascript">
			<!--
			/*All page alterations happen here
			@param (pages) - object used to update site based on specific events
			@param (win) - window object
			@param (pushState) - check for pushState support*/
			(function(pages,win,pushState){
				var	doc=pages.doc,
				i=0,c,g='',
				popState,//Null popstate is set by browser on page load so this var will be used to check if popstate is a result of user action
				link=location.href,//Current uri
				path=currentFile(link,1),//Get path of current file
				nav=doc.getElementById('nav'),//Main navigation
				body=doc.getElementsByTagName('body')[0];//Body 
		        doc.getElementById('curYr').innerHTML = new Date().getFullYear();//Insert current date beside copyright symbol
		        //Iteratate over links object, setting property as current file and name as url text
		        for(c in pages.links){
		        	if(pages.links.hasOwnProperty(c)){
		        		if(mob && c == 'home'){//Home link only in main nav on mobile (not a part of dropdown )
		        			continue;
		        		}
		        		g += '<a class="main-link d-block';
		        	    if(!mob){//Only center link text and make flexible if not on mobile
		        	    	g += ' flex-link center';
		        	    }
		        	    //Highlight link only if user is on desktop
		        	    //'hightlight home link if there's no path and property c == 'home''
		        	    if(!mob && ((!path && c == 'home') || path == c)){
		        	    	g += ' active';
		        	    }
				        g+='" href="/';
				        if(c != 'home'){//Only set path if property != home
				        	g+=c;
				    	}
				        g += '">';
				        if(mob){//Add respective icon to link text if mobile
				        	g += '<span class="sprite ' + c + '13"></span> ';
				        }
				        g += pages.links[c];//Link's name as text
				        g += '</a>';
				    }
				}
			    if(mob){
			    	var linkCon = doc.createElement('div'),//Dropdown list of links wrapper
			    	scrn=doc.createElement('div'),//Black screen - sits below dropdown menu and spans entire screen
			    	menu,//Holds menu element on menu icon is clicked
			    	r=body.firstChild,links,
			    	pageTitle = '<h2 id="mob-page-title" class="center no-overflow no-white-space ellip"></h2>';//Title of page is lo ated in nav (#nav) on mobile
			    	linkCon.className = 'link-container hide max-h w-bg abs-pos';
				    linkCon.id = 'link-container';
				    linkCon.innerHTML = '<span id="remove-menu" class="inline-block float-right">x</span>' + g;//Add list of links/popup 'x' remover
				    body.insertBefore(linkCon,r);
				    scrn.id = 'scrn';
				    scrn.className = 'max-w max-h abs-pos opacity hide abs-pos';
				    body.insertBefore(scrn,r);
				    //Add home/menu icons and page title container to nav element
				    nav.innerHTML = '<a class="main-link sprite home16 float-right" href="/">Home</a><span style="float:left;" id="get-main-menu" class="sprite menu16">Menu</span>' + pageTitle;
				    nav.className = 'no-overflow w-bg';
				    menu = doc.getElementById('link-container');
				    scrn = doc.getElementById('scrn');
				    addClickTouchListener(doc.querySelector('#scrn'), function(e){//Clicks/touches black screen
				    	e.stopPropagation();
				    	hideMenu();
				    });
				    addClickTouchListener(doc.querySelector('#get-main-menu'), function(e){//Menu icon; show dropdown lists of links
				    	e.stopPropagation();
				    	menu.style.display = 'block';
				    	scrn.style.display = 'block';
				    	body.style.overflow = 'hidden';
				    });
				    addClickTouchListener(doc.querySelector('#remove-menu'),function(e){//Hide menu
				    	e.stopPropagation();
				    	hideMenu();
					
				    });
				    function hideMenu(){//Hides dropdown list of links
				    	menu.style.display = 'none';
				    	scrn.style.display = 'none';
				    	body.style.overflow = 'auto';
				    }
			    }else{
			    	nav.className = 'link-container flex';
				    nav.innerHTML = g;
			    }
			    //Get links and add touchstart/click events
			    links=doc.querySelectorAll('.main-link');
			    for(i = 0; i < links.length; i++){//Add click event to main link
			        addClickTouchListener(links[i], function(e){
			    		e.stopPropagation();
			    		//Only set handler if start/end positions are the same
			    		//This prevents trigger of handle if user swipes/scroll
			    		if(e.type == 'touchstart'){
			    			var touch = e.targetTouches,//List of touches
			    			positionX = touch[touch.length-1].pageX;//Start position
			    			//Add touch events to DOM that has touchstart event attached
			    			e.target.ontouchend = function(e){
			    				var endTouch = e.targetTouches;
			    				if(endTouch[endTouch.length-1].pageX == positionX){//Set handler if start/end positions are the same
			    					handleEv(e);
			    				}
			    			}
			    		}else{
			    			handleEv(e)
			    		}
			    	});
			    }
			    //Add popstate event if supported
			    if(pushState){
			    	win.onpopstate = function(e){
				         if(popState === true){//Make sure current state was set by user
				         	link = doc.location;
				         	activeLink(link);
				            currentFile(link, '', 1);
				         }
			        }
			    }
			    /*//Detect current file
			    @param (href) - current page's uri 
			    @param (r) - boolean used to check if path should be return
			    @param (content) - boolean used to check if page's content should be updated*/
			    function currentFile(href,r,content){
			    	path = href.match(/([^\/]*)\/*$/)[1];//Path portion of uri
					if(!path){//Assume path is home if empty
						path = 'home';
					}
					if(content){//Get page content
						var title = 'Home',//Default doc title
						d, 
						u = pages.mainContent();//Main content container
						//Show updated content if path is content worthy
						if(['about', 'services', 'gallery', 'directions', 'contact'].indexOf(path) != '-1'){
							pages[path]();
							title = pages.links[path];//Update doc title with link name
						}else{//Path is not content worthy, then show home page content
							u.innerHTML = '<h1 style="margin-top:10px;" class="center">Welcome</h1>';
						}
						doc.title = title;//Update doc title 
						if(mob){
							d = doc.getElementById('mob-page-title');//Title wrapper in nav on mobile
							d.innerHTML = '';//Empty element is default
							if(title != 'Home'){//Update title if not on home page
								d.innerHTML = title;
							}
						}else if(title != 'Home'){//Desktop so title is apart of main content
							var t = doc.createTextNode(title);							
							d = doc.createElement('h1');
							d.appendChild(t);
							u.insertBefore(d, u.getElementsByTagName('div')[0]);//Insert title atop main content
							
						}
					}
					if(r)return path//Return current file
			    }
			    /*//Add active class to main link when clicked
			    @param (elem) - DOM of clicked/touched link*/
			    function activeLink(elem){
			    	if(!mob){//Highlight link only if user is not on mobile
			    		var cName = elem.className,//Classes of link
				        parent = elem.parentNode,//Links's parent 
				        a = parent.getElementsByTagName('a');//Parent's children links
				        //Iterate over links
				        for(i = 0; i < a.length; i++){
				        	var b = a[i];//Link
					        var c = b.className;//Link classes
					        if(/(?:active)/.test(c)){//Check if link has hightlight class and remove
					        	b.className = c.replace('active','').trim();
					        }
					    }
				        if(!/(?:active)/.test(cName)){//Add highlight class if absent from clicked link
				        	cName += ' active';
				        }
				        elem.className = cName;//Update link class with active class
			    	}
			    	if(mob){//Hide dropdown menu in user is on mobile
				    	hideMenu();
					}
			    }
			    function handleEv(e){//Handles .main-link events
			    	//Check for pushState support and update page content
					if(pushState){
						e.preventDefault();
						link = e.target;
					    var href = link.href;
					    path = currentFile(href, 1, 1);				    
					    history.pushState({'page' : path}, '', href);//Add current uri to browser's history stack
					    activeLink(link);//Add respective content and hightlight current link
					    popState=true;//User sets browser's history
					}
			    }
			    /*Adds device specific event (s)
			    @param (el) - DOM element that event will be added to
			    @param (listener) - function call back function*/
			    function addClickTouchListener(el, listener){
			    	el.onclick = ontouchstart = listener;
			    }
			    currentFile(link, '', 1);
			})({
				doc: document,
				px: 'px',
				imgSrc: '/images/',
				photos: ['accident','bar','castle','clock','empirestate','fireman','fireworks','food','house','lock','manonbridge','nyc-buildings','passport','station','statueofliberty','takepicture'],
				mainContent: function(){
					return this.doc.getElementById('main-content');
				},
				links : {
					'home' : 'Home',
				    'about' : 'About Us',
				    'services' : 'Services',
				    'gallery' :'Gallery',
				    'directions' :'Directions',
				    'contact' : 'Contact Us'
				},
				nonDeScript : "<div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</div>",
				home : function(){
					var l = this;
					l.mainContent().innerHTML = l.nonDeScript;
				},
				about : function(){
					var l = this;
					l.mainContent().innerHTML = l.nonDeScript;
				},
				services : function(){
					var l = this;
					l.mainContent().innerHTML = l.nonDeScript;
				},
				gallery : function(){
					var j = 0,t = 1, temp = null, l=this, doc=l.doc, photos=l.photos,len = photos.length,u=l.mainContent(), g='';
                    for(i = len - 1; i > 0; i -= 1){
                    	j = Math.floor(Math.random() * (i + 1))//Random array index
                        temp = photos[i];//Current index
                        photos[i] = photos[j];//Swap current index with random index
                        photos[j] = temp;//Swap random index with current index
                    }
                    u.innerHTML = '<div id="photo-container" class="flex"></div>';
                    u= doc.getElementById('photo-container');
                    for(; t <= len;){
                    	g += '<img src="';
                        g += l.imgSrc;
                        g += 'gallery/';
                        g += photos[t-1];
                        g += '.jpg" width="100%">';
                        if( (t%4) == 0){
                        	var p = doc.createElement('div');
                        	p.className = 'photos-wrapper';
                        	p.innerHTML = g;
                        	u.appendChild(p);
                        	g = '';
                        }
						t++;
					}
				},
				directions : function(){
					var l = this;
					l.mainContent().innerHTML = l.nonDeScript;
				},
				contact : function(){
					var l = this, fields,
					doc=l.doc , c, form, btn,
					contactFieldsBorder, inputs,
					btnClass='opacity bold center no-overflow no-white-space grn form-fields white-color ',
					g = '<div id="contact"><h3>Your Business, Inc</h3>';
					g += '<address>100 Business Street<br>Business City, State 01000</address>';
					g += '<div>Phone: 000-000-0000</div>';
					g += '<div>Fax: 000-000-0000</div>';
					g += '<div>Email: <a href="mailto:business@example.com">business@example.com</a></div>';
					g += '<form method="post" action="/" id="contact-form" class="form-fields rel-pos"><div><sup class="err">*</sup> required fields</div></form></div>';
					l.mainContent().innerHTML = g;
					form = doc.getElementById('contact-form');
					btn = doc.createElement('button');
					fields = l.contactFields;
					btnClass += mob ? 'd-block max-w' : 'inline-block'
					btn.className = btnClass;
					btn.disabled = true;
					btn.id = 'send';
					btn.type = 'submit';
					btn.innerHTML = 'Send Message';
					for(c in fields){
						c = c + '';
						var input = doc.createElement('div');
						var h = fields[c];
						var val;
						var q = '';
						var currentField;
						input.className = 'form-fields-container form-fields pad color rel-pos';
						if(c != 'phone'){
							q = '<span class="err abs-pos required">*</span>';
						}
						q += '<div class="';
						if(c == 'captcha'){
							val = h.val(1,99);
						}else{
							val = h.val.capitalize();
						}
						q += c == 'message' ? c : 'input';
						q += '-sub-wrapper"><';
						q += c == 'message' ? 'textarea' : 'input';
						q += ' class="max-w max-h contact-fields" id="';
						q += c;
						q += '" name="' + c + '"';
						if(c != 'message'){
							q += ' value="' + val +'"'; 
						}
						q += '>';
						if(c == 'message'){
						 	q += val + '</textarea>';
						 }
						q += '</div><div class="err" id="';
						q += c;
						q += '-err"></div>';
						input.innerHTML = q
						form.appendChild(input);
						if(c == 'message'){
							var txtLen = doc.createElement('div');
							txtLen.className = 'color align-right no-overflow no-white-space ellip';
							txtLen.style.color = '#acacac';
							txtLen.innerHTML = 'Min. characters: <span class="inline-block" id="' + c + '-len">50</span>';
							form.appendChild(txtLen);
						}
						currentField = doc.getElementById(c);//Get just-attached form field
						currentField.onfocus = function(){
							//Fields outline is disabled and border set to 0. As a result, fields wrapper border
							//masquerade as fields border
							//Wrapper border highlighted on hover/focus dynamically
							var elem = this,
							y = sortVal(elem.id + ''),//Use element id to field-specific title
							wrapper = elem.parentNode; //Immediate parent of form field (see use immediately below)
							contactFieldsBorder = wrapper.parentNode;//Element for border change
							contactFieldsBorder.style.borderColor = '#808080';//Highlight wrapper border color
							//Set value to empty if field value==default value and change font color to black
							if(elem.value.toLowerCase() == y){
								elem.value = '';
								elem.style.color = '#000000';
							}
						}
						currentField.onblur = function(){
							var elem = this,
							val = elem.value.toLowerCase(),
							f = elem.id + '',
							y = sortVal(f);
							contactFieldsBorder.style.borderColor = '#c0c0c0';//Set wrapper border color to default
							if(val == '' || val == y){//Set to default color/value if value is empty/default 
								elem.value = y;
								elem.style.color='#acacac';
                                //Update strLen container with defaults if message field 
								if(f == 'message'){
									var txtLen = doc.getElementById(f + '-len');
								    txtLen.style.color = '#acacac';
								    txtLen.innerHTML = '50';
								}
							}else{
								//Check for and display error
								var err = fields[f].validate(val);
								if(err){
									doc.getElementById(f + '-err').innerHTML = err;
								}
								if(f == 'message'){//Update current strLen if message field 
									checkMessageLen(f,val);
								}
							}
						}
					}
					form.appendChild(btn);//Append button to end of form
					//Form submitted with ajax
					doc.getElementById('contact-form').onsubmit = function (e){
						e.preventDefault();
						disableBtn();//Disable submit button
						//Append sending of message update to contact form
						var b = doc.getElementById('contact-form'),
						xhr = new XMLHttpRequest() || new ActiveXObject('Microsoft.XMLHTTP'), 
						data = l.send,//Object with form values
						sending = doc.createElement('span');
						sending.id = 'message-notifier';
						sending.className = 'abs-pos';
						sending.style.padding = '';
						sending.innerHTML = '<span id="message-notifier-sub-container" style="padding:4px 8px;margin-left:-50%;" class="inline-block center white-color blu-bg">Sending...</span>';
						b.appendChild(sending);
						//Set query str as property = value and encode before data is 
						//sent to server
						data = Object.keys(data).map(function(k){
						 	return l.encodeData(k) + '=' + l.encodeData(data[k]);
    		 	         }).join('&');
    		 	         xhr.open('POST',location.protocol + '//' + location.hostname + '/process_message.php',true);
    		 	         xhr.onreadystatechange = function(){
    		 	         	if(xhr.readyState > 3 && xhr.status == 200){ 
    		 	         		var resp = xhr.responseText.trim(),
    		 	         		v = doc.getElementById('message-notifier-sub-container');//Message progress element
    		 	         		if(resp == 'sent'){//Message sent successfully
    		 	         			v.innerHTML = 'Message sent!';
    		 	         			//Update fields with default value/color
    		 	         			var k = doc.getElementsByClassName('contact-fields'),
    		 	         			fields = l.contactFields;
    		 	         			for(i = 0; i < k.length; i++){
    		 	         				var m = k[i];
    		 	         				var p = m.id + '';
    		 	         				m.style.color = '#acacac';
								        m.value = p != 'captcha' ? fields[p].val.capitalize() : fields[p].val(1, 99);
    		 	         			}
    		 	         		}else{//Message fail
    		 	         			v.style.backgroundColor = '#ff0000';
    		 	         			//Sanitize server response before appended to DOM
    		 	         			var h, s = l.htmlEntities;
    		 	         			for(h in s){
    		 	         				resp = resp.replace(h, '&' + s[h] + ';');
    		 	         			}
    		 	         			v.innerHTML = resp;
    		 	         			enableBtn();//Enable button so user can potentially send message 
    		 	         		}
    		 	         		//Remove notifier after 3sec
    		 	         		setTimeout(function(){
    		 	         			b.removeChild(doc.getElementById('message-notifier'));
    		 	         		},3000);
    		 	         	}
                         }
    		 	         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    		 	         xhr.send(data);
					}
					inputs = doc.getElementsByClassName('contact-fields');
					for(i = 0; i<inputs.length; i++){
						inputs[i].onkeyup = function(){
							var elem = this,
							id = elem.id
							checkFields();//Check if submit button can be disabled
							if(id == 'message'){//Update strLen if message
								checkMessageLen(id, elem.value);
							}
						}
						//Empty error element onkeydown
						inputs[i].onkeydown = function(){
							doc.getElementById(this.id + '-err').innerHTML = '';
						}
					}
					/*Alert user of message length
					Message length must be > 50 before submit button can be disabled
					@param (f) field's id
					@param (v) string to check against*/
					function checkMessageLen(f, v){
						var len = v.length,
						txtLen = doc.getElementById(f + '-len');
						txtLen.innerHTML = len;
						if(len > 50){
							txtLen.style.color = '#006600';
						}else{
							txtLen.style.color = '#ff0000';
						}
					}
					/*Validated all fields, update object with fields that will be sent with
					ajax and enable sumbit button if criteria met
					 */
					function checkFields(){
						var k = doc.getElementsByClassName('contact-fields'), 
						validate = true;//Submit button will be enabled if validate comes out 'true' after checks
						for(var b = 0; b < k.length; b++){
							var m = k[b].id + '';//Field id
							var v=k[b].value + '';//Field value
							validate = fields[m].keyDown(v.toLowerCase());//Validate field with respective validation keydown method 
							if(validate){//Field passed validation
							    /*Phone not required so field could have passed validation if field was empty or had default value
							    Check if field is phone and delete previous phone property (if previously set) query string 
							    object if current value is empty or default*/
								if(m == 'phone' && (v == '' || v == fields[m].val)){
									if(l.hasOwnProperty('send') && l.send.hasOwnProperty(m)){
										delete l['send'][m];
									}
									continue;
								}
								if(m!='captcha'){//Captcha not apart of query string
								    //Create object if doesn't exist 
									if(!l.hasOwnProperty('send')){
										l.send = {};
										l.send[m] = v;
									}else if(l['send'][m] != v){//set new value if different from old value
										l['send'][m] = v;
									}
								}
							}else{
								//Delete old property if current value failed validation
								if(l.hasOwnProperty('send') && l.send.hasOwnProperty(m)){
									delete l['send'][m];
								}
								break;
							}
						}
						l.btn=doc.getElementById('send');//Set send button DOM to object main object property
						//Enable button if validate is true, disable if false
						if(validate){
							enableBtn()
						}else{
							disableBtn()
						}
					}
					function enableBtn(){//Enable button for submission
						btn = l.btn;
						btn.disabled = false;
						btn.style.opacity = '1.0';
		                btn.style.filter = 'alpha(opacity=100)';
					}
					function disableBtn(){//Disable submit button
						btn = l.btn;
						btn.disabled=true;
						btn.style.opacity='0.5';
		                btn.style.filter='alpha(opacity=50)';
					}
					/*Get field's default value
					@param (id) - field id value
					 */
					function sortVal(id){
						var val;
						if(id == 'captcha'){
							val= fields[id].setVal;
						}else{
							val = fields[id].val;
						}
						return val;
					}
				},
				/*Form fields operations @propert (name) - name of fields 
				@property (val) - default fields value 
				@property (keydown) - validate fields onkeydown @param (val) - field value 
				@property (validate) - validate fields onblur @param (val) - field value
				@property (captcha) - set captcha that validates to the sum of two integers*/ 
				contactFields:{
					name : {
						val : 'john',
						keyDown : function(val){
							//True if @val not default value and include some letters
							return (val != this.val && /[a-zA-Z]/.test(val));
						},
						validate : function(val){
							var err;
							if(val == '' || val == this.val){
								err = 'You did not include a name';
							}else if(!/[a-zA-Z]/.test(val)){
								err = 'Name must have letters';
							}
							return err;
						},
					},
					email : {
						val : 'someone@example.com',
						keyDown : function(val){
							//True if @val not default value and meets email convention
							return val != this.val && /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(val);
						},
						validate : function(val){
							var err;
							if(!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(val)){
								err = 'Acceptable email type: ' + this.val;
							}
							return err;
						}
					},
					phone : {
						val : '000-000-000',
						keyDown : function(val){
							return this.checkPhoneNumber(val);
						},
						validate : function(val){
							var l = this,err;
							if(val != '' && !l.checkPhoneNumber(val)){
								err = 'Acceptable phone number type: ' + l.val;
							}
							return err;
						},
						checkPhoneNumber : function(val){//Validates phone number
							if(val == '' || val == this.val) return true;
							else if(/^[0-9]{3}[0-9]{3}[0-9]{4}$/.test(val) || /^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/.test(val)) return true;
							else return false;
						}
					},
					subject : {
						val : 'i need your help...',
						keyDown : function(val){
							//True if @val not default value and include some letters
							return (val != this.val && /[a-zA-Z]/.test(val));
					    },
						validate : function(val){
							var value = this.val, err;
							if(val == value){
								err = 'You must include a subject';
							}else if(!/[a-zA-Z]/.test(val)){
								err = 'Subject must include letters';
							}
							return err;
						}
					},
					message : {
						val : 'type message here...',
						keyDown : function(val){
							//True if @val not default value, > 50 and include some letters
							return (val != this.val && val.length > 50 && /[a-zA-Z]/.test(val));
					    },
						validate : function(val){
							var err;
							if(val == this.val){
								err = 'You must include a message';
							}else if(!/[a-zA-Z]/.test(val)){
								err = 'Message must include letters';
							}
							return err
						}
					},
					captcha : {
						val : function(min,max){
							min = Math.ceil(min);
                            max = Math.floor(max);
                            //2 random numbers to add
                            var o = Math.floor(Math.random() * (max - min + 1)) + min,
                            p = Math.floor(Math.random() * (max - min + 1)) + min,
                            l=this;
                            //Default value
                            //Indicate to user that values must added
                            var setVal = o + '+' + p;
                            l.result = o + p;//Adds numbers/value to check against
                            l.setVal = setVal;//Property used to reset default value onblur
                            return setVal;
						},
						keyDown : function(val){
							//True if @val equals to result from adding numbers
							return (val == this.result);
						},
						validate : function(val){
							var err;
							if(val != this.result){
								err = 'Incorrect captcha result';
							}
							return err;
						}
					}
				},
				encodeData:function(d){//Encode @param (d)
					return encodeURIComponent(d).replace(/[!'()*]/g, function(c){
						return '%' + c.charCodeAt(0).toString(16);
                    });
                },
                htmlEntities : {//Replaces html characters with respective properties
                	'<' : 'lt',
                	'>' : 'gt', 
                	"'" : '#39',
                	'"' : 'quot',
                	'&' : 'amp'
                }
            },window,history.pushState?true:false);
			
			//-->
		</script>
	</body>
</html>
