@extends('main')
@section('content')

  <div class="alert mycolor1 mt-2" role="alert">제품 이미지</div>
  <script>
    function find_text() {
      form1.action="{{route('picture.index')}}";
      form1.submit();
    }
  </script>

  <form name="form1" action="">
    <div class="row mb-3">
        <div class="col-3" align="left">
            <div class="input-group input-group-sm">
                <span class="input-group-text">제품명</span>
                <input type="text" name="search_image" value="{{$search_image}}" class="form-control" onkeydown="if (event.keyCode==13) {find_text()}">
                <button class="btn mycolor1" type="button" onClick="find_text();">검색</button>
            </div>
        </div>
    </div>
  </form>

  <div class="row">
  @foreach ($list as $row)
    @php
      $image_name = $row->pic ? $row->pic : "";
      $picture_name = $row->name;
    @endphp
    <div class="col-3">
      <div class="mythumb_box">
        <img src="{{asset('/storage/product_img/'.$image_name)}}" class="mythumb_image" style="cursor:pointer;" 
        data-bs-toggle="modal" data-bs-target="#zoomModal" 
        onclick="document.getElementById('zoomModalLabel').innerText='{{$picture_name}}'; 
        picname.src='{{asset('/storage/product_img/'.$image_name)}}'">
        <div class="mythumb_text">{{$picture_name}}</div>
      </div>
    </div>
  @endforeach

    <div class="row">
      <div class="col">
        {{$list->links('mypagination')}}
      </div>
    </div>

@endsection()

<div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="zoomModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center" >
        <img src="#" name="picname" class="img-fluid img-thumbnail" style="cursor: pointer;" data-bs-dismiss="modal">
      </div>
    </div>
  </div>
</div>