<template>
  <div class="row">
    <div class="message-head col-md-12 col-sm-12 col-xs-12">
      <div class>
        <div class="msg_menu">
          <span class="sub-menu-toggle visible-xs">
            <img src="/style/assets/img/icon/menu.svg" />
          </span>
        </div>
      </div>
      <div class="section-title">
        <h1>Messages</h1>
      </div>
      <div class="search-box">
        <div class="message-option">
          <a
            href="#"
            class="dropdown-toggle"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <img src="/style/assets/img/icon/menu.svg" />
          </a>
          <ul class="dropdown-menu">
            <!-- <li>
              <a href="#" v-on:click="showAll">All</a>
            </li>
            <li>
              <a href="#" v-on:click="showUnread">Unread</a>
            </li>
            <li>
              <a href="#" v-on:click="showTrash">Thrash</a>
            </li>
            <li>
              <a href="#" v-on:click="showArchived">Archived</a>
            </li>-->
          </ul>
        </div>
        <!-- <button
          class="btn action-btn restore"
          type="button"
          style="display:none"
          v-on:click="restoreCurrent"
          title="Restore"
        >
          <i class="fa fa-check-circle fa-2x"></i>
        </button>-->
        <!-- <button class="btn action-btn" type="button" v-on:click="trashCurrent" title="Trash">
          <i class="fa fa-trash-o fa-2x"></i>
        </button>
        <button class="btn action-btn" type="button" v-on:click="archiveCurrent" title="Archive">
          <i class="fa fa-file-archive-o fa-2x"></i>
        </button>-->
        <input type="text" class="search-query form-control" placeholder="SEARCH MESSAGES" />
        <button class="btn" type="button">
          <img src="/style/assets/img/search_button.svg" alt="icon" />
        </button>
      </div>
    </div>
    <div class="message-center">
      <div class="chat_sidebar col-md-4 col-sm-4 hidden-xs">
        <div v-if="conversation != null" class="member-list">
          <ul>
            <li
              v-for="convo in conversations"
              :key="convo.person.id"
              @click="select(convo)"
              :class="{ 'selected-chat': convo.id == conversation.id }"
            >
              <span class="chat-img">
                <span class="seen on-seen"></span>
                <img :src="convo.person.avatar_url" alt />
              </span>
              <div class="chat-body">
                <div class="chat-info">
                  <h1>{{convo.person.first_name}}</h1>
                  <h3>{{convo.last_message[0].body.substring(0, 30) + '...'}}</h3>
                  <span class="on-time">
                    <timeago :datetime="convo.last_message[0].created_at" :auto-update="60"></timeago>
                  </span>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="message_section col-md-8 col-sm-8">
        <div class="chat-log">
          <div class="timeline">
            <span>Today</span>
          </div>
          <div class="chat_area">
            <ul>
              <div v-if="messages.length > 0" class="chat-message" id="chat-app">
                <li
                  v-for="message in messages"
                  :key="message.id"
                  v-if="message.user_id === user.id"
                  class="admin_chat"
                >
                  <span class="pull-right chat-img">
                    <img :src="message.user.avatar_url" />
                  </span>
                  <div class="chat-body blue-body">
                    <p v-html="message.body" class="pull-right"></p>
                    <div class="chat_time pull-right text-right">
                      <timeago :datetime="message.created_at" :auto-update="60"></timeago>
                    </div>
                  </div>
                </li>

                <li v-else class="user_chat">
                  <span class="chat-img">
                    <img :src="message.user.avatar_url" />
                  </span>
                  <div class="chat-body grey-body">
                    <p v-html="message.body"></p>
                    <div class="chat_time pull-left">
                      <timeago :datetime="message.created_at" :auto-update="60"></timeago>
                    </div>
                  </div>
                </li>
              </div>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="message-footer col-md-12 col-sm-12 col-xs-12">
      <div class="chat-composer">
        <div class="message_write">
          <textarea
            v-model="newMessage"
            class="form-control"
            @keydown="isTyping"
            @keyup.enter.prevent="sendMessage"
          ></textarea>
          <a @click.prevent="pickImage" class="file" href="#">
            <img src="/style/assets/img/pin.png" />
          </a>
          <a class="emoji" href="#">
            <img src="/style/assets/img/emoji.png" />
          </a>

          <button
            :disabled="emptyMessage"
            @click.prevent="sendMessage"
            type="button"
            class="btn btn-red"
          >Send</button>
          <input
            type="file"
            ref="image"
            @change="previewImage"
            accept=".jpeg, .jpg, .png, .gif"
            style="display: none"
          />

          <div class="mb-10" v-if="typingUser != null" v-show="typing">
            <span class="mb-25 mt-10 text text-danger">{{ typingUser }} is typing...</span>
          </div>

          <div class="picture-collage-item" v-if="imageData != null">
            <!-- PHOTO PREVIEW -->
            <div class="photo-preview">
              <img :src="imageData" alt="photo-preview-14" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["selected"],

  data() {
    return {
      user: User,
      otherUser: {},

      loading: false,

      conversations: [],

      conversation: null,

      messages: [],
      newMessage: "",

      imageAttachment: null,
      imageData: null,

      typing: false,
      typingUser: null
    };
  },

  computed: {
    noChatSelected() {
      return this.conversation == null || this.conversation.length === 0;
    },

    emptyMessage() {
      return this.newMessage == "";
    }
  },

  async mounted() {
    await this.getConversations();
  },

  methods: {
    async getConversations() {
      let url = `/get-conversations`;

      axios.get(url).then(response => {
        this.conversations = response.data.conversations;

        if (this.conversation == null) {
          this.conversation = this.conversations[0];

          if (this.selected != 0) {
            this.getMessages(this.selected);
          } else {
            this.getMessages(this.conversation.id);
          }
        }
      });
    },

    async select(conversation) {
      if (this.conversation.id == conversation.id) {
        return;
      }

      conversation.has_unread = 0;

      await this.set(conversation).then(() => {
        if (this.conversation != null) {
          this.getMessages(conversation.id);
        }
      });
    },

    async set(conversation) {
      this.conversation = conversation;
    },

    async getMessages(conversation_id) {
      let _this = this;

      this.loading = true;

      let url = `/messages-with-conversation/${conversation_id}`;

      axios.get(url).then(response => {
        if (response.data.messages != null) {
          this.messages = response.data.messages;
        }

        this.loading = false;
        this.loadingMessage = "";

        // setTimeout(function() {
        //   var chat_body = document.getElementById("chat-app");
        //   chat_body.scrollTop = chat_body.scrollHeight;
        // }, 200);

        $(".message_section").mCustomScrollbar("update");
        setTimeout(function() {
          $(".message_section").mCustomScrollbar("scrollTo", "bottom");
        }, 0);
      });

      let self = this;

      Echo.private("chat")
        .listen("NewMessage", e => {
          console.log(e);

          if (self.user.id == e.message.user_id) {
            return;
          }

          this.messages.push({
            id: e.message.id,
            user_id: e.message.user_id,
            user: e.message.user,
            body: e.message.body,
            created_at: e.message.created_at
          });

          // setTimeout(function() {
          //   var chat_body = document.getElementById("chat-app");
          //   chat_body.scrollTop = chat_body.scrollHeight;
          // }, 200);

          $(".message_section").mCustomScrollbar("update");
          setTimeout(function() {
            $(".message_section").mCustomScrollbar("scrollTo", "bottom");
          }, 0);
        })
        .listenForWhisper("typing", e => {
          console.log(e);

          this.typingUser = e.typingUser;
          this.typing = e.typing;

          // remove is typing indicator after 0.9s
          setTimeout(function() {
            _this.typing = false;
          }, 9000);
        });
    },

    isTyping() {
      let channel = Echo.private("chat");
      let self = this;
      setTimeout(function() {
        channel.whisper("typing", {
          typingUser: self.user.first_name,
          typing: true
        });
      }, 3000);
    },

    pickImage() {
      if (!this.user || this.user == null) {
        return (window.location.href = "/login");
      }

      this.$refs.image.click();
    },

    previewImage: function(event) {
      let input = event.target;

      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
          this.imageData = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
        this.imageAttachment = input.files[0];
      }
    },

    removeImage() {
      this.imageAttachment = null;
      this.imageData = null;
    },

    sendMessage() {
      if (this.newMessage == "") {
        return;
      }

      let user_id = this.conversation.person.id;
      let message = this.newMessage;

      let url = `/send-message/${user_id}`;

      let formData = new FormData();

      if (this.imageAttachment != null) {
        formData.append("image", this.imageAttachment);
      }

      formData.append("user_id", user_id);
      formData.append("message", message);

      let headers = { "Content-Type": "multipart/form-data" };

      axios
        .post(url, formData, { headers })
        .then(response => {
          this.messages.push(response.data.message);
          this.newMessage = "";

          this.imageAttachment = null;
          this.imageData = null;

          // setTimeout(function() {
          //   var chat_body = document.getElementById("chat-app");
          //   chat_body.scrollTop = chat_body.scrollHeight;
          // }, 200);

          $(".message_section").mCustomScrollbar("update");
          setTimeout(function() {
            $(".message_section").mCustomScrollbar("scrollTo", "bottom");
          }, 0);

          //Refresh all conversations and set the receiver to the latest convo
          this.getConversations();
        })
        .catch(error => {
          error.response.data.error.message
            ? (this.errors.message = error.response.data.error.message)
            : null;
        });
    }
  }
};
</script>

<style>
.selected-chat {
  background-color: #1085ac;
  width: 100%;
  padding-right: 26px;
  border-radius: 0px 6px 6px 0px;
}

.selected-chat > .chat-body > .chat-info > h1 {
  color: #fff !important;
}
</style>