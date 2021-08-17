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
                        <div class="form-control">
                            <!-- <input type="text"> -->
                            <v-row>
                                <v-col>
                                    <v-btn block rounded="lg">Login</v-btn>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col>
                                    <v-btn
                                        block
                                        rounded="lg"
                                        color="deep-orange-darken-1"
                                        @click="togglePokedex"
                                        >Pokedex</v-btn
                                    >
                                </v-col>
                            </v-row>
                            <v-row v-if="search">
                                <v-col>
                                    <v-banner rounded="pill">
                                        <input type="text" v:model="" />
                                        <v-icon>mdi-magnify</v-icon>
                                    </v-banner>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col>
                                    <div class="loader-container">
                                        <v-progress-circular
                                            indeterminate
                                            v-if="isLoading"
                                        ></v-progress-circular>
                                    </div>
                                    <v-list dense rounded="lg">
                                        <v-card  v-for="pokemon in pokemons"
                                                :key="pokemon.id"
                                                class="item"
                                                color="deep-orange-darken-1"
                                                elevation="15">
                                            <v-list-item>
                                                <v-list-item-avatar>
                                                    <v-img
                                                        lazy-src
                                                        :src="
                                                            pokemon.sprites
                                                                .front_default
                                                        "
                                                    ></v-img>
                                                </v-list-item-avatar>

                                                <v-list-item-title
                                                    v-html="pokemon.name"
                                                ></v-list-item-title>
                                            </v-list-item>
                                        </v-card>
                                    </v-list>
                                </v-col>
                            </v-row>
                        </div>
                    </v-container>
                </v-navigation-drawer>
            </v-card>
        </v-app>
    </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
export default {
    setup() {
        const drawer = ref(true);
        const pokemons = ref([]);
        const search = ref(false);
        const isActive = ref(false);
        const isLoading = ref(false);
        const selectedItem = ref(1);
        const searchPokemons = () => {
            // axios
            //     .get("api/pokemon?limit=1&skip=0")
            //     .then((result) => {
            //         console.log(result);
            //     })
            //     .catch((error) => {
            //         throw error;
            //     });
        };

        const togglePokedex = () => {
            search.value = !search.value;
            if (search.value) {
                isLoading.value = !isLoading.value;
                axios
                    .get("api/pokemon?limit=151&skip=0")
                    .then((result) => {
                        pokemons.value = result.data;
                        isLoading.value = !isLoading.value;
                    })
                    .catch((error) => {
                        throw error;
                    });
            } else {
                pokemons.value = [];
            }
        };

        return {
            searchPokemons,
            togglePokedex,
            pokemons,
            drawer,
            search,
            isActive,
            isLoading,
            selectedItem,
        };
    },
};
</script>

<style>
.loader-container {
    display: flex;
    justify-content: center;
}
.v-progress-circular {
    margin-top: 2rem;
}
.item {
    cursor: pointer;
    margin-bottom: 1rem;
}
</style>
