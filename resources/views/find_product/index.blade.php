@extends('main_nomenu')
@section('content')

  <div class="alert mycolor1 mt-2" role="alert">제품 선택</div>
  <script>
    function find_text() {
      form1.action="{{route('find_product.index')}}";
      form1.submit();
    }

    function send_product(id, name, price) {
      console.log('작동');
      opener.form1.product_id.value = id;
      opener.form1.product_name.value = name;
      opener.form1.price.value = price;
      opener.form1.total_price.value = Number(price) * Number(opener.form1.num_out.value);
      self.close();
    }
  </script>

  <form name="form1" action="">
    <div class="row">
        <div class="col-6" align="left">
            <div class="input-group input-group-sm">
                <span class="input-group-text">제품명</span>
                <input type="text" name="text1" value="{{$text1}}" class="form-control" onkeydown="if (event.keyCode==13) {find_text()}">
                <button class="btn mycolor1" type="button" onClick="find_text();">검색</button>
            </div>
        </div>
    </div>
  </form>

  <table class="table table-sm table-bordered table-hover mymargin5">
    <tr class="mycolor2">
        <td width="10%">번호</td>
        <td width="20%">카테고리명</td>
        <td width="30%">제품명</td>
        <td width="20%">단가</td>
        <td width="20%">재고</td>
    </tr>

    @foreach($list as $row)
    <tr>
        <td>{{$row->id}}</td>
        <td>{{$row->category_name}}</td>
        <td><a href="javascript:send_product({{$row->id}}, '{{$row->name}}', '{{$row->price}}');">{{$row->name}}</a></td>
        <td>{{$row->price}}</td>          
        <td>{{$row->stock}}</td>          
    </tr>
    @endforeach
  </table>

  <div class="row">
    <div class="col">
      {{$list->links('mypagination')}}
    </div>
  </div>

@endsection()