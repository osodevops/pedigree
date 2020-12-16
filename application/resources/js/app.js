require("./bootstrap");

require("moment");

import Vue from "vue";
import { InertiaApp } from "@inertiajs/inertia-vue";
import { InertiaForm } from "laravel-jetstream";
import PortalVue from "portal-vue";

Vue.config.devtools = true;

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

import store from "@/Store/store";
import { mapMutations } from "vuex";

const app = document.getElementById("app");

new Vue({
    store,
    methods: {
        ...mapMutations(["updateUser"])
    },
    mounted() {
        this.updateUser(JSON.parse(app.dataset.page).props.user);
    },
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(app);
