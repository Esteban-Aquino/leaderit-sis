$(document).ready(()=>inicializar());
function inicializar() {
    init_charts();
}

function init_charts() {

    if (typeof(Chart) === 'undefined') { return; }

    Chart.defaults.global.legend = {
        enabled: false
    };



    // Line chart

    if ($('#lineChart').length) {

        var ctx = document.getElementById("lineChart");
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"],
                datasets: [{
                    label: "Ventas",
                    backgroundColor: "rgba(38, 185, 154, 0.31)",
                    borderColor: "rgba(38, 185, 154, 0.7)",
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,
                    data: [120000, 120000, 60000, 39000, 200000, 150000, 75000]
                }]
            }
        });
        $('#lineChart').focus();

    }

  
}