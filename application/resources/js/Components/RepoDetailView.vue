<template>
    <div>
        <div class="mx-auto flex flex-wrap flex-1">
            <commits-heatmap :username="repository.owner.id" :repository="repository.name" class="mb-4" />
            <repository-languages :username="repository.owner.id" :repository="repository.name" />
        </div>

        <div v-show="forkData.length > 0" class="mx-auto mt-3 mb-2">
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
        numberFormat(number) {
            return window.numberFormat(number);
        }
    }
};
</script>

<style lang="scss" scoped></style>
