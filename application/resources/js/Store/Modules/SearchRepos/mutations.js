import * as Types from "./types";

export default {
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
    },
    [Types.SEARCH_REPO_LOADING_STATE](state, isLoading) {
        state.loadingGithubInfo = isLoading;
    }
};
