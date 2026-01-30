<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Post Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Post New Article</h1>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $title = $_POST['title'] ?? '';
            $author = $_POST['author'] ?? 'Admin';
            $category = $_POST['category'] ?? 'General';
            $content = $_POST['content'] ?? '';
            $image_url = $_POST['image_url'] ?? '';
            $alt_text = $_POST['alt_text'] ?? '';
            $summary = $_POST['summary'] ?? '';
            
            if (!empty($title) && !empty($content)) {
                // Read existing blog data
                $jsonFile = '../../data/blog_data.json';
                $blogData = json_decode(file_get_contents($jsonFile), true);
                
                // Generate new ID
                $newId = count($blogData) > 0 ? (string)(max(array_column($blogData, 'id')) + 1) : '1';
                
                // Create new blog entry
                $newEntry = [
                    'id' => $newId,
                    'title' => $title,
                    'author' => $author,
                    'date' => date('Y-m-d'),
                    'category' => $category,
                    'image_url' => $image_url,
                    'alt_text' => $alt_text,
                    'summary' => $summary,
                    'content' => $content
                ];
                
                // Add to blog data
                $blogData[] = $newEntry;
                
                // Save to JSON file
                file_put_contents($jsonFile, json_encode($blogData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                
                // Create filename from title
                $filename = strtolower(trim($title));
                $filename = preg_replace('/[^a-z0-9]+/', '-', $filename);
                $filename = trim($filename, '-');
                $filename = substr($filename, 0, 50); // Limit length
                
                // Ensure blogs/sunsari directory exists
                $blogDir = '../../blogs/sunsari';
                if (!file_exists($blogDir)) {
                    mkdir($blogDir, 0777, true);
                }
                
                // Create PHP file in blogs/sunsari
                $phpFilePath = $blogDir . '/' . $filename . '.php';
                
                // Create blog page content
                $phpContent = '<?php
$pageTitle = "' . addslashes($title) . '";
$blogId = "' . $newId . '";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Sunsari-2</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <article class="bg-white rounded-lg shadow-lg p-8">
            <header class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4"><?php echo htmlspecialchars($pageTitle); ?></h1>
                <div class="flex items-center text-gray-600 text-sm space-x-4">
                    <span>By <strong>' . htmlspecialchars($author) . '</strong></span>
                    <span>•</span>
                    <span>' . date('F j, Y') . '</span>
                    <span>•</span>
                    <span class="text-primary">' . htmlspecialchars($category) . '</span>
                </div>
            </header>
            
            <?php if (!empty("' . addslashes($image_url) . '")): ?>
            <div class="mb-8">
                <img src="' . htmlspecialchars($image_url) . '" 
                     alt="' . htmlspecialchars($alt_text) . '"
                     class="w-full h-auto rounded-lg shadow-md">
            </div>
            <?php endif; ?>
            
            <div class="prose prose-lg max-w-none">
                ' . $content . '
            </div>
            
            <footer class="mt-12 pt-6 border-t border-gray-200">
                <a href="../../index.php" class="text-blue-600 hover:text-blue-800 font-medium">
                    ← Back to all articles
                </a>
            </footer>
        </article>
    </div>
</body>
</html>';
                
                file_put_contents($phpFilePath, $phpContent);
                
                echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        <strong>Success!</strong> Article posted successfully!<br>
                        <span class="text-sm">File created: blogs/sunsari/' . $filename . '.php</span><br>
                        <a href="' . $phpFilePath . '" class="text-blue-600 underline">View article</a>
                      </div>';
            } else {
                echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <strong>Error!</strong> Title and content are required.
                      </div>';
            }
        }
        ?>
        
        <form method="POST" class="bg-white rounded-lg shadow-lg p-8">
            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title *</label>
                <input type="text" id="title" name="title" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter article title">
            </div>
            
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="author" class="block text-gray-700 font-bold mb-2">Author</label>
                    <input type="text" id="author" name="author" value="Admin"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                    <select id="category" name="category"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Constituency News">Constituency News</option>
                        <option value="Election News">Election News</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Politics">Politics</option>
                        <option value="Development">Development</option>
                        <option value="General">General</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="image_url" class="block text-gray-700 font-bold mb-2">Image URL</label>
                <input type="url" id="image_url" name="image_url"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="https://example.com/image.jpg">
            </div>
            
            <div class="mb-6">
                <label for="alt_text" class="block text-gray-700 font-bold mb-2">Image Alt Text</label>
                <input type="text" id="alt_text" name="alt_text"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Describe the image">
            </div>
            
            <div class="mb-6">
                <label for="summary" class="block text-gray-700 font-bold mb-2">Summary</label>
                <textarea id="summary" name="summary" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Brief summary of the article"></textarea>
            </div>
            
            <div class="mb-6">
                <label for="content" class="block text-gray-700 font-bold mb-2">Content (HTML) *</label>
                <textarea id="content" name="content" rows="15" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                          placeholder="<p>Write your article content here with HTML tags...</p>"></textarea>
                <p class="text-sm text-gray-600 mt-2">You can use HTML tags like &lt;p&gt;, &lt;h3&gt;, &lt;ul&gt;, &lt;li&gt;, etc.</p>
            </div>
            
            <div class="flex justify-between items-center">
                <a href="../../index.php" class="text-gray-600 hover:text-gray-800">Cancel</a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-200">
                    Post Article
                </button>
            </div>
        </form>
    </div>
</body>
</html>
