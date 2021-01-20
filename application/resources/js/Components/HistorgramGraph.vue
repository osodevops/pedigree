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
                colors: ["#008FFB"],
                title: {
                    text: "HeatMap Chart (Single color)"
                }
            },
            series: [
                {
                    name: "Metric1",
                    data: [
                        {
                            x: "W1",
                            y: 22
                        },
                        {
                            x: "W2",
                            y: 29
                        },
                        {
                            x: "W3",
                            y: 13
                        },
                        {
                            x: "W4",
                            y: 32
                        }
                    ]
                },
                {
                    name: "Metric2",
                    data: [
                        {
                            x: "W1",
                            y: 22
                        },
                        {
                            x: "W2",
                            y: 29
                        },
                        {
                            x: "W3",
                            y: 13
                        },
                        {
                            x: "W4",
                            y: 32
                        }
                    ]
                },
                {
                    name: "Metric3",
                    data: [
                        {
                            x: "W1",
                            y: 22
                        },
                        {
                            x: "W2",
                            y: 29
                        },
                        {
                            x: "W3",
                            y: 13
                        },
                        {
                            x: "W4",
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
