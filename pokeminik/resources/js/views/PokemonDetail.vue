<template>
    <div >
        <v-progress-circular
            indeterminate
            v-if="isLoading"
            class="progress-center"
        ></v-progress-circular>
        <v-card v-if="!isLoading">
            <v-container>
                <v-row>
                    <v-col md="4" style="cursor:pointer">
                        <v-icon @click="movePreviousPokemonDetail"
                            >mdi-arrow-left-thick</v-icon
                        >
                        <label class="arrow-description">Previous</label>
                    </v-col>
                    <v-col md="4">
                        <h2 class="pokemon-name">
                            {{ "#" + pokemon.id + " " + pokemon.name }}
                        </h2>
                    </v-col>
                    <v-col md="4" >
                        <div class="right-arrow-aligner">
                            <v-icon @click="moveNextPokemonDetail"

                                >mdi-arrow-right-thick</v-icon
                            >
                            <label class="arrow-description">Next</label>
                        </div>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col md="4" offset="4">
                        <v-img
                            v-if="pokemon"
                            :lazy-src="pokemon?.sprites?.front_default"
                            :src="pokemon?.sprites?.front_default"
                            max-height="200"
                        ></v-img>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col md="1" offset="2"></v-col>
                    <v-col v-for=" (stat,index) in pokemon?.stats" :key="stat" md="1" class="stat-container">
                        <v-icon :color="colors[index]">{{ icons[index] }}</v-icon>
                        <label style="margin-top: 0.5rem;">{{ stat.base_stat }}</label>
                    </v-col>
                </v-row>
                <v-row style="margin-top: 2rem">
                    <v-col offset="3" md="2" class="stat-container">
                        <v-icon color="pink lighten-2">mdi-brain</v-icon>
                        <label>{{ pokemon.base_experience }}</label>
                    </v-col>
                    <v-col md="2" class="stat-container">
                        <v-icon color="blue-grey darken-4"
                            >mdi-human-male-height-variant</v-icon
                        >
                        <label>{{ pokemon.height / 10 }}</label>
                    </v-col>
                    <v-col md="2" class="stat-container">
                        <v-icon color="blue-grey darken-4"
                            >mdi-weight-kilogram</v-icon
                        >
                        <label>{{ pokemon.weight / 10 }}</label>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import { onMounted, watch, computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStore } from "vuex";
export default {
    setup() {
        const store = useStore();

        const route = useRoute();
        const router = useRouter();
        const id = ref(route.params.id);
        const pokemon = computed(() => store.state.pokemon.pokemon);
        const isLoading = computed(
            () => store.state.pokemon.pokemonDetailLoading
        );
        const getPokemon = () => store.dispatch("pokemon/getPokemon", id.value);

        onMounted(() => {
            getPokemon();
        });

        watch(
            () => route.params.id,
            async (newId) => {
                id.value = newId;
                getPokemon();
            }
        );

        const moveNextPokemonDetail = () => {
            if (id.value < 151) {
                router.push({
                    name: "PokemonDetail",
                    params: { id: +id.value + 1 },
                });
            }
        };
        const movePreviousPokemonDetail = () => {
            if (id.value > 1) {
                router.push({
                    name: "PokemonDetail",
                    params: { id: +id.value - 1 },
                });
            }
        };

        const icons = ref([
            "mdi-water",
            "mdi-sword-cross",
            "mdi-shield",
            "mdi-flash",
            "mdi-shield-star",
            "mdi-speedometer",
        ]);
        const colors = ref([
            "red",
            "grey-darken-2",
            "brown-darken-2",
            "yellow-darken-2",
            "light-blue-darken-3",
            "cyan lighten-2",
        ]);

        return {
            route,
            id,
            pokemon,
            getPokemon,
            isLoading,
            moveNextPokemonDetail,
            movePreviousPokemonDetail,
            icons,
            colors,
        };
    },
};
</script>

<style scoped>
.pokemon-name {
    display: flex;
    justify-content: center;
}
.progress-center {
    top: 50%;
    left: 50%;
}
.v-icon {
    font-size: 2.5em;
}

label {
    font-weight: bolder;
}
.right-arrow-aligner {
    justify-content: flex-end;
    display: flex;
    align-items: center;
    cursor: pointer;
}
.stat-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>
