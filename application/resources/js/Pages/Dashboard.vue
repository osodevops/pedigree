<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <component :is="activeComponent"></component>
    </app-layout>
</template>

<script>
import { mapGetters, mapMutations, mapState } from "vuex";
import AppLayout from "@/Layouts/AppLayout";
import dashboardModule from "@/Store/Modules/Dashboard/index";
import searchRepos from "@/components/SearchRepos";

export default {
    components: {
        AppLayout,
        searchRepos
    },
    props: {
        user: Object
    },
    computed: {
        storeDashboard() {
            return this.$store.state.dashboard;
        },
        activeComponent() {
            if (this.storeDashboard) {
                switch (this.storeDashboard.stage) {
                    case "dashboard-search-component":
                        return searchRepos;
                }
            }
        }
    },
    mounted() {
        this.$store.registerModule("dashboard", dashboardModule);
    },
    beforeDestroy() {
        this.$store.unregisterModule("dashboard", dashboardModule);
    }
};
</script>
