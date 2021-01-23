<template>
    <base-card>
        <search-bar :searchMethod="getRepositoryInformation"></search-bar>
    </base-card>
</template>

<script>
import { mapActions } from "vuex";
import SearchBar from "@/Components/Base/SearchBar";
import BasePanel from "@/Components/Base/Panel";
import BaseCard from "@/Components/Base/Card";
import JetButton from "@/Jetstream/Button";
import SearchReposModule from "@/Store/Modules/SearchRepos/index";

export default {
    components: {
        SearchBar,
        BasePanel,
        JetButton,
        BaseCard
    },
    mounted() {
        this.$store.registerModule("searchRepos", SearchReposModule);
    },
    beforeDestroy() {
        this.$store.unregisterModule("searchRepos", SearchReposModule);
    },
    methods: {
        ...mapActions("searchRepos", ["getRepositoryInformation"])
    }
};
</script>

<style lang="scss" scoped></style>
