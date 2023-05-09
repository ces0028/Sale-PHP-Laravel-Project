@extends('main')
@section('content')

    <div class="alert mycolor1 mt-2" role="alert">카테고리</div>
    <form name="form1" method="post" action="">
        <table class="table table-bordered table-sm mymargin5">
            <tr>
                <td width="20%" class="mycolor2">번호</td>
                <td width="80%" align="left">{{$row->id}}</td>
            </tr>
            <tr>
                <td width="20%" class="mycolor2"><font color="red">*</font> 카테고리명</td>
                <td width="80%" align="left">{{$row->name}}</td>
            </tr>
        </table>
        <div align="center">
            <a href="{{route('category.edit', $row->id)}}" class="btn btn-sm mycolor1">수정</a>
            <form action="{{route('category.destroy', $row->id)}}{{$tmp}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm mycolor1" onclick="return comfirm('삭제할까요?')">삭제</button>&nbsp;
            </form>
            <input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back()">
        </div>
    </form>
    
@endsection