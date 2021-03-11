<template>
    <form class="w-full relative" @submit.prevent="searchMethod(internalUrl)">
        <div class="flex flex-no-wrap">
            <jet-input
                class="flex-1 mr-2"
                v-model="internalUrl"
                :placeholder="placeholder"
                @input="autocomplete()"
                onClick="this.select();"
            ></jet-input>
            <jet-button>Search</jet-button>
        </div>
        <jet-input-error :message="errorMessage"></jet-input-error>
        <div class="absolute left-0 w-full" style="top:100%">
            <div class="p-2 w-full" v-for="repo in searchResults" v-bind:key="repo.id">
                {{ repo.id }}
            </div>
        </div>
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
        autocomplete() {
            if (! this.internalUrl) return;
            this.autocompleteMethod(this.internalUrl);
        }
    }
};
</script>
