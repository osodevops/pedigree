<template>
    <div id="chart" class="py-12"></div>
</template>

<script>
import ApexCharts from 'apexcharts'

export default {
    props: [
        'companies',
    ],
    mounted() {
        var options = {
          series: [{
          name: 'Stars',
          type: 'column',
          data: this.take('stars')
        }, {
          name: 'Stars (AGR)',
          type: 'line',
          data: _.map(this.take('stars_agr'), (row) => {
              return Math.ceil(row / 100);
          })
        }],
        chart: {
          height: 350,
          type: 'line',
          toolbar: {
              show: false,
          }
        },
        stroke: {
          width: [0, 2]
        },
        labels: this.take('company.name'),
        yaxis: [{
          title: {
            text: 'Stars',
          },
          labels: {
              formatter: (value) => {
                if (value > 1000) {
                    return Math.floor(value / 1000) + 'k';
                }
                return value;
            }
          },

        }, {
          opposite: true,
          title: {
            text: 'Star growth (AGR)'
          },
          labels: {
            formatter: (value) => {
              return value + "%";
            }
          },
          axisTicks: {
              show: true,
          }
        }],
        colors:['#3f83f8', '#000000']
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    },
    methods: {
        take(key) {
            return _.map(this.companies, (row) => {
                return _.get(row, key);
            });
        }
    }
}
</script>
