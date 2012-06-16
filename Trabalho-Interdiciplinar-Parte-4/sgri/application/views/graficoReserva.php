<script type="text/javascript">
    $(function () {
        var chart;
        $(document).ready(function() {
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'container',
                    type: 'column'
                },
                title: {
                    text: 'Gráfico de Eventos Ativos e Cancelados Pelo Professor'
                },
               
                xAxis: {
                    categories: [
                        'Total de '
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Reservas (N)'
                    }
                },
                legend: {
                    layout: 'vertical',
                    backgroundColor: '#FFFFFF',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 100,
                    y: 70,
                    floating: true,
                    shadow: true
                },
                tooltip: {
                    formatter: function() {
                        return ''+
                            this.x +': '+ this.y +' reservas';
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Canceladas',
                        data: [<?php echo $ativas; ?>]
    
                    }, {
                        name: 'Ativas',
                        data: [<?php echo $canceladas; ?>]
    
                    }]
            });
        });
    
    });
</script>

<div class="widget chartWrapper">
    <div class="title"><img src="../theme/images/icons/dark/graph.png" alt="" class="titleIcon" /><h6>Grafico</h6></div>
    <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
</div>
