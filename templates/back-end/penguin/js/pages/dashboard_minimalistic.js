'use strict';
// Line chart
// ------------------------------
// Initialize chart
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawLineChart);
// Chart settings
function drawLineChart() {
    // Data
    var data = google.visualization.arrayToDataTable([
        ['Year', 'Penjualan'],
        ['2012',  1000],
        ['2013',  1170],
        ['2014',  660],
        ['2015',  1030],
		['2016',  1437]
    ]);
    // Options
    var options = {
        fontName: 'open_sansregular',
        height: 260,
        curveType: 'function',
        fontSize: 12,
        chartArea: {
            left: '10%',
            width: '100%',
            height: 200
        },
        pointSize:8,
        tooltip: {
            textStyle: {
                fontName: 'open_sansregular',
                fontSize: 12
            }
        },
        vAxis: {
            
            titleTextStyle: {
                fontSize: 12,
                italic: false
            },
            gridlines:{
                color: '#f8f8f8',
                count: 8
            },
            minValue: 0
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        },
		series: {
            0: { color: '#4CAF50' },
            1: { color: '#3F51B5' }
        }
    };
    // Draw chart
    var line_chart = new google.visualization.LineChart($('#google-line')[0]);
    line_chart.draw(data, options);
}

// Resize chart
// ------------------------------
$(function () {
    // Resize chart on sidebar width change and window resize
    $(window).on('resize', resize);
    $(".sidebar-control").on('click', resize);
    // Resize function
    function resize() {
        drawLineChart();
    }
});