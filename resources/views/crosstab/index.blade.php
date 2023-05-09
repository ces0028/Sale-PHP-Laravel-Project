@extends('main')
@section('content')

  <div class="alert mycolor1 mt-2" role="alert">월별 제품별 매출현황</div>
  <script>
    function find_text() {
      form1.action="{{route('crosstab.index')}}";
      form1.submit();
    }
  </script>

  <script>
    $(function() {
      $('#search_month').datetimepicker({
        locale: "ko",
        format: "YYYY",
        viewMode: "years",
        defaultDate: moment()
      });

      $('#search_month').on("dp.change", function(e) {
        find.text();
      });
    });
  </script>

  <form name="form1" action="">
  <div class="row">
      <div class="col-12" align="left">
          <div class="d-inline-flex">
            <div class="input-group input-group-sm date" id="search_month">
              <span class="input-group-text">날짜</span>
              <input type="text" name="search_month" size="4" value="{{$search_month}}" class="form-control" onkeydown="if (event.keyCode==13) {find_text()}">
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
          <td width="40%">제품명</td>
          <td width="5%">1월</td>
          <td width="5%">2월</td>
          <td width="5%">3월</td>
          <td width="5%">4월</td>
          <td width="5%">5월</td>
          <td width="5%">6월</td>
          <td width="5%">7월</td>
          <td width="5%">8월</td>
          <td width="5%">9월</td>
          <td width="5%">10월</td>
          <td width="5%">11월</td>
          <td width="5%">12월</td>
      </tr>

      @foreach($list as $row)
      <tr>
          <td align="left" class="mycolor3">{{$row->product_name}}</td>
          <td align="right">{{$row->m1==0 ? "" : number_format($row->m1)}}</td>
          <td align="right">{{$row->m2==0 ? "" : number_format($row->m2)}}</td>
          <td align="right">{{$row->m3==0 ? "" : number_format($row->m3)}}</td>
          <td align="right">{{$row->m4==0 ? "" : number_format($row->m4)}}</td>
          <td align="right">{{$row->m5==0 ? "" : number_format($row->m5)}}</td>
          <td align="right">{{$row->m6==0 ? "" : number_format($row->m6)}}</td>
          <td align="right">{{$row->m7==0 ? "" : number_format($row->m7)}}</td>
          <td align="right">{{$row->m8==0 ? "" : number_format($row->m8)}}</td>
          <td align="right">{{$row->m9==0 ? "" : number_format($row->m9)}}</td>
          <td align="right">{{$row->m10==0 ? "" : number_format($row->m10)}}</td>
          <td align="right">{{$row->m11==0 ? "" : number_format($row->m11)}}</td>
          <td align="right">{{$row->m12==0 ? "" : number_format($row->m12)}}</td>
      </tr>
      @endforeach
    </table>
    
    <div class="row">
      <div class="col">
        {{$list->links('mypagination')}}
      </div>
    </div>

@endsection()