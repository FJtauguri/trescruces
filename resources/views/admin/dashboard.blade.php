@extends('layouts.app')
@section('content')
@include('layouts.sidebar')

    <div id="layoutSidenav_content" style="background-color: rgb(240,236,236);">
       <main>
          <div class="container-fluid px-4">
             <div class="d">
             <!-- <i class="cstm-colorz me-1 fa-solid fa-house"></i> -->
                <h1 class="mt-4">{{ ucwords(auth()->user()->roles) }} | <span style="font-size:22px;">Dashboard</span></h1>
             </div>
             <hr style="border:1px solid black;">
          
       </main>
       <div class="row">
         <div class="col-xl-3 col-md-6">
               <div class="card y-gradient-cstm text-dark mb-4">
                  <div class="card-body fw-bold">
                     Staffs
                     <div class="d-flex justify-content-between">
                        <a class="small text-dark stretched-link" href="{{route('staff.view')}}">View Details</a>
                        <div class="text-dark" style="font-size:36px; margin-top:-25px;"><i class="fa-solid fa-staff-snake"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-md-6">
               <div class="card b-gradient-cstm text-dark mb-4">
                  <div class="card-body fw-bold">
                     All Logs
                     <div class="d-flex justify-content-between">
                        <a class="small text-dark stretched-link" href="{{ route('all-logs')}}">View Logs</a>
                        <div class="text-dark" style="font-size:36px; margin-top:-25px;"><i class="fa-solid fa-shoe-prints"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- New Card for Total Registered Residents -->
            <div class="col-xl-3 col-md-6">
                <div class="card text-dark mb-4">
                    <div class="card-body fw-bold">
                        Total Registered Resident Accounts
                        <div class="d-flex justify-content-between">
                            <div class="text-dark" style="font-size:30px; margin-top:-15px;">{{ $resCount }} </div>
                            <div class="text-dark" style="font-size:25px; margin-top:-10px;"><i class="fa-solid fa-user"></i></div>
                        </div>
                    </div>
                </div>
            </div>
</div>
            <div class="container mt-4">
        <div class="row">

                         <!-- Area Chart -->
                         <div class="col-xl-12 col-lg-12 mx-auto">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-dark">Service requests</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart 
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Number of Residents</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Male
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Female
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-secondary"></i> Uncategorized
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>-->

        </div>
        
    </div>
       <footer class="py-4 bg-light mt-auto">
       <div class="container-fluid px-4">
       <div class="d-flex align-items-center justify-content-between small">
       <div class="text-muted">Copyright &copy; Brgy Tres Cruses 2023</div>
       <div>
       <!-- <a href="#">Privacy Policy</a>
       &middot;
       <a href="#">Terms &amp; Conditions</a> -->
       </div>
       </div>
       </div>
       </footer>
       </div>
       </div>
       <script src="./assets/js/sb-script.js"></script>
       <link href="./assets/css/sb-style.css" rel="stylesheet" />
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    
    // Number format function
    function number_format(number, decimals, dec_point, thousands_sep) {
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
          prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
          sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
          dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
          s = '',
          toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
          };
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }
    
    // Area Chart Example
    var ctxLine = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctxLine, {
      type: 'line',
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Requests",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgb(240,220,140)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: [
            <?php echo implode(',', array_pad($monthly_requests, 12, 0)); ?>
          ],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 5,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              callback: function(value, index, values) {
                return number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
            }
          }
        }
      }
    });
    
    // Pie Chart Example
    var ctxPie = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctxPie, {
      type: 'doughnut',
      data: {
        labels: ["Male", "Female", "Uncategorized"],
        datasets: [{
          data: [<?=$male_count;?>, <?=$female_count;?>, <?=$uncat_count;?>],
          backgroundColor: ['#4e73df', '#dc3444', '#6c747e'],
          hoverBackgroundColor: ['#2e59d9', '#dc3444', '#6c747e'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        title: {
          display: true,
          text: "Total: <?=$male_count + $female_count + $uncat_count;?>"
        },
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 0,
      },
    });

    const navLinks = document.querySelectorAll('.nav-link');
    
    const uri = window.location.href;
    const uriParts = uri.split('=');
    const uriValue = uriParts[uriParts.length - 1];
    
    // navLinks.forEach(link => {
    //    const href = link.getAttribute('href');
    //    const hrefParts = href.split('=');
    //    const linkValue = hrefParts[hrefParts.length - 1];
    //    if (linkValue === uriValue) {
    //       link.classList.add('active-nav');
    //       let parent = link.parentNode;
    //       if(parent){
    //          p = parent.parentNode;
    //          p.classList.add('show');
    //          pp = document.getElementById("monr");
    //          pp.setAttribute('aria-expanded', 'true');
    //          pp.classList.remove('collapsed');
    //          pp.classList.add('active-parent');
    //       }
    //    }
    // });
    navLinks.forEach(link => {
       const href = link.getAttribute('href');
       const hrefParts = href.split('=');
       const linkValue = hrefParts[hrefParts.length - 1];
       if (linkValue === uriValue) {
          link.classList.add('active-nav');
          let parent = link.parentNode;
          const mon_reqs = ['monr_wir','monr_pr','monr_ar','monr_dr','cms_navs','cms_pages','cms_general','cms_new_page'];
          if(parent && mon_reqs.includes(linkValue)){
             p = parent.parentNode;
             let e_id = '';
             if(p.classList.contains('news_anoucement')){
                e_id = "news_anoucement";
             }else if(p.classList.contains('monr')){
                e_id = 'monr';
             }
             p.classList.add('show');
             pp = document.getElementById(e_id);
             pp.setAttribute('aria-expanded', 'true');
             pp.classList.remove('collapsed');
             pp.classList.add('active-parent');
          }
       }
    });
    </script>
    <style>
.cstm-text{
   color: #fbec89;
}
</style>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">
@endsection