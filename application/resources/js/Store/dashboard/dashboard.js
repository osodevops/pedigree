import * as Types from "./types";

export default new Vuex.Store({
    state: {
        githubUrl: "",
        repositoryInformation: []
    },
    getters: {
        //
    },
    mutations: {
        [Types.DASHBOARD_UPDATE_GITHUB_URL](state, url) {
            state.githubUrl = url;
        }
    },
    actions: {
        getRepositoryInformation() {
            // send a request to the backend
        }
    }
});
