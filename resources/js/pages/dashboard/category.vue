<template>
  <v-data-table
    :headers="headers"
    :items="categoryList"
    sort-by="id"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Category List</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on"
              >New Category</v-btn
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
                      label="Category Name"
                      outlined
                    ></v-text-field>
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
      categoryList.indexOf(item) + 1
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
      { text: "Actions", value: "actions", sortable: false }
    ],
    categoryList: [],
    editedIndex: -1,
    editedItem: {
      title:""
    },
    defaultItem: {
      title:""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Category" : "Edit Category";
    },
    usertypeNew(){
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
      HTTP.get(`ticket-categories`)
        .then(response => {
          // console.log(response.data);
          this.categoryList = response.data.data.ticket_categories;
          console.log(this.categoryList);
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    createNewCategory(payload){
      HTTP.post(`ticket-categories`,payload)
        .then(response => {
          console.log(response.data);
         
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    editCategory(payload){
       HTTP.patch(`ticket-categories/${payload.id}`,payload)
        .then(response => {
          console.log(response.data);
         
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    deleteCategory(payload){
       HTTP.delete(`ticket-categories/${payload.id}`)
        .then(response => {
          console.log(response.data);
         
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },


    editItem(item) {
      this.editedIndex = this.categoryList.indexOf(item);
      // console.log(this.editedIndex);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.categoryList.indexOf(item);
      
      confirm("Are you sure you want to delete this item?") &&
        this.categoryList.splice(index, 1);
        this.deleteCategory(item);
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
        this.editCategory(this.editedItem);
        Object.assign(this.categoryList[this.editedIndex], this.editedItem);
      } else {
        this.createNewCategory(this.editedItem);
        this.categoryList.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>
