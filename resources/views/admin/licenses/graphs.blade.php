@extends('layouts.app')

@section('content')

<div id="chartContainer" style="height: 400px; width: 100%;"></div>

@endsection

@section('extra_js')

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Date"
	},
	axisY: {
		title: "Number Of Licenses Used",
		includeZero: false
	},
	data: [{
		type: "stepLine",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection