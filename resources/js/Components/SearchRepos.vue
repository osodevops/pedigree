<template>
    <search-bar
        :autocompleteMethod="searchRepositories"
        :searchMethod="getRepositoryInformation"
        :searchResults="getSearchResults"
    ></search-bar>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import SearchBar from "@/Components/Base/SearchBar";
import JetButton from "@/Jetstream/Button";
import SearchReposModule from "@/Store/Modules/SearchRepos/index";

export default {
    components: {
        SearchBar,
        JetButton,
    },
    methods: {
        ...mapActions("searchRepos", ["getRepositoryInformation", "searchRepositories"])
    },
    computed: {
        ...mapGetters("searchRepos", ["getSearchResults"]),
    },
};
</script>

<style lang="scss" scoped></style>
