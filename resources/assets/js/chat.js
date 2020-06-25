/**
 * Created by Awsaf on 3/20/2017.
 */

// window.io = require('socket.io-client');

// Vue.component('messages', require('./components/Messages'));
// Vue.component('test-component', require('./components/TestComponent'));


// Vue.component('chat-threads', require('./components/ChatTheads.vue'));
// Vue.component('chat-message', require('./components/ChatMessage.vue'));
// Vue.component('chat-log', require('./components/ChatLog.vue'));
// Vue.component('chat-composer', require('./components/ChatComposer.vue'));

// var socket = io('http://muzbnb.tk:3000');

import VueTimeago from 'vue-timeago';
Vue.use(VueTimeago, {
    name: 'timeago', // component name, `timeago` by default
    locale: 'en-US',
    /*locales: {
        'en-US': require('vue-timeago/locales/en-US.json')
    }*/
    
})

import messages from "./components/Messages.vue";

const TYPE_ALL = 1;
const TYPE_TRASH = 2;
const TYPE_ARCHIVED = 3;
const TYPE_UNREAD = 4;

const app = new Vue({
    components: { messages },
    el: '#app',
    data:{
        user: User,
        restoreId: 0,
        archiveId: 0,
        trashId: 0,
        activeThreadId: 0,
        activeThread: {},
        messages: [],
        allMessages: [],
        threads: [],
        hash: USER_HASH,
        type: TYPE_ALL,
        username: USER_NAME,
        userId: USER_ID
    },
    mounted: function() {
        this.setMessagesNotification();
    },
    methods: {
        setMessagesNotification() {
            var self = this;

            Echo.private("chat")
            .listen("NewMessage", e => {
                if (self.user.id == e.message.user_id) {
                    return;
                }
                console.log(e);
                toastr.success(e.message.body, 'You have a message from ' + e.message.user.first_name)
            });
        }
    }
    // mounted: function () {
    //     var socket = io(window.location.protocol + '//' + window.location.hostname + ':3000');
    //     $this = this;
    //     this.loadMessages(0);
    //     socket.on('chat:' + this.hash, function (data) {
    //         if(!$this.allMessages[data.thread.id]) {
    //             $this.threads.push(data.thread);
    //             $this.allMessages[data.thread.id] = [];
    //         }
    //         $this.allMessages[data.thread.id].push(data.message);
    //         scrollToBottom();
    //     }.bind(this));
    // },
    // methods:{
    //     messageAdd: function (message) {
    //         var m = {
    //             user : this.username,
    //             user_id : USER_ID,
    //             user_img : USER_IMG,
    //             body: message.body,
    //             time: Date.now()
    //         };
    //         this.allMessages[this.activeThreadId].push(m);
    //         this.activeThread.time = Date.now();
    //         axios.post('chat/new-message', {t:this.activeThreadId, m: message.body})
    //             .then(function (response) {
    //             })
    //             .catch(function (error) {
    //                 console.log(error);
    //             });
    //         scrollToBottom();
    //     },
    //     threadClick: function (thread) {
    //         this.activeThreadId = thread.id;
    //         this.threads.forEach(function (e) {
    //             if(e.id === thread.id) {
    //                 this.activeThread = thread;
    //             }
    //         });
    //         if(!this.allMessages[this.activeThreadId]) {
    //             this.loadMessages(0);
    //         } else {
    //             this.updateMessages();
    //         }
    //     },
    //     updateMessages: function () {
    //         this.messages = this.allMessages[this.activeThreadId];
    //         if(!this.threads.length) {
    //             $(".action-btn").hide();
    //         }
    //         this.restoreId = 0;
    //         this.archiveId = 0;
    //         this.trashId = 0;
    //     },
    //     showAll: function() {
    //         $(".action-btn").show();
    //         $(".action-btn.restore").hide();
    //         this.type = TYPE_ALL;
    //         this.activeThreadId = 0;
    //         this.threads = [];
    //         this.allMessages = [];
    //         this.loadMessages(0);
    //     },
    //     showUnread: function() {
    //         $(".action-btn").show();
    //         $(".action-btn.restore").hide();
    //         this.type = TYPE_UNREAD;
    //         this.activeThreadId = 0;
    //         this.threads = [];
    //         this.allMessages = [];
    //         this.loadMessages(0);
    //     },
    //     showTrash: function() {
    //         $(".action-btn").hide();
    //         $(".action-btn.restore").show();
    //         this.type = TYPE_TRASH;
    //         this.activeThreadId = 0;
    //         this.threads = [];
    //         this.allMessages = [];
    //         this.loadMessages(0);
    //     },
    //     showArchived: function() {
    //         $(".action-btn").hide();
    //         $(".action-btn.restore").show();
    //         this.type = TYPE_ARCHIVED;
    //         this.activeThreadId = 0;
    //         this.threads = [];
    //         this.allMessages = [];
    //         this.loadMessages(0);
    //     },
    //     trashCurrent: function () {
    //         this.trashId = this.activeThreadId;
    //         this.activeThreadId = 0;
    //         this.threads = [];
    //         this.allMessages = [];
    //         this.loadMessages(0);
    //     },
    //     restoreCurrent: function () {
    //         this.restoreId = this.activeThreadId;
    //         this.activeThreadId = 0;
    //         this.threads = [];
    //         this.allMessages = [];
    //         this.loadMessages(0);
    //     },
    //     archiveCurrent: function () {
    //         this.archiveId = this.activeThreadId;
    //         this.activeThreadId = 0;
    //         this.threads = [];
    //         this.allMessages = [];
    //         this.loadMessages(0);
    //     },
    //     loadMessages: function (start) {
    //         axios.post('chat-data', {h: this.hash, t: this.activeThreadId, start: start, type: this.type,
    //             restoreId: this.restoreId,
    //             archiveId: this.archiveId,
    //             trashId: this.trashId})
    //             .then(function (response) {
    //                 if(response.data.threads) {
    //                     $this.threads = response.data.threads;
    //                     $this.activeThread = response.data.threads[response.data.threads.length - 1];
    //                     $this.activeThreadId = response.data.threadId;
    //                 }
    //                 if($this.allMessages[$this.activeThreadId]) {
    //                     $this.allMessages[$this.activeThreadId] = $this.allMessages[$this.activeThreadId].concat(response.data.messages);
    //                 } else {
    //                     $this.allMessages[$this.activeThreadId] = response.data.messages;
    //                 }
    //                 $this.updateMessages();
    //             })
    //             .catch(function (error) {
    //                 console.log(error);
    //             });
    //     }
    // }
});