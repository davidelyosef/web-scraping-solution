<?php

namespace App\Exports;

use App\Models\CrawledUrl;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCrawledUrl implements FromCollection, WithHeadings
{
    protected $data;

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function __construct($data)

    {

        $this->data = $data;

    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function collection()

    {

        return collect($this->data);

    }

  
    public function headings() :array

    {

        return [
            'id',

            'Site Url',

            'Crawled Urls',

        ];

    }
}
