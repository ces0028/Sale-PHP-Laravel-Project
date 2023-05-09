@extends('main')
@section('content')

  <div class="alert mycolor1 mt-2" role="alert">기간별 매출입 현황</div>
  <script>
    function find_text() {
      form1.action="{{route('period.index')}}";
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
          <div class="d-inline-flex">
            <div class="input-group input-group-sm" id="search_product">
              <span class="input-group-text">제품명</span>
              <select name="search_product" class="form-select form-select-sm">
                <option value="0" selected>전체</option>
            @foreach($list_product as $row)
              @if($row->id == $search_product)
                <option value="{{$row->id}}" selected>{{$row->name}}</option>
              @else
                <option value="{{$row->id}}">{{$row->name}}</option>
              @endif
            @endforeach
              </select>
              <input type="button" value="검색" class="btn btn-sm mycolor1" onclick="find_text();">
            </div>
          </div>
      </div>
  </div>
  </form>

  <table class="table table-sm table-bordered table-hover mymargin5">
      <tr class="mycolor2">
          <td width="15%">날짜</td>
          <td width="25%">제품명</td>
          <td width="10%">단가</td>
          <td width="10%">매입수량</td>
          <td width="10%">매출수량</td>
          <td width="15%">금액</td>
          <td width="15%">비고</td>
      </tr>

      @foreach($list as $row)
        @php
          $num_in = $row->num_in ? number_format($row->num_in) : "";
          $num_out = $row->num_out ? number_format($row->num_out) : "";
        @endphp
      <tr>
          <td>{{$row->write_date}}</td>
          <td><a href="{{route('note_out.show',$row->id)}}">{{$row->product_name}}</a></td>
          <td align="right">{{number_format($row->price)}}</td>
          <td align="right">{{$num_in}}</td>
          <td align="right">{{$num_out}}</td>
          <td align="right">{{number_format($row->total_price)}}</td>        
          <td align="left">{{$row->note}}</td>          
      </tr>
      @endforeach
    </table>

    <div class="row">
      <div class="col">
        {{$list->links('mypagination')}}
      </div>
    </div>

@endsection()