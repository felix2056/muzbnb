<template>

    <div class="member-list">
        <ul>
            <li v-for="thread in allThreads()" v-on:click="clicked(thread.id)" v-if="thread != undefined">
                <span class="chat-img">
                    <!--<span class="seen on-seen"></span>-->
                    <img :src="thread.user_img" alt="">
                </span>
                <div class="chat-body">
                    <div class="chat-info">
                        <h1>{{thread.name}}</h1>
                        <h3>{{thread.name}}</h3>
                        <!--<span class="on-time">1:54 PM</span>-->
                    </div>
                </div>
            </li>

        </ul>
    </div>

</template>

<script>
    export default {
        props: ['threads'],
        methods:{
            allThreads: function () {
                return  _.orderBy(this.threads, ['time'], ['desc']);
            },
            clicked(id) {
                this.$emit('clicked',{
                    id: id
                });
            }
        }
    }
</script>

