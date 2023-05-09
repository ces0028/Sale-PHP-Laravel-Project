<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Note;

class PeriodController extends Controller {
    public function index() {
        $start_date = request('start_date');
        if (!$start_date) $start_date = date('Y-m-d', strtotime('-1 month'));
        
        $end_date = request('end_date');
        if (!$end_date) $end_date = date('Y-m-d');

        $search_product = request('search_product');
        if (!$search_product) $search_product = 0;

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['search_product'] = $search_product;
        $data['list'] = $this->getlist($start_date, $end_date, $search_product);
        $data['list_product'] = $this->getlist_product();

        return view('period.index', $data);
    }

    public function getlist($start_date, $end_date, $search_product) {
        if ($search_product == 0) {
            $result = Note::leftjoin('products', 'notes.product_id', '=', 'products.id')
                    ->select('notes.*', 'products.name as product_name')
                    ->wherebetween('notes.write_date', array($start_date, $end_date))
                    ->orderby('notes.id', 'desc')
                    ->paginate(5)
                    ->appends(['start_date'=>$start_date, 'end_date'=>$end_date, 'search_product'=>$search_product]);
        } else {
            $result = Note::leftjoin('products', 'notes.product_id', '=', 'products.id')
                    ->select('notes.*', 'products.name as product_name')
                    ->wherebetween('notes.write_date', array($start_date, $end_date))
                    ->where('notes.product_id', '=', $search_product)
                    ->orderby('notes.id', 'desc')
                    ->paginate(5)
                    ->appends(['start_date'=>$start_date, 'end_date'=>$end_date, 'search_product'=>$search_product]);
        }
        return $result;
    }

    public function getlist_product() {
        $result = Product::orderby('name')->get();
        return $result;
    }
}
