function createChart(labels, data) {

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'kihúzva',
                data: data,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            backgroundColor: 'rgba(54, 162, 235, 0.2)'
        }
    });
}

$.get(
    SITE_ROOT + "service/number_distribution",
    function(data) {
        let labels = [];
        let numbers = [];
        $.each(data.lista, function(key, elem) {
            labels.push(elem.szam);
            numbers.push(elem.darab);
        })
        createChart(labels, numbers);

    },
    "json")
