<script>
    $(document).ready(function () {

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    // borderColor: [
                    //     'rgba(255, 99, 132, 1)',
                    //     'rgba(54, 162, 235, 1)',
                    //     'rgba(255, 206, 86, 1)',
                    //     'rgba(75, 192, 192, 1)',
                    //     'rgba(153, 102, 255, 1)',
                    //     'rgba(255, 159, 64, 1)'
                    // ],
                    // borderWidth: 2


                }]
            },

            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    datalabels: {
                        backgroundColor: function (context) {
                            return context.dataset.backgroundColor;
                        },
                        borderColor: 'white',
                        borderRadius: 25,
                        borderWidth: 1,
                        color: 'white',
                        display: function (context) {
                            var dataset = context.dataset;
                            var count = dataset.data.length;
                            var value = dataset.data[context.dataIndex];
                            return value;
                        },
                        font: {
                            weight: 'bold'
                        },
                        padding: 6,
                        formatter: Math.round
                    },

                    title: {
                        display: true,
                        text: 'Reporte circular',
                        padding: 0,
                        // color: '#56b2c4',
                    }

                },


                // Core options
                // aspectRatio: 4 / 3,
                cutoutPercentage: 32,
                layout: {
                    padding: 10
                },
                elements: {
                    line: {
                        fill: false
                    },
                    point: {
                        hoverRadius: 7,
                        radius: 5
                    }
                }
            }
        });
    });
</script>


<!-- reportes ejemplo -->
<div class="card text-center">
    <div class="card-body">
        <!-- canvas -->
        <canvas id="myChart" width="400" height="400"></canvas>
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