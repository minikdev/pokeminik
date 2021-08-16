<template>
    <div>
        <v-app>
            <v-card class="overflow-hidden">
                <v-app-bar
                    color="deep-orange-darken-1"
                    scroll-target="#scrolling-techniques"
                >
                    <v-app-bar-nav-icon
                        @click="drawer = !drawer"
                    ></v-app-bar-nav-icon>

                    <v-app-bar-title>Pokeminik</v-app-bar-title>

                    <v-spacer></v-spacer>
                </v-app-bar>
                <v-navigation-drawer temporary v-model="drawer">
                    <v-container>
                        <v-row>
                            <v-col >
                                <input type="text" class="bg-deep-orange-darken-1">
                            </v-col>
                             <v-col >
                                <v-icon @click="searchPokemons">mdi-magnify</v-icon>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-navigation-drawer>
            </v-card>
        </v-app>
    </div>
</template>

<script>
import { onMounted, ref } from "vue";
import axios from "axios";
export default {
    setup() {
        const drawer = ref(true);
        const pokemons = ref([]);
        onMounted(() => {});

        const searchPokemons = ()=>{
            axios.get("api/pokemon?limit=1&skip=0").then(result=>{
                console.log(result);
            }).catch(error=>{
                throw error
            })
        }

        return {
            drawer,
            searchPokemons,
            pokemons
        };
    },
};
</script>

<style></style>
