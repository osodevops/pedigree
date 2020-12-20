import * as Types from "./types";

export default {
    namespaced: true,
    state: {
        repositoryBreakdown: [],
        errorMessage: "",
        githubUsername: "",
        githubRepositoryName: "",
        forkData: ""
    },
    mutations: {
        [Types.SEARCH_REPOS_UPDATE_REPOSITORY_BREAKDOWN](
            state,
            repositoryBreakdown
        ) {
            state.repositoryBreakdown = repositoryBreakdown;
        },
        [Types.SEARCH_REPOS_UPDATE_ERROR_MESSAGE](state, message) {
            state.errorMessage = message;
        },
        [Types.SEARCH_REPOS_UPDATE_GITHUB_USERNAME](state, username) {
            state.githubUsername = username;
        },
        [Types.SEARCH_REPOS_UPDATE_GITHUB_REPOSITORY_NAME](state, repoName) {
            state.githubRepositoryName = repoName;
        },
        [Types.SEARCH_REPOS_UPDATE_FORKS_INFORMATION](state, forkData) {
            state.forkData = forkData;
        }
    },
    actions: {
        getRepositoryInformation({ commit, state, dispatch }, url) {
            let matches = [
                ...url.matchAll(
                    /(https:\/\/github\.com\/)?([\w\d-]*)\/([\w\d-]*)(.*)?/g
                )
            ];
            const [username, repository] = [matches[0][2], matches[0][3]];

            commit(Types.SEARCH_REPOS_UPDATE_GITHUB_USERNAME, username);
            commit(
                Types.SEARCH_REPOS_UPDATE_GITHUB_REPOSITORY_NAME,
                repository
            );

            axios
                .get(
                    `/repos/${state.githubRepositoryName}/${state.githubRepositoryName}`
                )
                .then(
                    ({ data }) => {
                        commit(
                            Types.SEARCH_REPOS_UPDATE_REPOSITORY_BREAKDOWN,
                            data
                        );

                        dispatch("getRepositoryForkInformation");
                    },
                    error => {
                        commit(Types.SEARCH_REPOS_UPDATE_ERROR_MESSAGE, error);
                    }
                );
        },
        getRepositoryForkInformation({ commit, state }) {
            axios
                .get(
                    `/repos/${state.githubUsername}/${state.githubRepositoryName}/forks`
                )
                .then(
                    ({ data }) => {
                        commit(
                            Types.SEARCH_REPOS_UPDATE_FORKS_INFORMATION,
                            data
                        );
                    },
                    error => {
                        commit(Types.SEARCH_REPOS_UPDATE_ERROR_MESSAGE, error);
                    }
                );
        }
    }
};
