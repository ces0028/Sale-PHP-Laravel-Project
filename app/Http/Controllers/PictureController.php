<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class PictureController extends Controller {
    public function index() {
        $search_image = request('search_image');
        $data['search_image'] = $search_image;
        $data['list'] = $this->getlist($search_image);

        return view('picture.index', $data);
    }

    public function getlist($search_image) {
        $result = Product::where('name', 'like', '%'.$search_image.'%')
        ->orderby('name', 'asc')
        ->paginate(8)
        ->appends(['search_image'=>$search_image]);

        return $result;
    }
}
