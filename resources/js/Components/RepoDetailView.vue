<template>
    <div>
        <div class="mx-auto flex flex-wrap flex-1">
            <commits-heatmap :username="repository.owner.id" :repository="repository.name" class="mb-4" />
            <repository-languages :username="repository.owner.id" :repository="repository.name" />
        </div>
    </div>
</template>
<script>
import BaseContainer from "@/Components/Base/Container";
import BaseCard from "@/Components/Base/Card";
import JetInput from "@/Jetstream/Input";
import Icon from "@/Components/Base/Icon";
import RepositoryLanguages from "@/Components/RepositoryLanguagesContainer";
import CommitsHeatmap from "@/Components/HeatmapContainer";

export default {
    components: {
        BaseContainer,
        BaseCard,
        Icon,
        CommitsHeatmap,
        RepositoryLanguages,
        JetInput
    },
    props: {
        repository: Object,
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
