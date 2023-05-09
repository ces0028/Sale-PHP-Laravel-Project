@extends('main')
@section('content')

  <div class="alert mycolor1 mt-2" role="alert">카테고리</div>
  <script>
    function find_text() {
      form1.action="{{route('category.index')}}";
      form1.submit();
    }
  </script>

  <form name="form1" action="">
  <div class="row">
      <div class="col-5" align="left">
          <div class="input-group input-group-sm">
              <span class="input-group-text">카테고리명</span>
              <input type="text" name="text1" value="{{$text1}}" class="form-control" onkeydown="if (event.keyCode==13) {find_text()}">
              <button class="btn mycolor1" type="button" onClick="find_text();">검색</button>
          </div>
      </div>
      <div class="col-7" align="right">
          <a href="{{route('category.create')}}{{$tmp}}" class="btn btn-sm mycolor1">추가</a>
      </div>
  </div>
  </form>

  <table class="table table-sm table-bordered table-hover mymargin5">
      <tr class="mycolor2">
          <td width="10%">번호</td>
          <td width="90%">카테고리명</td>
      </tr>

      @foreach($list as $row)
    
      <tr>
          <td>{{$row->id}}</td>
          <td><a href="{{route('category.show',$row->id)}}{{$tmp}}">{{$row->name}}</a></td>
      </tr>
      @endforeach
    </table>

    <div class="row">
      <div class="col">
        {{$list->links('mypagination')}}
      </div>
    </div>

@endsection()