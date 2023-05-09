<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// DB 사용
use Illuminate\Support\Facades\DB;
// Eloquent 사용할 때만 필요로 됨
use App\Models\Member;

class MemberController extends Controller {
    public function index() {
        if (session()->get('rank')!=1) return redirect('/');

        $text1 = request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);

        $data['tmp'] = $this->qstring();

        return view('member.index', $data);
    }

    public function getlist($text1) {
        $result = Member::where('name', 'like', '%'.$text1.'%')
                  ->orderby('name', 'asc')->paginate(5)->appends(['text1'=>$text1]);
        return $result;
    }

    public function create() {
        $data['tmp'] = $this->qstring();
        return view('member.create', $data);
    }

    public function store(Request $request) {
        $row = new Member;
        $this->save_row($request, $row);

        $tmp = $this->qstring();

        return redirect('member'. $tmp);
    }

    public function show(string $id) {
        $data['row'] = Member::find($id);

        $data['tmp'] = $this->qstring();

        return view('member.show', $data);
    }

    public function edit(string $id) {
        $data['row'] = Member::find($id);

        $data['tmp'] = $this->qstring();

        return view('member.edit', $data);
    }

    public function update(Request $request, string $id) {
        $row=Member::find($id);
        $this->save_row($request, $row);

        $tmp = $this->qstring();

        return redirect('member'.$tmp);
    }

    public function destroy(string $id) {
        Member::find($id)->delete();

        $tmp = $this->qstring();

        return redirect('member'.$tmp);        
    }

    public function save_row(Request $request, $row) {
        $request->validate([
            'uid'=>'required|max:20',
            'pwd'=>'required|max:20',
            'name'=>'required|max:20'
        ],
        [
            'uid.required'=>'아이디는 필수입력입니다.',
            'pwd.required'=>'비밀번호는 필수입력입니다.',
            'name.required'=>'이름은 필수입력입니다.',
            'uid.max'=>'아이디는 20자 이내입니다.',
            'pwd.max'=>'비밀번호는 20자 이내입니다.',
            'name.max'=>'이름은 20자 이내입니다.',
        ]);

        $tel1 = $request->input("tel1");
        $tel2 = $request->input("tel2");
        $tel3 = $request->input("tel3");
        $tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);

        $row->uid = $request->input('uid');
        $row->pwd = $request->input('pwd');
        $row->name = $request->input('name');
        $row->tel = $tel;
        $row->rank = $request->input('rank');

        $row->save();
    }

    public function qstring() {
        $text1 = request('text1') ? request('text1') : "";
        $page = request('page') ? request('page') : "1";

        $tmp = $text1 ? "?text1 = $text1&$page=$page" : "?page=$page";
        
        return $tmp;
    }
}
