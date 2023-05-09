@extends('main')
@section('content')

    <div class="alert mycolor1 mt-2" role="alert">매입</div>
    <form name="form1" method="post" action="">
        <table class="table table-bordered table-sm mymargin5">
            <tr>
            <td width="20%" class="mycolor2"><font color="red">*</font> 날짜</td>
                <td width="80%" align="left">{{$row->write_date}}</td>
            </tr>
            <td width="20%" class="mycolor2"><font color="red">*</font> 제품명</td>
                <td width="80%" align="left">{{$row->product_name}}</td>
            </tr>
            <tr>
                <td width="20%" class="mycolor2">단가</td>
                <td width="80%" align="left">{{$row->price}}</td>
            </tr>
            <tr>
                <td width="20%" class="mycolor2">수량</td>
                <td width="80%" align="left">{{$row->num_in}}</td>
            </tr>
            <tr>
                <td width="20%" class="mycolor2">금액</td>
                <td width="80%" align="left">{{$row->total_price}}</td>
            </tr>
            <tr>
                <td width="20%" class="mycolor2">비고</td>
                <td width="80%" align="left">{{$row->note}}</td>
            </tr>
        </table>
        <div align="center">
            <a href="{{route('note_in.edit', $row->id)}}" class="btn btn-sm mycolor1">수정</a>
            <form action="{{route('note_in.destroy', $row->id)}}{{$tmp}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm mycolor1" onclick="return comfirm('삭제할까요?')">삭제</button>&nbsp;
            </form>
            <input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back()">
        </div>
    </form>
    
@endsection