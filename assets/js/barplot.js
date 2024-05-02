var countries = ['Tuvalu', 'Burundi', 'Chad', 'Somalia', 'Central African Republic', 'Rwanda', 'Niger', 'Sierra Leone', 'Ethiopia', 'Madagascar'];
        var energyConsumption = [0.0, 212.15319, 222.486983, 284.050823, 309.469573, 373.834004, 385.941909, 509.89938, 542.731811, 555.880324];

        // Create the bar plot
        var ctx = document.getElementById('bar-chart-lowest').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: countries,
                datasets: [{
                    label: 'Average energy consumption per capita (kWh/person)',
                    data: energyConsumption,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 100,
                            max: 500
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Average energy consumption per capita (kWh/person)'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Country'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Top 10 Countries with Highest Average Energy Consumption Per-Capita'
                },
                legend: {
                    display: false
                }
            }
        });

        var countries = ['Qatar', 'Iceland', 'Bahrain', 'Singapore', 'United Arab Emirates', 'Trinidad and Tobago', 'Kuwait', 'Canada', 'Norway', 'Luxembourg'];
        var energyConsumption = [215565.206190, 157872.888286, 153990.354762, 140814.132381, 140361.304048, 137467.305952, 119108.304143, 113492.290810, 109565.265190, 90423.056429];

        // Create the bar plot
        var ctx = document.getElementById('bar-chart-highest').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: countries,
                datasets: [{
                    label: 'Average energy consumption per capita (kWh/person)',
                    data: energyConsumption,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 50000,
                            max: 200000
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Average energy consumption per capita (kWh/person)'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Country'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Top 10 Countries with Highest Average Energy Consumption Per-Capita'
                },
                legend: {
                    display: false
                }
            }
        });