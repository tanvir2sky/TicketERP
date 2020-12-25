<template>
  <section>
    <v-card outlined class="ticketCard pa-3">
      <v-toolbar dense dark color="primary">
        <v-toolbar-title>Reply Ticket</v-toolbar-title>
      </v-toolbar>
      <!-- {{ticketInfo.replies}} -->
      <v-list class="replyList">
        <v-list-item
          v-for="(item, i) in data"
          :key="i"
          :class="item.is_customer ? 'text-right' : 'text-left'"
        >
          <div
            :class="
              item.is_customer ? 'userflexRowReverse' : 'adminflexRowReverse'
            "
          >
            <v-list-item-avatar v-if="item.is_customer" class="ml-5">
              <v-img
                src="https://banner2.cleanpng.com/20180523/tha/kisspng-businessperson-computer-icons-avatar-clip-art-lattice-5b0508dc6a3a10.0013931115270566044351.jpg"
              ></v-img>
            </v-list-item-avatar>
                  <v-avatar v-else color="primary mr-5" size="40">
        <span class="white--text headline caption text-capitalize f-20">
          {{ item.created_by.slice(0,1)}}</span>
      </v-avatar>
            <!-- <p v-else class="caption mt-3 ml-5 text--disabled text-capitalize">
              {{ item.created_by.slice(0,1)}}
            </p> -->
            <v-list-item-content class="py-0">
              <!-- <v-list-item-subtitle class="mt-5" :class="item.is_customer ? 'd-none':''"
                >{{ item.created_by }}
              </v-list-item-subtitle> -->
              <v-list-item-title
                :class="
              item.is_customer ? 'userReplies' : 'adminReplies'
            "
                v-html="item.body"
              ></v-list-item-title>              
              <p class="caption createdAt">{{ item.created_at }}</p>
              <v-divider></v-divider>
            </v-list-item-content>
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
      <v-btn color="primary" @click="addToReply" dark>Reply to Ticket</v-btn>
    </v-card>
  </section>
</template>
<script>
import { HTTP } from "../../../axios";

import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  props: ["data", "ticketId"],
  data: () => ({
    editor: ClassicEditor,
    editorData: "",
    editorConfig: {
      // The configuration of the rich-text editor.
    },
  }),
  methods: {
    addToReply() {
      let reply = {
        ticket_number: this.ticketId,
        body: this.editorData,
      };
      console.log(response);

      HTTP.post(`frontend/search-ticket`, reply, {
        headers: {
          Accept: "application/json",
        },
      })
        .then((response) => {
          //   this.ticketReply.push(reply);

          this.editorData = "";
          console.log(response);
        })
        .catch((e) => {
          // this.errors.push(e)
        });
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
  margin:5px 0px -10px 0px;
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
.f-20{
  font-size: 1.2rem !important;
}
</style>