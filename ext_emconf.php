<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Content Owners',
    'description' => 'This extension adds a field to tt_content elements or other records to specify the only allowed BE user to edit the record (admins can edit anyway)',
    'category' => 'plugin',
    'author' => 'Paul Beck',
    'author_email' => 'hi@toll-paul.de',
    'author_company' => 'jansass GmbH',
    'state' => 'beta',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.2.1',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
