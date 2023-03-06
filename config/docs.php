<?php

return [

    /**
     * ---------------------------------------------------------
     * Documentation Repository
     * ---------------------------------------------------------
     *
     * The repository where the documentation is stored.
     *
     */
    'repository' => env('DOCS_REPOSITORY', ''),

    /**
     * ---------------------------------------------------------
     * Documentation Branch
     * ---------------------------------------------------------
     *
     * The branch where the documentation is stored.
     *
     */
    'branch' => env('DOCS_BRANCH', 'main'),

    /**
     * ---------------------------------------------------------
     * Access Token
     * ---------------------------------------------------------
     *
     * If the repository is private, you need to provide an
     * access token to access the repository.
     *
     */
    'access_token' => env('DOCS_ACCESS_TOKEN', ''),

    /**
     * ---------------------------------------------------------
     * Documentation Colors
     * ---------------------------------------------------------
     *
     * The colors used for the documentation site.
     *
     */
    'colors' => [
        'primary'   => env('PRIMARY_COLOR', '#16BAC5'),
        'secondary' => env('SECONDARY_COLOR', '#416788'),
    ],

];
