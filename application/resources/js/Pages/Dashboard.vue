<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <search-repos></search-repos>
        <div v-if="this.activeRepository">
            <repo-detail-view :repository="this.activeRepository"></repo-detail-view>
        </div>
    </app-layout>
</template>

<script>
import { mapGetters, mapMutations, mapState } from "vuex";
import RepoDetailView from "@/Components/RepoDetailView.vue";
import dashboardModule from "@/Store/Modules/Dashboard/index";
import searchRepos from "@/components/SearchRepos";
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout,
        RepoDetailView,
        searchRepos
    },
    props: {
        user: Object
    },
    computed: {
        storeDashboard() {
            return this.$store.state.dashboard;
        },
        activeRepository() {
            if (!this.$store.state.searchRepos) return false;
            return this.$store.state.searchRepos.repositoryBreakdown.data;
        },
        activeComponent() {
            if (this.storeDashboard) {
                switch (this.storeDashboard.stage) {
                    case "dashboard-search":
                        return searchRepos;
                    case "dashboard-repo-detail-view":
                        return RepoDetailView;
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
