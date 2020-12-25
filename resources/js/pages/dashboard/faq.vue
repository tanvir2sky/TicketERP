<template>
  <v-data-table
    :headers="headers"
    :items="faqList"
    sort-by="id"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>FAQ List</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on"
              >New FAQ</v-btn
            >
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-text-field
                      v-model="editedItem.title"
                      label="Title"
                      outlined
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      outlined
                      v-model="editedItem.description"
                      label="Description"
                      hint="Hint text"
                      rows="3"
                    ></v-textarea>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.id="{ item }">{{
      faqList.indexOf(item) + 1
    }}</template>
    <template v-slot:item.actions="{ item }">
      <v-icon class="mr-2" @click="editItem(item)">
        edit
      </v-icon>
      <v-icon @click="deleteItem(item)">
        delete_forever
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table>
</template>

<script>
import { HTTP } from "../../axios";
export default {
  data: () => ({
    dialog: false,
    headers: [
      {
        text: "id",
        align: "start",
        sortable: false,
        value: "id"
      },
      { text: "Title", value: "title" },
      { text: "Description", value: "description" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    faqList: [],
    editedIndex: -1,
    editedItem: {
      title: "",
      description: ""
    },
    defaultItem: {
      title: "",
      description: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New FAQ" : "Edit FAQ";
    },
    usertypeNew() {
      return this.editedIndex === -1 ? true : false;
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },
  mounted() {},

  methods: {
    initialize() {
      HTTP.get(`faqs`)
        .then(response => {
          // console.log(response.data);
          this.faqList = response.data.data;
          console.log(this.faqList);
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    createNewFaq(payload){
      HTTP.post(`faqs`,payload)
        .then(response => {
          console.log(response.data);
          this.initialize();

        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    editFaq(payload){
       HTTP.patch(`faqs/${payload.id}`,payload)
        .then(response => {
          console.log(response.data);

        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    deleteFaq(payload){
       HTTP.delete(`faqs/${payload.id}`)
        .then(response => {

          console.log(response.data);

        })
        .catch(e => {
          // this.errors.push(e)
        });
    },

    editItem(item) {
      this.editedIndex = this.faqList.indexOf(item);
      // console.log(this.editedIndex);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.faqList.indexOf(item);

      confirm("Are you sure you want to delete this item?") &&
        this.faqList.splice(index, 1);
        this.deleteFaq(item);
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        this.editFaq(this.editedItem);
        Object.assign(this.faqList[this.editedIndex], this.editedItem);
      } else {
        // this.createNewUser(this.editedItem);
        this.createNewFaq(this.editedItem);
        this.faqList.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>
