<!-- Key Constituency Issues Section -->
<section>
    <div class="flex items-center gap-3 mb-6">
        <span class="material-symbols-outlined text-primary text-3xl">error</span>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Key Constituency Issues</h2>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
        <!-- Tab Buttons -->
        <div class="flex border-b border-slate-200 dark:border-slate-700">
            <button onclick="switchTab('rural')" id="tab-rural" class="flex-1 py-4 text-sm font-bold border-b-2 border-secondary text-secondary bg-blue-50/50 dark:bg-blue-900/10 transition-all">
                Rural
            </button>
            <button onclick="switchTab('urban')" id="tab-urban" class="flex-1 py-4 text-sm font-bold border-b-2 border-transparent text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-all">
                Urban
            </button>
            <button onclick="switchTab('youth')" id="tab-youth" class="flex-1 py-4 text-sm font-bold border-b-2 border-transparent text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-all">
                Youth
            </button>
            <button onclick="switchTab('women')" id="tab-women" class="flex-1 py-4 text-sm font-bold border-b-2 border-transparent text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-all">
                Women
            </button>
        </div>
        
        <!-- Tab Content -->
        <div class="p-6">
            <?php if (!empty($index_data['key_issues']) && is_array($index_data['key_issues'])): ?>
                <!-- Rural Issues -->
                <div id="content-rural" class="tab-content">
                    <div class="space-y-6">
                        <?php if (!empty($index_data['key_issues']['rural'])): ?>
                            <?php foreach ($index_data['key_issues']['rural'] as $issue): ?>
                                <div class="bg-slate-50 dark:bg-slate-900/50 p-4 rounded-lg border border-slate-200 dark:border-slate-700">
                                    <div class="flex items-start gap-4 mb-3">
                                        <div class="<?php echo htmlspecialchars($issue['icon_bg_color']); ?> text-primary p-2 rounded-full flex-shrink-0">
                                            <span class="material-symbols-outlined text-lg">
                                                <?php echo htmlspecialchars($issue['icon']); ?>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <p class="font-bold text-slate-800 dark:text-white">
                                                    <?php echo htmlspecialchars($issue['title']); ?>
                                                </p>
                                                <span class="text-sm font-bold <?php echo $issue['severity'] >= 80 ? 'text-red-600' : ($issue['severity'] >= 60 ? 'text-orange-600' : 'text-yellow-600'); ?>">
                                                    <?php echo $issue['severity']; ?>% Critical
                                                </span>
                                            </div>
                                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">
                                                <?php echo htmlspecialchars($issue['description']); ?>
                                            </p>
                                            <!-- Progress Bar -->
                                            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                                <div class="h-2.5 rounded-full transition-all <?php echo $issue['severity'] >= 80 ? 'bg-red-600' : ($issue['severity'] >= 60 ? 'bg-orange-500' : 'bg-yellow-500'); ?>" 
                                                     style="width: <?php echo $issue['severity']; ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Urban Issues -->
                <div id="content-urban" class="tab-content hidden">
                    <div class="space-y-6">
                        <?php if (!empty($index_data['key_issues']['urban'])): ?>
                            <?php foreach ($index_data['key_issues']['urban'] as $issue): ?>
                                <div class="bg-slate-50 dark:bg-slate-900/50 p-4 rounded-lg border border-slate-200 dark:border-slate-700">
                                    <div class="flex items-start gap-4 mb-3">
                                        <div class="<?php echo htmlspecialchars($issue['icon_bg_color']); ?> text-primary p-2 rounded-full flex-shrink-0">
                                            <span class="material-symbols-outlined text-lg">
                                                <?php echo htmlspecialchars($issue['icon']); ?>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <p class="font-bold text-slate-800 dark:text-white">
                                                    <?php echo htmlspecialchars($issue['title']); ?>
                                                </p>
                                                <span class="text-sm font-bold <?php echo $issue['severity'] >= 80 ? 'text-red-600' : ($issue['severity'] >= 60 ? 'text-orange-600' : 'text-yellow-600'); ?>">
                                                    <?php echo $issue['severity']; ?>% Critical
                                                </span>
                                            </div>
                                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">
                                                <?php echo htmlspecialchars($issue['description']); ?>
                                            </p>
                                            <!-- Progress Bar -->
                                            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                                <div class="h-2.5 rounded-full transition-all <?php echo $issue['severity'] >= 80 ? 'bg-red-600' : ($issue['severity'] >= 60 ? 'bg-orange-500' : 'bg-yellow-500'); ?>" 
                                                     style="width: <?php echo $issue['severity']; ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Youth Issues -->
                <div id="content-youth" class="tab-content hidden">
                    <div class="space-y-6">
                        <?php if (!empty($index_data['key_issues']['youth'])): ?>
                            <?php foreach ($index_data['key_issues']['youth'] as $issue): ?>
                                <div class="bg-slate-50 dark:bg-slate-900/50 p-4 rounded-lg border border-slate-200 dark:border-slate-700">
                                    <div class="flex items-start gap-4 mb-3">
                                        <div class="<?php echo htmlspecialchars($issue['icon_bg_color']); ?> text-primary p-2 rounded-full flex-shrink-0">
                                            <span class="material-symbols-outlined text-lg">
                                                <?php echo htmlspecialchars($issue['icon']); ?>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <p class="font-bold text-slate-800 dark:text-white">
                                                    <?php echo htmlspecialchars($issue['title']); ?>
                                                </p>
                                                <span class="text-sm font-bold <?php echo $issue['severity'] >= 80 ? 'text-red-600' : ($issue['severity'] >= 60 ? 'text-orange-600' : 'text-yellow-600'); ?>">
                                                    <?php echo $issue['severity']; ?>% Critical
                                                </span>
                                            </div>
                                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">
                                                <?php echo htmlspecialchars($issue['description']); ?>
                                            </p>
                                            <!-- Progress Bar -->
                                            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                                <div class="h-2.5 rounded-full transition-all <?php echo $issue['severity'] >= 80 ? 'bg-red-600' : ($issue['severity'] >= 60 ? 'bg-orange-500' : 'bg-yellow-500'); ?>" 
                                                     style="width: <?php echo $issue['severity']; ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Women Issues -->
                <div id="content-women" class="tab-content hidden">
                    <div class="space-y-6">
                        <?php if (!empty($index_data['key_issues']['women'])): ?>
                            <?php foreach ($index_data['key_issues']['women'] as $issue): ?>
                                <div class="bg-slate-50 dark:bg-slate-900/50 p-4 rounded-lg border border-slate-200 dark:border-slate-700">
                                    <div class="flex items-start gap-4 mb-3">
                                        <div class="<?php echo htmlspecialchars($issue['icon_bg_color']); ?> text-primary p-2 rounded-full flex-shrink-0">
                                            <span class="material-symbols-outlined text-lg">
                                                <?php echo htmlspecialchars($issue['icon']); ?>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <p class="font-bold text-slate-800 dark:text-white">
                                                    <?php echo htmlspecialchars($issue['title']); ?>
                                                </p>
                                                <span class="text-sm font-bold <?php echo $issue['severity'] >= 80 ? 'text-red-600' : ($issue['severity'] >= 60 ? 'text-orange-600' : 'text-yellow-600'); ?>">
                                                    <?php echo $issue['severity']; ?>% Critical
                                                </span>
                                            </div>
                                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">
                                                <?php echo htmlspecialchars($issue['description']); ?>
                                            </p>
                                            <!-- Progress Bar -->
                                            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                                <div class="h-2.5 rounded-full transition-all <?php echo $issue['severity'] >= 80 ? 'bg-red-600' : ($issue['severity'] >= 60 ? 'bg-orange-500' : 'bg-yellow-500'); ?>" 
                                                     style="width: <?php echo $issue['severity']; ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-8 text-slate-500">
                    <p>No issues data available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    function switchTab(tabName) {
        // Hide all tab contents
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(content => {
            content.classList.add('hidden');
        });
        
        // Remove active state from all tabs
        const tabs = document.querySelectorAll('[id^="tab-"]');
        tabs.forEach(tab => {
            tab.classList.remove('border-secondary', 'text-secondary', 'bg-blue-50/50', 'dark:bg-blue-900/10');
            tab.classList.add('border-transparent', 'text-slate-400');
        });
        
        // Show selected tab content
        const selectedContent = document.getElementById('content-' + tabName);
        if (selectedContent) {
            selectedContent.classList.remove('hidden');
        }
        
        // Add active state to selected tab
        const selectedTab = document.getElementById('tab-' + tabName);
        if (selectedTab) {
            selectedTab.classList.add('border-secondary', 'text-secondary', 'bg-blue-50/50', 'dark:bg-blue-900/10');
            selectedTab.classList.remove('border-transparent', 'text-slate-400');
        }
    }
</script>
