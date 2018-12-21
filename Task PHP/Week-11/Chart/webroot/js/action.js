
var radar = document.getElementById('js-radar-chart').getContext('2d');
var bar = document.getElementById('js-bar-chart').getContext('2d');
var pie = document.getElementById('js-pie-chart').getContext('2d');
var dataRadar = JSON.parse(document.getElementById('js-data-radar').value);
var dataBar = JSON.parse(document.getElementById('js-data-bar').value);
var dataPie = JSON.parse(document.getElementById('js-data-pie').value);

var labelRadar = ["January", "February", "March", "April", "May", "June"];

/**
 * Function to get label for Radar Chart with name label and value
 * @param (string)array labelRadar is all label of radar chart
 * @param (int)array dataRadar is value for every label
 * @return (string)array is the Labels for Radar Chart
 */
function getLabelRadar(labelRadar, dataRadar) {
	var newLabel = []
	// Run loop for to add new label with name label and value of Radar Chart
	for (var i = 0; i < labelRadar.length; i++) {
		newLabel[i] = labelRadar[i] + "\n (" + dataRadar[i] + ")";
	}

	return newLabel;
}

// Draw Radar Chart
var radarChart = new Chart(radar, {
    type: 'radar',
    data: {
        labels: getLabelRadar(labelRadar, dataRadar),
        datasets: [
        {
            label: 'Opt1',
            data: dataRadar,
            backgroundColor: ['rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(255,99,132,1)'],
            borderWidth: 1
        }]
    },
    options: {
    	responsive: true,
    	title: {
            display: true,
            text: 'Radar Chart',
            fontSize: 20
        },
    	legend: {
	        display: false
	    },
        scales: {
        	tick: {
        		display: false
        	}
        }
    }
});

// Draw Bar Chart
var barChart = new Chart(bar, {
    type: 'horizontalBar',
    data: {
    	labels: labelRadar,
    	datasets: [{
    		label: 'Opt1',
            data: dataBar,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255,99,132,1)',
            borderWidth: 1,
    	}]
    },
    options: {
    	responsive: true,
    	title: {
            display: true,
            text: 'Bar Chart',
            fontSize: 20
        },
    	legend: {
	        display: false
	    },
	    scales: {
			yAxes: [{
		        gridLines: {
		            display: false
		        }
			}],
			xAxes: [{
				ticks: {
					beginAtZero:true,
					min: 0
				}
			}]
        }
    }
});

// Draw Pie Chart
var pieChart = new Chart(pie, {
    type: 'pie',
    data: {
    	labels: labelRadar,
    	datasets: [{
    		label: 'Opt1',
            data: dataPie,
            backgroundColor: [
	            'rgba(255,99,132,1)',
	            'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
			]
    	}]
    },
    options: {
    	responsive: true,
    	title: {
            display: true,
            text: 'Pie Chart',
            fontSize: 20
        },
    	legend: {
			display: false
		},
		plugins: {
			labels: [
			{
				render: function (args) 
				{
				    return args.label + '\n' + args.percentage + '%';
  				},
				fontColor: '#000',
				fontSize: 14,
				precision: 2
			}]
		}
    }
});
