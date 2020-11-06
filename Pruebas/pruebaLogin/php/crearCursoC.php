<?php


$array['data'] =  json_decode(file_get_contents("php://input"), true);


print_r ($array['data']);