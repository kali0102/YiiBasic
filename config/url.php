<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    //'enableStrictParsing' => false,
    'rules' => [
        '<c:\w+>/<id:\d+>/<hashId:\w+>/<num:\d+>'=>'<c>/index',
        '<c:\w+>/<id:\d+>' => '<c>/view',
        '<c:\w+>/<a:\w+>/<id:\d+>' => '<c>/<a>',
        '<c:\w+>/<a:\w+>' => '<c>/<a>',
    ],
];