<?php

namespace App\Http\Controllers;

use App\Models\CrawledUrl;
use Exception;
use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;


class ScraperController extends Controller
{
    public function index()
    {
        $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
        
        $website = $client->request('GET', 'https://www.businesslist.com.ng/category/interior-design/city:lagos');
        $companies = $website->filter('h4 > a')->each(function ($node) {
            dump($node->text());
        });
        return $companies;
    }

    public function crawl(Request $request)
    {
        // try {

        //     $site_url = $request->input('url');
        //     $depth = $request->input('depth', 1);
    
        //     $client =  new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
    
        //     $crawler = $client->request('GET', $site_url);
    
        //     $urls = $crawler->filter('a')->extract(['href']);
        //     $response = $client->getResponse();
            
        //     if ($response) {
        //         foreach ($urls as $url) {
        //             if (filter_var($url, FILTER_VALIDATE_URL) && !CrawledUrl::where('url', $url)->exists()) {
        //                 CrawledUrl::create([
        //                     'site_url' => $site_url,
        //                     'url' => $url
        //                 ]);
        //             }
        //         }
        //     }
        //     return response()->json(['message' => 'Crawling completed successfully'], 200);
    
        // } catch(Exception $e) {
        //     throw new Exception($e->getMessage() . ' LINE: ' . $e->getLine());
        // }

        $site_url = $request->input('url');
        $depth = $request->input('depth');

        $this->crawlRecursive($site_url, $depth);

        return response()->json(['message' => 'Crawling completed successfully']);


    }

    private function crawlRecursive($site_url, $depth)
    {
        if ($depth <= 0) {
            return;
        }

        $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));

        try {
            $crawler = $client->request('GET', $site_url);
            $urls = $crawler->filter('a')->extract(['href']);
            $error_array = array();
            foreach ($urls as $url) {
                if (filter_var($url, FILTER_VALIDATE_URL) && !CrawledUrl::where('url', $url)->exists()) {
                    CrawledUrl::create([
                        'site_url' => $site_url,
                        'url' => $url
                    ]); 
                     // Continue crawling with reduced depth
                    $this->crawlRecursive($site_url, $depth - 1);
                }
                else {
                    array_push($error_array, [
                        'url'=> $url,
                        'message' => "not a validate url"
                    ]);
                }
            }
        } catch (Exception $e) {
            // Handle exceptions (e.g., connection error, invalid URL)
            // You may log the error or take appropriate action based on your needs
            throw new Exception($e->getMessage() . ' LINE: ' . $e->getLine());
         }
    }


}
