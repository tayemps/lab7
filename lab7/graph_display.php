<?php include('db_connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenditure Graphs</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        canvas {
            max-width: 90%; /* Restrict the width */
            max-height: 400px; /* Restrict the height */
            margin: 20px auto;
            display: block;
        }

        .chart-container {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <!-- Domestic Visitors Section -->
    <h1>Expenditure by Domestic Visitors</h1>
    <div class="chart-container">
        <canvas id="barChartVisitors"></canvas>
        <canvas id="pieChartVisitors"></canvas>
    </div>

    <?php
    // Fetch data from the database for Domestic Visitors
    $sql = "SELECT * FROM expenditure_domestic_visitors";
    $result = $conn->query($sql);

    $components_visitors = [];
    $expenditure_2010_visitors = [];
    $expenditure_2011_visitors = [];

    while ($row = $result->fetch_assoc()) {
        $components_visitors[] = $row['component'];
        $expenditure_2010_visitors[] = $row['expenditure_2010'];
        $expenditure_2011_visitors[] = $row['expenditure_2011'];
    }
    ?>

    <!-- Domestic Tourists Section -->
    <h1>Expenditure by Domestic Tourists</h1>
    <div class="chart-container">
        <canvas id="barChartTourists"></canvas>
        <canvas id="pieChartTourists"></canvas>
    </div>

    <?php
    // Hardcoded data for Domestic Tourists
    $components_tourists = ["Food & beverages", "Transport", "Accommodation", "Shopping", "Other activities"];
    $expenditure_2010_tourists = [4000, 5000, 3500, 2000, 1500];
    $expenditure_2011_tourists = [4500, 5200, 3000, 2500, 1800];
    ?>

    <script>
        // Data for Domestic Visitors (Database-driven)
        const componentsVisitors = <?php echo json_encode($components_visitors); ?>;
        const expenditure2010Visitors = <?php echo json_encode($expenditure_2010_visitors); ?>;
        const expenditure2011Visitors = <?php echo json_encode($expenditure_2011_visitors); ?>;

        // Bar Chart for Domestic Visitors
        const barCtxVisitors = document.getElementById('barChartVisitors').getContext('2d');
        new Chart(barCtxVisitors, {
            type: 'bar',
            data: {
                labels: componentsVisitors,
                datasets: [
                    {
                        label: '2010 Expenditure (RM Million)',
                        data: expenditure2010Visitors,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: '2011 Expenditure (RM Million)',
                        data: expenditure2011Visitors,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Pie Chart for Domestic Visitors
        const pieCtxVisitors = document.getElementById('pieChartVisitors').getContext('2d');
        new Chart(pieCtxVisitors, {
            type: 'pie',
            data: {
                labels: componentsVisitors,
                datasets: [{
                    data: expenditure2011Visitors,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { enabled: true }
                }
            }
        });

        // Data for Domestic Tourists (Hardcoded)
        const componentsTourists = <?php echo json_encode($components_tourists); ?>;
        const expenditure2010Tourists = <?php echo json_encode($expenditure_2010_tourists); ?>;
        const expenditure2011Tourists = <?php echo json_encode($expenditure_2011_tourists); ?>;

        // Bar Chart for Domestic Tourists
        const barCtxTourists = document.getElementById('barChartTourists').getContext('2d');
        new Chart(barCtxTourists, {
            type: 'bar',
            data: {
                labels: componentsTourists,
                datasets: [
                    {
                        label: '2010 Expenditure (RM Million)',
                        data: expenditure2010Tourists,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: '2011 Expenditure (RM Million)',
                        data: expenditure2011Tourists,
                        backgroundColor: 'rgba(153, 102, 255, 0.7)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Pie Chart for Domestic Tourists
        const pieCtxTourists = document.getElementById('pieChartTourists').getContext('2d');
        new Chart(pieCtxTourists, {
            type: 'pie',
            data: {
                labels: componentsTourists,
                datasets: [{
                    data: expenditure2011Tourists,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { enabled: true }
                }
            }
        });
    </script>
</body>
</html>
