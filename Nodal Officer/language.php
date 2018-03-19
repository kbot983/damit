<?php
    $apiKey = 'AIzaSyDBsEajGK8Lev3hgGDh679rwlhOPiZiwNU';
    $text = 'नमस्ते दुनिया!';
    $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=hi&target=en';

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);                 
    $responseDecoded = json_decode($response, true);
    curl_close($handle);

    echo 'Source: ' . $text . '<br>';
    echo 'Translation: ' . $responseDecoded['data']['translations'][0]['translatedText'];
?>