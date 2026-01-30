<!-- Search Section -->
<section class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 md:p-12 shadow-lg">
    <div class="max-w-4xl mx-auto text-center">
        <div class="flex items-center justify-center gap-3 mb-4">
            <span class="material-symbols-outlined text-white text-4xl">search</span>
            <h2 class="text-3xl font-bold text-white">Search Constituency Information</h2>
        </div>
        <p class="text-white/90 mb-8 text-lg">
            Find articles, landmarks, issues, and more about Sunsari-2 constituency
        </p>
        
        <form action="blogs/index.php" method="GET" class="bg-white rounded-xl p-2 flex flex-col md:flex-row gap-2 shadow-xl">
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search for articles, news, updates..." 
                    class="w-full pl-12 pr-4 py-4 rounded-lg border-0 focus:outline-none focus:ring-2 focus:ring-primary text-slate-800 placeholder:text-slate-400"
                />
            </div>
            <button 
                type="submit" 
                class="bg-primary hover:bg-primary/90 text-white font-bold px-8 py-4 rounded-lg transition-all flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                <span class="material-symbols-outlined">search</span>
                <span>Search</span>
            </button>
        </form>
        
        <!-- Quick Search Tags -->
        <div class="mt-6 flex flex-wrap items-center justify-center gap-2">
            <span class="text-white/70 text-sm">Popular:</span>
            <a href="blogs/index.php?category=Development" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-full text-sm font-medium transition-all">
                Development
            </a>
            <a href="blogs/index.php?category=Agriculture" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-full text-sm font-medium transition-all">
                Agriculture
            </a>
            <a href="blogs/index.php?category=Politics" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-full text-sm font-medium transition-all">
                Politics
            </a>
            <a href="blogs/index.php?category=Education" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-full text-sm font-medium transition-all">
                Education
            </a>
        </div>
    </div>
</section>
