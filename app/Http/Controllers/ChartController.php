<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Note;

class ChartController extends Controller {
    public function index() {
        $start_date = request('start_date');
        if (!$start_date) $start_date = date('Y-m-d', strtotime('-1 month'));
        
        $end_date = request('end_date');
        if (!$end_date) $end_date = date('Y-m-d');

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $list = $this->getlist($start_date, $end_date);

        $str_label = "";
        $str_data = "";
        foreach($list as $row) {
            $str_label .= "'$row->category_name', ";
            $str_data .= $row->count_out.', ';
        }
        $data['str_label'] = $str_label;
        $data['str_data'] = $str_data;

        return view('chart.index', $data);
    }

    public function getlist($start_date, $end_date) {
        $result = Note::leftjoin('products', 'notes.product_id', '=', 'products.id')
                ->leftjoin('categories', 'products.category_id', '=', 'categories.id')
                ->select('categories.name as category_name', DB::raw('count(notes.num_out) as count_out'))
                ->wherebetween('notes.write_date', array($start_date, $end_date))
                ->where('notes.in_out', '=', 1)
                ->orderby('count_out', 'desc')
                ->groupby('categories.name')
                ->limit(14)
                ->paginate(5)
                ->appends(['start_date'=>$start_date, 'end_date'=>$end_date]);
        return $result;
    }
}
