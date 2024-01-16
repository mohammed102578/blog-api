<?Php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
    
    
    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ]
      
    ],
];














?>
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;