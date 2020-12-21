<template>
    <app-layout>
        <search-repos></search-repos>
        <div v-if="this.activeRepository">
            <repo-detail-view
                :repository="this.activeRepository"
                :forkData="this.activeForks"
            ></repo-detail-view>
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
        activeRepository() {
            if (!this.$store.state.searchRepos) return false;
            return this.$store.state.searchRepos.repositoryBreakdown.data;
        },
        activeForks() {
            if (!this.$store.state.searchRepos) return false;
            return this.$store.state.searchRepos.forkData;
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
