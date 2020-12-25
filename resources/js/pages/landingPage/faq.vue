<template>
    <section style="background-image: url('images/faq.jpg');background-size: cover;
    background-position: top;min-height: 60em;">
       <v-row>
                <v-col md="6" offset-md="3">
                    <v-card class="pa-5 px-5">
                        <p class="primaryTitle">
                            <v-icon dark left>library_books</v-icon> FAQ
                        </p>

                        <v-expansion-panels hover popout>
                            <v-expansion-panel v-for="(item,i) in faqList" :key="i">
                                <v-expansion-panel-header>{{item.title}}</v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    {{item.description}}
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>

                    </v-card>
                </v-col>
            </v-row>


    </section>
</template>

<script>
    import { HTTP } from "../../axios";
    export default {
        data: () => ({

            faqList: []

        }),
        created() {
            this.initialize();
        },
        methods: {
            initialize() {
                HTTP.get(`frontend/faqs`)
                    .then(response => {
                        // console.log(response.data);
                        this.faqList = response.data.data;
                        console.log(this.faqList);
                    })
                    .catch(e => {
                        // this.errors.push(e)
                    });
            },
        }
    };
</script>

<style lang="scss" scoped>
     .v-card{
        height: 90vh;
        overflow-y: scroll;
        background: transparent;
    }
    .primaryTitle {
        font-size: 1.5em;
        background: #1976d2;
        font-weight: bold;
        color: white;
        padding: 1em 0.5em;
    }
</style>
