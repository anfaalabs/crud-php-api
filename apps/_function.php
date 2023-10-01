<?php

function base_url(?string $path = "")
{
  global $base_path;

  $app_dir = isset($base_path) ? $base_path : __DIR__ . "/../";

  return $app_dir . $path;
}


function api_response(?object $options, $data)
{
  $response = (object) [
    "status" => isset($options->status) ? $options->status : "success",
    "status_code" => isset($options->status_code) ? $options->status_code : 200,
    "message" => isset($options->message) ? $options->message : "Success!",
    "data" => isset($data) ? $data : null,
  ];

  return json_encode($response);
}
