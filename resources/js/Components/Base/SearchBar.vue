<template>
    <form class="w-full relative" @submit.prevent="search">
        <div class="flex flex-no-wrap">
            <div class="flex-1 relative mr-2">
                <jet-input
                    class="w-full"
                    v-model="internalUrl"
                    :placeholder="placeholder"
                    @input="autocomplete()"
                    onClick="this.select();"
                ></jet-input>
                <div class="absolute h-full flex items-center top-0 right-3" v-show="loading">
                    <Icon icon="spinner" :spins="true" />
                </div>
                <div class="absolute left-0 w-full divide-y-1 divide-gray-200 shadow-lg rounded-lg overflow-hidden" style="top:110%">
                    <a @click="navigateTo(repo)" class="block px-6 py-2 w-full bg-white text-gray-800 hover:bg-blue-500 hover:text-white cursor-pointer active:bg-blue-500 active:text-white" v-for="repo in searchResults" v-bind:key="repo.id">
                        <div class="flex items-center">
                            <Icon class="mr-2" icon="book" size="sm" />
                            <span>{{ repo.owner.id }}</span>
                            <span class="mx-1">/</span>
                            <span>{{ repo.name }}</span>
                        </div>
                    </a>
                </div>
            </div>
            <jet-button>Search</jet-button>
        </div>
        <jet-input-error :message="errorMessage"></jet-input-error>
    </form>
</template>

<script>
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import JetInputError from "@/Jetstream/InputError";
import Icon from "@/Components/Base/Icon";

export default {
    components: {
        JetInput,
        JetButton,
        JetInputError,
        Icon
    },
    props: {
        placeholder: {
            type: String,
            default: "Enter a GitHub user/repository, or search for a repository"
        },
        errorMessage: {
            type: String
        },
        searchMethod: {
            type: Function,
            default: () => {},
            required: true
        },
        autocompleteMethod: {
            type: Function,
            default: () => {},
            required: true,
        },
        url: {
            type: String,
            default: ""
        },
        searchResults: {},
        loading: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
            // clone is important here as it stops the prop url data from being mutated.
            internalUrl: _.clone(this.url)
        };
    },
    methods: {
        search() {
            this.searchMethod(this.internalUrl)
            this.internalUrl = "";
            this.emptySearchResults();
        },
        navigateTo(repo) {
            this.searchMethod(`${repo.owner.id}/${repo.name}`);
            this.internalUrl = "";
            this.emptySearchResults();
        },
        autocomplete() {
            if (! this.internalUrl) return this.emptySearchResults();
            this.autocompleteMethod(this.internalUrl);
        },
        emptySearchResults() {
            this.$emit('choose', []);
        }
    }
};
</script>
