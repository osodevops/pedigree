import * as Types from "./types";
import mutations from "./mutations";
import * as actions from "./actions";

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
    mutations,
    actions
};
