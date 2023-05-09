@extends('main')
@section('content')

  <div class="alert mycolor1 mt-2" role="alert">BEST 제품</div>
  <script>
    function find_text() {
      form1.action="{{route('best.index')}}";
      form1.submit();
    }
  </script>

  <script>
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
            </div>
          </div>
      </div>
  </div>
  </form>

  <table class="table table-sm table-bordered table-hover mymargin5">
      <tr class="mycolor2">
          <td width="50%">제품명</td>
          <td width="50%">매출건수</td>
      </tr>

      @foreach($list as $row)
      <tr>
          <td>{{$row->product_name}}</td>
          <td>{{number_format($row->count_out)}}</td>
      </tr>
      @endforeach
    </table>

    <div class="row">
      <div class="col">
        {{$list->links('mypagination')}}
      </div>
    </div>
@endsection()