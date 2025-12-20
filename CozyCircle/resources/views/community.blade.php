@extends('layouts.app')

@section('content')
<div class="community-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>CozyCircle Community</h1>
            <p>Connect, Share, and Grow Together</p>
            <div class="mt-4">
                <span class="bg-jive-yellow border border-black px-4 py-1 rounded-full text-sm font-bold shadow-[2px_2px_0px_rgba(0,0,0,1)]">Community Space</span>
            </div>
        </div>
    </div>

    <!-- Main Community Content -->
    <div class="community-main">
        <div class="container">
            <!-- Community Stats -->
            <div class="community-stats">
                <div class="stat-card">
                    <div class="stat-number">{{ $totalMembers ?? 0 }}</div>
                    <div class="stat-label">Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $totalPosts ?? 0 }}</div>
                    <div class="stat-label">Posts</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $totalCategories ?? 0 }}</div>
                    <div class="stat-label">Categories</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $activeUsers ?? 0 }}</div>
                    <div class="stat-label">Active Users</div>
                </div>
            </div>

            <!-- Community Grid -->
            <div class="community-grid">
                <!-- Left Sidebar -->
                <aside class="community-sidebar">
                    <!-- Categories -->
                    <div class="sidebar-section">
                        <h2>Categories</h2>
                        <ul class="category-list">
                            @forelse($categories ?? [] as $category)
                                <li>
                                    <a href="{{ url('/forum') }}?category={{ $category->id }}" class="category-link">
                                        <span class="category-icon">📁</span>
                                        <span class="category-name">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <a href="#" class="category-link">
                                        <span class="category-icon">�</span>
                                        <span class="category-name">Movies</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="category-link">
                                        <span class="category-icon">🏀</span>
                                        <span class="category-name">Sports</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="category-link">
                                        <span class="category-icon">🍰</span>
                                        <span class="category-name">Baking</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="category-link">
                                        <span class="category-icon">🎨</span>
                                        <span class="category-name">Painting</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="category-link">
                                        <span class="category-icon">⚽</span>
                                        <span class="category-name">Sports & Games</span>
                                    </a>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Quick Actions -->
                    <div class="sidebar-section">
                        <h2>Quick Actions</h2>
                        @auth
                            <button class="btn btn-primary btn-block" onclick="window.location.href='{{ route('forum') }}?compose=1'">Start a Discussion</button>
                            <button class="btn btn-secondary btn-block" onclick="window.location.href='{{ route('forum') }}'">Browse Posts</button>
                        @else
                            <button class="btn btn-primary btn-block" onclick="window.location.href='{{ route('login') }}'">
                                Sign In to Participate
                            </button>
                        @endauth
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="community-content">
                    <!-- Welcome Section -->
                    <section class="welcome-section">
                        <h2>Welcome to Our Community</h2>
                        <p>
                            CozyCircle is a warm and welcoming community for people who share a passion for hobbies, creativity, 
                            and meaningful connections. Whether you're interested in baking, reading, movies, sports, or painting, 
                            you'll find a place to belong here.
                        </p>
                    </section>

                    <!-- Featured Posts -->
                    <section class="featured-posts">
                        <h2>Featured Discussions</h2>
                        <div class="posts-container">
                            @forelse($featuredPosts ?? [] as $post)
                                <article data-post-id="{{ $post->id }}" class="post-card post-clickable cursor-pointer">
                                    <div class="post-header">
                                        <h3>{{ $post->title }}</h3>
                                        <span class="post-category">{{ $post->category->name ?? 'General' }}</span>
                                    </div>
                                    <div class="post-body">
                                        {{ Str::limit($post->content, 150) }}
                                    </div>
                                    <div class="post-footer">
                                        <span class="post-author">By {{ $post->user->name ?? 'Anonymous' }}</span>
                                        <span class="post-date">{{ $post->created_at->diffForHumans() ?? 'Recently' }}</span>
                                    </div>
                                    <a href="#" data-post-id="{{ $post->id }}" class="btn btn-small read-more-link">Read More</a>
                                </article>
                            @empty
                                <div class="empty-state">
                                    <p>No discussions yet. Be the first to start one!</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    <!-- Community Guidelines -->
                    <section class="guidelines-section">
                        <h2>Community Guidelines</h2>
                        <div class="guidelines-grid">
                            <div class="guideline-card">
                                <div class="guideline-icon">🤝</div>
                                <h3>Be Respectful</h3>
                                <p>Treat all members with kindness and respect. We celebrate diversity of opinions and backgrounds.</p>
                            </div>
                            <div class="guideline-card">
                                <div class="guideline-icon">💬</div>
                                <h3>Keep It Constructive</h3>
                                <p>Provide helpful feedback and engage in meaningful discussions that add value to the community.</p>
                            </div>
                            <div class="guideline-card">
                                <div class="guideline-icon">🛡️</div>
                                <h3>Stay Safe</h3>
                                <p>Never share personal information and report any inappropriate behavior to moderators.</p>
                            </div>
                            <div class="guideline-card">
                                <div class="guideline-icon">✨</div>
                                <h3>Have Fun</h3>
                                <p>Enjoy connecting with like-minded people and exploring shared interests in a positive environment.</p>
                            </div>
                        </div>
                    </section>
                </main>

                <!-- Right Sidebar -->
                <aside class="community-sidebar-right">
                    <!-- Online Members -->
                    <div class="sidebar-section">
                        <h2>Active Members</h2>
                        <div class="members-list">
                            @forelse($activeMembers as $member)
                                <div class="member-item">
                                    <div class="member-avatar">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $member->name }}" alt="avatar" style="width: 40px; height: 40px; border-radius: 50%;">
                                    </div>
                                    <div class="member-info">
                                        <p class="member-name">{{ $member->name }}</p>
                                        <span class="online-status">{{ $member->posts->count() + $member->comments->count() }} contribution{{ ($member->posts->count() + $member->comments->count()) !== 1 ? 's' : '' }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No active members yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Community News -->
                    <div class="sidebar-section">
                        <h2>Recent Updates</h2>
                        <div class="news-list">
                            <div class="news-item">
                                <span class="news-date">Today</span>
                                <p>New category added: Photography!</p>
                            </div>
                            <div class="news-item">
                                <span class="news-date">Yesterday</span>
                                <p>Welcome our new moderators to the team.</p>
                            </div>
                            <div class="news-item">
                                <span class="news-date">2 days ago</span>
                                <p>Community event: Monthly cooking challenge starts!</p>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

<style>
    /* Page container */
    .community-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #D4C4FC 0%, #E8D7FF 100%);
        padding: 40px 0 80px 0;
    }

    /* Hero */
    .hero-section {
        background: linear-gradient(135deg, rgba(212,196,252,0.85) 0%, rgba(232,215,255,0.85) 100%);
        border-bottom: 3px solid #000;
        color: #1a1a1a;
        padding: 48px 20px;
        text-align: center;
        position: relative;
        box-shadow: 4px 4px 0 rgba(0,0,0,0.1);
        border-radius: 12px;
        margin: 8px 20px;
    }

    .hero-content h1 {
        font-size: 2.5rem;
        font-weight: 900;
        letter-spacing: -1px;
        margin-bottom: 6px;
    }

    .hero-content p {
        font-size: 1.125rem;
        opacity: 0.9;
        font-weight: 600;
        color: #333;
    }

    /* Responsive tweaks */
    @media (max-width: 640px) {
        .hero-section { padding: 36px 14px; margin: 0 8px; }
        .hero-content h1 { font-size: 1.75rem; }
        .community-grid { gap: 18px; }
        .stat-number { font-size: 1.5rem; }
    }

    @media (max-width: 480px) {
        .hero-content p { font-size: 1rem; }
        .sidebar-section { padding: 16px; }
        .post-card { padding: 14px; }
    }

    /* Layout */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .community-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 28px 0;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 4px 4px 0 rgba(0,0,0,0.15);
        border: 2px solid #000;
        transition: transform 0.18s ease, box-shadow 0.18s ease;
    }

    .stat-card:hover { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 rgba(0,0,0,0.2); }

    .stat-number { font-size: 2rem; font-weight: 900; color: #7c3aed; }

    .stat-label { color: #666; margin-top: 8px; }

    .community-grid {
        display: grid;
        grid-template-columns: 250px 1fr 300px;
        gap: 30px;
        margin: 32px 0;
    }

    @media (max-width: 1024px) {
        .community-grid { grid-template-columns: 1fr; }
        .community-sidebar-right { order: 3; }
        .community-sidebar { order: 2; }
    }

    /* Sidebars */
    .sidebar-section {
        background: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 4px 4px 0 rgba(0,0,0,0.15);
        border: 2px solid #000;
    }

    .sidebar-section h2 { font-size: 1.15rem; margin-bottom: 12px; color: #1a1a1a; font-weight: 900; }

    .category-list { list-style: none; padding: 0; margin: 0; }

    .category-link { display:flex; align-items:center; padding:8px 0; color: #7c3aed; text-decoration: none; transition: all 0.18s ease; font-weight: 500; }
    .category-link:hover { padding-left: 8px; color: #6d28d9; font-weight: 600; }
    .category-icon { margin-right: 10px; font-size: 1.2rem; }

    /* Buttons */
    .btn { padding: 10px 20px; border: 2px solid #000; border-radius: 8px; cursor: pointer; font-size: 1rem; transition: all 0.18s ease; font-weight: 700; box-shadow: 2px 2px 0 rgba(0,0,0,0.2); }
    .btn:hover { transform: translate(-2px,-2px); box-shadow: 4px 4px 0 rgba(0,0,0,0.3); }
    .btn-primary { background: #7c3aed; color: white; }
    .btn-primary:hover { background: #6d28d9; }
    .btn-secondary { background: #FDF5A5; color: #1a1a1a; }
    .btn-secondary:hover { background: #fef08a; }
    .btn-small { padding: 8px 16px; font-size: 0.9rem; }
    .btn-block { width: 100%; display:block; }

    /* Content */
    .welcome-section { background: white; padding: 30px; border-radius: 12px; margin-bottom: 32px; box-shadow: 4px 4px 0 rgba(0,0,0,0.15); border: 2px solid #000; }
    .welcome-section h2 { font-weight: 900; color: #1a1a1a; margin-bottom: 10px; }
    .welcome-section p { color: #4b5563; line-height: 1.6; }

    .featured-posts h2 { font-weight: 900; color: #1a1a1a; margin-bottom: 12px; }
    .posts-container { display: grid; gap: 18px; }

    .post-card { background: white; padding: 18px; border-radius: 12px; box-shadow: 4px 4px 0 rgba(0,0,0,0.15); border: 2px solid #000; transition: transform 0.18s ease; }
    .post-card:hover { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 rgba(0,0,0,0.2); }

    .post-header { display:flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
    .post-header h3 { margin: 0; font-weight: 700; color: #1a1a1a; }
    .post-category { background: #FDF5A5; color: #1a1a1a; padding: 4px 12px; border-radius: 20px; border: 1px solid #000; font-size: 0.85rem; white-space: nowrap; font-weight: 600; }

    .post-body { color: #4b5563; margin-bottom: 12px; line-height: 1.6; }
.post-footer { display:flex; justify-content: space-between; color: #777; font-size: 0.9rem; margin-bottom: 12px; }

    /* Guidelines */
    .guidelines-section h2 { font-weight: 900; color: #1a1a1a; margin-bottom: 12px; }
    .guidelines-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap: 18px; }
    .guideline-card { background: white; padding: 20px; border-radius: 12px; text-align:center; box-shadow: 4px 4px 0 rgba(0,0,0,0.15); border: 2px solid #000; transition: transform 0.18s ease; }
    .guideline-card:hover { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 rgba(0,0,0,0.2); }
    .guideline-icon { font-size: 2.2rem; margin-bottom: 10px; }
    .guideline-card h3 { font-weight: 900; color: #1a1a1a; margin-bottom: 8px; }
    .guideline-card p { color: #4b5563; }

    /* Members */
    .members-list { display:flex; flex-direction: column; gap: 10px; }
    .member-item { display:flex; align-items:center; }
    .member-avatar { width:40px; height:40px; background: #7c3aed; color: white; border-radius: 50%; display:flex; align-items:center; justify-content:center; font-weight: bold; margin-right: 10px; border:2px solid #000; }
    .member-name { margin: 0; color: #1a1a1a; font-size: 0.95rem; font-weight: 600; }
    .online-status { background: #86efac; color: #1a1a1a; padding: 2px 8px; border-radius: 3px; font-size: 0.75rem; font-weight:600; border:1px solid #000; }

    /* News */
    .news-list { display:flex; flex-direction:column; gap:10px; }
    .news-item { padding: 12px 0; border-bottom: 1px solid #e0e0e0; }
    .news-date { color: #777; font-size: 0.85rem; margin-bottom: 5px; font-weight: 600; }
    .news-item p { color: #4b5563; margin: 0; font-size: 0.95rem; }

    .empty-state { text-align:center; padding:40px; color: #777; }
    .text-muted { color: #777; }
</style>
</div>
@endsection
