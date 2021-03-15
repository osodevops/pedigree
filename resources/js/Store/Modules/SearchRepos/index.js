import * as Types from "./types";
import Vue from "vue";
import axios from "axios";
import _ from "lodash";

export default {
    namespaced: true,
    state: {
        repositoryBreakdown: [],
        errorMessage: "",
        githubUsername: "",
        githubRepositoryName: "",
        forkData: [],
        loadingGithubInfo: false,
        searchResults: [],
        loadingSearchResults: false,
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
            state.forkData = forkData.map((fork, index) => {
                fork.showMore = false;

                Vue.set(state.forkData, index, fork);
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

            if (! state.forkData[index]) return;
            Vue.set(state.forkData[index], "difference", {});
            Vue.set(state.forkData[index], "difference", difference);
        },
        [Types.SEARCH_REPOS_UPDATE_FORK_SHOW_STATE](state, index) {
            state.forkData[index].showMore === true
                ? (state.forkData[index].showMore = false)
                : (state.forkData[index].showMore = true);
        },
        [Types.SEARCH_REPOS_UPDATE_RESULTS](state, results) {
            state.searchResults = results;
        },
        [Types.SEARCH_REPOS_SEARCH_LOADING_STATE](state, loading) {
            state.loadingSearchResults = loading;
        }
    },
    getters: {
        getSearchResults: (state) => {
            return state.searchResults;
        },
        isLoadingSearchResults: (state) => {
            return state.loadingSearchResults;
        },
        filteredForks: (state) => (query, status) => {
            return state.forkData.filter(fork => {
                if (query === "" && status === "") return fork;

                if (status !== "") {
                    if (!fork.difference || (fork.difference && status.toLowerCase() !== fork.difference.status.toLowerCase())) {
                        return;
                    }
                }

                if (fork.owner.id.toLowerCase().includes(query.toLowerCase())) {
                    return fork;
                }
            });
        },
        forkMaxScale: (state) => {
            const data = state.forkData;
            if (data.length === 0) return 0;

            let max = 0;
            _.forEach(data, fork => {
                if (typeof fork.difference === "undefined") return;
                max =
                    fork.difference.ahead_by > max
                        ? fork.difference.ahead_by
                        : max;
                max =
                    fork.difference.behind_by > max
                        ? fork.difference.behind_by
                        : max;
            });
            return max;
        }
    },
    actions: {
        getRepositoryInformation({ commit, state, dispatch }, url) {
            let matches = [
                ...url.matchAll(
                    /(https:\/\/github\.com\/)?([\w\d-\.]*)\/([\w\d-\.]*)(.*)?/g
                )
            ];

            if (!matches[0]) return;

            const [username, repository] = [matches[0][2], matches[0][3]];

            commit(Types.SEARCH_REPOS_UPDATE_GITHUB_USERNAME, username);
            commit(
                Types.SEARCH_REPOS_UPDATE_GITHUB_REPOSITORY_NAME,
                repository
            );

            commit(Types.SEARCH_REPOS_UPDATE_RESULTS, []);
            commit(Types.SEARCH_REPOS_UPDATE_FORKS_INFORMATION, []);
            commit(Types.SEARCH_REPOS_UPDATE_REPOSITORY_BREAKDOWN, {});
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
                        commit(Types.SEARCH_REPOS_UPDATE_RESULTS, []);
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
                                    fork => (fork.difference && fork.difference.status === "unknown")
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
        },
        searchRepositories: _.debounce(({ commit }, queryString) => {
            if (queryString.length < 3) return;
            commit(Types.SEARCH_REPOS_SEARCH_LOADING_STATE, true);
            axios.get(`/repos?q=${queryString}`)
                .then(({ data }) => {
                    commit(Types.SEARCH_REPOS_SEARCH_LOADING_STATE, false);
                    commit(
                        Types.SEARCH_REPOS_UPDATE_RESULTS,
                        data.data
                    )
                })
        }, 300)
    }
};
