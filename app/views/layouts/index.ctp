  <div class="container-fluid">
    

     <div class="row">
      

      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-body">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
          <h4>Sales</h4>
           <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>Ventas</th>
              <th>Columnas</th>
              <th>Columnas</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Valor</td>
               <td>Valor</td>
                <td>Valor</td>
            </tr>
          </table>
          </div>
        </div>

      </div>

      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                <!-- <h4>Sales This Month</h4> -->
               <div id="chartContainer" style="height: 300px; width: 100%;"></div>
              </div>
           </div> 
         </div>

         <div class="col-md-6">
           <div class="panel panel-default">
            <div class="panel-body">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
              <!-- <h4>Sales</h4> -->
               <div id="chartContainer2" style="height: 300px; width: 100%;"></div>
            </div>
          </div>
        </div>

       </div> 
     </div>


    </div>

    <div class="row">


      

      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-body">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
          <h4>Sales</h4>
           <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>Columnas</th>
              <th>Columnas</th>
              <th>Columnas</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Valor</td>
               <td>Valor</td>
                <td>Valor</td>
            </tr>
          </table>
          </div>
        </div>

      </div>

      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-body">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
          <h4>Sales</h4>
           <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>Columnas</th>
              <th>Columnas</th>
              <th>Columnas</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Valor</td>
               <td>Valor</td>
                <td>Valor</td>
            </tr>
          </table>
          </div>
        </div>

      </div>

    </div>

<!--     <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
            <h4>Sales</h4>
             <div id="chartContainer2" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
      </div>
    </div> -->
  </div>




















    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   
    <script type="text/javascript" src="js/charts/canvasjs.min.js"></script>


    <script type="text/javascript">
      window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {

          title:{
            text: "Fruits sold in First Quarter"              
          },
          data: [//array of dataSeries              
            { //dataSeries object

             /*** Change type "column" to "bar", "area", "line" or "pie"***/
             type: "column",
             dataPoints: [
             { label: "banana", y: 18 },
             { label: "orange", y: 29 },
             { label: "apple", y: 40 },                                    
             { label: "mango", y: 34 },
             { label: "grape", y: 24 }
             ]
           }
           ]
         });

        chart.render();

        var chart = new CanvasJS.Chart("chartContainer2",
        {
          title: {
            text: "Monthly Downloads"
          },
            data: [
          {
            type: "area",
            dataPoints: [//array

            { x: new Date(2012, 00, 1), y: 2600 },
            { x: new Date(2012, 01, 1), y: 3800 },
            { x: new Date(2012, 02, 1), y: 4300 },
            { x: new Date(2012, 03, 1), y: 2900 },
            { x: new Date(2012, 04, 1), y: 4100 },
            { x: new Date(2012, 05, 1), y: 4500 },
            { x: new Date(2012, 06, 1), y: 8600 },
            { x: new Date(2012, 07, 1), y: 6400 },
            { x: new Date(2012, 08, 1), y: 5300 },
            { x: new Date(2012, 09, 1), y: 6000 }
            ]
          }
          ]
        });

        chart.render();

        $('.canvasjs-chart-credit').remove();


      }

     
      </script>