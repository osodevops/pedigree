import * as Types from "./types";

export default {
    state: {
        repositoryInformation: []
    },
    mutations: {
        [Types.DASHBOARD_UPDATE_REPOSITORY_INFORMATION](
            state,
            repositoryInformation
        ) {
            state.repositoryInformation = repositoryInformation;
        }
    },
    actions: {
        getRepositoryInformation({ sate, commit }, url) {
            axios.get(`/repos/${state.user.id}/${url}`).then(
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
