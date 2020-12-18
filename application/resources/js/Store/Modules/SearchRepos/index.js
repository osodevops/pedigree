import * as Types from "./types";

export default {
    namespaced: true,
    state: {
        repositoryBreakdown: [],
        errorMessage: ""
    },
    mutations: {
        [Types.REPOSITORY_INFORMATION_UPDATE_REPOSITORY_BREAKDOWN](
            state,
            repositoryBreakdown
        ) {
            state.repositoryBreakdown = repositoryBreakdown;
        },
        [Types.REPOSITORY_INFORMATION_UPDATE_ERROR_MESSAGE](state, message) {
            state.errorMessage = message;
        }
    },
    actions: {
        getRepositoryInformation({ commit, rootState }, url) {
            axios.get(`/repos/${rootState.searchBar.url}`).then(
                ({ data }) => {
                    commit(
                        Types.REPOSITORY_INFORMATION_UPDATE_REPOSITORY_BREAKDOWN,
                        data
                    );
                },
                error => {
                    commit(
                        Types.REPOSITORY_INFORMATION_UPDATE_ERROR_MESSAGE,
                        error
                    );
                }
            );
        }
    }
};
