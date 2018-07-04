/* 
 * Developer: Pavel Grebennikov, nekwave@gmail.com
 */
var consoleChat = function(name) {
    this.keyToOpen = 192; //`     (Key codes you can watch at http://help.adobe.com/en_US/AS2LCR/Flash_10.0/help.html?content=00000520.html)
    this.shiftKey = 17; //16 - shift, 17 - control
    this.needPressShift = 1; // 0 - do't need press two buttons for open
    this.chatUrl = 'console_chat/chat.php'; // request new messages and send youres
    this.username = 'Guest'; //guest name
    this.cssClass = 'white'; // '', 'white', 'black'
    this.allowGuest = true; // Send user to auth on site
    this.siteAuthLink = '/auth/';// Auth link
    if (name != undefined && name) {
        this.username = name;
    }
    if (this.username == 'Guest') {
        if (getCookie('chat_last_name')) {
            this.username = getCookie('chat_last_name');
        }
    }
    this.appendOpenButton = 1; // add button on page header to open the chat
    this.resives = 0; // count ajax requests for recive history
    this.messages = new Array(); // history of sended messages
    this.updateTimer = 5000; // time for request history (defaule 5sec)
    this.allowChangeName = 0; // allow change name
    var self = this; 
    
    this.shiftPressed = false;
    
    if (this.appendOpenButton) {
        $(document.body).append('<div id="chat-button"></div>');
        $('#chat-button').on('click',function(){
            self.toggle();
        });
    }
    $(document).on('keydown',function(event) { 
        if (self.displayed) {
            self.input.focus();
        }
        if (self.needPressShift) { // save, shift is down
            if(event.keyCode == self.shiftKey) { 
                self.shiftPressed = true;
            }
        }
    })
    $(document).on('keyup',function(event) {
        if (self.needPressShift) { // save, shift is up
            if(event.keyCode == self.shiftKey) { 
                self.shiftPressed = false;
            }
        } 
        if(event.keyCode == self.keyToOpen) {
            if ((self.needPressShift && self.shiftPressed) || !self.needPressShift) { 
                self.toggle();
            } 
        }
    });
    this.displayed = false;
    this.toggle = function() {
        if (this.displayed) { //hide 
            this.displayed = false;
            this.getNewHistory(1);
            $('#chat').hide();
            $('#chat-button').css('top','0px');
        } else { // show
            if (!this.created) {
                this.getNewHistory(0,!this.created); 
                this.create();
            } else {
                self.historyUpdateTime = setTimeout('self.getNewHistory(0);', self.updateTimer);
            }
            $('#chat').show();
            this.displayed = true; 
            $('#chat-button').css('top',$('#chat').css('height'));
            self.input.focus();
        }
    }
    this.created = false;
    this.input = false;
    this.nowSend = false; 
    this.selectedText = 0;
    this.isAdmin = false;
    this.lastMsg = '';
    $(document).ajaxStart(function() { 
        self.nowSend = 1;
    }); 
    $(document).ajaxStop(function() { 
        self.nowSend = 0;
    }); 
    jQuery.postChat = function(url, data, callback, type) {  
        if (self.nowSend == 1) {
            setTimeout(function(){ 
                jQuery.postChat(url, data, callback, type);
            },100); 
        } else {
            jQuery.post(url, data, callback, type);
        }
    }
    this.create = function(){
        this.created = true; 
        this.input = $(document.body).append('<div id="chat" class="'+self.cssClass+'" style="width:'+$(document).width()+'px;height:'+($(window).height()/2.2)+'px !important;"><div class="chat_history"></div><input type="text"/><a href="#" class="close_chat"></a></div>').css('overflow-x','hidden').find('#chat input');
        $('#chat .close_chat').on('click',function(){
            self.toggle();
            return false;
        });
        this.input.on('keydown',function(event){
            if(event.keyCode == 38) { 
                if (self.messages[self.selectedText] != undefined) {
                    $(this).val(self.messages[self.selectedText]);
                    self.selectedText--;
                } else {
                    if (!self.selectedText) return;
                    self.selectedText = self.messages.length-1;
                    $(this).val(self.messages[self.selectedText]);
                }
            }
            if(event.keyCode == 40) { 
                if (self.messages[self.selectedText] != undefined) {
                    $(this).val(self.messages[self.selectedText]);
                    self.selectedText++;
                } else {
                    if (!self.selectedText) return;
                    self.selectedText = 0;
                    $(this).val(self.messages[self.selectedText]);
                }
            }
            if(event.keyCode == 13){ // enter press
                if (self.username == 'Guest' && !self.allowGuest) {
                    $('#chat .chat_history').append('<p><a href="'+self.siteAuthLink+'">Login to Chat</a></p>');
                    self.scrollChat();
                    return;
                }
                var text = this.value;
                this.value = '';
                for (var i in self.commands) {
                    if (text.indexOf(self.commands[i].name, 0) === 0) {
                        self.nowSend = 0;
                        this.value = '';
                        return self.commands[i].func(text);
                    }
                }
                if (!self.nowSend) {
                    self.sendMessage(text);
                    self.nowSend = 1;
                } else {
                    setTimeout(function(){
                        if (self.nowSend) {
                            self.sendMessage(text);
                            self.nowSend = 1;
                        }
                    },100);
                } 
                
            }
        });
    }
    this.com = {
        help:function(){
            $('#chat .chat_history').append('<p>/help - watch this text</p>');
            $('#chat .chat_history').append('<p>/name - change name</p>');
            $('#chat .chat_history').append('<p>/w %username% %message% - private message(Or /pm %username% %message%)</p>');

            self.scrollChat();
        },
        name:function(command){
            if (!self.allowChangeName) {
                $('#chat .chat_history').append('<p>Change name is not allowed</p>');
                self.scrollChat();
                return;
            }
            var name = $.trim(command.replace('/name', ''));
            if (name.length > 2) {
                self.sendMessage('Change name to ' + name + '',1);
                self.username = name;
                setCookie('chat_last_name', name)
            } else {
                $('#chat .chat_history').append('<p>Name is to short. Min length is 3</p>');
                self.scrollChat();
            }
        },
        admin:function(command){
            var password = $.trim(command.replace('/admin', ''));
            $.postChat(self.chatUrl,{
                url:document.location.href,
                'admin':password,
                'username':self.username
            },function(data){ 
                if (data) {
                    self.resiveChat(data);
                    self.scrollChat();
                } 
            });
        },
        ban: function(command){
            var name = $.trim(command.replace('/ban', ''));
            $.postChat(self.chatUrl,{
                url:document.location.href,
                'admin-command':'banName',
                name:name,
                'username':self.username
            },function(data){
                self.resiveChat(data);
                self.scrollChat();
            });
        },
        banip: function(command){
            var ip = $.trim(command.replace('/banip', ''));
            $.postChat(self.chatUrl,{
                url:document.location.href,
                'admin-command':'banIp',
                ip:ip
            },function(data){
                $('#chat .chat_history').append(data);
                self.scrollChat();
            });
        },
        unbanall: function(command){ 
            $.postChat(self.chatUrl,{
                url:document.location.href,
                'admin-command':'unbanall'
            },function(data){
                $('#chat .chat_history').append(data);
                self.scrollChat();
            });
        },
        unban: function(command){
            var name = $.trim(command.replace('/unban', ''));
            $.postChat(self.chatUrl,{
                url:document.location.href,
                'admin-command':'unban',
                name:name
            },function(data){
                $('#chat .chat_history').append(data);
                self.scrollChat();
            });
        },
        
        bannedips: function(command){ 
            $.postChat(self.chatUrl,{
                url:document.location.href,
                'admin-command':'bannedips'
            },function(data){
                $('#chat .chat_history').append(data);
                self.scrollChat();
            });
        },
        bannednames: function(command){ 
            $.postChat(self.chatUrl,{
                url:document.location.href,
                'admin-command':'bannednames'
            },function(data){
                $('#chat .chat_history').append(data);
                self.scrollChat();
            });
        },
        clear: function(command){ 
            $('#chat .chat_history').html('');
        },
        privateMsg: function(command) {
            $.postChat(self.chatUrl,{
                url:document.location.href,
                'type':'private',
                'msg':command,
                username:self.username
            },function(data){
                $('#chat .chat_history').append(data);
                self.scrollChat();
            });
        }
    }
    this.scrollChat = function(){
        $('#chat .chat_history').animate({
            scrollTop:100000000
        },0);
    }
    this.commands = new Array({
        name:'/help',
        func:this.com.help
    },

    {
        name:'/name',
        func:this.com.name
    },
    
    {
        name:'/w',
        func:this.com.privateMsg
    },
    
    {
        name:'/pm',
        func:this.com.privateMsg
    },

    {
        name:'/admin',
        func:this.com.admin
    },

    {
        name:'/banip',
        func:this.com.banip
    },

    {
        name:'/bannedips',
        func:this.com.bannedips
    },

    {
        name:'/bannednames',
        func:this.com.bannednames
    },

    {
        name:'/ban',
        func:this.com.ban
    },

    {
        name:'/unbanall',
        func:this.com.unbanall
    },

    {
        name:'/clear',
        func:this.com.clear
    },

    {
        name:'/cls',
        func:this.com.clear
    },

    {
        name:'/unban',
        func:this.com.unban
    });
    
    this.sendMessage = function(text,dontSave) { 
        if (dontSave==undefined || dontSave != 1) {
            self.messages[self.messages.length] = text; 
        }
        
        $.postChat(self.chatUrl,{
            url:document.location.href,
            'msg':text,
            'username':self.username
        },function(data){ 
            self.resiveChat(data);
        });
    }
    this.historyUpdateTime = false;
    this.getNewHistory = function(stop,full){
        if (stop) {
            clearTimeout(self.historyUpdateTime)
        } else {  
            self.historyUpdateTime = setTimeout('self.getNewHistory(0);', self.updateTimer);
            if (full != undefined && full) {
                $.postChat(self.chatUrl+'?full',{
                    url:document.location.href,
                    'username':self.username
                },self.resiveChat);
            } else {
                $.postChat(self.chatUrl,{
                    url:document.location.href,
                    'username':self.username
                },self.resiveChat);
            }
            
        }
    }
    this.resiveChat = function(data,clear) {
        if (clear != undefined && clear == 1) {
            $('#chat .chat_history').html('');
        }
        clearTimeout(self.historyUpdateTime);
        self.historyUpdateTime = setTimeout('self.getNewHistory(0);', self.updateTimer);
        if (self.resives == 0) {
            if (self.username == 'Guest' && !self.allowGuest) {
                $('#chat .chat_history').append(data+'<p><a href="'+self.siteAuthLink+'">Login to Chat</a></p>');
            } else {
                $('#chat .chat_history').append(data+'<p>Welcome to Flagship communication terminal...</p>');
            }
        } else {
            $('#chat .chat_history').append(data);
        }
        $('#chat .chat_history p strong').off('click',self.appendAdminMenu);
        $('#chat .chat_history p strong').on('click',self.appendAdminMenu);
        self.scrollChat();
        self.nowSend = 0;
        self.resives++;
    }
    this.appendAdminMenu = function(){
        if ($('#chat .chat_history').next().data('submenu')) {
            $('#chat .chat_history').next().remove();
        }
        console.log($(this).data('user'));
        var data = $(this).data('user');
        var menu = '[<a href="#" onclick="$(this).parent().remove();return false;">x</a>]<br/>'; 
        menu += '<a href="#" onclick="chatAdmin.banName(\''+data.username+'\');return false;">Ban name '+data.username+'</a><br/>';
        menu += '<a href="#" onclick="chatAdmin.banIp(\''+data.ip+'\');return false;">Ban ip '+data.ip+'</a>';
        $('#chat .chat_history').after('<div class="chat-modal" data-submenu="1">'+menu+'</div>');
    }
}
var chatAdmin = {
    deleteMessage: function(id) {
        $('#'+id).html('deleted');
        $.postChat(self.chatUrl,{
            url:document.location.href,
            'admin-command':'deleteMsg',
            id:id
        },function(data){
            $('#chat .chat_history').append(data);
        });
    },
    banName: function(name){
        $.postChat(self.chatUrl,{
            url:document.location.href,
            'admin-command':'banName',
            name:name
        },function(data){
            $('#chat .chat_history').append(data);
        });
    },
    banIp: function(ip){
        $.postChat(self.chatUrl,{
            url:document.location.href,
            'admin-command':'banIp',
            ip:ip
        },function(data){
            $('#chat .chat_history').append(data);
        });
    }
}


function getCookie(c_name)
{
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1)
    {
        c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1)
    {
        c_value = null;
    }
    else
    {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1)
        {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start,c_end));
    }
    return c_value;
}

function setCookie(c_name,value,exdays)
{
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value;
}