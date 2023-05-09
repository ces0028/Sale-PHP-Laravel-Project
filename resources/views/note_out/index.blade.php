@extends('main')
@section('content')

  <div class="alert mycolor1 mt-2" role="alert">매출</div>
  <script>
    function find_text() {
      form1.action="{{route('note_out.index')}}";
      form1.submit();
    }
  </script>

  <script>
    $(function() {
      $('#text1').datetimepicker({
        locale: "ko",
        format: "YYYY-MM-DD",
        defaultDate: moment()
      });

      $('#text1').on("dp.change", function(e) {
        find.text();
      });
    });
  </script>

  <form name="form1" action="">
  <div class="row">
      <div class="col-3" align="left">
          <div class="d-inline-flex">
            <div class="input-group input-group-sm date" id="text1">
              <span class="input-group-text">날짜</span>
              <input type="text" name="text1" size="10" value="{{$text1}}" class="form-control" onkeydown="if (event.keyCode==13) {find_text()}">
              <span class="input-group-text">
                <div class="input-group-addon">
                  <i class="fa-regular fa-calendar-days fa-lg"></i>
                </div>
              </span>
            </div>
          </div>
      </div>
      <div class="col-9" align="right">
          <a href="{{route('note_out.create')}}{{$tmp}}" class="btn btn-sm mycolor1">추가</a>
      </div>
  </div>
  </form>

  <table class="table table-sm table-bordered table-hover mymargin5">
      <tr class="mycolor2">
          <td width="15%">날짜</td>
          <td width="30%">제품명</td>
          <td width="10%">단가</td>
          <td width="10%">수량</td>
          <td width="15%">금액</td>
          <td width="20%">비고</td>
      </tr>

      @foreach($list as $row)
    
      <tr>
          <td>{{$row->write_date}}</td>
          <td><a href="{{route('note_out.show',$row->id)}}{{$tmp}}">{{$row->product_name}}</a></td>
          <td>{{number_format($row->price)}}</td>
          <td>{{number_format($row->num_out)}}</td>
          <td>{{number_format($row->total_price)}}</td>        
          <td>{{$row->note}}</td>          
      </tr>
      @endforeach
    </table>

    <div class="row">
      <div class="col">
        {{$list->links('mypagination')}}
      </div>
    </div>

@endsection()