<template>
    <div class="flex">
        <div v-for="(week, weekKey) in data" :key="weekKey">
            <div v-for="(day, dayKey) in week" :key="dayKey" style="height:11px; width:11px; margin:3px 2px; border: 1px solid #1b1f230f;" :style="{backgroundColor:colours[day]}" class="rounded-sm"></div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: Array
    },
    data() {
        return {
            colours: ['#ebedf1', '#9be9a8', '#41c463', '#31a14e', '#216e39']
        }
    }
}
</script>