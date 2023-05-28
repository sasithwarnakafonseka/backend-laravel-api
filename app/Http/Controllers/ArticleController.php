<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Source\SourceNewsAPI;
use Carbon\Carbon;
use Illuminate\Http\Request;
use jcobhams\NewsApi\NewsApi;
use GuzzleHttp\Client;

// use App\Http\Controllers\Source\SourceNewsAPI;

class ArticleController extends Controller
{

    public function show(Request $request)
    {
        // show by id
        return null;
    }

    public function index(Request $request)
    {
        // latest data 
        return null;
    }
    public function getLatest(Request $request)
    {
        $newsapi = new NewsApi(env('SOURCENEWSAPI'));
        $q = $request->query->get('q');
        $category = $request->query->get('category');
        $domains = $request->query->get('domains');
        $sources = $request->query->get('source');
        $exclude_domains = $request->query->get('exclude_domains');
        $page_size = $request->query->get('page_size');
        $page = $request->query->get('page');
        $language = $request->query->get('language');
        $sort_by = $request->query->get('sort_by');

        $date = Carbon::now()->format('Y-m-d');
        return $newsapi->getEverything($q, $sources, $domains, $exclude_domains, $date, $date, $language, $sort_by, $page_size, $page);
    }


    public function topHeadlines()
    {
        $client = new Client();

        try {
            $response = $client->request('GET', 'https://newsapi.org/v2/top-headlines?pageSize=20&page=1&country=us&apiKey=' . env('SOURCENEWSAPI'));
            $statusCode = $response->getStatusCode();
            $data = $response->getBody()->getContents();

            // Process the response data as needed

            return $data;
        } catch (\Exception $e) {
            // Handle any exceptions or errors that occur
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getLanguagesTypes()
    {
        $newsapi = new NewsApi(env('SOURCENEWSAPI'));
        return $newsapi->getLanguages();

    }

    public function getCountriesTypes()
    {
        $newsapi = new NewsApi(env('SOURCENEWSAPI'));
        return $newsapi->getCountries();

    }

    public function getSortTypes()
    {
        $newsapi = new NewsApi(env('SOURCENEWSAPI'));
        return $newsapi->getSortBy();

    }

    public function getCategoriesTypes()
    {
        $newsapi = new NewsApi(env('SOURCENEWSAPI'));
        return $newsapi->getCategories();

    }

    public function getSources(Request $request)
    {
        $newsapi = new NewsApi(env('SOURCENEWSAPI'));
        return $newsapi->getSources($request->selectedCategory, $request->language, 'de');

    }


    public function getEverything(Request $request)
    {
        $client = new Client();

        try {
            $q = $request->query->get('q');
            $category = $request->query->get('category');
            $domains = $request->query->get('domains');
            $sources = $request->query->get('source');
            $excludeDomains = $request->query->get('excludeDomains');
            $pageSize = $request->query->get('pageSize');
            $page = $request->query->get('page');
            $language = $request->query->get('language');
            $sortBy = $request->query->get('sortBy');
            $response = $client->request('GET', 'https://newsapi.org/v2/everything',[
                'query' => [
                    'apiKey' => env('SOURCENEWSAPI'),
                    'q' => $q,
                    'pageSize' => $pageSize,
                    'page'=>$page,
                    'sortBy'=>$sortBy,
                    'language'=>$language,
                    'category'=>$category,
                    'domains'=>$domains,
                    'sources'=>$sources,
                    'excludeDomains'=>$excludeDomains
                    
                ],
            ]);
            $statusCode = $response->getStatusCode();
            $data = $response->getBody()->getContents();

            // Process the response data as needed

            return $data;
        } catch (\Exception $e) {
            // Handle any exceptions or errors that occur
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

}