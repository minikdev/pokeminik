import axios from "axios";
import _ from "lodash";
const state = {
    pokemons: [],
    isLoading: false,
    pokemonDetailLoading:false,
    pokemon: {},
};
const getters = {};

const actions = {
    getPokemons({ commit }) {
        let pokemons = [];
        commit("SET_LOADING", true);
        axios
            .get("/api/pokemon?limit=151&skip=0")
            .then((result) => {
                pokemons = result.data;

                commit("SET_POKEMONS", pokemons);
                commit("SET_LOADING", false);
            })
            .catch((error) => {
                throw error;
            });
    },
    searchPokemon: _.debounce(({ commit }, searchTerm) => {
        let pokemons = [];
        commit("SET_LOADING", true);
        axios
            .get(`/api/pokemon/search/${searchTerm}`)
            .then((result) => {
                pokemons = result.data;
                commit("SET_LOADING", false);
                commit("SET_POKEMONS", pokemons);
            })
            .catch((error) => {
                throw error;
            }, 1000);
    }),
    getPokemon({ commit },id) {
        let pokemon;
        commit("SET_POKEMON_DETAIL_LOADING", true);
        axios.get(`/api/pokemon/${id}`).then((result) => {
            pokemon = result.data;
            console.log(pokemon);
            commit("SET_POKEMON", pokemon);
            commit("SET_POKEMON_DETAIL_LOADING", false);
        });
    },
};

const mutations = {
    SET_POKEMONS(state, pokemons) {
        state.pokemons = pokemons;
    },
    SET_LOADING(state, isLoading) {
        state.isLoading = isLoading;
    },
    SET_POKEMON_DETAIL_LOADING(state, isLoading) {
        state.pokemonDetailLoading = isLoading;
    },
    SET_POKEMON(state, pokemon) {
        state.pokemon = pokemon;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
