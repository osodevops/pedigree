<template>
    <div class="flex flex-col items-end xl:items-center overflow-hidden h-full text-center">
        <commits-heatmap :data="data" />
    </div>
</template>

<script>
import CommitsHeatmap from "@/Components/CommitsHeatmap";

export default {
    components: {
        CommitsHeatmap
    },
    props: {
        username: String,
        repository: String,
    },
    data() {
        return {
            data: []
        }
    },
    mounted() {
        axios.get(`repos/${this.username}/${this.repository}/stats/commits`)
            .then(({data}) => {
                this.data = data.data;
            });
    }
}
</script>