<template>
    <app-layout>
        <div class="bg-white p-4 rounded shadow mt-8">
            <heatmap :data="commits" />
        </div>
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
import Heatmap from "@/Components/HeatmapContainer";


export default {
    components: {
        AppLayout,
        RepoDetailView,
        searchRepos,
        BaseLoadingSpinner,
        Heatmap,
    },
    props: {
        user: Object
    },
    data() {
        return {
            commits: _.map(_.range(0, 52), () => { return [0,1,2,3,4,3,2]; }),
        }
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
