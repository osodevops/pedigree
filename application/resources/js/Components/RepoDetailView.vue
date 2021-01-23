<template>
    <div>
        <div class="mx-auto flex flex-wrap flex-1">
            <commits-heatmap :username="repository.owner.id" :repository="repository.name" class="mb-4" />
            <repository-languages :username="repository.owner.id" :repository="repository.name" />
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
import RepoForks from "@/Components/RepoForks";
import RepositoryLanguages from "@/Components/RepositoryLanguagesContainer";
import CommitsHeatmap from "@/Components/HeatmapContainer";

export default {
    components: {
        BaseContainer,
        BaseCard,
        Icon,
        CommitsHeatmap,
        RepositoryLanguages,
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
        },
        numberFormat(number) {
            return window.numberFormat(number);
        }
    }
};
</script>

<style lang="scss" scoped></style>
