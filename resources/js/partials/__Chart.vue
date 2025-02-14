<template>
    <canvas id="responseChart" class="w-full"></canvas>
</template>

<script>

export default {
    name: 'Header',
    props: {
        answers: {
            type: [Object, Array]
        }
    },
    data() {
        return {
        }
    },
    methods: {
        loadChart() {
            let xValues = ["0", "1", "2", "3", "4", "5"];
            let xLabels = ["Very poor", "Poor", "Fair", "Good", "Very good", "Exellent"];
            let yValues = xValues.map(this.displayAnswers);

            var barColors = "rgba(0, 0, 0, 0.65)";

            new Chart("responseChart", {
              type: "bar",
              data: {
                labels: xLabels,
                datasets: [{
                    backgroundColor: barColors,
                    borderColor: "black",
                    borderWidth: 2,
                    data: yValues
                }]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: { display: false },
                title: {
                    display: true
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            max: 100,
                            stepSize: 10,
                            callback: function(value) {
                                return value + "%";
                            }
                        }
                    }]
                }
              }
            });
        },

        displayAnswers(xValues) {
            return (this.answers[xValues] / this.answers.total) * 100;
        }
    },
    mounted () {
        this.loadChart();
    },
    created() {}
}

</script>