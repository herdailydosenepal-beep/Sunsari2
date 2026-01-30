<?php
// Main Configuration for Sunsari-2 Website

// -----------------------------------------------------------------------------
// 1. SEO & PAGE METADATA
// -----------------------------------------------------------------------------
// This array holds all the crucial SEO metadata for each page.
// It's used to dynamically generate <title>, <meta description>, etc.
// 'og_type' refers to Open Graph type (e.g., website, article, profile).

$page_config = [
    'index' => [
        'title' => 'Sunsari-2 Constituency | Koshi Province Nepal Election Data',
        'meta_description' => 'Complete constituency data for Sunsari-2: Dewangunj, Harinagara, Ramdhuni, Inaruwa, Itahari. Demographics, wards, political strategy, and election information.',
        'meta_keywords' => 'Sunsari-2, Koshi Province, Nepal election, constituency data, Dewangunj, Harinagara, Inaruwa, Ramdhuni, Itahari',
        'canonical' => 'https://yourdomain.com/',
        'og_type' => 'website'
    ],
    'candidate' => [
        'title' => '[Candidate Name] - Sunsari-2 Candidate Profile & Political Vision',
        'meta_description' => 'Meet [Candidate Name], candidate for Sunsari-2 constituency. Learn about political vision, development priorities, and commitments to Dewangunj, Harinagara, Ramdhuni, Inaruwa, and Itahari.',
        'meta_keywords' => '[Candidate Name], Sunsari-2 candidate, Nepal election, political profile, campaign promises',
        'canonical' => 'https://yourdomain.com/candidate.php',
        'og_type' => 'profile'
    ],
    'blogs' => [
        'title' => 'Sunsari-2 News & Political Updates | Campaign Blog',
        'meta_description' => 'Latest news, updates, and political analysis from Sunsari-2 constituency. Campaign activities, local issues, development projects, and community engagement.',
        'meta_keywords' => 'Sunsari-2 news, political blog, campaign updates, local issues, Nepal politics',
        'canonical' => 'https://yourdomain.com/blogs.php',
        'og_type' => 'blog'
    ]
];

// -----------------------------------------------------------------------------
// 2. CANDIDATE & CAMPAIGN INFORMATION
// -----------------------------------------------------------------------------
// Central place for candidate details. Replace placeholders.
$candidate_name = "Shri Ram Chaudhary";
$political_party = "Independent";
$campaign_office_address = "123 Main Street, Inaruwa, Sunsari";

// -----------------------------------------------------------------------------
// 3. STRUCTURED DATA (SCHEMA.ORG JSON-LD)
// -----------------------------------------------------------------------------
// Schema markup helps search engines understand the content's context.

// For index.php: Describes the electoral constituency as a place.
$schema_place = [
    "@context" => "https://schema.org",
    "@type" => "AdministrativeArea",
    "name" => "Sunsari-2 Electoral Constituency",
    "containedInPlace" => [
        "@type" => "AdministrativeArea",
        "name" => "Koshi Province",
        "containedInPlace" => [
            "@type" => "Country",
            "name" => "Nepal"
        ]
    ],
    "containsPlace" => [
        ["@type" => "City", "name" => "Dewangunj Rural Municipality"],
        ["@type" => "City", "name" => "Harinagara Rural Municipality"],
        ["@type" => "City", "name" => "Ramdhuni Municipality"],
        ["@type" => "City", "name" => "Inaruwa Municipality"],
        ["@type" => "City", "name" => "Itahari Sub-Metropolitan City"]
    ]
];

// For candidate.php: Describes the candidate as a person.
$schema_person = [
    "@context" => "https://schema.org",
    "@type" => "Person",
    "name" => $candidate_name,
    "jobTitle" => "Political Candidate",
    "affiliation" => [
        "@type" => "Organization",
        "name" => $political_party
    ],
    "knowsAbout" => ["Politics", "Governance", "Rural Development", "Agriculture Policy"],
    "workLocation" => [
        "@type" => "Place",
        "name" => "Sunsari-2 Constituency, Koshi Province, Nepal"
    ]
];

// For Local SEO: Describes the campaign office.
$campaign_office_schema = [
    "@context" => "https://schema.org",
    "@type" => "LocalBusiness",
    "name" => $candidate_name . " Campaign Office",
    "address" => [
        "@type" => "PostalAddress",
        "streetAddress" => $campaign_office_address,
        "addressLocality" => "Inaruwa",
        "addressRegion" => "Koshi Province",
        "addressCountry" => "NP"
    ],
    "geo" => [
        "@type" => "GeoCoordinates",
        "latitude" => "26.6544",  // Approximate center of constituency
        "longitude" => "87.2718"
    ]
];

