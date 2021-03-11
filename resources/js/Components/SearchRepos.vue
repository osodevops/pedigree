<template>
    <search-bar
        :autocompleteMethod="searchRepositories"
        :searchMethod="getRepositoryInformation"
        :searchResults="getSearchResults"
        @choose="emptySearchResults"
    ></search-bar>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import SearchBar from "@/Components/Base/SearchBar";
import JetButton from "@/Jetstream/Button";

export default {
    components: {
        SearchBar,
        JetButton,
    },
    methods: {
        ...mapMutations("searchRepos", ["setSearchRepositories"]),
        ...mapActions("searchRepos", ["getRepositoryInformation", "searchRepositories"]),
        emptySearchResults() {
            this.setSearchRepositories([]);
        },
    },
    computed: {
        ...mapGetters("searchRepos", ["getSearchResults"]),
    },
};
</script>

<style lang="scss" scoped></style>
