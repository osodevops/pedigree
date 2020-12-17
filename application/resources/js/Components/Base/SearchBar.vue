<template>
    <div class="w-full p-4">
        <div class="flex flex-wrap">
            <jet-input
                class="w-8/12 mr-2"
                v-model="url"
                @input="searchBarUpdateUrl"
                :placeholder="placeholder"
            ></jet-input>
            <button
                type="button"
                class="w-64 bg-red-500 text-white font-semibold text-center rounded"
                @click="searchMethod(url)"
            >
                Search
            </button>
        </div>
        <jet-input-error :message="errorMessage"></jet-input-error>
    </div>
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
