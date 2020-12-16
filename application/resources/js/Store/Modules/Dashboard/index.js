import * as Types from "./types";

export default {
    namespaced: true,
    state: {
        stage: "dashboard-search-component"
    },
    mutations: {
        [Types.DASHBOARD_UPDATE_STAGE](state, stage) {
            state.stage = stage;
        }
    }
};
