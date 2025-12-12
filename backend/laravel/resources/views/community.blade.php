@extends('layouts.app')

@section('content')
<div class="community-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>CozyCircle Community</h1>
            <p>Connect, Share, and Grow Together</p>
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
                                    <a href="#category-{{ $category->id }}" class="category-link">
                                        <span class="category-icon">📁</span>
                                        <span class="category-name">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <a href="#" class="category-link">
                                        <span class="category-icon">🎨</span>
                                        <span class="category-name">Arts & Crafts</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="category-link">
                                        <span class="category-icon">📚</span>
                                        <span class="category-name">Books & Reading</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="category-link">
                                        <span class="category-icon">🍰</span>
                                        <span class="category-name">Baking & Cooking</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="category-link">
                                        <span class="category-icon">🎬</span>
                                        <span class="category-name">Movies & TV</span>
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
                            <button class="btn btn-primary btn-block">Start a Discussion</button>
                            <button class="btn btn-secondary btn-block">Browse Posts</button>
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
                                <article class="post-card">
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
                                    <a href="#post-{{ $post->id }}" class="btn btn-small">Read More</a>
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
                            @forelse($activeMembers ?? [] as $member)
                                <div class="member-item">
                                    <div class="member-avatar">
                                        <span>{{ substr($member->name, 0, 1) }}</span>
                                    </div>
                                    <div class="member-info">
                                        <p class="member-name">{{ $member->name }}</p>
                                        <span class="online-status">Online</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">Loading members...</p>
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
    .community-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #D4C4FC 0%, #E8D7FF 100%);
        padding-bottom: 40px;
    }

    .hero-section {
        background: linear-gradient(135deg, rgba(212, 196, 252, 0.8) 0%, rgba(232, 215, 255, 0.8) 100%);
        border-b: 3px solid #000;
        color: #1a1a1a;
        padding: 60px 20px;
        text-align: center;
        position: relative;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
    }
    font-weight: 900;
        letter-spacing: -1px;
    }

    .hero-content p {
        font-size: 1.2rem;
        opacity: 0.8;
        font-weight: 600

    .hero-content p {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .community-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 40px 0;
    }

    .stat-card {12px;
        text-align: center;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.15);
        border: 2px solid #000;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 900;
        color: #7c3aed
        font-size: 2rem;
        font-weight: bold;
        color: #667eea;
    }

    .stat-label {
        color: #666;
        margin-top: 10px;
    }

    .community-grid {
        display: grid;
        grid-template-columns: 250px 1fr 300px;
        gap: 30px;
        margin: 40px 0;
    }

    @media (max-width: 1024px) {
        .community-grid {
            grid-template-columns: 1fr;
        }

        .community-sidebar-right {
            order: 3;12px;
        margin-bottom: 20px;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.15);
        border: 2px solid #000;
    }

    .sidebar-section h2 {
        font-size: 1.2rem;
        margin-bottom: 15px;
        color: #1a1a1a;
        font-weight: 900om: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .sidebar-section h2 {
        font-size: 1.2rem;
        margin-bottom: 15px;
        color: #333;
    }

    .category-li7c3aed;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .category-link:hover {
        padding-left: 10px;
        color: #6d28d9;
        font-weight: 600enter;
        padding: 10px 0;
        color: #667eea;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .category-link:hover {
        padding-left: 10px;
        color: #764ba2;
    }

    .category-icon {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    .btn-block {
        width: 100%;
        margin-bottom: 10px;
    }2px solid #000;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-weight: 600;
        box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
    }

    .btn:hover {
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.3);
    }

    .btn-primary {
        background: #7c3aed;
        color: white;
    }

    .btn-primary:hover {
        background: #6d28d9;
    }

    .btn-secondary {
        background: #FDF5A5;
        color: #1a1a1a;
    }

    .btn-secondary:hover {
        background: #fef08a
    }

    .btn-secondary:hover {
        background: #e0e0e0;
    }
12px;
        margin-bottom: 40px;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.15);
        border: 2px solid #000;
    }

    .welcome-section h2 {
        margin-bottom: 15px;
        color: #1a1a1a;
        font-weight: 900;
    }

    .welcome-section p {
        color: #4b5563 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .welcome-section h2 {
        margin-bottom: 15px;
        color: #333;
    }

    .welcome-section p {
        color: #666;
        line-hei1a1a1a;
        font-weight: 900: 1.6;
    }

    .featured-posts {
        margin-bottom: 40px;
    }

    .featured-posts h2 {
        margin-bottom: 20px;
        color: #333;
    }12px;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.15);
        border: 2px solid #000;
        transition: all 0.3s ease;
    }

    .post-card:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2
    .post-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .post-card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-b1a1a1a;
        flex: 1;
        font-weight: 700;
    }

    .post-category {
        background: #FDF5A5;
        color: #1a1a1a;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid #000;
        font-size: 0.85rem;
        white-space: nowrap;
        margin-left: 10px;
        font-weight: 600
        padding: 4px 12px;
        border-radius: 20px;
        font-siz4b5563;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .post-footer {
        display: flex;
        justify-content: space-between;
        color: #777: 1.6;
    }

    .post-footer {
        display: flex;
        justify-content: space-between;
        color: #999;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .guidelines-1a1a1a;
        font-weight: 900tion {
        margin-bottom: 40px;
    }

    .guidelines-section h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .guidelines-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;12px;
        text-align: center;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.15);
        border: 2px solid #000;
        transition: transform 0.3s ease;
    }

    .guideline-card:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
    }

    .guideline-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    .guideline-card h3 {
        color: #1a1a1a;
        margin-bottom: 10px;
        font-weight: 900;
    }

    .guideline-card p {
        color: #4b5563 h3 {
        color: #333;
        margin-bottom: 10px;
    }

    .guideline-card p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .members-list {
        display: flex7c3aed;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 10px;
        border: 2px solid #000;
    }

    .member-info {
        flex: 1;
    }

    .member-name {
        margin: 0;
        color: #1a1a1a;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .online-status {
        display: inline-block;
        background: #86efac;
        color: #1a1a1a;
        padding: 2px 8px;
        border-radius: 3px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid #000
    .member-name {
        margin: 0;
        color: #333;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .online-status {
        display: inline-block;
        background: #4caf50;0e0e0;
    }

    .news-item:last-child {
        border-bottom: none;
    }

    .news-date {
        display: block;
        color: #777;
        font-size: 0.85rem;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .news-item p {
        color: #4b5563;
        margin: 0;
        font-size: 0.95rem;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #777;
    }

    .text-muted {
        color: #777

    .news-item p {
        color: #666;
        margin: 0;
        font-size: 0.95rem;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #999;
    }

    .text-muted {
        color: #777;
    }
</style>
</div>
@endsection
