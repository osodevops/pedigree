<template>
    <svg width="828" height="128">
        <g transform="translate(10, 20)">
            <g v-for="(week, weekKey) in data" :key="weekKey" :transform="`translate(${calculateWeekX(weekKey)}, 0)`">
                <rect
                    v-for="(day, dayKey) in week"
                    :key="dayKey"
                    width="11"
                    height="11"
                    :x="0"
                    :y="calculateDayY(dayKey)"
                    :fill="colours[day]"
                    class="day"></rect>
            </g>
        </g>
    </svg>
    <!-- :data-count="week.count[dayKey] || 0" :data-date="week.dates[dayKey] || ''" -->
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
    },
    methods: {
        calculateWeekX(offset) {
            return offset * 15;
        },
        calculateDayY(offset) {
            return offset * 14;
        }
    }
}
</script>

<style scoped>
svg {
    overflow: hidden;
}
.day {
    shape-rendering: geometricPrecision;
    outline: 1px solid #1b1f230f;
    outline-offset: -1px;
    rx: 2;
    ry: 2;
}
.wday {
    font-size: 9px;
    fill: #24292e;
}
</style>