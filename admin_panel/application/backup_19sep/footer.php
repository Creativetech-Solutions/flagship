 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      
    </div>
    <strong>All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url('assets')?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?=base_url('assets')?>/js/custom.js"></script>
<script src="<?=base_url('assets')?>/bootstrap/js/bootstrap.min.js"></script>
<?php /* ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>
<?php */ ?>
<script src="<?=base_url('assets')?>/plugins/select2/select2.full.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/vendors/noty-2.3.8/js/noty/packaged/jquery.noty.packaged.min.js"></script>
<?php if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='home/index') { ?>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/chartjs/Chart.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- show bar chart -->
<script>
var areaChartData = {
    labels: ["Transport", "Modes", "Flights", "Classes", "Locations", "Room Types" ],
    datasets: [
        {
            label: "My First dataset",
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            data: ['<?=$this->counter["transport"]?>','<?=$this->counter["modes"]?>','<?=$this->counter["flights"]?>','<?=$this->counter["fl_class"]?>','<?=$this->counter["locations"]?>','<?=$this->counter["roomtypes"]?>']
        }
    ]
};
var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?=base_url('assets')?>/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url('assets')?>/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url('assets')?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url('assets')?>/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=base_url('assets')?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url('assets')?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url('assets')?>/dist/js/pages/dashboard.js"></script>
<script>
  //Donut Chart
  var donut = new Morris.Donut({
    element: 'sales-chart',
    resize: true,
    colors: ["#00c0ef", "#00a65a", "#41418d", "#f39c12" ,"#d7c708","#dd4b39"],
    data: [
      {label: "Users", value: <?=$this->counter['users']? $this->counter['users']:0?>},
      {label: "Operators", value: <?=$this->counter['operators']? $this->counter['operators']:0?>},
      {label: "Transport Suppliers", value: <?=$this->counter['transport']? $this->counter['transport']:0?>},
      {label: "Vehicles", value: <?=$this->counter['vehicles']? $this->counter['vehicles']:0?>},
      {label: "Locations", value: <?=$this->counter['locations']? $this->counter['locations']:0?>},
      {label: "Flights", value: <?=$this->counter['flights']? $this->counter['flights']:0?>}
    ],
    hideHover: 'auto'
  });

</script>
<?php } if(strtolower($this->router->fetch_class())=='user') { ?>

<script src="<?=base_url('assets')?>/plugins/daterangepicker/moment.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/daterangepicker/daterangepicker.js"></script>
<?php }

if(strtolower($this->router->fetch_class())!='home') { ?>

<script src="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<script src="<?=base_url('assets')?>/js/customScripting.js"></script>
<?php } if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='flight/index' ) { ?>

<script src="<?=base_url('assets')?>/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<?php }


if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='touroperator/index' ) { 
  // php file containing js
  $this->load->view('tour/tour_js');
 }  if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='vehicle/index' ) { 
  // php file containing js
  $this->load->view('vehicle/vehicle_js');
 } if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='flight/index' ) { 
  // php file containing js
  $this->load->view('flight/flight_js');
 } if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='driver/index' ) { 
  // php file containing js
  $this->load->view('driver/driver_js');
 } if(strtolower($this->router->fetch_class())=='user' ) { 
  // php file containing js
  $this->load->view('user/user_js');
 } if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='location/index' ) { 
  // php file containing js
  $this->load->view('location/locations_js');
 } if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='flight/classeslist' ) { 
  // php file containing js
  $this->load->view('flight/fl_class_js.php');
 }
if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='fasttrack/tourop' ) { 
  // php file containing js
  $this->load->view('fasttrack/tour_js');
 }
if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='roomtype/index' ) { 
  // php file containing js
  $this->load->view('roomtype/roomtype_js');
 }  ?>
<!-- Slimscroll -->
<script src="<?=base_url('assets')?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url('assets')?>/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets')?>/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets')?>/dist/js/demo.js"></script>

<?php  // Script for all pages ?>
<script>
// top dropdown -- select db
  $(document).on('change', '#config_select', function(e){
    $(this).parents('.select-config').submit();
  })

$('.select2').select2();

//fix modal force focus
  /* $.fn.modal.Constructor.prototype.enforceFocus = function () {
      var that = this;
      $(document).on('focusin.modal', function (e) {
         if ($(e.target).hasClass('select2-input')) {
            return true;
         }

         if (that.$element[0] !== e.target && !that.$element.has(e.target).length) {
            that.$element.focus();
         }
      });
   };*/
</script>


</body>
</html>