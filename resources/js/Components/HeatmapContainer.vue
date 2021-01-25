<template>
    <div class="max-w-full w-full">
        <h2 class="text-black text-lg mb-2">{{ numberFormat(total) }} contributions in the last year</h2>
        <base-card>
            <BaseLoadingSpinner v-show="loading" />
            <div class="flex flex-col items-end xl:items-center overflow-hidden h-full text-center" v-if="!loading && success">
                <commits-heatmap :data="commits" />
            </div>
            <div v-else class="flex justify-center items-center p-4 text-sm text-gray-700">
                <div v-if="!loading">Commit history could not be loaded. <a class="text-blue-500 cursor-pointer hover:underline" @click="load()">Retry</a></div>
            </div>
        </base-card>
    </div>
</template>

<script>
import CommitsHeatmap from "@/Components/CommitsHeatmap";
import BaseCard from "@/Components/Base/Card";
import BaseLoadingSpinner from "@/Components/Base/LoadingSpinner";

export default {
    components: {
        CommitsHeatmap,
        BaseCard,
        BaseLoadingSpinner,
    },
    props: {
        username: {
            type: String,
            required: true,
        },
        repository: {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            commits: [],
            total: 0,
            loading: false,
            success: false,
        };
    },
    methods: {
        numberFormat(number) {
            return window.numberFormat(number);
        },
        load() {
            this.loading = true;
            axios
                .get(`/repos/${this.username}/${this.repository}/stats/commits`)
                .then(({ data }) => {
                    this.total = data.data.total;
                    this.commits = data.data.commits;
                    this.success = true;
                    this.loading = false;
                }, () => {
                    this.success = false;
                    this.loading = false;
                });
        }
    },
    mounted() {
        this.load();
    },
};
</script>
