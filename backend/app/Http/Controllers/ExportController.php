<?php

namespace App\Http\Controllers;

use App\Exports\ExportCrawledUrl;
use App\Models\CrawledUrl;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    //
    public function index()
    {
       return view('index');
    }

    public function exportCSVFile() 
    {
        $data = CrawledUrl::select('site_url','url')->get();
        return Excel::download(new ExportCrawledUrl($data), 'urls.xlsx');
        // return (new ExportCrawledUrl)->download('urls.csv', \Maatwebsite\Excel\Excel::CSV);
    }    
}
