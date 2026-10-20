<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - TaskFlow</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
</head>

<body>

    <div class="agenda-layout">

        <aside class="agenda-sidebar">

            <div class="brand-box">

                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo TaskFlow">

                <div class="brand-text">
                    <h1>TaskFlow</h1>
                    <p>Workspace de produtividade</p>
                </div>

            </div>

            <nav class="agenda-nav">

                <a href="/dashboard" class="active">Dashboard</a>

                <a href="/">Tarefas</a>

                <a href="/usuario">Usuários</a>

                <a href="/projeto">Projetos</a>

            </nav>

        </aside>


        <main class="agenda-main">

            @php
                $usuario = Auth::user();
            @endphp


            <section class="hero-box">

                <div>

                    <h2>Dashboard</h2>

                    <p>
                        Acompanhe os dados da sua agenda.
                    </p>

                </div>


                <div class="top-actions">

                    <a href="/" class="btn-primary">
                        Tarefas
                    </a>

                    <form action="/logout" method="POST" style="display: inline;">

                        @csrf

                        <button type="submit" class="btn-secondary">
                            Sair
                        </button>

                    </form>

                </div>

            </section>


            <section class="dashboard-grid">

                <div class="dashboard-chart">
                    <div id="main"></div>
                </div>

                <div class="dashboard-chart">
                    <div id="graficoProjetos"></div>
                </div>

                <div class="dashboard-chart">
                    <div id="graficoTarefasProjeto"></div>
                </div>

                <div class="dashboard-chart">
                    <div id="graficoDispersao"></div>
                </div>
                
            </section>

        </main>

    </div>


    <!-- GRÁFICO 1 -->

    <script>

        const dadosStatus = @json($tarefasPorStatus);

        const dados = dadosStatus.map(item => ({
            value: item.quantidade,
            name: item.status
        }));

        var chartDom = document.getElementById('main');
        var myChart = echarts.init(chartDom);
        var option;

        option = {

            title: {
                text: 'Tarefas por Status'
            },

            tooltip: {
                trigger: 'item'
            },

            legend: {
                top: '10%',
                left: 'center'
            },

            series: [
                {
                    name: 'Tarefas',
                    type: 'pie',
                    radius: ['40%', '70%'],

                    avoidLabelOverlap: false,

                    label: {
                        show: false,
                        position: 'center'
                    },

                    emphasis: {
                        label: {
                            show: true,
                            fontSize: 40,
                            fontWeight: 'bold'
                        }
                    },

                    labelLine: {
                        show: false
                    },

                    data: dados
                }
            ]
        };

        option && myChart.setOption(option);

    </script>


    <!-- GRÁFICO 2 -->

    <script>

        const projetosPorUsuario = @json($projetosPorUsuario);

        const nomes = projetosPorUsuario.map(item => item.nome);

        const quantidades = projetosPorUsuario.map(item => item.quantidade);

        var chartDom = document.getElementById('graficoProjetos');
        var myChart = echarts.init(chartDom);
        var option;

        option = {

            title: {
                text: 'Projetos por Usuário'
            },

            tooltip: {
                trigger: 'axis'
            },

            xAxis: {
                type: 'category',
                data: nomes
            },

            yAxis: {
                type: 'value'
            },

            series: [
                {
                    data: quantidades,
                    type: 'bar',

                    showBackground: true,

                    backgroundStyle: {
                        color: 'rgba(180, 180, 180, 0.2)'
                    }
                }
            ]
        };

        option && myChart.setOption(option);

    </script>


    <!-- GRÁFICO 3 -->

    <script>

        const tarefasPorProjeto = @json($tarefasPorProjeto);

        const nomesProjetos =
            tarefasPorProjeto.map(item => item.nome);

        const quantidadesTarefas =
            tarefasPorProjeto.map(item => item.quantiaTarefas);

        var chartDom =
            document.getElementById('graficoTarefasProjeto');

        var myChart = echarts.init(chartDom);

        var option;

        option = {

            title: {
                text: 'Tarefas por Projeto'
            },

            tooltip: {
                trigger: 'axis'
            },

            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },

            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },

            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: nomesProjetos
            },

            yAxis: {
                type: 'value'
            },

            series: [
                {
                    name: 'Tarefas',
                    type: 'line',
                    data: quantidadesTarefas
                }
            ]
        };

        option && myChart.setOption(option);

    </script>


    <!-- GRÁFICO 4 -->

    <script>

        const projetosETarefasPorUsuario =
            @json($projetosETarefasPorUsuario);

        const dadosDispersao =
            projetosETarefasPorUsuario.map(item => [

                Number(item.projetos),

                Number(item.tarefas)

            ]);

        var chartDom =
            document.getElementById('graficoDispersao');

        var myChart = echarts.init(chartDom);

        var option;

        option = {

            title: {
                text: 'Projetos x Tarefas por Usuário'
            },

            xAxis: {
                name: 'Projetos'
            },

            yAxis: {
                name: 'Tarefas'
            },

            tooltip: {
                trigger: 'item'
            },

            series: [
                {
                    symbolSize: 20,

                    data: dadosDispersao,

                    type: 'scatter'
                }
            ]
        };

        option && myChart.setOption(option);

    </script>


</body>

</html>