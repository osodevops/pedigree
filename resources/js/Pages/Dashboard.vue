<template>
    <app-layout>
        <section class="bg-gray-100 w-full border-b border-gray-200 pt-8 mb-8">
            <base-container>
                <div :class="{'mb-4': activeRepository.id, 'mb-8': !activeRepository.id}">
                    <search-repos></search-repos>
                </div>

                <div v-if="activeRepository.id">
                    <repository-header :repository="activeRepository" />
                </div>
            </base-container>
        </section>

        <BaseLoadingSpinner v-show="loading" />
        <base-container id="overview">
            <div v-if="this.activeRepository.id">
                <repo-detail-view
                    :repository="activeRepository"
                ></repo-detail-view>
                <div v-show="activeForks.length > 0" class="mx-auto mt-3 mb-2">
                    <RepoForks v-if="activeForks.length > 0" />
                </div>
            </div>
        </base-container>
    </app-layout>
</template>

<script>
import { mapActions, mapGetters, mapMutations, mapState } from "vuex";
import BaseLoadingSpinner from "@/Components/Base/LoadingSpinner";
import RepoDetailView from "@/Components/RepoDetailView.vue";
import dashboardModule from "@/Store/Modules/Dashboard/index";
import searchRepos from "@/components/SearchRepos";
import AppLayout from "@/Layouts/AppLayout";
import RepositoryHeader from "@/Components/RepositoryHeader";
import BaseContainer from "@/Components/Base/Container";
import RepoForks from "@/Components/RepoForks";

export default {
    components: {
        AppLayout,
        RepoDetailView,
        searchRepos,
        BaseLoadingSpinner,
        RepositoryHeader,
        BaseContainer,
        RepoForks,
    },
    props: {
        repository: Object,
        search: Object
    },
    computed: {
        activeRepository() {
            if (!this.$store.state.searchRepos) return {};
            return this.$store.state.searchRepos.repositoryBreakdown;
        },
        activeForks() {
            if (!this.$store.state.searchRepos) return [];
            if (!this.$store.state.searchRepos.forkData) return [];
            return this.$store.state.searchRepos.forkData;
        },
        loading() {
            if (!this.$store.state.searchRepos) return false;
            return this.$store.state.searchRepos.loadingGithubInfo;
        }
    },
    methods: {
        ...mapActions("searchRepos", ['getRepositoryInformation']),
    },
    mounted() {
        this.$store.registerModule("dashboard", dashboardModule);
        if (this.repository.id) {
            this.$store.state.searchRepos.repositoryBreakdown = this.repository;
        } else {
            if (this.search.user) {
                this.getRepositoryInformation(`${this.search.user}/${this.search.repository}`);
            }
        }
    },
    beforeDestroy() {
        this.$store.unregisterModule("dashboard", dashboardModule);
    }
};
</script>
