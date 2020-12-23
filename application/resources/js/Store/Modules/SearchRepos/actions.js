import * as Types from "./types";

const getRepositoryInformation = ({ commit, state, dispatch }, url) => {
    let matches = [
        ...url.matchAll(
            /(https:\/\/github\.com\/)?([\w\d-]*)\/([\w\d-]*)(.*)?/g
        )
    ];
    const [username, repository] = [matches[0][2], matches[0][3]];

    commit(Types.SEARCH_REPOS_UPDATE_GITHUB_USERNAME, username);
    commit(Types.SEARCH_REPOS_UPDATE_GITHUB_REPOSITORY_NAME, repository);

    commit(Types.SEARCH_REPO_LOADING_STATE, true);

    commit(Types.SEARCH_REPOS_UPDATE_FORKS_INFORMATION, []);

    axios
        .get(
            `/repos/${state.githubUsername}/${state.githubRepositoryName}`
        )
        .then(
            ({ data }) => {
                commit(Types.SEARCH_REPOS_UPDATE_REPOSITORY_BREAKDOWN, data);
                commit(Types.SEARCH_REPO_LOADING_STATE, false);
                dispatch("getRepositoryForkInformation");
            },
            error => {
                commit(Types.SEARCH_REPOS_UPDATE_ERROR_MESSAGE, error);
            }
        );
};
const getRepositoryForkInformation = ({ commit, state }) => {
    axios
        .get(
            `/repos/${state.githubUsername}/${state.githubRepositoryName}/forks`
        )
        .then(
            ({ data }) => {
                commit(Types.SEARCH_REPOS_UPDATE_FORKS_INFORMATION, data);
            },
            error => {
                commit(Types.SEARCH_REPOS_UPDATE_ERROR_MESSAGE, error);
            }
        );
};

export { getRepositoryInformation, getRepositoryForkInformation };
