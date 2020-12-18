import * as Types from "./types";

export default {
    namespaced: true,
    state: {
        url: ""
    },
    mutations: {
        [Types.SEARCH_BAR_UPDATE_URL](state, url) {
            let matches = [...url.matchAll(/(https:\/\/github\.com\/)?([\w\d-]*)\/([\w\d-]*)(.*)?/g)];
            const [username, repository] = [matches[0][2], matches[0][3]];
            state.url = `${username}/${repository}`;
        }
    }
};
