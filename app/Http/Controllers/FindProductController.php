<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class FindProductController extends Controller {
    public function index() {
        $text1 = request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);

        return view('find_product.index', $data);
    }

    public function getlist($text1) {
        $result = Product::leftjoin('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->where('products.name', 'like', '%'.$text1.'%')
        ->orderby('name', 'asc')->paginate(5)->appends(['text1'=>$text1]);

        return $result;
    }
}
