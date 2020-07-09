<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function BingWebSearch ($url, $key, $query) {
        $headers = "Ocp-Apim-Subscription-Key: $key\r\n";
        $options = array ('http' => array (
            'header' => $headers,
            'method' => 'GET'));
        $context = stream_context_create($options);
        $result = file_get_contents($url . "?q=" . urlencode($query) . "&mkt=en-us" . "&freshness=" . $this->interval, false, $context);
        $headers = array();
        foreach ($http_response_header as $k => $v) {
            $h = explode(":", $v, 2);
            if (isset($h[1]))
                if (preg_match("/^BingAPIs-/", $h[0]) || preg_match("/^X-MSEdge-/", $h[0]))
                    $headers[trim($h[0])] = trim($h[1]);
        }
        return array($headers, $result);
    }

    public function ExecuteSearch()
    {
        $accessKey = 'mykey';
        $endpoint = 'https://api.cognitive.microsoft.com/bing/v7.0/news/search';
        $term = $this->term;

        list($headers, $json) = $this->BingWebSearch($endpoint, $accessKey, $term);;
        return $json;
    }
}
