<template>
    <div class="chat-log">
        <div class="timeline"><span>Today</span></div>
            <div class="chat_area">
                <ul>
                   <chat-message v-for="message in messages" :message="message"></chat-message>
                </ul>
            </div>
    </div>
</template>

<script>
    export default {
        props: ['messages']
    }
</script>

<style lang="css">

</style>
