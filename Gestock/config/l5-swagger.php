<?php

return [
  'paths' => [
    'docs' => storage_path('api-docs'),
    'docs_json' => 'api-docs.json',
    'docs_yaml' => 'api-docs.yaml',
    'annotations' => base_path('app/Http/Controllers'),
    'excludes' => [],
],

    'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),
    'generate_docs' => env('L5_SWAGGER_GENERATE_DOCS', true),
    'generate_yaml_spec' => env('L5_SWAGGER_GENERATE_YAML_SPEC', false),
    'routes' => [
        'api' => [
            'enabled' => true,
            'prefix' => 'api/documentation',
            'name' => 'api.documentation',
        ],
    ],
    
];
