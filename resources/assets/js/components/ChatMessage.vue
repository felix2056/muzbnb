<template>
    <div class="chat-message">

     <li v-if="isUser()" class="admin_chat">
        <span class="chat-img pull-right">
            <img :src="message.user_img">
        </span>
        <div class="chat-body blue-body">
            <p class="pull-right">{{ message.body}}</p>
            <div class="chat_time pull-right text-right">{{getTime(message.time)}}</div>
        </div>
     </li>
     <li v-else class="user_chat">
        <span class="chat-img ">
            <img :src="message.user_img">
        </span>
        <div class="chat-body grey-body">
            <p>{{ message.body}}</p>
            <div class="chat_time pull-left">{{getTime(message.time)}}</div>
        </div>
     </li>
    </div>
</template>

<script>
    export default {
        props:['message'],
        methods:{
            isUser() {
                return this.message.user_id == USER_ID;
            },
            getTime(unix_timestamp) {
                var date = new Date(unix_timestamp*1000);
                // Hours part from the timestamp
                var hours = date.getHours();
                var str = ' AM';
                if(hours >= 12) {
                    str = ' PM';
                    if(hours > 12) {
                        hours = hours - 12;
                    }
                }
                // Minutes part from the timestamp
                var minutes = "0" + date.getMinutes();
                // Seconds part from the timestamp
                var seconds = "0" + date.getSeconds();

                return hours + ':' + minutes.substr(-2) + str;
            }
        }
    }
</script>

<style lang="css">

</style>
