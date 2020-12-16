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

        <!-- <component :is="activeComponent"></component> -->

        <repo-detail-view v-show="canSee">
              <repo-detail-layout> </repo-detail-layout>
        </repo-detail-view>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import SearchBar from "@/Components/SearchBar.vue";
import BasePanel from "@/Components/Base/Panel";
import BaseCard from "@/Components/Base/Card";
import JetButton from "@/Jetstream/Button";
import RepoDetailView from "@/Components/RepoDetailView.vue";
import RepoDetailLayout from "@/Components/Base/Container.vue";

export default {
    components: {
        AppLayout,
        SearchBar,
        BasePanel,
        BaseCard,
        JetButton,
        RepoDetailView,
        RepoDetailLayout
    },
    props: {
        user: Object,
    },
    data() {
        return {
            canSee: false
        };
    },
    computed: {
        // activeComponent() {
        //     switch(dashboard.stage) {
        //         'dashboard-search-component':
        //             DashboardSearchRepos,
        //         '':
        //             DashboardIndividualRepo,
        //     };
        // }
    },
    methods: {
        activateCanSee() {
            this.canSee = !this.canSee
        }
    }
};
</script>
