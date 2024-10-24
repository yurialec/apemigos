<template>
    <div class="container">
        <div class="row mb-3">
            <div class="col text-center">
                <div class="card">
                    <div class="card-header">
                        Vendas
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas ref="chart1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col text-center">
                <div class="card">
                    <div class="card-header">
                        Votos
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas ref="chart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col text-center">
                <div class="card">
                    <div class="card-header">
                        grafico3
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas ref="chart3"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col text-center">
                <div class="card">
                    <div class="card-header">
                        grafico4
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas ref="chart4"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col text-center">
                <div class="card">
                    <div class="card-header">
                        grafico5
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas ref="chart5"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { Chart } from 'chart.js/auto';

export default {
    mounted() {
        this.createChart('chart1', {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [
                {
                    label: 'Sales',
                    data: [30, 50, 40, 60, 70],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                },
            ],
        }, 'bar');

        this.createChart('chart2', {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
            datasets: [
                {
                    label: 'Votes',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1,
                },
            ],
        }, 'bar');

        this.createChart('chart3', {
            labels: ['January', 'February', 'March', 'April'],
            datasets: [
                {
                    label: 'Revenue',
                    data: [100, 200, 150, 300],
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                },
            ],
        }, 'pie');

        this.createChart('chart4', {
            labels: ['A', 'B', 'C', 'D', 'E'],
            datasets: [
                {
                    label: 'Performance',
                    data: [70, 60, 80, 90, 85],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                },
            ],
        }, 'pie');

        this.createChart('chart5', {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    label: 'Monthly Data',
                    data: [120, 150, 170, 130, 180, 140, 160, 190, 200, 170, 210, 220],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: false,
                },
            ],
        }, 'line');
    },
    methods: {
        createChart(refName, chartData, chartType) {
            new Chart(this.$refs[refName], {
                type: chartType,
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });
        },
    },
};
</script>
