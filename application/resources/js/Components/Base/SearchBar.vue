<template>
    <form class="w-full p-4" @submit.prevent="searchMethod(url)">
        <div class="flex flex-wrap">
            <jet-input
                class="w-8/12 mr-2"
                v-model="url"
                @input="searchBarUpdateUrl"
                :placeholder="placeholder"
            ></jet-input>
            <jet-button>
                Search
            </jet-button>
        </div>
        <jet-input-error :message="errorMessage"></jet-input-error>
    </form>
</template>

<script>
import { mapMutations } from "vuex";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import JetInputError from "@/Jetstream/InputError";
import searchBarModule from "@/Store/Modules/SearchBar/index";

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
        }
    },
    data() {
        return {
            url: ""
        };
    },
    methods: {
        ...mapMutations("searchBar", ["searchBarUpdateUrl"])
    },
    mounted() {
        this.$store.registerModule("searchBar", searchBarModule);
    },
    beforeDestroy() {
        this.$store.unregisterModule("searchBar", searchBarModule);
    }
};
</script>
