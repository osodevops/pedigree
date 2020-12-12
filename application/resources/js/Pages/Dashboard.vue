<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <base-panel>
            <search-bar></search-bar>

            <base-card>
                <jet-button @click="activateCanSee()"
                    >see full section</jet-button
                >
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

        <!-- <your-component-name v-show=""></your-component-name -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import SearchBar from "@/Components/SearchBar.vue";
import BasePanel from "@/Components/Base/Panel";
import BaseCard from "@/Components/Base/Card";
import JetButton from "@/Jetstream/Button";

export default {
    components: {
        AppLayout,
        SearchBar,
        BasePanel,
        BaseCard,
        JetButton
    },
    props: {
        user: Object
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
            // set can see to true
        }
    }
};
</script>
