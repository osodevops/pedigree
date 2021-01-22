<template>
    <ApexChart type="heatmap" :series="series" :options="options" />
</template>

<script>
export default {
    data() {
        return {
            options: {
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                colors: ["#008FFB"]
            },
            series: [
                {
                    data: [
                        {
                            x: 1,
                            y: 22
                        },
                        {
                            x: 2,
                            y: 29
                        },
                        {
                            x: 3,
                            y: 13
                        },
                        {
                            x: 4,
                            y: 32
                        }
                    ]
                },
                {
                    data: [
                        {
                            x: 1,
                            y: 22
                        },
                        {
                            x: 2,
                            y: 29
                        },
                        {
                            x: 3,
                            y: 13
                        },
                        {
                            x: 4,
                            y: 32
                        }
                    ]
                },
                {
                    data: [
                        {
                            x: 1,
                            y: 22
                        },
                        {
                            x: 2,
                            y: 29
                        },
                        {
                            x: 3,
                            y: 13
                        },
                        {
                            x: 4,
                            y: 32
                        }
                    ]
                }
            ]
        };
    }
};
</script>

<style lang="scss" scoped></style>
