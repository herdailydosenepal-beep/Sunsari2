<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <?php
        $edit_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;
        
        if (!$edit_id) {
            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <strong>Error!</strong> No article ID provided.
                  </div>';
            echo '<a href="manage.php" class="text-blue-600 hover:underline">← Back to Manage Articles</a>';
            exit;
        }
        
        // Load blog data
        $jsonFile = '../../data/blog_data.json';
        $blogData = json_decode(file_get_contents($jsonFile), true);
        
        // Find the post to edit
        $edit_post = null;
        $edit_index = null;
        foreach ($blogData as $key => $post) {
            if ($post['id'] == $edit_id) {
                $edit_post = $post;
                $edit_index = $key;
                break;
            }
        }
        
        if (!$edit_post) {
            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <strong>Error!</strong> Article not found.
                  </div>';
            echo '<a href="manage.php" class="text-blue-600 hover:underline">← Back to Manage Articles</a>';
            exit;
        }
        
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $author = $_POST['author'] ?? 'Admin';
            $category = $_POST['category'] ?? 'General';
            $content = $_POST['content'] ?? '';
            $image_url = $_POST['image_url'] ?? '';
            $alt_text = $_POST['alt_text'] ?? '';
            $summary = $_POST['summary'] ?? '';
            
            // Handle image upload
            if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = '../../assets/images/news/';
                
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $file_extension = strtolower(pathinfo($_FILES['image_upload']['name'], PATHINFO_EXTENSION));
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                
                if (in_array($file_extension, $allowed_extensions)) {
                    $new_filename = 'blog-' . time() . '-' . uniqid() . '.' . $file_extension;
                    $upload_path = $upload_dir . $new_filename;
                    
                    if (move_uploaded_file($_FILES['image_upload']['tmp_name'], $upload_path)) {
                        $image_url = 'assets/images/news/' . $new_filename;
                        
                        if (empty($alt_text)) {
                            $alt_text = $title;
                        }
                    }
                }
            }
            
            if (!empty($title) && !empty($content)) {
                // Get old filename for deletion
                $old_filename = strtolower(trim($edit_post['title']));
                $old_filename = preg_replace('/[^a-z0-9]+/', '-', $old_filename);
                $old_filename = trim($old_filename, '-');
                $old_filename = substr($old_filename, 0, 50);
                
                // Update blog entry
                $blogData[$edit_index] = [
                    'id' => $edit_id,
                    'title' => $title,
                    'author' => $author,
                    'date' => $edit_post['date'], // Keep original date
                    'category' => $category,
                    'image_url' => $image_url,
                    'alt_text' => $alt_text,
                    'summary' => $summary,
                    'content' => $content
                ];
                
                // Save to JSON file
                file_put_contents($jsonFile, json_encode($blogData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                
                // Delete old PHP file if title changed
                $new_filename = strtolower(trim($title));
                $new_filename = preg_replace('/[^a-z0-9]+/', '-', $new_filename);
                $new_filename = trim($new_filename, '-');
                $new_filename = substr($new_filename, 0, 50);
                
                $old_php_path = '../../blogs/sunsari/' . $old_filename . '.php';
                if ($old_filename !== $new_filename && file_exists($old_php_path)) {
                    unlink($old_php_path);
                }
                
                // Create new PHP file
                $blogDir = '../../blogs/sunsari';
                $phpFilePath = $blogDir . '/' . $new_filename . '.php';
                
                $phpContent = '<?php
$pageTitle = "' . addslashes($title) . '";
$blogId = "' . $edit_id . '";
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
                    <span>' . date('F j, Y', strtotime($edit_post['date'])) . '</span>
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
                        <strong>Success!</strong> Article updated successfully!<br>
                        <a href="' . $phpFilePath . '" class="text-blue-600 underline">View article</a> | 
                        <a href="manage.php" class="text-blue-600 underline">Back to manage</a>
                      </div>';
                
                // Reload the updated post
                $edit_post = $blogData[$edit_index];
            } else {
                echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <strong>Error!</strong> Title and content are required.
                      </div>';
            }
        }
        ?>
        
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Edit Article</h1>
            <a href="manage.php" class="text-gray-600 hover:text-gray-800 font-medium">← Back to Manage</a>
        </div>
        
        <form method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title *</label>
                <input type="text" id="title" name="title" required
                       value="<?php echo htmlspecialchars($edit_post['title']); ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="author" class="block text-gray-700 font-bold mb-2">Author</label>
                    <input type="text" id="author" name="author" 
                           value="<?php echo htmlspecialchars($edit_post['author']); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                    <select id="category" name="category"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php
                        $categories = ['Constituency News', 'Election News', 'Agriculture', 'Politics', 'Development', 'General', 'Education', 'Healthcare', 'Environment', 'Youth & Employment'];
                        foreach ($categories as $cat):
                        ?>
                            <option value="<?php echo $cat; ?>" <?php echo $edit_post['category'] === $cat ? 'selected' : ''; ?>>
                                <?php echo $cat; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <!-- Image Section -->
            <div class="mb-6 p-4 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50">
                <h3 class="font-bold text-gray-700 mb-3">Featured Image</h3>
                
                <?php if (!empty($edit_post['image_url'])): ?>
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                        <img src="../../<?php echo htmlspecialchars($edit_post['image_url']); ?>" 
                             alt="Current" 
                             class="max-w-xs h-48 object-cover rounded-lg border border-gray-300">
                    </div>
                <?php endif; ?>
                
                <div class="mb-4">
                    <label for="image_upload" class="block text-gray-700 font-bold mb-2">
                        Upload New Image (Optional)
                    </label>
                    <input type="file" id="image_upload" name="image_upload" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           onchange="previewImage(event)">
                    <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                    
                    <div id="imagePreview" class="mt-3 hidden">
                        <img id="previewImg" src="" alt="Preview" class="max-w-xs h-48 object-cover rounded-lg border border-gray-300">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="image_url" class="block text-gray-700 font-bold mb-2">Or Image URL</label>
                    <input type="url" id="image_url" name="image_url"
                           value="<?php echo htmlspecialchars($edit_post['image_url']); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="alt_text" class="block text-gray-700 font-bold mb-2">Image Alt Text</label>
                    <input type="text" id="alt_text" name="alt_text"
                           value="<?php echo htmlspecialchars($edit_post['alt_text']); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <div class="mb-6">
                <label for="summary" class="block text-gray-700 font-bold mb-2">Summary</label>
                <textarea id="summary" name="summary" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($edit_post['summary']); ?></textarea>
            </div>
            
            <div class="mb-6">
                <label for="content" class="block text-gray-700 font-bold mb-2">Content (HTML) *</label>
                <textarea id="content" name="content" rows="20" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"><?php echo htmlspecialchars($edit_post['content']); ?></textarea>
                <p class="text-sm text-gray-600 mt-2">You can use HTML tags like &lt;p&gt;, &lt;h3&gt;, &lt;ul&gt;, &lt;li&gt;, etc.</p>
            </div>
            
            <div class="flex justify-between items-center">
                <a href="manage.php" class="text-gray-600 hover:text-gray-800">Cancel</a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-200">
                    Update Article
                </button>
            </div>
        </form>
    </div>
    
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    const img = document.getElementById('previewImg');
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
