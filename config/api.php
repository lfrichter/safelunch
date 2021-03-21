<?php

return [
    'FHRS' => ENV('FHRS_API', 'https://api.ratings.food.gov.uk'),
    'FHRS_header' => [
        'x-api-version' => '2',
        'accept' => 'application/json',
        'content-type' => 'application/json',
    ],
];
