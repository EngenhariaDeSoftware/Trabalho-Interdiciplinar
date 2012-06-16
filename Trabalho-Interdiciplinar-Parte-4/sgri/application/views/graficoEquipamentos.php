<script type="text/javascript">
    $(function () {
        var chart;
        $(document).ready(function() {
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'graficoEquipamentosProfessor',
                    type: 'column'
                },
                title: {
                    text: 'Equipamentos mais reservados e menos reservados'
                },
                xAxis: {
                    categories: [
                        'Equipamentos'
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Equipamentos (total)'
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
                            this.x +': '+ this.y +' no total';
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [
                    <?php echo $a; ?>
                    ]
            });
        });
    
    });
</script>

<div class="widget chartWrapper">
    <div class="title"><img src="../theme/images/icons/dark/graph.png" alt="" class="titleIcon" /><h6>Grafico de Equipamentos que Estão ATIVOS</h6></div>
    <div id="graficoEquipamentosProfessor" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
</div>