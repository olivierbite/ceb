<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <script src="{{Url()}}/assets/dist/js/Chart.js" type="text/javascript"></script>
		<div style="width:50%">
			<div>
				<canvas id="bar" height="450" width="600"></canvas>
			</div>
		</div>
		<div style="width:50%">
			<div>
				<canvas id="line" height="450" width="600"></canvas>
			</div>
		</div>
	<script>
		var barChartData = {
			labels : [@foreach ($contributions as $contribution){!!$contribution->month!!},@endforeach],
			datasets : [
				{
					label: "Contribution per month",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data :  [@foreach ($contributions as $contribution){!!$contribution->amount!!},@endforeach]
				}
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("bar").getContext("2d");
		window.mybar = new Chart(ctx).Bar(barChartData, {
			responsive: true
		});
	}

	</script>
</div>