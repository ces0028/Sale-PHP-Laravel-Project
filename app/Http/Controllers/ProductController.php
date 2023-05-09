<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index() {
        $text1 = request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);

        $data['tmp'] = $this->qstring();

        return view('product.index', $data);
    }

    public function getlist($text1) {
        $result = Product::leftjoin('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->where('products.name', 'like', '%'.$text1.'%')
        ->orderby('name', 'asc')->paginate(5)->appends(['text1'=>$text1]);

        return $result;
    }

    public function create() {
        $data['list'] = $this->getlist_category();
        $data['tmp'] = $this->qstring();
        return view('product.create', $data);
    }

    public function store(Request $request) {
        $row = new Product;
        $this->save_row($request, $row);

        $tmp = $this->qstring();

        return redirect('product'. $tmp);
    }

    public function show(string $id) {
        $data['row'] = Product::leftjoin('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->where('products.id', '=', $id)->first();

        $data['tmp'] = $this->qstring();

        return view('product.show', $data);
    }

    public function edit(string $id) {
        $data['row'] = Product::find($id);

        $data['tmp'] = $this->qstring();

        return view('product.edit', $data);
    }

    public function update(Request $request, string $id) {
        $row=Product::find($id);
        $this->save_row($request, $row);

        $tmp = $this->qstring();

        return redirect('product'.$tmp);
    }

    public function destroy(string $id) {
        Product::find($id)->delete();

        $tmp = $this->qstring();

        return redirect('product'.$tmp);        
    }

    public function save_row(Request $request, $row) {
        $request->validate([
            'category_id'=>'required|numeric',
            'name'=>'required|max:50',
            'price'=>'required|numeric'
        ],
        [
            'category_id.required'=>'구분명은 필수입력입니다.',
            'name.required'=>'이름은 필수입력입니다.',
            'price.required'=>'단가는 필수입력입니다.',
            'name.max'=>'이름은 50자 이내입니다.',
        ]);

        $row->category_id = $request->input('category_id');
        $row->name = $request->input('name');
        $row->price = $request->input('price');
        $row->stock = $request->input('stock');

        if ($request->hasFile('pic')) {
            $pic = $request->file('pic');
            
            $pic_name = $pic->getClientOriginalName();
            $pic->storeAs('public/product_img', $pic_name);
            $row->pic = $pic_name;
        }

        $row->save();
    }

    public function qstring() {
        $text1 = request('text1') ? request('text1') : "";
        $page = request('page') ? request('page') : "1";

        $tmp = $text1 ? "?text1 = $text1&$page=$page" : "?page=$page";
        
        return $tmp;
    }

    public function getlist_category() {
        $result = Category::orderby('name')->get();
        return $result;
    }

    public function check_stock() {
        DB::statement('DROP TABLE IF EXISTS temps');
        DB::statement('CREATE TABLE temps(
            id INT NOT NULL AUTO_INCREMENT,
            product_id INT,
            stock INT DEFAULT 0,
            PRIMARY KEY(id)
        )');
        DB::statement('UPDATE products SET stock=0;');
        DB::statement('INSERT INTO temps (product_id, stock) SELECT product_id, sum(num_in)-sum(num_out) FROM notes GROUP BY product_id');
        DB::statement('UPDATE products JOIN temps ON products.id=temps.product_id SET products.stock=temps.stock');

        return redirect('product');
    }
}
