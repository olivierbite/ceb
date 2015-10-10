<script src="{{Url()}}/assets/dist/js/Chart.js" type="text/javascript"></script>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="border: 1px solid #f1f1f1;">
<h4>{{ trans('report.contribution_per_month') }}</h4>
        <canvas id="chart-area1" />
</div> 
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="border: 1px solid #f1f1f1;">
<h4>{{ trans('report.member_per_institution') }}</h4>
	<canvas id="chart-area2" />
</div> 
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="border: 1px solid #f1f1f1;">
<h4>{{ trans('report.given_loan_per_month') }}</h4>
        <canvas id="chart-area3" />
</div> 
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="border: 1px solid #f1f1f1;">
<h4>{{ trans('report.given_loan_per_insitution') }}</h4>
	<canvas id="chart-area4" />
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
		var lineChartData = {
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
      var pieData = [ @foreach ($contributions as $contribution)
                       {
				        value: {!!$contribution->amount!!},
				        color: "#F7464A",
				        highlight: "#FF5A5E",
				        label: "{!!$contribution->month!!}"
					    }
					  ,@endforeach
					 ];

      var pieData = [ @foreach ($contributions as $contribution)
                   {
			        value: {!!$contribution->amount!!},
			        color: "#F7464A",
			        highlight: "#FF5A5E",
			        label: "{!!$contribution->month!!}"
				    }
				  ,@endforeach
				 ];

	var radarChartData = {
		labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
		datasets: [
			{
				label: "My First dataset",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: [65,59,90,81,56,55,40]
			},
			{
				label: "My Second dataset",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: [28,48,40,19,96,27,100]
			}
		]
	};

    window.onload = function() {
        var ctx1 = document.getElementById("chart-area1").getContext("2d");
        window.myPie = new Chart(ctx1).Bar(barChartData);

        var ctx2 = document.getElementById("chart-area2").getContext("2d");
        window.myPie = new Chart(ctx2).Pie(pieData);       
        
        var ctx3 = document.getElementById("chart-area3").getContext("2d");
        window.myPie = new Chart(ctx3).Line(lineChartData);

        var ctx4 = document.getElementById("chart-area4").getContext("2d");
        window.myPie = new Chart(ctx4).Radar(radarChartData);
    };
    
	</script>