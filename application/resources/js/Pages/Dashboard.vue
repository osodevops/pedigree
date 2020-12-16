<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <base-panel>
            <search-bar></search-bar>

            <base-card @click.native="activateCanSee()">
                <jet-button>see full section</jet-button>
            </base-card>
            <base-card>
                <h1>rendering card</h1>
            </base-card>
            <base-card>
                <h1>rendering card</h1>
            </base-card>
            <base-card>
                <h1>rendering card</h1>
            </base-card>
        </base-panel>
        <repo-detail-view v-show="canSee">
              <repo-detail-layout> </repo-detail-layout>
        </repo-detail-view>
        <component :is="activeComponent"></component>

    </app-layout>
</template>

<script>
import { mapGetters, mapMutations, mapState } from "vuex";
import AppLayout from "@/Layouts/AppLayout";
import SearchBar from "@/Components/SearchBar.vue";
import BasePanel from "@/Components/Base/Panel";
import BaseCard from "@/Components/Base/Card";
import JetButton from "@/Jetstream/Button";
import RepoDetailView from "@/Components/RepoDetailView.vue";
import RepoDetailLayout from "@/Components/Base/Container.vue";
import dashboardModule from "@/Store/Modules/Dashboard/index";
import searchRepos from "@/components/SearchRepos";

export default {
    components: {
        AppLayout,
        SearchBar,
        BasePanel,
        BaseCard,
        JetButton,
        RepoDetailView,
        RepoDetailLayout
        searchRepos
    },
    props: {
        user: Object,
    },
    computed: {
    },
    methods: {
        activateCanSee() {
            this.canSee = !this.canSee
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
