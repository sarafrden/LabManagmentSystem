<?php
return [
    'resources' => [


// user options
        'banner' => [
            'allowedSorts' => [
              'id',
                'created_at',
                'updated_at',
            ],
            'allowedFilters' => [
                'column',
                'column'
            ],
            'allowedIncludes' => [
                'relation',
                'relation'
            ],
        ],







// banner options
        // 'banner' => [
        //     'allowedSorts' => [
        //         'column',
        //         'column'
        //     ],
        //     'allowedFilters' => [
        //         'column',
        //         'column'
        //     ],
        //     'allowedIncludes' => [
        //         'relation',
        //         'relation'
        //     ],
        // ],



// news options
        'news' => [
            'allowedSorts' => [
              'id',
                'title',
                'created_at',
                'updated_at'
            ],
            'allowedFilters' => [
                'title',
            ],
            'allowedIncludes' => [
                'relation',
                'relation'
            ],

        ],



// doctor options
        'doctor' => [
            'allowedSorts' => [
              'id',
                'name',
                'created_at',
                'updated_at',
            ],
            'allowedFilters' => [
              'id',
                'name',
                'specialization',
            ],
            'allowedIncludes' => [
                'relation',
                'relation'
            ],
        ],



        // paitent options
        'patient' => [
            'allowedSorts' => [
              'id',
                'name',
                'created_at',
                'updated_at',
                'status'
            ],
            'allowedFilters' => [
              'id',
                'name',
                'phone',
                'address',
            ],
            'allowedIncludes' => [
                'relation',
                'relation'
            ],
        ],






//dont-remove-or-edit-this-line
    ]
];

?>
