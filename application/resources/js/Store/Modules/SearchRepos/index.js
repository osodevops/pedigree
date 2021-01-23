import * as Types from "./types";
import Vue from "vue";

export default {
    namespaced: true,
    state: {
        repositoryBreakdown: [],
        errorMessage: "",
        githubUsername: "",
        githubRepositoryName: "",
        forkData: [],
        loadingGithubInfo: false
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
            state.forkData = forkData.map(fork => {
                fork.showMore = false;
                return fork;
            });
        },
        [Types.SEARCH_REPO_LOADING_STATE](state, isLoading) {
            state.loadingGithubInfo = isLoading;
        },
        [Types.SEARCH_REPOS_UPDATE_FORK_DIFFERENCES](state, difference) {
            let index = state.forkData.findIndex(
                fork => fork.id === difference.repository_id
            );
            state.forkData[index].difference = {};
            Vue.set(state.forkData[index], "difference", difference);
        },
        [Types.SEARCH_REPOS_UPDATE_FORK_SHOW_STATE](state, index) {
            state.forkData[index].showMore === true
                ? (state.forkData[index].showMore = false)
                : (state.forkData[index].showMore = true);
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

            commit(Types.SEARCH_REPO_LOADING_STATE, true);

            axios
                .get(
                    `/repos/${state.githubUsername}/${state.githubRepositoryName}`
                )
                .then(
                    ({ data }) => {
                        commit(
                            Types.SEARCH_REPOS_UPDATE_REPOSITORY_BREAKDOWN,
                            data
                        );
                        commit(Types.SEARCH_REPO_LOADING_STATE, false);
                        dispatch("getRepositoryForkInformation");
                    },
                    error => {
                        commit(Types.SEARCH_REPOS_UPDATE_ERROR_MESSAGE, error);
                    }
                );
        },
        getRepositoryForkInformation({ commit, dispatch, state }) {
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

                        dispatch("getForkDifferences");
                    },
                    error => {
                        commit(Types.SEARCH_REPOS_UPDATE_ERROR_MESSAGE, error);
                    }
                );
        },
        getForkDifferences({ commit, state }) {
            let polling = setInterval(() => {
                axios
                    .get(
                        `/repos/${state.githubUsername}/${state.githubRepositoryName}/differences`
                    )
                    .then(
                        ({ data }) => {
                            data.data.forEach(differences => {
                                commit(
                                    Types.SEARCH_REPOS_UPDATE_FORK_DIFFERENCES,
                                    differences
                                );
                            });

                            if (
                                state.forkData.find(
                                    fork => fork.difference.status === "unknown"
                                ) === undefined
                            ) {
                                clearInterval(polling);
                            }
                        },
                        error => {
                            commit(
                                Types.SEARCH_REPOS_UPDATE_ERROR_MESSAGE,
                                error
                            );
                        }
                    );
            }, 3000);
        }
    }
};
