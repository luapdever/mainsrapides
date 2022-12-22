(function ($) {

      /* legent font family */
      var ctxFont = "'Quicksand', sans-serif",
          ctxTickColor = '#8896a5',
          months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];


      /* set chart js flobal style */
      Chart.defaults.global.defaultFontFamily = ctxFont;
      Chart.defaults.global.defaultFontColor = "#8896a5";
      Chart.defaults.global.defaultFontSize = 14;

      var jp_a = localStorage.getItem('vente_un_cinq_mois_prec');
      var jp_b = localStorage.getItem('vente_six_dix_mois_prec');
      var jp_c = localStorage.getItem('vente_onze_quinze_mois_prec');
      var jp_d = localStorage.getItem('vente_seize_vingt_mois_prec');
      var jp_e = localStorage.getItem('vente_vingtun_vingtcinq_mois_prec');
      var jp_f = localStorage.getItem('vente_vingtsix_trente_mois_prec');



      var jp_g = localStorage.getItem('vente_un_cinq_mois_en_cours');
      var jp_h = localStorage.getItem('vente_six_dix_mois_en_cours');
      var jp_i = localStorage.getItem('vente_onze_quinze_mois_en_cours');
      var jp_j = localStorage.getItem('vente_seize_vingt_mois_en_cours');
      var jp_k = localStorage.getItem('vente_vingtun_vingtcinq_mois_en_cours');
      var jp_l = localStorage.getItem('vente_vingtsix_trente_mois_en_cours');






    var jpy_a = localStorage.getItem('achat_un_cinq_mois_prec');
    var jpy_b = localStorage.getItem('achat_six_dix_mois_prec');
    var jpy_c = localStorage.getItem('achat_onze_quinze_mois_prec');
    var jpy_d = localStorage.getItem('achat_seize_vingt_mois_prec');
    var jpy_e = localStorage.getItem('achat_vingtun_vingtcinq_mois_prec');
    var jpy_f = localStorage.getItem('achat_vingtsix_trente_mois_prec');



    var jpy_g = localStorage.getItem('achat_un_cinq_mois_en_cours');
    var jpy_h = localStorage.getItem('achat_six_dix_mois_en_cours');
    var jpy_i = localStorage.getItem('achat_onze_quinze_mois_en_cours');
    var jpy_j = localStorage.getItem('achat_seize_vingt_mois_en_cours');
    var jpy_k = localStorage.getItem('achat_vingtun_vingtcinq_mois_en_cours');
    var jpy_l = localStorage.getItem('achat_vingtsix_trente_mois_en_cours');




      /* custom legend function */
      function customLegend(chart) {
          var text = [];
          text.push('<ul class="piechart'+ chart.id + '-legend">');
          var data = chart.data;
          var datasets = data.datasets;
          var labels = data.labels;
          if (datasets.length) {
              /*check if the type of the chart is line and take length accordingly for iteration*/
              var dataLength = chart.config.type === "line" ? datasets.length : datasets[0].backgroundColor.length;

              /*set the data source according to type*/
              function getData(i){
                  return (
                      [chart.config.type === "line" ? datasets[i].borderColor : datasets[0].backgroundColor[i],
                          chart.config.type === "line" ? datasets[i].label : data.labels[i]]);
              }

              /* loop through data to generate html */
              for (var i=0 ; i < dataLength; ++i) {
                  text.push('<li><span style="background-color:' + (getData(i)[0]) + '"></span>');
                  text.push(getData(i)[1]);
                  text.push('</li>');
              }

              text.push('</ul>');
              return text.join('');
          }

      }

      /* Plugin for piechart */
      var piePlugin = {
          beforeDraw: function(chart) {
              var width = chart.chart.width,
                  height = chart.chart.height,
                  ctx = chart.chart.ctx,
                  p=0;
              chart.data.datasets[0].data.map(function (t) {
                  if(typeof t === 'number' && !isNaN(t)){
                      p+=t;
                  }
              });

              ctx.restore();
              var fontSize = (height / 114).toFixed(2);
              ctx.font = fontSize + "em Quicksand";
              ctx.textBaseline = "middle";

              var text = p+' Visit',
                  textX = Math.round((width - ctx.measureText(text).width) / 2),
                  textY = height / 2;

              ctx.fillText(text, textX, textY);
              ctx.save();
          }
      };



      /* Graphique du nombre de ventes */

      if($('#graphVente').length){
          var ctx = $('#graphVente');
          //ctx.attr('height',150);
          var chart = new Chart(ctx, {
              // The type of chart we want to create
              type: 'line',

              // The data for our dataset
              data: {
                  labels: ['du 1er au 5','du 6 au 10','du 11 au 15','du 16 au 20','du 21 au 25','du 26 au 30'],
                  //labels: [5, 10, 15, 20, 25, 30],
                  datasets: [
                      {
                          label: "Ventes achevées le mois précédent",
                          backgroundColor: 'rgba(115, 71, 193,.5)',
                          borderColor: '#7347c1',
                          data: [jp_a,jp_b,jp_c,jp_d,jp_e,jp_f],
                          pointBackgroundColor: '#7347c1',
                          pointBorderColor: '#fff'
                      },
                      {
                          label: "Ventes achevées ce mois",
                          backgroundColor: 'rgba(243, 151, 18,.5)',
                          borderColor: '#f39712',
                          data: [jp_g,jp_h,jp_i,jp_j,jp_k,jp_l],
                          pointBackgroundColor: '#f39712',
                          pointBorderColor: '#fff'
                      }]
              },

              // Configuration options go here
              options: {
                  scales:{
                      yAxes: [{
                          display: true,
                          ticks: {
                              beginAtZero: true,
                              suggestedMax: 10,
                              fontColor: ctxTickColor
                          }
                      }]
                  },
                  legend: {
                      display: false
                  },
                  legendCallback: customLegend
              }
          });
          /* genereate legend for sale view chart */
          var legendSale = chart.generateLegend();
          $('#stat_legend').html(legendSale);
      }




    /* Graphique du nombre d'achats */

    if($('#graphAchat').length){
        var ctx = $('#graphAchat');
        //ctx.attr('height',150);
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ['du 1er au 5','du 6 au 10','du 11 au 15','du 16 au 20','du 21 au 25','du 26 au 30'],
                //labels: [5, 10, 15, 20, 25, 30],
                datasets: [
                    {
                        label: "Achats achevés le mois précédent",
                        backgroundColor: 'rgba(115, 71, 193,.5)',
                        borderColor: '#7347c1',
                        data: [jpy_a,jpy_b,jpy_c,jpy_d,jpy_e,jpy_f],
                        pointBackgroundColor: '#7347c1',
                        pointBorderColor: '#fff'
                    },
                    {
                        label: "Achats achevés ce mois",
                        backgroundColor: 'rgba(243, 151, 18,.5)',
                        borderColor: '#f39712',
                        data: [jpy_g,jpy_h,jpy_i,jpy_j,jpy_k,jpy_l],
                        pointBackgroundColor: '#f39712',
                        pointBorderColor: '#fff'
                    }]
            },

            // Configuration options go here
            options: {
                scales:{
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 10,
                            fontColor: ctxTickColor
                        }
                    }]
                },
                legend: {
                    display: false
                },
                legendCallback: customLegend
            }
        });
        /* genereate legend for sale view chart */
        var legendSale = chart.generateLegend();
        $('#stat_legend').html(legendSale);
    }




        /* sale view statistics line chart */

        /*
        if($('#myChart').length){
            var ctx = $('#myChart');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: [5,10,15,20,25,30],
                    datasets: [
                        {
                            label: "Daily Views",
                            backgroundColor: 'rgba(115, 71, 193,.5)',
                            borderColor: '#7347c1',
                            data: [5,17,13,23,18,16],
                            pointBackgroundColor: '#7347c1',
                            pointBorderColor: '#fff'
                        },
                        {
                            label: "Daily Sale",
                            backgroundColor: 'rgba(5, 116, 236,.5)',
                            borderColor: '#0674ec',
                            data: [10,12,17,19,15,9],
                            pointBackgroundColor: '#0674ec',
                            pointBorderColor: '#fff'
                        }]
                },

                // Configuration options go here
                options: {
                    scales:{
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                suggestedMax: 40,
                                fontColor: ctxTickColor
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    legendCallback: customLegend
                }
            });
            // genereate legend for sale view chart
            var legendSale = chart.generateLegend();
            $('#stat_legend').html(legendSale);
        }
        */


      /* visit statistics pie chart */
      if($('#piechart').length){
          var piechart = $('#piechart');
          var part  = new Chart(piechart, {
              type: 'doughnut',
              plugins: [piePlugin],
              data:{
                  datasets: [{
                      data: [120,90,70],
                      backgroundColor: [
                          '#0674ec',
                          '#ff6a6c',
                          '#61d039'
                      ]
                  }],
                  labels: [
                      "Google",
                      "Website",
                      "Other"
                  ]
              },
              options:{
                  cutoutPercentage: 75,
                  responsive: true,
                  legend: {
                      display: false
                  },
                  legendCallback: customLegend
              }
          });
          /* genereate legend for visitor pie chart */
          var legend = part.generateLegend();
          $('#pie-legend').html(legend);
      }


      /* single item view statistics */
      if($('#single_item_visit').length){
          var item_view = $('#single_item_visit');
          var viewBar = new Chart(item_view, {
              type: 'bar',

              data: {
                  labels: [3,6,9,12,15,18,21,24,27,30],
                  datasets: [
                      {
                          data:[15,14,23,48,55,25,82,33,55,41,2],
                          backgroundColor: '#0674ec'
                      }
                  ]
              },

              options: {
                  scales:{
                      yAxes: [{
                          ticks:{
                              beginAtZero: true,
                              suggestedMax: 60
                          }
                      }],
                      xAxes: [{
                          barThickness: 40
                      }]
                  },
                  legend:{
                      display: false
                  }
              }
          });
      }


      /* revenue chart */
      if($('#revenue').length){
          var revenue = $('#revenue');
          var reveChart = new Chart(revenue, {
              type: 'line',

              data: {
                  labels: months,
                  datasets:[
                      {
                          label: "2015",
                          data: [3,2.9,2.7,3.5,4,3.8,3.7,3.5,4,4.5,4.3,4.2],
                          fill: false,
                          borderColor: '#7347c1',
                          lineTension: 0,
                          pointBorderColor: '#7347c1'
                      },
                      {
                          label: "2016",
                          data: [4,3.9,3.7,4.5,5,5.8,5.1,4.5,5.7,7,6.25,5.9],
                          fill: false,
                          borderColor: '#0674ec',
                          lineTension: 0,
                          pointBorderColor: '#0674ec'
                      },
                      {
                          label: "2019",
                          data: [5,5.5,5.9,5.5,5,4.8,5.8,6.5,6.1,5.8,6.7,7.2],
                          fill: false,
                          borderColor: '#62d03a',
                          lineTension: 0,
                          pointBorderColor: '#62d03a'
                      }
                  ]
              },

              options: {
                  legend: {
                      display: false
                  },
                  legendCallback: customLegend,
                  scales: {
                      yAxes: [{
                          ticks: {
                              suggestedMax: 10,
                              callback: function (value, index, values) {
                                  return value+'k';
                              }
                          }
                      }]
                  },
                  elements:{
                      point:{
                          backgroundColor: '#fff',
                          borderWidth: 3
                      }
                  }
              }
          });
          /* generate revenue chart lagend */
          var visitLegend = reveChart.generateLegend();
          $('#visit_legend').html(visitLegend);
      }


})(jQuery);