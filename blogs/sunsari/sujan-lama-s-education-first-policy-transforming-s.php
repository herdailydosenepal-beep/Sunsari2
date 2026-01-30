<?php
$pageTitle = "Sujan Lama\'s Education First Policy: Transforming Schools in Sunsari-2";
$blogId = "4";
require_once __DIR__ . "/../../includes/blogmeta.php";
?>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Article Content -->
            <article class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Featured Image -->
                    <?php if (!empty($current_post["image_url"])): ?>
                    <div class="w-full h-96 overflow-hidden">
                        <img src="../../<?php echo htmlspecialchars($current_post["image_url"]); ?>" 
                             alt="<?php echo htmlspecialchars($current_post["alt_text"]); ?>"
                             class="w-full h-full object-cover">
                    </div>
                    <?php endif; ?>
                    
                    <!-- Article Header -->
                    <header class="p-8 border-b border-gray-200">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="bg-primary/10 text-primary px-4 py-1 rounded-full text-sm font-bold">
                                <?php echo htmlspecialchars($current_post["category"]); ?>
                            </span>
                            <span class="text-gray-500 text-sm">
                                <?php echo date("F j, Y", strtotime($current_post["date"])); ?>
                            </span>
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                            <?php echo htmlspecialchars($current_post["title"]); ?>
                        </h1>
                        
                        <div class="flex items-center gap-3 text-gray-600">
                            <span class="material-symbols-outlined text-primary">person</span>
                            <span>By <strong><?php echo htmlspecialchars($current_post["author"]); ?></strong></span>
                        </div>
                        
                        <p class="mt-6 text-xl text-gray-600 italic leading-relaxed">
                            <?php echo htmlspecialchars($current_post["summary"]); ?>
                        </p>
                    </header>
                    
                    <!-- Article Body -->
                    <div class="p-8 prose prose-lg max-w-none">
                        <?php echo $current_post["content"]; ?>
                    </div>
                    
                    <!-- Article Footer -->
                    <footer class="p-8 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="text-sm font-bold text-gray-700">Tags:</span>
                            <a href="../../blogs.php" class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold hover:bg-blue-200 transition">Sujan Lama</a>
                            <a href="../../blogs.php" class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold hover:bg-blue-200 transition">Sunsari-2</a>
                            <a href="../../blogs.php" class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold hover:bg-blue-200 transition"><?php echo htmlspecialchars($current_post["category"]); ?></a>
                        </div>
                        
                        <div class="flex items-center justify-between border-t pt-6">
                            <a href="../../index.php" class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-bold transition">
                                <span class="material-symbols-outlined">arrow_back</span>
                                Back to Home
                            </a>
                            <a href="../../blogs.php" class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-bold transition">
                                View All Articles
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </footer>
                </div>
                
                <!-- Share Buttons -->
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Share This Article</h3>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://sunsari2.com/blogs/sunsari/' . basename(__FILE__)); ?>" 
                           target="_blank" 
                           class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                            Share on Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://sunsari2.com/blogs/sunsari/' . basename(__FILE__)); ?>&text=<?php echo urlencode($current_post['title']); ?>" 
                           target="_blank" 
                           class="bg-sky-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-sky-600 transition">
                            Share on Twitter
                        </a>
                    </div>
                </div>
            </article>
            
            <!-- Sidebar -->
            <aside class="space-y-6">
                <!-- About Sujan Lama -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">About Sujan Lama</h3>
                    <div class="mb-4">
                        <img src="../../assets/images/news/sujan-lama.jpg" 
                             alt="Sujan Lama - Sunsari-2 Leader" 
                             class="w-full h-48 object-cover rounded-lg">
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Sujan Lama is a visionary leader committed to the development and progress of Sunsari-2 constituency 
                        in Koshi Province, Nepal. Learn more about his mission and vision for the community.
                    </p>
                    <a href="https://sujanlama.com" target="_blank" 
                       class="inline-block bg-primary text-white px-6 py-2 rounded-lg font-bold hover:bg-primary/90 transition">
                        Learn More
                    </a>
                </div>
                
                <!-- Related Posts -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Related Articles</h3>
                    <div class="space-y-4">
                        <?php foreach ($related_posts as $related): 
                            $related_slug = strtolower(trim($related["title"]));
                            $related_slug = preg_replace("/[^a-z0-9]+/", "-", $related_slug);
                            $related_slug = trim($related_slug, "-");
                            $related_slug = substr($related_slug, 0, 50);
                        ?>
                        <a href="<?php echo $related_slug; ?>.php" class="block group">
                            <div class="flex gap-3">
                                <img src="../../<?php echo htmlspecialchars($related["image_url"]); ?>" 
                                     alt="<?php echo htmlspecialchars($related["title"]); ?>"
                                     class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 text-sm group-hover:text-primary transition line-clamp-2">
                                        <?php echo htmlspecialchars($related["title"]); ?>
                                    </h4>
                                    <span class="text-xs text-gray-500">
                                        <?php echo date("M j, Y", strtotime($related["date"])); ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Categories -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Categories</h3>
                    <div class="space-y-2">
                        <a href="../../blogs.php" class="block text-gray-700 hover:text-primary hover:bg-gray-50 px-3 py-2 rounded transition">Leadership</a>
                        <a href="../../blogs.php" class="block text-gray-700 hover:text-primary hover:bg-gray-50 px-3 py-2 rounded transition">Development</a>
                        <a href="../../blogs.php" class="block text-gray-700 hover:text-primary hover:bg-gray-50 px-3 py-2 rounded transition">Agriculture</a>
                        <a href="../../blogs.php" class="block text-gray-700 hover:text-primary hover:bg-gray-50 px-3 py-2 rounded transition">Education</a>
                        <a href="../../blogs.php" class="block text-gray-700 hover:text-primary hover:bg-gray-50 px-3 py-2 rounded transition">Healthcare</a>
                        <a href="../../blogs.php" class="block text-gray-700 hover:text-primary hover:bg-gray-50 px-3 py-2 rounded transition">Women Empowerment</a>
                        <a href="../../blogs.php" class="block text-gray-700 hover:text-primary hover:bg-gray-50 px-3 py-2 rounded transition">Technology</a>
                        <a href="../../blogs.php" class="block text-gray-700 hover:text-primary hover:bg-gray-50 px-3 py-2 rounded transition">Tourism</a>
                        <a href="../../blogs.php" class="block text-gray-700 hover:text-primary hover:bg-gray-50 px-3 py-2 rounded transition">Environment</a>
                        <a href="../../blogs.php" class="block text-gray-700 hover:text-primary hover:bg-gray-50 px-3 py-2 rounded transition">Youth & Employment</a>
                    </div>
                </div>
                
                <!-- CTA Box -->
                <div class="bg-gradient-to-br from-primary to-secondary rounded-lg shadow-lg p-6 text-white">
                    <h3 class="text-2xl font-bold mb-3">Join Our Movement</h3>
                    <p class="text-white/90 mb-4">
                        Be part of the change in Sunsari-2. Follow our campaign and stay updated with the latest news.
                    </p>
                    <a href="https://forms.gle/cUi2Wy9VAPjMtcKH8" target="_blank" 
                       class="block bg-white text-primary px-6 py-3 rounded-lg font-bold text-center hover:bg-gray-100 transition">
                        Contact Us
                    </a>
                </div>
            </aside>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-400 mb-2">© 2026 Sunsari-2 Constituency. All rights reserved.</p>
            <p class="text-gray-400 text-sm">Authorized by: Sujan Lama Campaign Office | Koshi Province, Nepal</p>
        </div>
    </footer>
</body>
</html>