<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Page</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Interaction Page</h1>
    <div class="buttons">
        <button id="regenerate">Regenerate Link</button>
        <button id="deactivate">Deactivate Link</button>
        <button id="imFeelingLucky">I'm Feeling Lucky</button>
        <button id="history">History</button>
    </div>
    <div id="result"></div>
    <div id="history-result"></div>
</div>

<script>
    document.getElementById('regenerate').addEventListener('click', function () {
        axios.post('{{ route('interact.regenerate', ['token' => $token]) }}', {
            _token: '{{ csrf_token() }}'
        })
            .then(function (response) {
                window.location.href = '{{ url('token') }}/' + response.data.token;
            })
            .catch(function (error) {
                console.error('Error regenerating link:', error);
            });
    });

    document.getElementById('deactivate').addEventListener('click', function () {
        axios.post('{{ route('interact.deactivate', ['token' => $token]) }}', {
            _token: '{{ csrf_token() }}'
        })
            .then(function (response) {
                window.location.href = '{{ url('/') }}';
            })
            .catch(function (error) {
                console.error('Error deactivating link:', error);
            });
    });

    document.getElementById('imFeelingLucky').addEventListener('click', function () {
        axios.get('{{ route('interact.lucky', ['token' => $token]) }}')
            .then(function (response) {
                document.getElementById('history-result').innerHTML = '';
                const data = response.data;
                document.getElementById('result').innerHTML = `Number: ${data.number} - Result: ${data.result} - Win Amount: ` + Math.round(data.win_amount * 100) / 100;
            })
            .catch(function (error) {
                console.error('Error fetching lucky data:', error);
            });
    });

    document.getElementById('history').addEventListener('click', function () {
        axios.get('{{ route('interact.history', ['token' => $token]) }}')
            .then(function (response) {
                document.getElementById('result').innerHTML = '';
                const data = response.data;
                let historyHtml = '';
                data.forEach(item => {
                    historyHtml += `<div>Number: ${item.number} - Result: ${item.result} - Win Amount: ${item.win_amount}</div>`;
                });
                document.getElementById('history-result').innerHTML = historyHtml;
            })
            .catch(function (error) {
                console.error('Error fetching history data:', error);
            });
    });
</script>
</body>
</html>
