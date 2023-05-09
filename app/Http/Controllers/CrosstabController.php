<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Note;

class CrosstabController extends Controller {
    public function index() {
        $search_month = request('search_month');
        if (!$search_month) $search_month = date('Y');

        $data['search_month'] = $search_month;
        $data['list'] = $this->getlist($search_month);

        return view('crosstab.index', $data);
    }

    public function getlist($search_month) {
        $result = Note::leftjoin('products', 'notes.product_id', '=', 'products.id')
                ->select('products.name as product_name', 
                  DB::raw('sum(if(month(notes.write_date)=1, notes.num_out, 0)) as m1,
                           sum(if(month(notes.write_date)=2, notes.num_out, 0)) as m2,
                           sum(if(month(notes.write_date)=3, notes.num_out, 0)) as m3,
                           sum(if(month(notes.write_date)=4, notes.num_out, 0)) as m4,
                           sum(if(month(notes.write_date)=5, notes.num_out, 0)) as m5,
                           sum(if(month(notes.write_date)=6, notes.num_out, 0)) as m6,
                           sum(if(month(notes.write_date)=7, notes.num_out, 0)) as m7,
                           sum(if(month(notes.write_date)=8, notes.num_out, 0)) as m8,
                           sum(if(month(notes.write_date)=9, notes.num_out, 0)) as m9,
                           sum(if(month(notes.write_date)=10, notes.num_out, 0)) as m10,
                           sum(if(month(notes.write_date)=11, notes.num_out, 0)) as m11,
                           sum(if(month(notes.write_date)=12, notes.num_out, 0)) as m12'))
                ->where(DB::raw('year(notes.write_date)'), '=', $search_month)
                ->where('notes.in_out', '=', 1)
                ->orderby('products.name', 'desc')
                ->groupby('products.name')
                ->paginate(5)
                ->appends(['search_month'=>$search_month]);
        return $result;
    }
}
