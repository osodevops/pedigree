<template>
    <div class="max-w-xs">
        <div class="flex flex-no-wrap">
            <div v-for="(language, key) in data"
                :key="key" class="h-2 bar"
                :style="{width: `${language.percentage}%`, backgroundColor:colours[key]}">
            </div>
        </div>
        <div class="flex flex-wrap">
            <div v-for="(language, key) in data" :key="key" class="flex flex-no-wrap items-center text-xs text-black w-1/2 mt-1" style="min-width: 80px">
                <span class="ml-3 h-3 w-3 rounded-full mr-1" :style="{backgroundColor: colours[key]}"></span>
                <span class="font-semibold">{{ key }}</span>
                <span class="ml-auto">{{ language.percentage }}%</span>
            </div>
        </div>
    </div>
</template>

<script>
import colours from "@/Config/colours";

export default {
    props: {
        username: String,
        repository: String
    },
    data() {
        return {
            data: [],
            colours: colours.languages,
        };
    },
    mounted() {
        axios
            .get(`/repos/${this.username}/${this.repository}/stats/languages`)
            .then(({ data }) => {
                this.data = data.data;
            });
    }
}
</script>

<style scoped>
.bar:first-child {
    border-radius: 4px 0px 0px 4px;
}
.bar:last-child {
    border-radius: 0px 4px 4px 0px;
}
</style>