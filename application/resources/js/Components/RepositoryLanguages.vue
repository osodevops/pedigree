<template>
    <div class="min-w-xs max-w-full">
        <div class="flex flex-no-wrap my-2">
            <div v-for="(language, key) in languages"
                :key="key" class="h-2 bar"
                :style="{width: `${language.percentage}%`, backgroundColor:colours[key]}">
            </div>
        </div>
        <div class="flex flex-wrap">
            <div v-for="(language, key) in languages" :key="key" class="flex flex-no-wrap items-center text-xs text-black w-1/2 mt-1" style="min-width: 80px; max-width: 160px">
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
        languages: [],
    },
    data() {
        return {
            colours: colours.languages,
        };
    },
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