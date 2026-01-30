<?php require_once 'includes/header.php'; ?>

<main class="max-w-7xl mx-auto p-4 md:p-8 space-y-12">
    <!-- Blog Posts Section -->
    <section class="mt-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-3xl">article</span>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Latest Blog Posts</h2>
            </div>
            <a href="admin/post/index.php" class="bg-primary text-white px-4 py-2 rounded-lg font-bold hover:bg-opacity-90 transition-all text-sm">
                + New Article
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($blog_data)): ?>
                <?php foreach ($blog_data as $post): ?>
                    <article class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-lg transition-shadow">
                        <?php if (!empty($post['image_url'])): ?>
                            <div class="h-48 overflow-hidden">
                                <img src="<?php echo htmlspecialchars($post['image_url']); ?>" 
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
                            
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-500">
                                    By <?php echo htmlspecialchars($post['author'] ?? 'Admin'); ?>
                                </span>
                                <?php
                                // Generate filename from title
                                $filename = strtolower(trim($post['title']));
                                $filename = preg_replace('/[^a-z0-9]+/', '-', $filename);
                                $filename = trim($filename, '-');
                                $filename = substr($filename, 0, 50);
                                ?>
                                <a href="blogs/sunsari/<?php echo $filename; ?>.php" 
                                   class="text-primary hover:text-primary/80 font-bold text-sm">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-slate-500 text-lg">No blog posts yet. <a href="admin/post/index.php" class="text-primary font-bold">Create your first post</a></p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>

<?php require_once 'includes/footer.php'; ?>