<template>
    <div class="w-full p-4">
        <jet-input
            class="w-full"
            v-model="githubUrl"
            placeholder="github repo url"
        ></jet-input>
    </div>
</template>

<script>
import JetInput from "@/Jetstream/Input";

export default {
    components: {
        JetInput
    },
    data() {
        return {
            githubUrl: ""
        };
    }
};
</script>

<style lang="scss" scoped></style>
