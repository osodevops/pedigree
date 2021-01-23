<template>
    <form class="w-full" @submit.prevent="searchMethod(url)">
        <div class="flex flex-no-wrap">
            <jet-input
                class="flex-1 mr-2"
                v-model="url"
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
        }
    },
    data() {
        return {
            url: ""
        };
    }
};
</script>
