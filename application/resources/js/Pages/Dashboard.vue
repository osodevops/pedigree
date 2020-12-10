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
                <h1>rendering card</h1>
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
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import SearchBar from "../Components/SearchBar.vue";
import BasePanel from "../Components/Base/Panel";
import BaseCard from "../Components/Base/Card";

export default {
    components: {
        AppLayout,
        SearchBar,
        BasePanel,
        BaseCard
    }
};
</script>
