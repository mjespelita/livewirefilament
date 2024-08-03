<?php

namespace App\Smark;

use DOMDocument;
use DOMXPath;

class Web
{
    public static function scrapeWebPage($url, $element, $attribute = null) {
        // Initialize cURL
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Execute cURL
        $html = curl_exec($ch);

        // Check for cURL errors
        if ($html === false) {
            return "cURL Error: " . curl_error($ch);
        }

        // Close cURL
        curl_close($ch);

        // Create a new DOMDocument
        $dom = new DOMDocument();

        // Suppress errors due to invalid HTML
        @$dom->loadHTML($html);

        // Create a new DOMXPath object
        $xpath = new DOMXPath($dom);

        // Construct the XPath query
        $query = "//{$element}" . ($attribute ? "[@{$attribute}]" : "");

        // Query the DOM
        $nodes = $xpath->query($query);

        // Extract data from the nodes
        $results = [];
        foreach ($nodes as $node) {
            $results[] = $attribute ? $node->getAttribute($attribute) : $node->nodeValue;
        }

        return $results;
    }

    public static function downloadImages($url, $saveDir) {
        $html = file_get_contents($url);
        $dom = new DOMDocument();
        @$dom->loadHTML($html);

        $images = [];
        foreach ($dom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (!empty($src)) {
                $images[] = $src;
                $filename = basename($src);
                file_put_contents("$saveDir/$filename", file_get_contents($src));
            }
        }
        return $images;
    }

    public static function extractLinks($url) {
        $html = file_get_contents($url);
        $dom = new DOMDocument();
        @$dom->loadHTML($html);

        $links = [];
        foreach ($dom->getElementsByTagName('a') as $a) {
            $href = $a->getAttribute('href');
            if (!empty($href)) {
                $links[] = $href;
            }
        }
        return $links;
    }

    public static function htmlToPlainText($html) {
        return strip_tags($html);
    }

    public static function copyWebpage($url, $saveDir) {
        // Create save directory if it doesn't exist
        if (!file_exists($saveDir)) {
            mkdir($saveDir, 0755, true);
        }

        // Fetch the webpage HTML
        $html = file_get_contents($url);
        if ($html === false) {
            return "Error fetching the URL.";
        }

        // Load HTML into DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($html);

        // Extract CSS links and download
        foreach ($dom->getElementsByTagName('link') as $link) {
            $href = $link->getAttribute('href');
            if (strpos($href, 'http') === 0) {
                // Download the CSS file
                $cssFile = basename($href);
                $cssContent = file_get_contents($href);
                file_put_contents("$saveDir/$cssFile", $cssContent);
                $link->setAttribute('href', $cssFile); // Update the link
            }
        }

        // Extract JavaScript links and download
        foreach ($dom->getElementsByTagName('script') as $script) {
            $src = $script->getAttribute('src');
            if (strpos($src, 'http') === 0) {
                // Download the JS file
                $jsFile = basename($src);
                $jsContent = file_get_contents($src);
                file_put_contents("$saveDir/$jsFile", $jsContent);
                $script->setAttribute('src', $jsFile); // Update the script src
            }
        }

        // Save the modified HTML
        $modifiedHtml = $dom->saveHTML();
        file_put_contents("$saveDir/index.html", $modifiedHtml);

        return "Webpage copied successfully!";
    }

}
