<template>
  <section
    style="background-image: url('images/ticket.jpg');background-size: cover;
    background-position: top;min-height: 60em;"
  >
    <v-row>
      <v-col md="6" offset-md="3">
        <v-card class="pa-5 px-5">
          <p class="primaryTitle">
            <v-icon dark left>library_books</v-icon>Create A Ticket
          </p>
          <form>
            <v-row>
              <v-col md="6">
                <v-text-field
                  v-model="name"
                  :error-messages="nameErrors"
                  :counter="10"
                  label="Name"
                  outlined
                  append-icon="person"
                  required
                  @input="$v.name.$touch()"
                  @blur="$v.name.$touch()"
                ></v-text-field>
              </v-col>
              <v-col md="6">
                <v-text-field
                  v-model="email"
                  :error-messages="emailErrors"
                  label="E-mail"
                  outlined
                  append-icon="email"
                  required
                  @input="$v.email.$touch()"
                  @blur="$v.email.$touch()"
                ></v-text-field>
              </v-col>
              <v-col md="6">
                <v-select
                  v-model="select"
                  :items="items"
                  item-text="title"
                  item-value="id"
                  outlined
                  append-icon="view_module"
                  :error-messages="selectErrors"
                  label="Category"
                  required
                  @change="$v.select.$touch()"
                  @blur="$v.select.$touch()"
                ></v-select>
              </v-col>
              <v-col md="6">
                <v-text-field
                  v-model="subject"
                  label="Subject"
                  outlined
                  append-icon="label"
                  required
                ></v-text-field>
              </v-col>
              <v-col md="12">
                <v-textarea
                  outlined
                  v-model="message"
                  append-icon="edit"
                  name="message"
                  label="Type Your Issue Here"
                  hint="Hint text"
                  rows="3"
                ></v-textarea>
              </v-col>
              <v-col md="12">
                <v-file-input
                  v-model="files"
                  color="primary accent-4"
                  counter
                  label="Attachments"
                  multiple
                  placeholder="Select your files"
                  outlined
                  :show-size="1000"
                >
                  <template v-slot:selection="{ index, text }">
                    <v-chip v-if="index < 2" color="primary accent-4" dark label small>{{ text }}</v-chip>

                    <span
                      v-else-if="index === 2"
                      class="overline grey--text text--darken-3 mx-2"
                    >+{{ files.length - 2 }} File(s)</span>
                  </template>
                </v-file-input>
              </v-col>
            </v-row>

            <div class="text-center">
              <v-btn class="mr-4" color="primary" @click="submit">Create A Ticket</v-btn>
              <v-btn @click="clear">Clear All</v-btn>
            </div>
          </form>
        </v-card>
      </v-col>
    </v-row>

    <v-row justify="center">
      <v-dialog v-model="successTicket" persistent max-width="600">
        <v-card class="pa-5">
          <v-progress-linear v-if="loader" indeterminate color="primary darken-2"></v-progress-linear>
          <!-- <v-card-title class="headline">Ticket</v-card-title> -->
          <v-card-text v-if="successData.data" class="text-center">
            <v-icon size="90" color="success">check_circle</v-icon>
            <p color="green darken-1">Ticket Created successfully</p>
            <table>
              <tr>
                <td>Created</td>
                <td>{{successData.data.created_at}}</td>
              </tr>
              <tr>
                <td>Ticket Number</td>
                <td>{{successData.data.ticket_number}}</td>
              </tr>
              <tr>
                <td>Name</td>
                <td>{{successData.data.name}}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{successData.data.email}}</td>
              </tr>
            </table>
            <v-alert type="success">We will review your ticket soon.</v-alert>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn text @click="successTicket = false">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </section>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, maxLength, email } from "vuelidate/lib/validators";

import { HTTP } from "../../axios";

export default {
  mixins: [validationMixin],

  validations: {
    name: { required, maxLength: maxLength(10) },
    email: { required, email },
    select: { required },
    checkbox: {
      checked(val) {
        return val;
      }
    }
  },

  data: () => ({
    name: "",
    email: "",
    subject: "",
    message: "",
    select: null,
    files: [],
    items: [],
    checkbox: false,
    successTicket: false,
    successData: {},
    loader: false
  }),
  created() {
    this.initialize();
  },

  computed: {
    checkboxErrors() {
      const errors = [];
      if (!this.$v.checkbox.$dirty) return errors;
      !this.$v.checkbox.checked && errors.push("You must agree to continue!");
      return errors;
    },
    selectErrors() {
      const errors = [];
      if (!this.$v.select.$dirty) return errors;
      !this.$v.select.required && errors.push("Category is required");
      return errors;
    },
    nameErrors() {
      const errors = [];
      if (!this.$v.name.$dirty) return errors;
      !this.$v.name.maxLength &&
        errors.push("Name must be at most 10 characters long");
      !this.$v.name.required && errors.push("Name is required.");
      return errors;
    },
    emailErrors() {
      const errors = [];
      if (!this.$v.email.$dirty) return errors;
      !this.$v.email.email && errors.push("Must be valid e-mail");
      !this.$v.email.required && errors.push("E-mail is required");
      return errors;
    }
  },

  methods: {
    initialize() {
      HTTP.get(`frontend/categories`)
        .then(response => {
          this.items = response.data.data.ticket_categories;
          console.log(this.items);
          this.$store.dispatch("snackbar/errorMessage", "CREATED", {
            root: true
          });
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    submit() {
      this.loader = true;
      this.successTicket = true;
      let formData = new FormData();
      formData.append("ticket_category_id", this.select);
      formData.append("name", this.name);
      formData.append("email", this.email);
      formData.append("subject", this.subject);
      formData.append("body", this.message);
      this.files.forEach(file => {
        formData.append("file[]", file);
      });
      HTTP.post(`frontend/store-ticket`, formData, {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      })
        .then(response => {
          setTimeout(() => {
            this.loader = false;
            this.successData = response.data;
          }, 3000);

          console.log(response.data);
          // this.$store.dispatch(
          //   "snackbar/errorMessage",
          //   "CREATED",
          //   { root: true }
          // );
        })
        .catch(e => {
          // this.errors.push(e)
        });

      // console.log(ticket);
    },
    clear() {
      this.$v.$reset();
      this.name = "";
      this.email = "";
      this.subject = "";
      this.message = "";
      this.select = null;
      this.checkbox = false;
    }
  }
};
</script>
<style lang="scss" scoped>
.primaryTitle {
  font-size: 1.5em;
  background: #1976d2;
  font-weight: bold;
  color: white;
  padding: 1em 0.5em;
}
// .v-card {
//   // background: transparent;
// }
table {
  width: 100%;
  td {
    padding: 0.5em;
    border: 1px solid #f1f1f1;
  }
}
</style>

