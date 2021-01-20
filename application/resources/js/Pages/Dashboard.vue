<template>
    <app-layout>
        <search-repos></search-repos>

        <BaseLoadingSpinner v-show="loading" />

        <div v-if="this.activeRepository">
            <repo-detail-view
                v-if="activeForks.length > 0"
                :repository="activeRepository"
                :forkData="activeForks"
            ></repo-detail-view>
        </div>
    </app-layout>
</template>

<script>
import { mapGetters, mapMutations, mapState } from "vuex";
import BaseLoadingSpinner from "@/Components/Base/LoadingSpinner";
import RepoDetailView from "@/Components/RepoDetailView.vue";
import dashboardModule from "@/Store/Modules/Dashboard/index";
import searchRepos from "@/components/SearchRepos";
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout,
        RepoDetailView,
        searchRepos,
        BaseLoadingSpinner
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
        },
        loading() {
            if (!this.$store.state.searchRepos) return false;
            return this.$store.state.searchRepos.loadingGithubInfo;
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
