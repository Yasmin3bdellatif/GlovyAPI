<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glovy - Parkinson's Disease</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <!-- <script src="script.js"></script> -->
</head>
<body>
<header>
    <div class="logo">
        <img src="logo.png" alt="FollowUp Logo">
    </div>
    <div>
        <p style="margin-top: 15px; margin-bottom: 0px; font-size: 25px; color: #489cc0;">Patient Report</p>
        <p style="margin-top: 0px; margin-bottom: 0px; font-size: 14px; color: #8cc2da; text-align: center;">Parkinson's Disease</p>
    </div>
</header>
<main>
    <section class="profile">
        <h4 class="hh">Name: {{ $username }}</h4>
        <h4 class="hh">Date of Birth: {{ $birthdate }}</h4>
        <h4 class="hh">Number: {{ $phoneNumber }}</h4>
    </section>
    <section class="chart-container">
        <p style="margin-bottom: 10px; margin-top: 0px; font-weight: 900; font-size: 20px;">Change in X Position</p>
        <canvas id="linchart" height="270px" width="900px"></canvas>
    </section>
</main>
<script>
    var ctx = document.getElementById('linchart').getContext('2d');
    var linchart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Time 1', 'Time 2', 'Time 3', 'Time 4', 'Time 5', 'Time 6', 'Time 7', 'Time 8', 'Time 9', 'Time 10'],
            datasets: [{
                label: 'X Position of Hand',
                data: @json($chartData), // البيانات من Firebase
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(75, 192, 192, 0.4)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(75, 192, 192, 1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75, 192, 192, 1)",
                pointHoverBorderColor: "rgba(220, 220, 220, 1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Time'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'X axis Position'
                    }
                }
            }
        }
    });
</script>
</body>
</html>
