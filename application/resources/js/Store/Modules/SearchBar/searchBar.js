import * as Types from "./types";

export default {
    state: {
        url: ""
    },
    mutations: {
        [Types.SEARCH_BAR_UPDATE_URL](state, url) {
            state.url = url;
        }
    }
};
