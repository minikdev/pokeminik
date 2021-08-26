import axios from "axios";
import _ from "lodash";
const state = {
    isAuthenticated: getIsAuthenticated(),
    trainer: {},
    isLoading: false,
};
const getters = {};

const actions = {
    login({ commit }, { username, password }) {
        let data = new FormData();
        data.append("username", username);
        data.append("password", password);

        commit("SET_LOADING", true);
        axios
            .post("/api/auth/login", data)
            .then((result) => {
                let responseData = result.data;
                let username = responseData.user.username;
                let money = responseData.user.money;
                let id = responseData.user.id;
                let token = responseData.access_token;
                let gender = responseData.gender;
                window.localStorage.setItem("token", token);
                window.localStorage.setItem("trainer_id", id);
                commit("SET_TRAINER_INFO", {
                    username,
                    money,
                    id,
                    token,
                    gender,
                });
                commit("SET_AUTHENTICATED", true);
                commit("SET_LOADING", false);
            })
            .catch((error) => {
                throw error;
            });
    },
    logout({ commit }) {
        commit("SET_LOADING", true);
        const token = window.localStorage.getItem("token");
        const config = {
            headers: { Authorization: `Bearer ${token}` },
        };

        axios
            .post("/api/auth/logout", {}, config)
            .then(() => {
                window.localStorage.clear();
                commit("SET_TRAINER_INFO", {});
                commit("SET_AUTHENTICATED", false);
                commit("SET_LOADING", false);
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    commit("SET_TRAINER_INFO", {});
                    commit("SET_AUTHENTICATED", false);
                    commit("SET_LOADING", false);
                } else {
                    throw error;
                }
            });
    },
    register({ commit }, trainer){
        let data = new FormData();
        data.append("username", trainer.username);
        data.append("password", trainer.password);
        data.append("password_confirmation", trainer.repeatPassword);
        data.append("gender", trainer.gender);
        commit("SET_LOADING", true);
        axios
            .post("/api/auth/register", data)
            .then((result) => {

                let responseData = result.data;
                let username = responseData.user.username;
                let money = responseData.user.money;
                let id = responseData.user.id;
                let token = responseData.token.original.access_token;
                let gender = responseData.gender;
                window.localStorage.setItem("token", token);
                window.localStorage.setItem("trainer_id", id);
                commit("SET_TRAINER_INFO", {
                    username,
                    money,
                    id,
                    token,
                    gender,
                });
                commit("SET_AUTHENTICATED", true);
                commit("SET_LOADING", false);
            })
            .catch((error) => {
                throw error;
            });
    },
    fetchTrainer({ commit }, trainerId) {
        let trainer;

        commit("SET_LOADING", true);
        axios.get(`/api/trainer/${trainerId}`).then((result) => {
            trainer = result.data;

            commit("SET_TRAINER_INFO", trainer);
            commit("SET_LOADING", false);
        });
    },
};

const mutations = {
    SET_TRAINER_INFO(state, trainer) {
        state.trainer = trainer;
    },
    SET_AUTHENTICATED(state, value) {
        state.isAuthenticated = value;
    },
    SET_LOADING(state, isLoading) {
        state.isLoading = isLoading;
    },
};
function getIsAuthenticated() {
    let token = localStorage.getItem("token");
    if (token) {
        return true;
    } else {
        false;
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
