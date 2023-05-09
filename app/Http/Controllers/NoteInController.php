<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Note;

class NoteInController extends Controller
{
    public function index()
    {
        $text1 = request('text1');
        if (!$text1) $text1 = date('Y-m-d');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);

        $data['tmp'] = $this->qstring();

        return view('note_in.index', $data);
    }

    public function getlist($text1)
    {
        $result = Note::leftjoin('products', 'notes.product_id', '=', 'products.id')
        ->select('notes.*', 'products.name as product_name')
        ->where('notes.in_out', '=', 0)
        ->where('notes.write_date', '=', $text1)
        ->orderby('notes.id', 'desc')
        ->paginate(5)
        ->appends(['text1'=>$text1]);

        return $result;
    }

    public function create()
    {
        $data['list'] = $this->getlist_product();
        $data['tmp'] = $this->qstring();
        return view('note_in.create', $data);
    }

    public function store(Request $request)
    {
        $row = new Note;
        $this->save_row($request, $row);

        $tmp = $this->qstring();

        return redirect('note_in'. $tmp);
    }

    public function show(string $id)
    {
        $data['row'] = Note::leftjoin('products', 'notes.product_id', '=', 'products.id')
        ->select('notes.*', 'products.name as product_name')
        ->where('notes.id', '=', $id)->first();

        $data['tmp'] = $this->qstring();

        return view('note_in.show', $data);
    }

    public function edit(string $id)
    {
        $data['list'] = $this->getlist_product();
        $data['row'] = Note::find($id);

        $data['tmp'] = $this->qstring();

        return view('note_in.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $row=Note::find($id);
        $this->save_row($request, $row);

        $tmp = $this->qstring();

        return redirect('note_in'.$tmp);
    }

    public function destroy(string $id)
    {
        Note::find($id)->delete();

        $tmp = $this->qstring();

        return redirect('note_in'.$tmp);        
    }

    public function save_row(Request $request, $row)
    {
        $request->validate([
            'write_date' => 'required|date',
            'product_id'=>'required'
        ],
        [
            'write_date.required'=>'날짜는 필수입력입니다.',
            'product_id.required'=>'제품명은 필수입력입니다.',
            'write_date.date'=>'날짜형식이 잘못입력되었습니다.'
        ]);

        $row->in_out = 0;
        $row->write_date = $request->input('write_date');
        $row->product_id = $request->input('product_id');
        $row->price = $request->input('price');
        $row->num_in = $request->input('num_in');
        $row->num_out = 0;
        $row->total_price = $request->input('total_price');
        $row->note = $request->input('note');

        $row->save();
    }

    public function qstring()
    {
        $text1 = request('text1') ? request('text1') : "";
        $page = request('page') ? request('page') : "1";

        $tmp = $text1 ? "?text1 = $text1&$page=$page" : "?page=$page";
        
        return $tmp;
    }

    public function getlist_product()
    {
        $result = Product::orderby('name')->get();
        return $result;
    }
}
