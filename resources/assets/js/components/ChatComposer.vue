<template>
    <div class="chat-composer">
        <div class="message_write">
            <textarea class="form-control" v-model="messageText" @keyup.enter="sendMessage"></textarea>
            <a class="file" href="#"><img src="/style/assets/img/pin.png"></a>
            <a class="emoji" href="#"><img src="/style/assets/img/emoji.png"></a>
            <input type="submit" name="" class="btn btn-red" value="Send" @click="sendMessage">
        </div>
    </div>
</template>

<script>
    export default {
            data(){
                return{
                    messageText: ''
                }
            },
            methods:{
                sendMessage() {
                    this.$emit('sendmessage',{
                        body: this.messageText
                    });
                    this.messageText='';
                }
            }
    }
</script>
