<template>
    <div>
        <h1 class="mx-auto text-2xl mt-2 mb-2 text-gray-700">
            Repository Overview
        </h1>

        <div class="mx-auto flex flex-wrap">
            <base-container>
                <div class="flex mb-4">
                    <!-- Repository Information -->
                    <div style="width: 75px; height:75px" class="mr-4">
                        <img :src="repository.owner.avatar_url" />
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl"
                            >{{ repository.name }} /
                            <span class="font-semibold">{{
                                repository.owner.name
                            }}</span></span
                        >
                        <div class="mt-2">
                            <p class="italic">{{ repository.description }}</p>
                        </div>
                    </div>
                </div>
                <div class="max-w-full">
                    <commits-heatmap
                        :username="repository.owner.name"
                        :repository="repository.name"
                    />
                </div>
            </base-container>

            <div class="w-1/4 p-4">
                <a
                    class="underline text-decoration-none text-gray-600 hover:text-gray-400 leading-3 cursor-pointer"
                    :href="repository.url"
                    >View on Github
                    <Icon icon="location-arrow" class="text-gray-400"
                /></a>
                <div class="flex items-center">
                    <Icon icon="code-branch" class="text-gray-400" />
                    <span class="font-bold ml-2">{{
                        repository.default_branch
                    }}</span>
                </div>
                <div class="flex items-center">
                    <Icon icon="star" class="text-gray-400" />
                    <span class="ml-2"
                        ><span class="font-bold">{{
                            repository.watchers_count
                        }}</span>
                        stars</span
                    >
                </div>

                <!-- languages section -->
            </div>
        </div>

        <div v-show="forkData.length > 0" class="mx-auto mt-3 mb-2">
            <section class="w-full flex flex-wrap">
                <h1 class="text-2xl text-gray-700">
                    Forks
                </h1>

                <jet-input
                    class="ml-auto w-1/5"
                    placeholder="search by fork user, or status"
                    @input="updateSearch"
                ></jet-input>
            </section>

            <RepoForks v-if="forkData.length > 0" />
        </div>
    </div>
</template>
<script>
import BaseContainer from "@/Components/Base/Container";
import BaseCard from "@/Components/Base/Card";
import JetInput from "@/Jetstream/Input";
import Icon from "@/Components/Base/Icon";
import CommitsHeatmap from "@/Components/HeatmapContainer.vue";
import RepoForks from "@/Components/RepoForks";

export default {
    components: {
        BaseContainer,
        BaseCard,
        Icon,
        CommitsHeatmap,
        RepoForks,
        JetInput
    },
    props: {
        repository: Object,
        forkData: {
            type: Array
        },
        loading: Boolean
    },
    methods: {
        updateSearch(value) {
            this.searchText = value;
        }
    }
};
</script>

<style lang="scss" scoped></style>
