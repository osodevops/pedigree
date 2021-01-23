<template>
    <div class="max-w-full w-full">
        <h2 class="text-black text-lg mb-2">{{ numberFormat(total) }} contributions in the last year</h2>
        <base-card>
            <div class="flex flex-col items-end xl:items-center overflow-hidden h-full text-center">
                <commits-heatmap :data="commits" />
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
    methods: {
        numberFormat(number) {
            return window.numberFormat(number);
        }
    },
    mounted() {
        axios
            .get(`/repos/${this.username}/${this.repository}/stats/commits`)
            .then(({ data }) => {
                this.total = data.data.total;
                this.commits = data.data.commits;
            });
    },
};
</script>
