<template>
  <section>
    <v-card outlined class="ticketCard pa-3">
      <v-toolbar dense dark color="primary">
        <v-toolbar-title>Reply Ticket</v-toolbar-title>
      </v-toolbar>
      <v-list class="replyList">
        <v-list-item
          v-for="(item, i) in ticketReply"
          :key="i"
          :class="item.is_customer ? 'text-left' : 'text-right'"
        >
          <div
            :class="
              item.is_customer ? 'adminflexRowReverse' : 'userflexRowReverse'
            "
          >
            <v-list-item-avatar class="ml-5">
              <v-img v-if="item.is_customer"
                src="https://banner2.cleanpng.com/20180523/tha/kisspng-businessperson-computer-icons-avatar-clip-art-lattice-5b0508dc6a3a10.0013931115270566044351.jpg"
              ></v-img>
              <span v-if="!item.is_customer" class="white--text headline caption text-capitalize f-20">
                {{ item.created_by.slice(0, 1) }}</span
              >
            </v-list-item-avatar>
            <v-list-item-content class="py-0">
              <v-list-item-title
                :class="item.is_customer ? 'userReplies' : 'adminReplies'"
                v-html="item.body"
              ></v-list-item-title>
            </v-list-item-content>
              <p class="caption createdAt">{{ item.created_at }}</p>
          </div>
        </v-list-item>
      </v-list>
      <v-divider></v-divider>
      <ckeditor
        :editor="editor"
        v-model="editorData"
        :config="editorConfig"
      ></ckeditor>
      <v-divider></v-divider>
      <v-btn color="primary" @click="addToReply" dark>Reply too Ticket</v-btn>
    </v-card>
  </section>
</template>
<script>
import { HTTP } from "../../../axios";

import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  data: () => ({
    priority_id: "1",
    editor: ClassicEditor,
    editorData: "",
    editorConfig: {
      // The configuration of the rich-text editor.
    },
    ticketInfo: "",
    ticketId: "",
    ticketReply: [],
  }),
  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      console.log("The id is: " + this.$route.params.id);
      this.ticketId = this.$route.params.id;
      HTTP.get(`tickets/${this.$route.params.id}`)
        .then((response) => {
          this.ticketInfo = response.data.data;
          this.ticketReply = response.data.data.replies;
        })
        .catch((e) => {
          // this.errors.push(e)
        });
    },
    addToReply() {
      console.log(this.editorData);

      let reply = {
        ticket_id: this.ticketId,
        body: this.editorData,
      };

      HTTP.post(`ticket-replies`, reply, {
        headers: {
          Accept: "application/json",
        },
      })
        .then((response) => {
          HTTP.get(`tickets/${this.$route.params.id}`).then((response) => {
            this.ticketInfo = response.data.data;
            this.ticketReply = response.data.data.replies;
          });
          this.editorData = "";
          console.log(response);
        })
        .catch((e) => {});
    },
  },
};
</script>
<style lang="scss" scoped>
.replyList.v-list {
  max-height: 18em;
  overflow-y: scroll;
}
.userflexRowReverse {
  display: flex;
  flex-direction: row-reverse;
  width: 100%;
}
.adminflexRowReverse {
  display: contents;
  width: 100%;
}
.userReplies {
  font-size: 0.9rem !important;
  margin: 5px 0px -10px 0px;
}
.adminReplies {
  font-size: 0.9rem !important;
  margin: 6px 0px -25px 0px;
}
.createdAt {
  font-size: 10px !important;
  color: darkgray;
  margin: 0px 0px -5px 0px;
}
.f-20 {
  font-size: 1.2rem !important;
}
</style>