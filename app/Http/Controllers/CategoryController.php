<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $text1 = request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);

        $data['tmp'] = $this->qstring();

        return view('category.index', $data);
    }

    public function getlist($text1)
    {
        $result = Category::where('name', 'like', '%'.$text1.'%')
                  ->orderby('name', 'asc')
                  ->paginate(10)
                  ->appends(['text1'=>$text1]);
        return $result;
    }

    public function create()
    {
        $data['tmp'] = $this->qstring();

        return view('category.create', $data);
    }

    public function store(Request $request)
    {
        $row = new Category;
        $this->save_row($request, $row);

        $tmp = $this->qstring();

        return redirect('category'.$tmp);
    }

    public function show(string $id)
    {
        $data['row'] = Category::find($id);

        $data['tmp'] = $this->qstring();

        return view('category.show', $data);
    }

    public function edit(string $id)
    {
        $data['row'] = Category::find($id);

        $data['tmp'] = $this->qstring();

        return view('category.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $row=Category::find($id);
        $this->save_row($request, $row);

        $tmp = $this->qstring();

        return redirect('category'.$tmp);
    }

    public function destroy(string $id)
    {
        Category::find($id)->delete();

        $tmp = $this->qstring();

        return redirect('category'.$tmp);        
    }

    public function save_row(Request $request, $row)
    {
        $request->validate([
            'name'=>'required|max:20'
        ],
        [
            'name.required'=>'이름은 필수입력입니다.',
            'name.max'=>'이름은 20자 이내입니다.',
        ]);

        $row->name = $request->input('name');

        $row->save();
    }

    public function qstring()
    {
        $text1 = request('text1') ? request('text1') : "";
        $page = request('page') ? request('page') : "1";

        $tmp = $text1 ? "?text1 = $text1&$page=$page" : "?page=$page";
        
        return $tmp;
    }
}
