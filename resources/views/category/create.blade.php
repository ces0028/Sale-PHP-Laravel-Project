@extends('main')
@section('content')

  <div class="alert mycolor1 mt-2" role="alert">카테고리</div>
    <form name="form1" method="post" action="{{route('category.store')}}">
    @csrf
        <table class="table table-bordered table-sm mymargin5">
          <tr>
              <td width="20%" class="mycolor2">번호</td>
              <td width="80%" align="left"></td>
          </tr>
          <tr>
              <td width="20%" class="mycolor2"><font color="red">*</font> 카테고리명</td>
              <td width="80%" align="left">
                  <div class="d-inline-flex">          
                    <input type="text" name="name" size="20" maxlength="20" value="{{old('name')}}" class="form-control form-control-sm">
                  </div>
                  @error('name')
                    {{$message}}
                  @enderror
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