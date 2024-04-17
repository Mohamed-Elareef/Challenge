<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use GuzzleHttp\Client;
 

class ShortUrlController extends Controller
{

    public function create(Request $request)
    {
        $url = $request->input('url');

        // استخدام API الخارجية لإنشاء رابط قصير
        $client = new Client();
        $response = $client->request('GET', 'https://tinyurl.com/api-create.php?url=' . urlencode($url));
        $shortURL = $response->getBody()->getContents();

        return response()->json(['short_url' => $shortURL]);
    }


    
    public function createOrRedirectShortUrl(Request $request)
    {
        $url = $request->input('url');
 
        // Check if the URL already exists in the database
        $existingShortUrl = ShortUrl::where('url', $url)->first();
    
        if ($existingShortUrl) {
            // Check if the shortened_url property is not null
            if ($existingShortUrl->short_code) {
                $code =  $existingShortUrl->short_code;
                $shortUrl = ShortUrl::where('short_code', $code)->first();
                // Redirect directly to the existing short URL
                $routeName = route('short_url.redirectShortUrl', ['code' => $code]);
                echo 'The stored short link is  '.$routeName.' ';
                echo "<script>";
                
                echo "alert('The stored short link is  ".$routeName." ');";
                echo "window.location.href = '".$routeName."';";
                echo "</script>";
                 
                //return redirect()->away($shortUrl->url);
            } 
        } else {
            // Generate short code
            $shortCode = $this->generateShortCode();
    
            // Store short URL in database
            $shortUrl = ShortUrl::create([
                'url' => $url,
                'short_code' => $shortCode
            ]);
            
            $routeName = route('short_url.redirectShortUrl', ['code' => $shortCode]);
            echo 'The new short link is  '.$routeName.' ';
            echo "<script>";        
            echo "alert('The new short link is  ".$routeName." ');";
            echo "window.location.href = '".$routeName."';";
            echo "</script>";
    
            //return redirect()->away(route('short_url.redirectShortUrl', ['code' => $shortCode]));
        }
    }

    private function generateShortCode()
    {
        // Generate a short code using a custom algorithm
        // You can use any logic here to generate short codes
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 6;
        $shortCode = '';
        
        // Loop to create a unique short code
        do {
            $shortCode = '';
            for ($i = 0; $i < $length; $i++) {
                $shortCode .= $characters[rand(0, strlen($characters) - 1)];
            }
            // Use the exists function to check if the short code already exists in the database
        } while (ShortUrl::where('short_code', $shortCode)->exists()); // Repeat the loop if the short code already exists
        
        return $shortCode;
    }
    

    public function redirectShortUrl($code)
    {
        // Find the original URL using the short code
        $shortUrl = ShortUrl::where('short_code', $code)->first();

        if ($shortUrl) {
            return redirect()->away($shortUrl->url);
        } else {
            return response()->json(['error' => 'Short URL not found'], 404);
        }
    }
}
