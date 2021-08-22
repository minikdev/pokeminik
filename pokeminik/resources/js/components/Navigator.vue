<template>
    <div>
        <v-app-bar
            color="deep-orange-darken-1"
            scroll-target="#scrolling-techniques"
            app="true"
        >
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-app-bar-title>Pokeminik</v-app-bar-title>
        </v-app-bar>
        <v-navigation-drawer v-model="drawer" app="true">
            <v-container>
                <v-row>
                    <v-col>
                        <v-btn block rounded="lg" disabled>Login</v-btn>
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
                <v-divider></v-divider>
                <v-row>
                    <v-col>
                        <v-banner rounded="pill">
                            <input
                                type="text"
                                @input="searchPokemon()"
                                v-model="searchTerm"
                            />
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
                        <v-list dense rounded="lg" v-if="!isLoading">
                            <v-card
                                v-for="pokemon in pokemons || []"
                                :key="pokemon.id"
                                class="item"
                                color="deep-orange-darken-1"
                                elevation="7"
                                @click="movePokemonDetail(pokemon.id)"
                            >
                                <v-list-item>
                                    <v-list-item-avatar>
                                        <v-img
                                            :src="
                                                pokemon?.sprites?.front_default
                                            "
                                            alt="m"
                                        ></v-img>
                                    </v-list-item-avatar>
                                    <v-list-item-title
                                        v-html="
                                            '#' +
                                            pokemon.id +
                                            ' ' +
                                            pokemon.name
                                        "
                                    ></v-list-item-title>
                                </v-list-item>
                            </v-card>
                        </v-list>
                    </v-col>
                </v-row>
            </v-container>
        </v-navigation-drawer>
    </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
import _ from "lodash";
import { useRouter } from "vue-router";
export default {
    setup(props) {
        const drawer = ref(true);
        const pokemons = ref([]);
        const toggle = ref(false);
        const isActive = ref(false);
        const isLoading = ref(false);
        const searchTerm = ref("");
        const router = useRouter();
        const searchPokemon = _.debounce(() => {
            isLoading.value = true;
            axios
                .get(`/api/pokemon/search/${searchTerm.value}`)
                .then((result) => {
                    pokemons.value = result.data;
                    isLoading.value = false;
                })
                .catch((error) => {
                    throw error;
                }, 1000);
        });

        const togglePokedex = () => {
            toggle.value = !toggle.value;
            if (toggle.value) {
                isLoading.value = !isLoading.value;

                axios
                    .get("/api/pokemon?limit=151&skip=0")
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

        const movePokemonDetail = (pokemonId) => {
            router.push({ name: "PokemonDetail", params: { id: pokemonId } });
        };

        return {
            togglePokedex,
            pokemons,
            drawer,
            toggle,
            isActive,
            isLoading,
            searchPokemon,
            searchTerm,
            movePokemonDetail,
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
.v-list-item-title {
    color: aliceblue;
}
.v-divider {
    margin-top: 1rem;
    margin-bottom: 1rem;
}
.router-link {
    text-decoration: none;
}
</style>
