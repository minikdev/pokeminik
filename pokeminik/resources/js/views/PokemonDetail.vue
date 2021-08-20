<template>
    <div>
        <v-progress-circular
            indeterminate
            v-if="isLoading"
            class="progress-center"
        ></v-progress-circular>
        <v-card v-if="!isLoading">
            <v-container>
                <v-row>
                    <v-col md="4">
                        <v-icon >mdi-arrow-left-thick</v-icon>
                        <label class="arrow-description">Previous</label>
                         </v-col>
                    <v-col md="4">
                        <h2 class="pokemon-name">
                            {{ "#"+pokemonData.id+ " "+pokemonData.name }}
                        </h2>
                    </v-col>
                    <v-col md="4" >
                        <div class="right-arrow-aligner">

                         <v-icon >mdi-arrow-right-thick</v-icon>
                        <label class="arrow-description">Next</label>
                        </div>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col md="4" offset="4">
                        <v-img
                            v-if="pokemonData"
                            :lazy-src="pokemonData?.sprites?.front_default"
                            :src="pokemonData?.sprites?.front_default"
                            max-height="200"
                        ></v-img>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import { onMounted, watch } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";
export default {
    setup(props) {
        const route = useRoute();
        const id = ref(route.params.id);
        const pokemonData = ref({});
        const isLoading = ref(false);
        const getPokemonData = () => {
            isLoading.value = true;
            axios
                .get(`/api/pokemon/${id.value}`)
                .then((result) => {
                    pokemonData.value = result.data;
                    console.log(result.data);
                    isLoading.value = false;
                })
                .catch((error) => {
                    throw error;
                }, 1000);
        };

        onMounted(() => {
            getPokemonData();
        });

        watch(
            () => route.params.id,
            async (newId) => {
                id.value = newId;
                getPokemonData();
            }
        );

        return {
            route,
            id,
            pokemonData,
            getPokemonData,
            isLoading,
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
.v-icon{
    font-size: 2.5em;
}
.arrow-description{
    font-weight: bolder
}
.right-arrow-aligner{
    justify-content: flex-end;
    display: flex;
    align-items: center;
}
</style>
