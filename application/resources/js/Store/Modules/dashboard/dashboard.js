import * as Types from "./types";

export default {
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
        },
        [Types.DASHBOARD_UPDATE_REPOSITORY_INFORMATION](
            state,
            repositoryInformation
        ) {
            state.repositoryInformation = repositoryInformation;
        }
    },
    actions: {
        getRepositoryInformation({ sate, commit }) {
            axios.get(`/repos/${state.user.id}/${state.githubUrl}`).then(
                ({ data }) => {
                    commit(Types.DASHBOARD_UPDATE_REPOSITORY_INFORMATION, data);
                },
                error => {
                    // here we will trigger the jet streams input error.vue so say that the
                    // search is not valid.
                }
            );
        }
    }
};
