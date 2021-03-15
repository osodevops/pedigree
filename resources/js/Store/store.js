import Vue from "vue";
import Vuex from "vuex";
import * as Types from "./types";
import SearchReposModule from "@/Store/Modules/SearchRepos/index";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: {}
    },
    mutations: {
        [Types.STORE_UPDATE_USER](state, user) {
            state.user = user;
        }
    },
    modules: {
        searchRepos: SearchReposModule
    }
});
