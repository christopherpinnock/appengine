
<!doctype html>
<html class="max-h" lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="/css/styles.css?r=l">
		<!-- Bootstrap CSS <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
        
	    <title>Hello World</title>
	 
	</head>
	<body class="max-h rel-pos">
		<script type="text/javascript">
			<!--
			var mob=!/(mobi|android)/i.test(navigator.userAgent);//Check if mobile
			//Insert mobile stylesheet with responsive styling if user is on mobile
			(function(d,m){
				if(m){
					var t = d.getElementsByTagName('title')[0],
				    s = d.createElement('link');
				    s.rel = 'stylesheet';
				    s.href = '/css/mobile.css';
				    t.parentNode.insertBefore(s,t);
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
				    	hideMenu();
				    });
				    addClickTouchListener(doc.querySelector('#get-main-menu'), function(e){//Menu icon; show dropdown lists of links
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
			    		//Touchstart/click events might fire twice on devices
			    		//that support both so check event type
			    		if(e.type == 'touchstart'){
			    			handleEv();
			    		}else{
			    			handleEv();
			    		}
			    		function handleEv(){//Check for pushState support and update page content
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
			    /*Adds device specific event (s)
			    @param (el) - DOM element that event will be added to
			    @param (listener) - function call back function*/
			    function addClickTouchListener(el, listener){
			    	if(mob){
			    		el.onclick = ontouchstart = listener;
			    	}else{
			    		el.onclick = listener;
			    	}
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
				services:function(){
					var l = this;
					l.mainContent().innerHTML = l.nonDeScript;
				},
				gallery:function(){
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
				contact:function(){
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
						var title;
						var q = '';
						var currentField;
						input.className = 'form-fields-container form-fields pad color rel-pos';
						if(c != 'phone'){
							q = '<span class="err abs-pos required">*</span>';
						}
						q += '<div class="';
						if(c == 'captcha'){
							title = h.title(1,99);
						}else{
							title = h.title;
						}
						q += c == 'message' ? c : 'input';
						q += '-sub-wrapper"><';
						q += c == 'message' ? 'textarea' : 'input';
						q += ' class="max-w max-h contact-fields" id="';
						q += c;
						q += '" name="' + c + '"';
						if(c != 'message'){
							q += ' value="' + title +'"'; 
						}
						q += '>';
						if(c == 'message'){
						 	q += title + '</textarea>';
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
						currentField = doc.getElementById(c);
						currentField.onfocus = function(){
							var elem = this,
							y = sortTitle(elem.id + ''),
							wrapper = elem.parentNode; 
							contactFieldsBorder = wrapper.parentNode;
							contactFieldsBorder.style.borderColor = '#808080';
							if(elem.value.toLowerCase() == y.toLowerCase()){
								elem.value = '';
								elem.style.color = '#000000';
							}
							
						}
						currentField.onblur = function(){
							var elem = this,
							val = elem.value.toLowerCase(),
							f = elem.id + '',
							y = sortTitle(f);
							contactFieldsBorder.style.borderColor = '#c0c0c0';
							if(val == '' || val == y.toLowerCase()){
								elem.value = y;
								elem.style.color='#acacac';
								if(f == 'message'){
									var txtLen = doc.getElementById(f + '-len');
								    txtLen.style.color = '#acacac';
								    txtLen.innerHTML = '50';
								}
							}else{
								var err = fields[f].validate(val);
								if(err){
									doc.getElementById(f + '-err').innerHTML = err;
								}
								if(f == 'message'){
									checkMessageLen(f,val);
								}
							}
						}
					}
					form.appendChild(btn);
					doc.getElementById('contact-form').onsubmit = function (e){//Submit form data to server with ajax
						e.preventDefault();
						disableBtn();//Disable submit button
						//Append sending of message update to contact form
						var b = doc.getElementById('contact-form'),
						sending = doc.createElement('span');
						sending.id = 'message-notifier';
						sending.className = 'abs-pos';
						sending.style.padding = '';
						sending.innerHTML = '<span id="message-notifier-sub-container" style="padding:4px 8px;margin-left:-50%;" class="inline-block center white-color blu-bg">Sending...</span>';
						b.appendChild(sending);
						var xhr = new XMLHttpRequest() || new ActiveXObject('Microsoft.XMLHTTP'), data = l.send;
						 data = Object.keys(data).map(function(k){
						 	return l.encodeData(k) + '=' + l.encodeData(data[k]) 
    		 	         }).join('&');
    		 	         xhr.open('POST',location.protocol + '//' + location.hostname + '/process_message.php',true);
    		 	         xhr.onreadystatechange = function(){
    		 	         	if(xhr.readyState > 3 && xhr.status == 200){ 
    		 	         		var resp = xhr.responseText.trim(),
    		 	         		v = doc.getElementById('message-notifier-sub-container');
    		 	         		if(resp == 'sent'){
    		 	         			v.innerHTML = 'Message sent!';
    		 	         			var k = doc.getElementsByClassName('contact-fields'),
    		 	         			fields = l.contactFields;
    		 	         			for(i = 0; i < k.length; i++){
    		 	         				var m = k[i];
    		 	         				var p = m.id + '';
    		 	         				m.style.color = '#acacac';
								        m.value = p != 'captcha' ? fields[p].title : fields[p].title(1, 99);
    		 	         			}
    		 	         		}else{
    		 	         			v.style.backgroundColor = '#ff0000';
    		 	         			var h, s = l.htmlEntities;
    		 	         			for(h in s){
    		 	         				resp = resp.replace(h, '&' + s[h] + ';');
    		 	         			}
    		 	         			v.innerHTML = resp;
    		 	         			enableBtn();//Enable button so user can potentially send message 
    		 	         		}
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
							checkFields(elem);
							if(id == 'message'){
								checkMessageLen(id, elem.value);
							}
						}
						inputs[i].onkeydown = function(){
							doc.getElementById(this.id + '-err').innerHTML = '';
						}
					}
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
					function checkFields(elem){
						var k = doc.getElementsByClassName('contact-fields'), sanitized = true;
						for(var b = 0; b < k.length; b++){
							var m = k[b].id + '';
							var v=k[b].value + '';
							sanitized = fields[m].keyDown(v.toLowerCase());
							if(sanitized){
								if(m == 'phone' && v== '' || v == l.contactFields[m].title){
									if(l.hasOwnProperty('send') && l.send.hasOwnProperty(m)){
										delete l['send'][m];
									}
									continue;
								}
								if(m!='captcha'){
									if(!l.hasOwnProperty('send')){
										l.send = {};
										l.send[m] = v;
									}else if(l['send'][m] != v){
										l['send'][m] = v;
									}
								}
							}else{
								if(l.hasOwnProperty('send') && l.send.hasOwnProperty(m)){
									delete l['send'][m];
								}
								break;
							}
						}
						l.btn=doc.getElementById('send');
						if(sanitized){
							enableBtn()
						}else{
							disableBtn()
						}
					}
					function enableBtn(){
						btn = l.btn;
						btn.disabled = false;
						btn.style.opacity = '1.0';
		                btn.style.filter = 'alpha(opacity=100)';
					}
					function disableBtn(){
						btn = l.btn;
						btn.disabled=true;
						btn.style.opacity='0.5';
		                btn.style.filter='alpha(opacity=50)';
					}
					function sortTitle(id){
						var title;
						if(id == 'captcha'){
							title = fields[id].setTitle;
						}else{
							title = fields[id].title;
						}
						return title;
					}
				},
				contactFields:{
					name:{
						title : 'John Doe',
						keyDown : function(val){
							return (val != '' && val != this.title.toLowerCase() && /\w/.test(val));
						},
						validate : function(val){
							var err;
							if(val == '' || val == this.title){
								err = 'You did not include a name';
							}else if(!/[a-zA-Z]/m.test(val)){
								err = 'Name must have letters';
							}
							return err;
						},
					},
					email:{
						title : 'someone@example.com',
						keyDown : function(val){
							return val != this.title.toLowerCase() && /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(val);
						},
						validate : function(val){
							var err;
							if(!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(val)){
								err = 'Acceptable email type: ' + this.title;
							}
							return err;
						}
					},
					phone : {
						title : '000-000-000',
						keyDown : function(val){
							return this.checkPhoneNumber(val);
						},
						validate : function(val){
							var l = this,err;
							if(val != '' && !l.checkPhoneNumber(val)){
								err = 'Acceptable phone number type: ' + this.title;
							}
							return err;
						},
						checkPhoneNumber : function(val){
							if(val == '' || val == this.title) return true;
							else if(/^[0-9]{3}[0-9]{3}[0-9]{4}$/.test(val) || /^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/.test(val)) return true;
							else return false;
						}
					},
					subject : {
						title : 'I need your help...',
						keyDown : function(val){
							return (val != '' && val != this.title.toLowerCase( )&& /\w/.test(val));
					    },
						validate : function(val){
							var title = this.title.toLowerCase(), err;
							if(val == title){
								err = 'You must include a subject';
							}else if(!/\w/.test(val)){
								err = 'Subject must include letters';
							}
							return err;
						}
					},
					message : {
						title : 'Type message here...',
						keyDown : function(val){
							return (val != this.title.toLowerCase() && val.length > 50 && /\w/.test(val));
					    },
						validate : function(val){
							var title = this.title.toLowerCase(), err;
							if(val == title){
								err = 'You must include a message';
							}else if(!/\w/.test(val)){
								err = 'Message must include letters';
							}
							return err
						}
					},
					captcha : {
						title : function(min,max){
							min = Math.ceil(min);
                            max = Math.floor(max);
                            var o = Math.floor(Math.random() * (max - min + 1)) + min,
                            p = Math.floor(Math.random() * (max - min + 1)) + min,
                            l=this;
                            var setTitle = o + '+' + p;
                            l.result = o + p;
                            l.setTitle = setTitle;
                            return setTitle;
						},
						keyDown : function(val){
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
				encodeData:function(data){
					return encodeURIComponent(data).replace(/[!'()*]/g, function(c){
						return '%' + c.charCodeAt(0).toString(16);
                    });
                },
                htmlEntities : {
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
