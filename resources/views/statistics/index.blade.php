<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика посещений</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        canvas {
            max-width: 100%;
            max-height: 100%;
        }

        #visitsPerHourChart {
            height: 50%;
            width: 80%;
        }

        #visitsByCityChart {
            height: 50%;
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Статистика посещений</h1>

        <h2>Посещения по часам</h2>
        <canvas id="visitsPerHourChart"></canvas>

        <h2>Посещения по городам</h2>
        <canvas id="visitsByCityChart"></canvas>
    </div>

    <script>
        console.log(@json($visitsPerHour));
        console.log(@json($visitsByCity));
        const visitsPerHour = @json($visitsPerHour);
        const visitsByCity = @json($visitsByCity);
        const hourLabels = visitsPerHour.map(v => v.hour + ":00");
        const visitCounts = visitsPerHour.map(v => v.visits);

        const ctx = document.getElementById('visitsPerHourChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: hourLabels,
                datasets: [{
                    label: 'Количество посещений',
                    data: visitCounts,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        });
        const cityLabels = visitsByCity.map(v => v.city);
        const cityCounts = visitsByCity.map(v => v.count);
        const ctxCity = document.getElementById('visitsByCityChart').getContext('2d');
        new Chart(ctxCity, {
            type: 'pie',
            data: {
                labels: cityLabels,
                datasets: [{
                    label: 'Посещения по городам',
                    data: cityCounts,
                    backgroundColor: ['red', 'blue', 'green', 'yellow', 'purple', 'orange']
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        });
    </script>
</body>
</html>
