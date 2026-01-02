<script>
    $(document).ready(function () {

        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const myChart2 = new Chart(ctx2, {
            type: 'radar',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [{
                    label: "A",
                    fill: true,
                    backgroundColor: "rgba(179,181,198,0.2)",
                    borderColor: "rgba(179,181,198,1)",
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "rgba(179,181,198,1)",
                    data: [8.77, 55.61, 21.69, 6.62, 6.82],

                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold'
                        },
                    }

                }, {
                    label: "B",
                    fill: true,
                    backgroundColor: "rgba(255,99,132,0.2)",
                    borderColor: "rgba(255,99,132,1)",
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "rgba(255,99,132,1)",
                    pointBorderColor: "#fff",
                    data: [25.48, 54.16, 7.61, 8.06, 4.45],

                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold'
                        },
                    }

                }

                ]
            },
            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    datalabels: {
                        backgroundColor: function (context) {
                            return context.dataset.borderColor;
                        },

                        formatter: Math.round
                    },
                    aspectRatio: 4 / 3,
                    elements: {
                        point: {
                            hoverRadius: 20,
                            radius: 15
                        }
                    },
                    title: {
                        display: true,
                        text: 'Distribution in % of world population'
                    }
                },
            }
        });
    });
</script>

<!-- reportes ejemplo -->
    <div class="card text-center">
        <div class="card-body">
            <!-- canvas -->
            <canvas id="myChart2" width="400" height="400"></canvas>
            <!-- spinner -->
            <div class="text-center">
                <div class="spinner-border text-primary mx-auto mb-5" id="spinner"
                    style="width: 200px;height:200px;display:none;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- end spinner -->
            <button class="btn btn-outline-dark" id="imageExport">Exportar PNG</button>
        </div>
        <!-- <div class="card-footer text-muted">2 days ago</div> -->
    </div>
    <br>
