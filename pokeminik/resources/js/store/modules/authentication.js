import axios from "axios";
import _ from "lodash";
const state = {
    isAuthenticated:false,
    userInfo:{},
    isLoading:false
};
const getters = {};

const actions = {
    login({ commit },{username,password}) {
        let data = new FormData();
        data.append("username",username)
        data.append("password",password)

        commit("SET_LOADING", true);
        axios
        .post("/api/auth/login",data)
        .then((result) => {
            let responseData = result.data
            let username = responseData.user.username
            let money = responseData.user.money
            let id = responseData.user.id
            let token = responseData.access_token
            let gender = responseData.gender
            commit("SET_USER_INFO", {username,money,id,token,gender});
            commit("SET_LOADING", false);

        })
        .catch((error) => {
            throw error;
        });
    },
};

const mutations = {
    SET_USER_INFO(state, userInfo) {
        state.userInfo = userInfo
    },
    SET_LOADING(state, isLoading) {
        state.isLoading = isLoading;
    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
