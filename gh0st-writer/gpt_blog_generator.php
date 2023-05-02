<?php

function generate_blog_content($api_key, $industry, $topic, $benefit, $tone, $length) {
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    );

    $data = array(
        'prompt' => '[ai_target-demographic-generator]{"role": "an ai market researcher and content strategist who specializes in identifying target demographics and their pain points, and how a blog post will address these pain points.",  "identify": {"target_demo": "_target_demo", "pain_points": ["_pain-1", "_pain-2",  "_pain-3"], "pain_addressed": ["_addressed-1", "_addressed-2", "_addressed-3"]}, "reply": {"Target_#":{"target_demo":"RESPONSE", "pain_points": ["RESPONSE", "RESPONSE", "RESPONSE"], "pain_addressed":["RESPONSE", "RESPONSE", "RESPONSE"]}, 3}}->[user_info]{"industry": "' . $industry . '", "main_topic":"' . $topic . '", "main_benefit":"' . $benefit . '"}->[begin]->[run]{"process": {"GPT Prompt": "[ai_target-demographic-generator] + [user_info]"}}->[generated_output::JSON-only]',
        'max_tokens' => $length,
        'temperature' => 0.5,
        'n' => 1,
        'stop' => '. '
    );

    $data_string = json_encode($data);

    $ch = curl_init('https://api.openai.com/v1/engines/davinci-codex/completions');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    $result = json_decode($result, true);

    if (isset($result['Target_01'])) {
        $target_1_demo = $result['Target_01']['target_demo'];
        $target_1_pain_1 = $result['Target_01']['pain_points'][0];
        $target_1_pain_2 = $result['Target_01']['pain_points'][1];
        $target_1_pain_3 = $result['Target_01']['pain_points'][2];
        $target_1_addressed_1 = $result['Target_01']['pain_addressed'][0];
        $target_1_addressed_2 = $result['Target_01']['pain_addressed'][1];
        $target_1_addressed_3 = $result['Target_01']['pain_addressed'][2];
    }

    if (isset($result['Target_02'])) {
        $target_2_demo = $result['Target_02']['target_demo'];
        $target_2_pain_1 = $result['Target_02']['pain_points'][0];
        $target_2_pain_2 = $result['Target_02']['pain_points'][1];
        $target_2_pain_3 = $result['Target_02']['pain_points'][2];
        $target_2_addressed_1 = $result['Target_02']['pain_addressed'][0];
        $target_2_addressed_2 = $result['Target_02']['pain_addressed'][1];
        $target_2_addressed_3 = $result['Target_02']['pain_addressed'][2];
    }

    if (isset($result['Target_03'])) {
        $target_3_demo = $result['Target_03']['target_demo'];
        $target_3_pain_1 = $result['Target_03']['pain_points'][0];
        $target_3_pain_2 = $result['Target_03']['pain_points'][1];
        $target_3_pain_3 = $result['Target_03']['pain_points'][2];
        $target_3_addressed_1 = $result['Target_03']['pain_addressed'][0];
        $target_3_addressed_2 = $result['Target_03']['pain_addressed'][1];
        $target_3_addressed_3 = $result['Target_03']['pain_addressed'][2];
    }
}

// Example usage: 
$api_key = "YOUR_API_KEY";
$topic = "artificial intelligence";
$tone = "professional, educational";
$length = 600;

echo generate_blog_content($api_key, $industry, $topic, $benefit, $tone, $length);
?>
