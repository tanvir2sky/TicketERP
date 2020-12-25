<template>
  <section>
    <v-card class="pa-3">
      <v-tabs grow background-color="primary">
        <v-tab>General Setting</v-tab>
        <v-tab>Email Setting</v-tab>

        <v-tab-item>
          <div class="pa-10">
            <v-row>
              <v-col cols="4">
                <p class="lableTitle">Site Logo</p>
              </v-col>
              <v-col cols="6">
                <v-file-input
                  accept="image/png, image/jpeg, image/bmp"
                  placeholder="Pick an avatar"
                  prepend-icon="camera"
                  label="Site Logo"
                  outlined
                ></v-file-input>
              </v-col>
              
            </v-row>
              <v-row>
              <v-col cols="4"></v-col>
              <v-col cols="6">
                <v-btn color="primary" block large>Update</v-btn>
              </v-col>
            </v-row>
          </div>
          <v-divider></v-divider>
          <div class="pa-10">
            <v-row  v-for="(item,i) in general" :key="i">
              <v-col cols="4">
                <div class="lableDiv">
                   <p class="lableTitle">{{item.key}}</p>
                <p class="caption">{{item.description}}</p>
                </div>
               
              </v-col>
              <v-col cols="6">
                <v-text-field outlined v-model="general[i].key" :value="item.value"></v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="4"></v-col>
              <v-col cols="6">
                <v-btn color="primary" block large @click="updateSetting">Update</v-btn>
              </v-col>
            </v-row>
          </div>
        </v-tab-item>
        <v-tab-item>
          <div class="pa-10">
            <v-row>
              <v-col cols="4">
                <p class="lableTitle">Mail Driver</p>
              </v-col>
              <v-col cols="6">
                <v-text-field outlined value="SMTP"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <p class="lableTitle">Mail Host</p>
              </v-col>
              <v-col cols="6">
                <v-text-field outlined value="Host"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <p class="lableTitle">Mail Port</p>
              </v-col>
              <v-col cols="6">
                <v-text-field outlined value="Port"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <p class="lableTitle">Mail Username</p>
              </v-col>
              <v-col cols="6">
                <v-text-field outlined value="SMTP"></v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="4">
                <p class="lableTitle">Mail Password</p>
              </v-col>
              <v-col cols="6">
                <v-text-field outlined value="SMTP"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4"></v-col>
              <v-col cols="6">
                <v-btn color="primary" block large>Update</v-btn>
              </v-col>
            </v-row>
          </div>
        </v-tab-item>
      </v-tabs>
    </v-card>
  </section>
</template>

<script>

import { HTTP } from "../../axios";
export default {
   data: () => ({
    general:[],
    email:[],
    generalModel:{
      parent_id: []
    },
   }),
    created() {
    this.initialize();
  },
  methods: {

    initialize() {
      HTTP.get(`global-settings`)
        .then(response => {
         response.data.data.filter((item)=>{
            // console.log(item)
            if(item.group === "general"){
              this.general.push(item);
            }
          });
          
          console.log(this.general);
       
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    updateSetting(){
      console.log(this.site_url);
    }
  }
}
</script>
<style lang="scss" scoped>
p{
  margin: 0;
}
.lableDiv{
  text-align: end;
}
.lableTitle {
  font-size: 1.5em;
  color: #777777;
}
</style>