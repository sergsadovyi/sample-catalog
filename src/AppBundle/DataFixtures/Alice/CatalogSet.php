<?php
use h4cc\AliceFixturesBundle\Fixtures\FixtureSet;

$set = new FixtureSet(
    [
        'do_drop'    => true,
        'do_persist' => true,
    ]
);
$set->addFile(__DIR__ . '/catalog.yml', 'yaml');

return $set;