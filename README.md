# Sunsari-2 Political Website

This website serves as a central information hub for the Sunsari-2 electoral constituency in Koshi Province, Nepal. It aims to provide voters and interested parties with key data, candidate information, and political updates in an accessible and SEO-optimized manner.

## Website Content Overview

The website is structured to provide comprehensive information across several key areas:

### 1. Homepage (`index.php`)
The homepage acts as a dashboard, offering a snapshot of the Sunsari-2 constituency. It contains:
*   **Constituency Boundaries**: Detailed information on local units (Dewangunj, Harinagara, Ramdhuni, Inaruwa, Itahari) and their respective wards covered within Sunsari-2, including population density.
*   **Demographic Profiles**: Breakdown of population figures, literacy rates, area, and main ethnic groups for each municipality.
*   **Local Landmarks**: Highlights significant places and community centers within Inaruwa.
*   **Key Constituency Issues**: A concise overview of critical political and developmental challenges faced by the region, such as irrigation access, electrification gaps, and seed/fertilizer supply.

### 2. Candidate Profile (`candidate.php`)
This section introduces the candidate representing Sunsari-2. It includes:
*   **Candidate Information**: Name and political affiliation (e.g., Independent).
*   **Political Vision**: An overview of the candidate's commitments, development priorities, and mission for the constituency.
*   **Key Message**: A prominent quote encapsulating the candidate's core philosophy.

### 3. Blog & News Updates (`blogs.php`)
The blog section provides the latest political updates, campaign news, and articles relevant to Sunsari-2. It features:
*   **Dynamic Articles**: A collection of articles covering infrastructure projects, voter awareness campaigns, agricultural initiatives, and public forums. Each article includes details like author, date, category, and descriptive content.
*   **Recent Posts Sidebar**: Highlights top recent articles for easy navigation.

## Core Characteristics & Technical Focus

*   **Dynamic Content**: All primary website content, including header statistics, demographic data, landmarks, key issues, and blog posts, is dynamically loaded from flat JSON data files. This approach prioritizes fast load times and efficient content delivery over complex database management.
*   **SEO Optimization**: The website is built with a strong focus on Search Engine Optimization. This includes:
    *   Dynamic generation of meta tags (title, description, keywords).
    *   Implementation of Schema.org JSON-LD structured data.
    *   Clean, SEO-friendly URLs via `.htaccess`.
    *   Configured `robots.txt` and a dynamic `sitemap.php` for improved crawlability.
    *   Semantic HTML5 structure.
    *   Optimized image `alt` attributes.
*   **Design Preservation**: The original visual design and layout of the static HTML templates have been meticulously preserved, ensuring a consistent user experience.
*   **Modular Structure**: The PHP codebase uses a modular structure with `config.php`, `includes/header.php`, and `includes/footer.php` for maintainability and scalability.

## What the Website Currently *Doesn't* Contain (and Future Considerations)

*   **Individual Blog Post Pages**: Currently, `blogs.php` displays all blog articles on a single page. There are no dedicated individual pages for each blog post (e.g., `blog.php?id=X`).
*   **Backend Database**: Content is managed through flat JSON files (`data/index_data.json` and `data/blog_data.json`) rather than a traditional relational database (like MySQL or SQLite).
*   **User Management**: There are no features for user authentication, administration, or content submission.
*   **Advanced Interactivity**: Features like comment sections, dynamic search filters beyond basic input, or interactive maps are not implemented.

This README provides a clear overview of the Sunsari-2 Political Website's content and underlying technical approach, focusing on delivering information efficiently and optimizing for search engines.