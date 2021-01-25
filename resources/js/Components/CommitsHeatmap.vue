<template>
    <svg width="800" height="128">
        <g transform="translate(10, 20)">
            <g v-for="(week, weekKey) in data" :key="weekKey" :transform="`translate(${calculateWeekX(weekKey)}, 0)`">
                <text :x="15" y="-8" class="month" v-if="week.display_month">{{ week.display_month }}</text>
                <rect
                    v-for="(day, dayKey) in week.scale"
                    :key="dayKey"
                    width="11"
                    height="11"
                    :x="0"
                    :y="calculateDayY(dayKey)"
                    :fill="colours[day]"
                    v-title.delay="`${week.count[dayKey] || 0} contributions on ${week.dates[dayKey] || ''}`"
                    class="day"></rect>
            </g>
        </g>
    </svg>
</template>



<script>
import colours from "@/Config/colours";

export default {
    props: {
        data: Array
    },
    data() {
        return {
            colours: colours.heatmap
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
rect.day {
    position: relative;
    shape-rendering: geometricPrecision;
    outline: 1px solid #1b1f230f;
    outline-offset: -1px;
    rx: 2;
    ry: 2;
}
text.month {
    font-size: 10px;
    fill: #24292e;
}
</style>