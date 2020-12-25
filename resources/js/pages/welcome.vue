<template>
  <section style="background-image: url('images/main-background.jpg');background-size: cover;
    background-position: center;">
    <div class="d-flex justify-center align-center h-100">
      <div class="contain">
        <div class="row justify-center">
          <div class="panel-wrapper col-md-4 offset-md-2" @click="$router.push('create-ticket')">
            <h2 class="panel">
              <v-icon dark large>edit</v-icon> Create Ticket
            </h2>
          </div>
          <div class="panel-wrapper col-md-4" @click="$router.push('search-ticket')">
            <h2 class="panel">
              <v-icon dark large>search</v-icon> Search Ticket
            </h2>
          </div>
          <div class="panel-wrapper col-md-4 offset-md-2" @click="$router.push('faq')">
            <h2 class="panel">
              <v-icon dark large>help</v-icon> FAQ
            </h2>
          </div>
          <div class="panel-wrapper col-md-4 " @click="$router.push('login')">
            <h2 class="panel">
              <v-icon dark large>lock</v-icon> Login
            </h2>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters } from "vuex";
import AppTicket from "../components/landingPage/AppTicket";

export default {
  layout: "landingPage",
  components: {
    AppTicket
  },

  data: () => ({
    title: window.config.appName
  }),

  computed: mapGetters({
    authenticated: "auth/check"
  })
};
</script>

<style lang="scss" scoped>
* {
  box-sizing: border-box;
}
.header {
  background: #5775e4;
  height: 5em;
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  .top-right {
    padding: 1em;
  }
  a {
    color: white;
    padding: 1em;
  }
}

.title {
  font-size: 85px;
}
section {
  height: 100%;
  background: black;
}

.panel-wrapper {
  border: 2px solid #95bce2;
  padding: 2px;
  margin: 0.2em;
  border-radius: 24px;
  position: relative;
  box-sizing: border-box;
  transition: border-color 0.5s ease;
}

.panel {
  margin: 0.2em;
  border: 3px solid  #95bce2;
  background-color: #1976d2;
  box-shadow: 0 1px 1px #95bce2;
  border-radius: 20px;
  min-height: 40px;
  position: relative;
  padding: 1em;
  color: white;
  &:hover{
    background: hsla(0, 0%, 78.4%, 0.9);
    color: #1976d2;
    cursor: pointer;
    .v-icon{
      color: #1976d2;
    }
  }
}
.panel-wrapper:after,
.panel-wrapper:before {
  content: "";
  height: 2px;
  background-color: #1976d2;
  position: absolute;
  left: 80px;
  right: 80px;
}
.panel-wrapper:before {
  top: -2px;
}
.panel-wrapper::after {
  bottom: -2px;
}
.contain {
  
  .column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 14em;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #0f79e6;
    border: 1px solid whitesmoke;
    border-radius: 5px;
    color: white;
    &:hover {
      cursor: pointer;
      background: #007bf7;
    }
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  /* Responsive layout - makes a two column-layout instead of four columns */
  @media screen and (max-width: 900px) {
    .column {
      width: 50%;
    }
  }

  /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
  @media screen and (max-width: 600px) {
    .column {
      width: 100%;
    }
  }
}
</style>
