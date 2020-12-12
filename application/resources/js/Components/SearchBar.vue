<template>
    <div class="w-full p-4">
        <div class="flex flex-wrap">
            <jet-input
                class="w-8/12 mr-2"
                v-model="githubUrl"
                placeholder="github repo url"
            ></jet-input>
            <jet-button
                type="button"
                class="w-2/12 text-center"
                @click="searchRepos()"
                >Search</jet-button
            >
        </div>
        <jet-input-error></jet-input-error>
    </div>
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
    data() {
        return {
            githubUrl: ""
        };
    },
    computed: {
        errorMessage() {
            //
        }
    },
    methods: {
        searchRepos() {
            //
        }
    }
};
</script>

<style lang="scss" scoped></style>
