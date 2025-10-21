<script>

    $(document).ready(function () {

        const ctx4 = document.getElementById('myChart4').getContext('2d');
        const myChart4 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd", "#3e95cd"],
                    data: [247, 526, 737, 787, 437],

                    datalabels: {
                        color: 'white',
                        font: {
                            weight: 'bold'
                        },
                        // posicion label
                        align: 'start',
                        anchor: 'end'
                    }


                },
                {
                    label: "Population (millions)",
                    backgroundColor: ["#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2", "#8e5ea2"],
                    data: [2478, 5267, 734, 784, 433],

                    datalabels: {
                        color: 'white',
                        font: {
                            weight: 'bold'
                        },
                        // posicion label
                        align: 'start',
                        anchor: 'end'
                    }


                }

                ]
            },

            plugins: [ChartDataLabels],
            options: {
                // apilar barras
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                },
                aspectRatio: 3 / 3,
                layout: {
                    padding: 5
                },
                plugins: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: true,
                        text: 'Predicted world population (millions) in 2050'
                    },

                },

            }

        });
    });
</script>

<!-- reportes ejemplo -->
<div class="card text-center">
    <div class="card-body">
        <!-- canvas -->
        <canvas id="myChart4" width="400" height="400"></canvas>
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