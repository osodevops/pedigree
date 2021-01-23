<template>
    <div class="md:mx-2 mx-3 flex flex-col items-end xl:items-center overflow-hidden pt-1 h-full text-center">
        <commits-heatmap :data="temp" />
    </div>
</template>

<script>
import CommitsHeatmap from "@/Components/CommitsHeatmap";

export default {
    components: {
        CommitsHeatmap
    },
    props: {
        data: Array
    },
    data() {
        return {
            temp: []
        }
    },
    mounted() {
        axios.get('repos/laravel/laravel/stats/commits')
            .then(({data}) => {
                this.temp = data.data;
            });
    }
}
</script>