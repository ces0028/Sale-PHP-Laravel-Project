@extends('main')
@section('content')

  <div class="alert mycolor1 mt-2" role="alert">종류별 매출 분포도</div>
  <script src="{{asset('my/js/chart.min.js')}}"></script>
  <script>
    function find_text() {
      form1.action="{{route('chart.index')}}";
      form1.submit();
    }

    $(function() {
      $('#start_date').datetimepicker({
        locale: "ko",
        format: "YYYY-MM-DD",
        defaultDate: moment()
      });
      $('#end_date').datetimepicker({
        locale: "ko",
        format: "YYYY-MM-DD",
        defaultDate: moment()
      });

      $('#start_date').on("dp.change", function(e) {
        find.text();
      });
      $('#end_date').on("dp.change", function(e) {
        find.text();
      });
    });
  </script>

  <form name="form1" action="">
  <div class="row">
      <div class="col-12" align="left">
          <div class="d-inline-flex">
            <div class="input-group input-group-sm date" id="start_date">
              <span class="input-group-text">날짜</span>
              <input type="text" name="start_date" size="10" value="{{$start_date}}" class="form-control" onkeydown="if (event.keyCode==13) {find_text()}">
              <span class="input-group-text">
                <div class="input-group-addon">
                  <i class="fa-regular fa-calendar-days fa-lg"></i>
                </div>
              </span>
            </div>
          </div>
          <b>-</b>
          <div class="d-inline-flex">
            <div class="input-group input-group-sm date" id="end_date">
              <input type="text" name="end_date" size="10" value="{{$end_date}}" class="form-control" onkeydown="if (event.keyCode==13) {find_text()}">
              <span class="input-group-text">
                <div class="input-group-addon">
                  <i class="fa-regular fa-calendar-days fa-lg"></i>
                </div>
              </span>
              <button class="btn btn-sm mycolor1" onclick="find_text();">검색</button>
            </div>
          </div>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col-12 mt-5 d-flex justify-content-center">
      <div style="width:30%">
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx,{
      type: 'pie',
      data: {
        labels: [ {!! $str_label !!} ],
        datasets: [{
          data: [{{$str_data}}],
          backgroundColor: [
            "rgba(255,99,132,0.8)",
            "rgba(255,159,64,0.8)",
            "rgba(255,205,86,0.8)",
            "rgba(75,192,192,0.8)",
            "rgba(153,102,255,0.8)",
            "rgba(201,203,207,0.8)",
            "rgba(54,162,235,0.8)",

            "rgba(255,99,132,0.5)",
            "rgba(255,159,64,0.5)",
            "rgba(255,205,86,0.5)",
            "rgba(75,192,192,0.5)",
            "rgba(153,102,255,0.5)",
            "rgba(201,203,207,0.5)",
            "rgba(54,162,235,0.5)",
          ],
        }]
      },
    });
  </script>

@endsection()