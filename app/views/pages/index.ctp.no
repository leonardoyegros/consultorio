<?php 
  // print_R($currency); die();

?>

 
<?php 
  $from = !empty($_GET['from']) ? $_GET['from'] : date('Y-m-01');
  $to = !empty($_GET['to']) ? $_GET['to'] : date('Y-m-d');
?>


  <div class="container-fluid">

    <div class="row">
         
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body indicator">
            <div id="salesByTime" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
      </div>
      
    </div>

      
  </div>

<script type="text/javascript" src="js/charts/canvasjs.min.js"></script>


<script type="text/javascript">
  // var salesByExpense = '<?php echo $javascript->object($salesByExpense); ?>';
  // var salesByExpense = [{ label: "banana", y: 18 },
  //        { label: "orange", y: 29 },
  //        { label: "apple", y: 40 },                                    
  //        { label: "mango", y: 34 },
  //        { label: "grape", y: 24 }];


  var salesByExpense = [<?php echo $format->array2js($salesByExpense); ?>];
  var purchasesByExpense = [<?php echo $format->array2js($purchasesByExpense); ?>];
  var salesByTime = [<?php echo $format->array2js($salesByTime); ?>];

 

  window.onload = function () {


    // var chart = new CanvasJS.Chart("salesByExpense", {
    //   title:{
    //     text: '<?php echo __("Sales by Expense", true);?> (<?php echo $currency['Currency']['symbol']?>)',
    //     fontFamily: "arial",
    //     fontSize: 18,
    //     fontWeight: "normal",
    //   },
    //   data: [
    //     { 
    //      type: "doughnut",
    //      dataPoints: salesByExpense
    //    }
    //    ]
    //  });
    // chart.render();

    var chart = new CanvasJS.Chart("salesByTime", {
      background: "none",
      title:{
        text: '<?php echo __("Sales by Time", true);?> (<?php echo $currency['Currency']['symbol']?>)',
        fontFamily: "arial",
        fontSize: 18,
        fontWeight: "normal",
      },
      axisY:{
        // gridColor: 'black',
        gridThickness: 0,
        labelFontSize: 12,
        labelFormatter: function(e){
          return  Math.round(e.value/1000)+'K';
        }
      },
      data: [
        { 
         type: "line",
         dataPoints: salesByTime
         }
       ]
     });
    chart.render();

    // // compras
    // var chart = new CanvasJS.Chart("purchasesByExpense", {
    //   title:{
    //     text: '<?php echo __("Purchases by Expense", true);?> (<?php echo $currency['Currency']['symbol']?>)' ,
    //     fontFamily: "arial",
    //     fontSize: 18,
    //     fontWeight: "normal",             
    //   },
    //   data: [
    //     { 
    //      type: "doughnut",
    //      dataPoints: purchasesByExpense
    //    }
    //    ]
    //  });
    // chart.render();

    // var chart = new CanvasJS.Chart("purchasesByTime", {
    //   title:{
    //     text: '<?php echo __("Purchases by Time", true);?> (<?php echo $currency['Currency']['symbol']?>)' ,
    //     fontFamily: "arial",
    //     fontSize: 18,
    //     fontWeight: "normal",           
    //   },
    //   axisY:{
    //     // gridColor: 'black',
    //     gridThickness: 1,
    //     labelFontSize: 12
    //   },
    //   data: [
    //     { 
    //      type: "line",
    //      dataPoints: [<?php echo $format->array2js($purchasesByTime); ?>]
    //    }
    //    ]
    //  });
    // chart.render();

    $('.canvasjs-chart-credit').remove();
  }     
</script>