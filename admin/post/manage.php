<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Manage Articles</h1>
            <div class="flex gap-3">
                <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    + New Article
                </a>
                <a href="../../index.php" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    ← Back to Site
                </a>
            </div>
        </div>
        
        <?php
        // Handle delete action
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $delete_id = htmlspecialchars($_GET['id']);
            $jsonFile = '../../data/blog_data.json';
            $blogData = json_decode(file_get_contents($jsonFile), true);
            
            $found = false;
            $deleted_post = null;
            foreach ($blogData as $key => $post) {
                if ($post['id'] == $delete_id) {
                    $deleted_post = $post;
                    unset($blogData[$key]);
                    $found = true;
                    break;
                }
            }
            
            if ($found) {
                // Re-index array
                $blogData = array_values($blogData);
                
                // Save updated data
                file_put_contents($jsonFile, json_encode($blogData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                
                // Try to delete the PHP file
                $filename = strtolower(trim($deleted_post['title']));
                $filename = preg_replace('/[^a-z0-9]+/', '-', $filename);
                $filename = trim($filename, '-');
                $filename = substr($filename, 0, 50);
                $phpFilePath = '../../blogs/sunsari/' . $filename . '.php';
                
                if (file_exists($phpFilePath)) {
                    unlink($phpFilePath);
                }
                
                echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        <strong>Success!</strong> Article deleted successfully.
                      </div>';
            } else {
                echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <strong>Error!</strong> Article not found.
                      </div>';
            }
        }
        
        // Load blog data
        $jsonFile = '../../data/blog_data.json';
        $blogData = [];
        if (file_exists($jsonFile)) {
            $blogData = json_decode(file_get_contents($jsonFile), true);
        }
        
        // Sort by date (newest first)
        usort($blogData, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        ?>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">ID</th>
                        <th class="px-6 py-4 text-left">Title</th>
                        <th class="px-6 py-4 text-left">Category</th>
                        <th class="px-6 py-4 text-left">Date</th>
                        <th class="px-6 py-4 text-left">Author</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($blogData)): ?>
                        <?php foreach ($blogData as $post): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($post['id']); ?></td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800 max-w-md truncate">
                                        <?php echo htmlspecialchars($post['title']); ?>
                                    </div>
                                    <?php if (!empty($post['summary'])): ?>
                                        <div class="text-xs text-gray-500 mt-1 max-w-md truncate">
                                            <?php echo htmlspecialchars(substr($post['summary'], 0, 100)); ?>...
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-bold">
                                        <?php echo htmlspecialchars($post['category']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?php echo date('M d, Y', strtotime($post['date'])); ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?php echo htmlspecialchars($post['author']); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <?php
                                        // Generate filename
                                        $filename = strtolower(trim($post['title']));
                                        $filename = preg_replace('/[^a-z0-9]+/', '-', $filename);
                                        $filename = trim($filename, '-');
                                        $filename = substr($filename, 0, 50);
                                        ?>
                                        <a href="../../blogs/sunsari/<?php echo $filename; ?>.php" 
                                           target="_blank"
                                           class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm font-bold transition"
                                           title="View">
                                            <span class="material-symbols-outlined text-sm">visibility</span>
                                        </a>
                                        <a href="edit.php?id=<?php echo htmlspecialchars($post['id']); ?>" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm font-bold transition"
                                           title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </a>
                                        <a href="?action=delete&id=<?php echo htmlspecialchars($post['id']); ?>" 
                                           onclick="return confirm('Are you sure you want to delete this article? This action cannot be undone.')"
                                           class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-bold transition"
                                           title="Delete">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                No articles found. <a href="index.php" class="text-blue-600 font-bold hover:underline">Create your first article</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-6 text-sm text-gray-600">
            <p><strong>Total Articles:</strong> <?php echo count($blogData); ?></p>
        </div>
    </div>
</body>
</html>
