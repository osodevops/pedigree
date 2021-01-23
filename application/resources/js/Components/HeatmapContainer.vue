<template>
    <div>
        <h2 class="text-black text-lg mb-2">{{ total }} contributions in the last year</h2>
        <base-card>
            <div class="max-w-full">
                <div class="flex flex-col items-end xl:items-center overflow-hidden h-full text-center">
                    <commits-heatmap :data="commits" />
                </div>
            </div>
        </base-card>
    </div>
</template>

<script>
import CommitsHeatmap from "@/Components/CommitsHeatmap";
import BaseCard from "@/Components/Base/Card";

export default {
    components: {
        CommitsHeatmap,
        BaseCard,
    },
    props: {
        username: String,
        repository: String
    },
    data() {
        return {
            commits: [],
            total: 0,
        };
    },
    mounted() {
        axios
            .get(`/repos/${this.username}/${this.repository}/stats/commits`)
            .then(({ data }) => {
                this.total = data.data.total;
                this.commits = data.data.commits;
            });
    }
};
</script>
