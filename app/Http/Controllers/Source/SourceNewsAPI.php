<?php

namespace App\Http\Controllers\Source;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use jcobhams\NewsApi\NewsApi;



class SourceNewsAPI extends Controller
{
    protected $api_key = env('SOURCENEWSAPI');
    protected $newsapi = new NewsApi($api_key);
    protected $date = Carbon::now()->format('Y-m-d');
    public function getLatest($q,$sources,$country,$category,$page_size,$page)
    {
        dd('hi');
        return $this->newsapi->getTopHeadlines($q, $sources, $country, $category, $page_size, $page);
    }
}