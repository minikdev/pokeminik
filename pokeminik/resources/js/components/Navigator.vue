<template>
    <div>
        <v-app-bar
            color="deep-orange-darken-1"
            scroll-target="#scrolling-techniques"
            app="true"
        >
            <v-app-bar-nav-icon @click="toggleSideBar"></v-app-bar-nav-icon>
            <v-app-bar-title>Pokeminik</v-app-bar-title>
        </v-app-bar>
        <v-navigation-drawer v-model="drawer" app="true">
            <v-container>
                <v-row v-if="!isAuthenticated">
                    <v-col>
                        <v-btn block rounded="lg" @click="moveToLogin"
                            >Login</v-btn
                        >
                    </v-col>
                </v-row>
                <v-row v-if="isAuthenticated">
                    <v-col>
                        <v-btn block rounded="lg" >{{
                            trainer.username
                        }}</v-btn>
                    </v-col>
                </v-row>
                <v-row v-if="isAuthenticated">
                    <v-col>
                        <v-btn block rounded="lg" @click="logout">Logout</v-btn>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-btn
                            block
                            rounded="lg"
                            color="deep-orange-darken-1"
                            @click="getPokemons"
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
import { computed, ref } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import { onMounted } from "@vue/runtime-core";
export default {
    setup(props) {
        const drawer = ref(true);
        const router = useRouter();

        const store = useStore();

        const pokemons = computed(() => store.state.pokemon.pokemons);
        const getPokemons = () => store.dispatch("pokemon/getPokemons");
        const isLoading = computed(() => store.state.pokemon.isLoading);

        const searchPokemon = () =>
        store.dispatch("pokemon/searchPokemon", searchTerm.value);

        const trainer = computed(() => store.state.authentication.trainer);

        const isAuthenticated = computed(
            () => store.state.authentication.isAuthenticated
        );
        const logout = () =>
        store.dispatch("authentication/logout");

        const searchTerm = ref("");
        const trainerId = ref("");

        const fetchTrainer = () =>
        store.dispatch("authentication/fetchTrainer", trainerId.value);

        const toggleSideBar = () => {
            drawer.value = !drawer.value;
        };

        const movePokemonDetail = (pokemonId) => {
            router.push({ name: "PokemonDetail", params: { id: pokemonId } });
        };
        const moveToLogin = () => {
            router.push({ name: "Login" });
        };
        onMounted(() => {
            let id = window.localStorage.getItem("trainer_id");
            if (id) {
                trainerId.value = id;
                fetchTrainer();
            }
        });
        return {
            pokemons,
            drawer,
            toggleSideBar,
            isLoading,
            searchPokemon,
            searchTerm,
            movePokemonDetail,
            getPokemons,
            moveToLogin,
            trainer,
            isAuthenticated,
            logout
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
