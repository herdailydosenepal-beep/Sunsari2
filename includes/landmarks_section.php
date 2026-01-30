<!-- Landmarks in Sunsari-2 Section -->
<section  class="my-19">
    <div class="flex items-center gap-3 mb-6">
        <span class="material-symbols-outlined text-primary text-3xl">synagogue</span>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Landmarks in Sunsari-2</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php if (!empty($index_data['landmarks']) && is_array($index_data['landmarks'])): ?>
            <?php foreach ($index_data['landmarks'] as $landmark): ?>
                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-slate-200 dark:border-slate-700 flex gap-4 hover:shadow-md transition-shadow">
                    <div class="w-16 h-16 rounded-lg bg-slate-100 dark:bg-slate-700 flex-shrink-0 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-3xl">
                            <?php echo htmlspecialchars($landmark['icon']); ?>
                        </span>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-slate-800 dark:text-white mb-1">
                            <?php echo htmlspecialchars($landmark['name']); ?>
                        </h3>
                        <p class="text-xs text-slate-500 mb-2">
                            <?php echo htmlspecialchars($landmark['location']); ?>
                        </p>
                        <span class="text-xs bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded font-medium text-slate-600 dark:text-slate-300">
                            <?php echo htmlspecialchars($landmark['type']); ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-3 text-center py-8 text-slate-500">
                <p>No landmarks data available.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
