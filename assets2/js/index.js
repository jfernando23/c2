$(function() {
    "use strict";

     // chart 1

		  var ctx = document.getElementById('chart1').getContext('2d');

			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ["Jensdfgdf", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"],
					datasets: [{
						label: 'New Visitor',
						data: [7, 5, 14, 7, 12, 6, 10, 6, 11, 5],
						backgroundColor: '#fff',
						borderColor: "transparent",
						pointRadius :"0",
						borderWidth: 3
					}, {
						label: 'Old Visitor',
						data: [10, 15, 14, 17, 12, 16, 10, 6, 11, 15],
						backgroundColor: "rgba(255, 255, 255, 0.25)",
						borderColor: "transparent",
						pointRadius :"0",
						borderWidth: 1
					}]
				},
			options: {
				maintainAspectRatio: false,
				legend: {
				  display: false,
				  labels: {
					fontColor: '#ddd',
					boxWidth:40
				  }
				},
				tooltips: {
				  displayColors:false
				},
			  scales: {
				  xAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#ddd'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(221, 221, 221, 0.08)"
					},
				  }],
				   yAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#ddd'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(221, 221, 221, 0.08)"
					},
				  }]
				 }

			 }
			});

      var ct2x = document.getElementById("migrafica").getContext('2d');
      var char=new Chart(ct2x,{
      type:"bar",
      data:{
        labels:["hola","sor","yo","de nuevo"],
          datasets:[
            {
              label:"Mi grafica"
            }
          ]
      }
    });
    // chart 2
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Si", "No",],
        datasets: [{
          label: "Respuestas",
          lineTension: 0.3,
          backgroundColor: "rgba(0, 136, 0, 0.2)",
          borderColor: "rgba(0, 136, 0, 1)",
          pointRadius: 5,
          pointBackgroundColor: "rgba(0, 136, 0, 1)",
          pointBorderColor: "rgba(0, 136, 0, 1)",
          pointHoverRadius: 5,
          pointHoverBackgroundColor: "rgba(0, 136, 0, 1)",
          pointHitRadius: 50,
          pointBorderWidth: 2,
          data: [10,5],
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{

            gridLines: {
              color: "rgba(0, 0, 0, .125)",
            },ticks: {
              beginAtZero: true
          }
          }],
        },
        legend: {
          display: false
        }
      }
    });
		var ctx = document.getElementById("chart2").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ["Direct", "Affiliate", "mail", "Other","lk"],
					datasets: [{
						backgroundColor: [
							"#ffffff",
							"rgba(255, 255, 255, 0.70)",
							"rgba(255, 255, 255, 0.50)",
							"rgba(255, 255, 255, 0.20)",
              "rgba(255, 255, 255, 0.10)"
						],
						data: [5856, 2602, 1802, 1105,3456],
						borderWidth: [0, 0, 0, 0, 0,0]
					}]
				},
			options: {
				maintainAspectRatio: false,
			   legend: {
				 position :"bottom",
				 display: false,
				    labels: {
					  fontColor: '#ddd',
					  boxWidth:15
				   }
				}
				,
				tooltips: {
				  displayColors:false
				}
			   }
			});




   });
