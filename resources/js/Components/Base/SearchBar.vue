<template>
    <form class="w-full relative" @submit.prevent="searchMethod(internalUrl)">
        <div class="flex flex-no-wrap">
            <div class="flex-1 relative mr-2">
                <jet-input
                    class="w-full"
                    v-model="internalUrl"
                    :placeholder="placeholder"
                    @input="autocomplete()"
                    onClick="this.select();"
                ></jet-input>
                <div class="absolute left-0 w-full divide-y-1 divide-gray-200 shadow-lg rounded-lg overflow-hidden" style="top:110%">
                    <div @click="navigateTo(repo)" class="p-2 w-full bg-white hover:bg-gray-50 cursor-pointer" v-for="repo in searchResults" v-bind:key="repo.id">
                        <div class="flex">
                            <span class="font-semibold">{{ repo.owner.id }}</span>
                            <span class="font-semibold mx-1">/</span>
                            <span>{{ repo.name }}</span>
                        </div>
                    </div>
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

export default {
    components: {
        JetInput,
        JetButton,
        JetInputError
    },
    props: {
        placeholder: {
            type: String,
            default: "Search for a GitHub Repo"
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
        searchResults: {}
    },
    data() {
        return {
            // clone is important here as it stops the prop url data from being mutated.
            internalUrl: _.clone(this.url)
        };
    },
    methods: {
        navigateTo(repo) {
            this.searchMethod(`${repo.owner.id}/${repo.name}`);
            this.internalUrl = "";
            this.$emit('choose', []);
        },
        autocomplete() {
            if (! this.internalUrl) return;
            this.autocompleteMethod(this.internalUrl);
        }
    }
};
</script>
