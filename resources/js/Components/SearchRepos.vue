<template>
    <search-bar :searchMethod="getRepositoryInformation"></search-bar>
</template>

<script>
import { mapActions } from "vuex";
import SearchBar from "@/Components/Base/SearchBar";
import JetButton from "@/Jetstream/Button";
import SearchReposModule from "@/Store/Modules/SearchRepos/index";

export default {
    components: {
        SearchBar,
        JetButton,
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
