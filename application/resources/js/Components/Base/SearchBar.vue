<template>
    <form class="w-full p-4" @submit.prevent="searchMethod(internalUrl)">
        <div class="flex flex-wrap">
            <jet-input
                class="w-11/12 mr-2"
                v-model="internalUrl"
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
        },
        url: {
            type: String,
            default: ""
        }
    },
    data() {
        return {
            // clone is important here as it stops the prop url data from being mutated.
            internalUrl: _.clone(this.url)
        };
    }
};
</script>
