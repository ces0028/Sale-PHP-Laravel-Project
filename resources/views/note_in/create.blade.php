@extends('main')
@section('content')

  <div class="alert mycolor1 mt-2" role="alert">매입</div>
    <script>
      $(function() {
        $('#write_date').datetimepicker({
          locale: "ko",
          format: "YYYY-MM-DD",
          defaultDate: moment()
        });
      });

      function select_product() {
        var str;
        str = form1.sel_product_id.value;
        if (str=="") {
          form1.product_id.value = "";
          form1.price.value = "";
          form1.total_price.value = "";
        } else {
          str = str.split("^^");
          form1.product_id.value = str[0];
          form1.price.value = str[1];
          form1.total_price.value = Number(form1.price.value) * Number(form1.num_in.value);
        }
      }

      function cal_total_price() {
        form1.total_price.value = Number(form1.price.value) * Number(form1.num_in.value);
        form1.note.focus();
      }
    </script>
    <form name="form1" method="post" action="{{route('note_in.store')}}{{$tmp}}" enctype="multipart/form-data">
    @csrf
        <table class="table table-bordered table-sm mymargin5">
          <tr>
            <td width="20%" class="mycolor2">날짜</td>
            <td width="80%" align="left">
              <div class="d-inline-flex">
                <div class="input-group input-group-sm date" id="write_date">
                  <input type="text" name="write_date" size="20" value="{{old('write_date')}}" class="form-control form-control-sm">
                  <span class="input-group-text">
                    <div class="input-group-addon">
                      <i class="fa-regular fa-calendar-days fa-lg"></i>
                    </div>
                  </span>
                </div>
              </div>
              @error('write_date')
                {{$message}}
              @enderror
            </td>
          </tr>
          <tr>
            <td width="20%" class="mycolor2"><font color="red">*</font> 제품명</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                  <input type="hidden" name="product_id" value="{{old('product_id')}}">
                  <select name="sel_product_id" class="form-control form-control-sm" onchange="select_product()">
                      <option value="" selected>선택</option>
                @foreach($list as $row)
                  @php
                    $t1 = "$row->id^^$row->price";
                    $t2 = "$row->name($row->price)";
                  @endphp
                  @if ($row->id == old('product_id'))
                      <option value="{{$t1}}" selected>{{$$t2}}</option>
                  @else
                      <option value="{{$t1}}">{{$t2}}</option>
                  @endif
                @endforeach
                  </select>   
                </div>
                @error('product_id')
                  {{$message}}
                @enderror
            </td>
          </tr>
          <tr>
            <td width="20%" class="mycolor2">단가</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <input type="text" name="price" size="20" maxlength="20" value="{{old('price')}}" class="form-control form-control-sm" onchange="cal_total_price()">
                </div>
            </td>
          </tr>
          <tr>
            <td width="20%" class="mycolor2">수량</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <input type="text" name="num_in" size="20" maxlength="20" value="{{old('num_in')}}" class="form-control form-control-sm" onchange="cal_total_price()">
                </div>
            </td>
          </tr>
          <tr>
            <td width="20%" class="mycolor2">금액</td>
            <td width="80%" align="left">
              <div class="d-inline-flex">
                  <input type="text" name="total_price" size="20" value="{{old('total_price')}}" class="form-control form-control-sm" readonly>
              </div>
            </td>
          </tr>
          <tr>
            <td width="20%" class="mycolor2">비고</td>
            <td width="80%" align="left">
              <div class="d-inline-flex">
                <input type="text" name="note" size="20" value="{{old('note')}}" class="form-control form-control-sm">
              </div>
            </td>
          </tr>
      </table>
      <div align="center">
        <input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
        <input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back()">
      </div>
    </form>
  </div>
@endsection