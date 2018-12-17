window.onload = function () {
	// Convert JSON data from string to object to get draw chart
	var dataGold = JSON.parse(document.getElementById('js-data-gold').value);
	var dataEuro = JSON.parse(document.getElementById('js-data-euro').value);
	var dataGBP = JSON.parse(document.getElementById('js-data-gbp').value);
	var dataYen = JSON.parse(document.getElementById('js-data-yen').value);
	var dataUSD = JSON.parse(document.getElementById('js-data-usd').value);
	var dataBTC = JSON.parse(document.getElementById('js-data-btc').value);

	// Config data for Chart of GOLD
	var chartGold = new CanvasJS.Chart("js-chart-gold", {
		animationEnabled: true,
		title:{
			text: "Chart of GOLD (SJC)"
		},
		subtitles: [{
			text: "GOLD SJC to VNĐ",
			fontSize: 18
		}],
		axisX:{      
            valueFormatString: "DD/MM/YYYY HH TT",
            labelAngle: 0
        },
		axisY: {
			includeZero: false,
			prefix: "VNĐ "
		},
		legend:{
			cursor: "pointer",
			itemclick: toggleDataGold
		},
		toolTip: {
			shared: true
		},
		data: [
		{
			type: "area",
			name: "SJC",
			showInLegend: "true",
			xValueType: "dateTime",
			xValueFormatString: "DD MMMM YYYY HH:mm TT",
			yValueFormatString: "VNĐ #,##0",
			dataPoints: dataGold
		}]
	});

	// Config data for Chart of Currency
	var chartCurrency = new CanvasJS.Chart("js-chart-currency", {
		animationEnabled: true,
		title:{
			text: "Chart of Currency"
		},
		subtitles: [{
			text: "GBP, EUR, YEN, USD to VNĐ",
			fontSize: 18
		}],
		axisX:{      
            valueFormatString: "DD/MM/YYYY HH TT",
            labelAngle: 0
        },
		axisY: {
			includeZero: false,
			prefix: "VNĐ "
		},
		legend:{
			cursor: "pointer",
			itemclick: toggleDataCurrency
		},
		toolTip: {
			shared: true
		},
		data: [
		{
			type: "area",
			name: "EUR",
			showInLegend: "true",
			xValueFormatString: "DD MMMM YYYY HH:mm TT",
			xValueType: "dateTime",
			yValueFormatString: "VNĐ #,##0",
			dataPoints: dataEuro
		},
		{
			type: "area",
			name: "GBP",
			showInLegend: "true",
			xValueType: "dateTime",
			xValueFormatString: "DD MMMM YYYY HH:mm TT",
			yValueFormatString: "VNĐ #,##0",
			dataPoints: dataGBP
		},
		{
			type: "area",
			name: "YEN",
			showInLegend: "true",
			xValueType: "dateTime",
			xValueFormatString: "DD MMMM YYYY HH:mm TT",
			yValueFormatString: "VNĐ #,##0",
			dataPoints: dataYen
		},
		{
			type: "area",
			name: "USD",
			showInLegend: "true",
			xValueType: "dateTime",
			xValueFormatString: "DD MMMM YYYY HH:mm TT",
			yValueFormatString: "VNĐ #,##0",
			dataPoints: dataUSD
		}
		]
	});

	// Config data for Chart of Bitcoin
	var chartBitcoin = new CanvasJS.Chart("js-chart-bitcoin", {
		animationEnabled: true,
		title:{
			text: "Chart of Bitcoin"
		},
		subtitles: [{
			text: "Bitcoin to VNĐ",
			fontSize: 18
		}],
		axisX:{      
            valueFormatString: "DD/MM/YYYY HH TT",
            labelAngle: 0
        },
		axisY: {
			includeZero: false,
			prefix: "VNĐ "
		},
		legend:{
			cursor: "pointer",
			itemclick: toggleDataBitcoin
		},
		toolTip: {
			shared: true
		},
		data: [
		{
			type: "area",
			name: "BTC",
			showInLegend: "true",
			xValueType: "dateTime",
			xValueFormatString: "DD MMMM YYYY HH:mm TT",
			yValueFormatString: "VNĐ #,##0",
			dataPoints: dataBTC
		}
		]
	});
 
 	// Draw 3 chart
 	chartGold.render();
 	chartCurrency.render();
	chartBitcoin.render();
 
	/**
     * Function to handle event click on name data in chart of gold
     * @param object e is the chart will be handle
     * @return void
     */
	function toggleDataGold(e) 
	{
		dataVisible(e);
		chartGold.render();
	}

	/**
     * Function to handle event click on name data in chart of currency
     * @param object e is the chart will be handle
     * @return void
     */
	function toggleDataCurrency(e) 
	{
		dataVisible(e);
		chartCurrency.render();
	}

	/**
     * Function to handle event click on name data in chart of bitcoin
     * @param object e is the chart will be handle
     * @return void
     */
	function toggleDataBitcoin(e) 
	{
		dataVisible(e);
		chartBitcoin.render();
	}

	/**
     * Function to hide data of chart
     * @param object e is the chart will be handle
     * @return void
     */
	function dataVisible(e) 
	{
		// Check property visible of this chart
		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		}
		else{
			e.dataSeries.visible = true;
		}
	}
}