// -----------------------------------------------------------------------------
// 4. LOCAL SEO & GEOGRAPHIC METADATA
// -----------------------------------------------------------------------------
// Legacy geo tags for broader compatibility.
$geo_tags = [
    'geo.region' => 'NP-P1',  // ISO 3166-2 code for Koshi Province
    'geo.placename' => 'Sunsari District',
    'geo.position' => '26.6544;87.2718', // latitude;longitude
    'ICBM' => '26.6544, 87.2718'         // latitude, longitude
];


// -----------------------------------------------------------------------------
// 5. DYNAMIC CONTENT & DATA
// -----------------------------------------------------------------------------

// Data for the constituency boundaries table on index.php
$local_units = [
    [
        'name' => 'Dewangunj',
        'wards' => '1, 2, 3, 4, 5, 6, 7',
        'type' => 'Rural Municipality',
        'density' => '812 /km²',
        'type_class' => 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300'
    ],
    [
        'name' => 'Harinagara',
        'wards' => '1, 2, 3, 4, 5, 6, 7',
        'type' => 'Rural Municipality',
        'density' => '745 /km²',
        'type_class' => 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300'
    ],
    [
        'name' => 'Ramdhuni',
        'wards' => '1, 2, 3, 5, 7, 8, 9',
        'type' => 'Municipality',
        'density' => '1,102 /km²',
        'type_class' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300'
    ],
    [
        'name' => 'Inaruwa',
        'wards' => '1, 2, 3, 4, 5, 6, 7, 8, 9, 10',
        'type' => 'Municipality',
        'density' => '1,450 /km²',
        'type_class' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300'
    ],
    [
        'name' => 'Itahari',
        'wards' => '6, 7, 8, 9, 10',
        'type' => 'Sub-Metropolitan',
        'density' => '2,230 /km²',
        'type_class' => 'bg-primary/10 text-primary'
    ]
];

// Load blog data from JSON file
$blog_data = [];
$blog_json_file = __DIR__ . '/../data/blog_data.json';
if (file_exists($blog_json_file)) {
    $blog_json_content = file_get_contents($blog_json_file);
    $blog_data = json_decode($blog_json_content, true);
}

// -----------------------------------------------------------------------------
// 6. MULTILINGUAL SUPPORT (I18N)
// -----------------------------------------------------------------------------
// Array for English/Nepali translations.
$translations = [
    'ne' => [
        'constituency' => 'सुनसरी-२ निर्वाचन क्षेत्र',
        'candidate' => 'उम्मेदवार',
        'demographics' => 'जनसांख्यिकी',
        'wards' => 'वडाहरू',
        'home' => 'गृहपृष्ठ'
    ],
    'en' => [
        'constituency' => 'Sunsari-2 Constituency',
        'candidate' => 'Candidate',
        'demographics' => 'Demographics',
        'wards' => 'Wards',
        'home' => 'Home'
    ]
];

// -----------------------------------------------------------------------------
// 7. UTILITY FUNCTIONS
// -----------------------------------------------------------------------------

/**
 * Generates breadcrumb navigation with Schema.org markup.
 *
 * @param string $current_page_title The title of the current page.
 * @param array $custom_trail An associative array for custom breadcrumb trails ['Title' => 'url.php'].
 * @return string JSON-LD schema for breadcrumbs.
 */
function generate_breadcrumbs($current_page_title, $custom_trail = [])
{
    $base_url = "https://yourdomain.com";
    $breadcrumbs = [
        'Home' => '/'
    ];

    if (!empty($custom_trail)) {
        $breadcrumbs = array_merge($breadcrumbs, $custom_trail);
    } else {
        $breadcrumbs[$current_page_title] = $_SERVER['REQUEST_URI'];
    }

    $schema = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => []
    ];

    $position = 1;
    foreach ($breadcrumbs as $name => $url) {
        $schema['itemListElement'][] = [
            "@type" => "ListItem",
            "position" => $position++,
            "name" => $name,
            "item" => $base_url . $url
        ];
    }

    return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}

/**
 * Gets the current page name from the script filename.
 * e.g., "index.php" becomes "index".
 *
 * @return string The name of the current page.
 */
function get_current_page()
{
    return basename($_SERVER['PHP_SELF'], '.php');
}

// Global variable to hold the current page's configuration
$current_page = get_current_page();
$page = isset($page_config[$current_page]) ? $page_config[$current_page] : $page_config['index'];

?>