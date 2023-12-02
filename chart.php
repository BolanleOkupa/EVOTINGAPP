<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Election Results Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js from CDN -->
</head>
<body>
    <canvas id="electionResultsChart" width="400" height="200"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Extract data for the chart
            var candidateNames = <?php echo json_encode($candidateNames); ?>;
            var totalVotes = <?php echo json_encode($totalVotes); ?>;

            var ctx = document.getElementById('electionResultsChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: candidateNames,
                    datasets: [{
                        label: 'Total Votes',
                        data: totalVotes,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)', // Adjust color as needed
                        borderColor: 'rgba(54, 162, 235, 1)', // Adjust color as needed
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
