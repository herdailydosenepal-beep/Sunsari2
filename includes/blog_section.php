<!-- Blog Posts Section -->
<section class="mt-8">
    <div class="flex items-center gap-3 mb-6">
        <span class="material-symbols-outlined text-primary text-3xl">article</span>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Sunsari Politics and Updates</h2>
    </div>

    <?php
    // Get filter and search parameters
    $selected_category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : 'all';
    $search_query = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $per_page = 9; // Show 9 posts per page (3x3 grid)
    
    // Extract unique categories from blog data
    $categories = ['all' => 'All Categories'];
    if (!empty($blog_data) && is_array($blog_data)) {
        foreach ($blog_data as $post) {
            if (!empty($post['category'])) {
                $categories[$post['category']] = $post['category'];
            }
        }
    }
    ?>

    <!-- Search and Filter Bar -->
    <div class="mb-6 bg-white dark:bg-slate-800 p-4 rounded-xl border border-slate-200 dark:border-slate-700">
        <form method="GET" action="" class="flex flex-col md:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input type="text" 
                       name="search" 
                       value="<?php echo $search_query; ?>"
                       placeholder="Search articles by title or content..."
                       class="w-full pl-10 pr-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary dark:bg-slate-700 dark:text-white">
            </div>
            
            <!-- Category Filter -->
            <div class="flex gap-2">
                <select name="category" 
                        class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary dark:bg-slate-700 dark:text-white">
                    <?php foreach ($categories as $cat_key => $cat_label): ?>
                        <option value="<?php echo $cat_key; ?>" <?php echo $selected_category === $cat_key ? 'selected' : ''; ?>>
                            <?php echo $cat_label; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit" 
                        class="bg-primary text-white px-6 py-2 rounded-lg font-bold hover:bg-opacity-90 transition-all">
                    Filter
                </button>
                
                <?php if ($selected_category !== 'all' || !empty($search_query)): ?>
                    <a href="?" 
                       class="bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 px-4 py-2 rounded-lg font-bold hover:bg-slate-300 dark:hover:bg-slate-600 transition-all">
                        Clear
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <?php
    // Filter blog posts based on category and search
    $filtered_posts = [];
    if (!empty($blog_data) && is_array($blog_data)) {
        foreach ($blog_data as $post) {
            // Category filter
            if ($selected_category !== 'all' && (!isset($post['category']) || $post['category'] !== $selected_category)) {
                continue;
            }
            
            // Search filter
            if (!empty($search_query)) {
                $search_lower = strtolower($search_query);
                $title_match = stripos($post['title'], $search_query) !== false;
                $summary_match = isset($post['summary']) && stripos($post['summary'], $search_query) !== false;
                $content_match = isset($post['content']) && stripos(strip_tags($post['content']), $search_query) !== false;
                
                if (!$title_match && !$summary_match && !$content_match) {
                    continue;
                }
            }
            
            $filtered_posts[] = $post;
        }
    }
    
    // Calculate pagination
    $total_posts = count($filtered_posts);
    $total_pages = ceil($total_posts / $per_page);
    $page = min($page, max(1, $total_pages)); // Ensure page is within valid range
    $offset = ($page - 1) * $per_page;
    $paginated_posts = array_slice($filtered_posts, $offset, $per_page);
    ?>

    <!-- Results Count -->
    <?php if ($selected_category !== 'all' || !empty($search_query)): ?>
        <div class="mb-4 text-sm text-slate-600 dark:text-slate-400">
            Found <strong><?php echo $total_posts; ?></strong> article<?php echo $total_posts !== 1 ? 's' : ''; ?>
            <?php if (!empty($search_query)): ?>
                matching "<strong><?php echo $search_query; ?></strong>"
            <?php endif; ?>
            <?php if ($selected_category !== 'all'): ?>
                in category "<strong><?php echo $selected_category; ?></strong>"
            <?php endif; ?>
            <?php if ($total_pages > 1): ?>
                (Page <?php echo $page; ?> of <?php echo $total_pages; ?>)
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($paginated_posts)): ?>
            <?php foreach ($paginated_posts as $post): ?>
                <article class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <?php if (!empty($post['image_url'])): ?>
                        <div class="h-48 overflow-hidden">
                            <?php
                            // Ensure image path is absolute (starts with /)
                            $image_path = $post['image_url'];
                            if (strpos($image_path, '/') !== 0 && strpos($image_path, 'http') !== 0) {
                                $image_path = '/' . $image_path;
                            }
                            ?>
                            <img src="<?php echo htmlspecialchars($image_path); ?>" 
                                 alt="<?php echo htmlspecialchars($post['alt_text'] ?? ''); ?>"
                                 class="w-full h-full object-cover">
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs bg-primary/10 text-primary px-3 py-1 rounded-full font-bold">
                                <?php echo htmlspecialchars($post['category'] ?? 'General'); ?>
                            </span>
                            <span class="text-xs text-slate-500">
                                <?php echo htmlspecialchars($post['date'] ?? ''); ?>
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-3 line-clamp-2">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </h3>
                        
                        <p class="text-sm text-slate-600 dark:text-slate-300 mb-4 line-clamp-3">
                            <?php echo htmlspecialchars($post['summary'] ?? ''); ?>
                        </p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs text-slate-500">
                                By <?php echo htmlspecialchars($post['author'] ?? 'Admin'); ?>
                            </span>
                            <span class="text-xs text-slate-400 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">schedule</span>
                                <?php echo calculate_reading_time($post['content'] ?? ''); ?> min read
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span></span>
                            <?php
                            // Generate filename from title
                            $filename = strtolower(trim($post['title']));
                            $filename = preg_replace('/[^a-z0-9]+/', '-', $filename);
                            $filename = trim($filename, '-');
                            $filename = substr($filename, 0, 50);
                            
                            // Determine if we're in root or subdirectory
                            $blog_link = (strpos($_SERVER['REQUEST_URI'], '/blogs') !== false) 
                                ? "sunsari/{$filename}.php" 
                                : "blogs/sunsari/{$filename}.php";
                            ?>
                            <a href="<?php echo $blog_link; ?>" 
                               class="text-primary hover:text-primary/80 font-bold text-sm">
                                Read More →
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-12">
                <?php if ($selected_category !== 'all' || !empty($search_query)): ?>
                    <span class="material-symbols-outlined text-slate-300 text-6xl mb-4 block">search_off</span>
                    <p class="text-slate-500 text-lg mb-2">No articles found matching your criteria</p>
                    <a href="?" class="text-primary font-bold">Clear filters</a>
                <?php else: ?>
                    <p class="text-slate-500 text-lg">No updates available at the moment.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <div class="mt-8 flex justify-center items-center gap-2">
            <?php
            // Build query string for pagination links
            $query_params = [];
            if ($selected_category !== 'all') $query_params['category'] = $selected_category;
            if (!empty($search_query)) $query_params['search'] = $search_query;
            
            function build_page_url($page_num, $params) {
                $params['page'] = $page_num;
                return '?' . http_build_query($params);
            }
            ?>
            
            <!-- Previous Button -->
            <?php if ($page > 1): ?>
                <a href="<?php echo build_page_url($page - 1, $query_params); ?>" 
                   class="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                </a>
            <?php else: ?>
                <span class="px-4 py-2 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-slate-400 cursor-not-allowed">
                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                </span>
            <?php endif; ?>
            
            <!-- Page Numbers -->
            <?php
            // Show max 5 page numbers
            $start_page = max(1, $page - 2);
            $end_page = min($total_pages, $start_page + 4);
            $start_page = max(1, $end_page - 4);
            
            for ($i = $start_page; $i <= $end_page; $i++):
            ?>
                <?php if ($i === $page): ?>
                    <span class="px-4 py-2 bg-primary text-white font-bold rounded-lg">
                        <?php echo $i; ?>
                    </span>
                <?php else: ?>
                    <a href="<?php echo build_page_url($i, $query_params); ?>" 
                       class="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                        <?php echo $i; ?>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>
            
            <!-- Next Button -->
            <?php if ($page < $total_pages): ?>
                <a href="<?php echo build_page_url($page + 1, $query_params); ?>" 
                   class="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </a>
            <?php else: ?>
                <span class="px-4 py-2 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-slate-400 cursor-not-allowed">
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </span>
            <?php endif; ?>
        </div>
        
        <!-- Page Info -->
        <div class="mt-4 text-center text-sm text-slate-600 dark:text-slate-400">
            Showing <?php echo $offset + 1; ?>-<?php echo min($offset + $per_page, $total_posts); ?> of <?php echo $total_posts; ?> articles
        </div>
    <?php endif; ?>
</section>
