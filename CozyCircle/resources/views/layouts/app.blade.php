<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CozyCircle')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'jive-purple': '#D4C4FC',
                        'jive-yellow': '#FDF5A5',
                    }
                }
            }
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #333;
            background: linear-gradient(135deg, #D4C4FC 0%, #E8D7FF 100%);
            min-height: 100vh;
        }
    </style>
    @stack('styles')
</head>
</script>
<body class="bg-jive-purple min-h-screen relative font-sans flex flex-col">
    <div class="absolute inset-0 pointer-events-none flex items-center justify-center opacity-30">
        <div class="border border-gray-500 rounded-full w-[400px] h-[400px] absolute"></div>
        <div class="border border-gray-500 rounded-full w-[700px] h-[700px] absolute"></div>
        <div class="border border-gray-500 rounded-full w-[1100px] h-[1100px] absolute"></div>
    </div>

    <div class="absolute top-20 left-20 bg-white p-2 rounded-full shadow-sm hidden md:block">
        <span>❤️</span>
    </div>
    <div class="absolute bottom-20 right-20 bg-white p-2 rounded-full shadow-sm hidden md:block">
        <span>🎸</span>
    </div>

    @include('components.navbar')
    <div class="h-16"></div>

    <div class="flex-1 flex flex-col">
        <main class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-1">
            @yield('content')
        </main>

        @unless(request()->routeIs('login','signup','register'))
            @include('components.footer')
        @endunless
    </div>

    @unless(request()->routeIs('login','signup','register'))
        <!-- Post Modal -->
        <div id="postModal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black bg-opacity-60" onclick="closePostModal()"></div>
        <div class="relative bg-white w-full max-w-3xl rounded-2xl shadow-xl z-10 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 id="postModalTitle" class="text-2xl font-bold">Post Title</h2>
                        <div class="text-sm text-gray-600" id="postModalMeta">By <span id="postModalAuthor"></span> • <span id="postModalTime">just now</span></div>
                    </div>
                    <div>
                        <button onclick="closePostModal()" class="text-gray-500">Close</button>
                    </div>
                </div>

                <div class="mt-4 text-gray-800" id="postModalContent">Loading...</div>

                <div class="mt-6">
                    <h3 class="font-semibold mb-2">Comments</h3>
                    <div id="postModalComments" class="space-y-3 max-h-64 overflow-auto p-2 border rounded"></div>
                </div>

                <div class="mt-4" id="postModalCommentFormContainer">
                    @auth
                    <form id="postModalCommentForm" class="flex items-start gap-3">
                        <textarea id="postModalComment" rows="3" class="flex-1 px-3 py-2 border rounded" placeholder="Add a comment..."></textarea>
                        <button type="submit" class="px-4 py-2 rounded bg-jive-purple text-white border-2 border-black font-semibold">Comment</button>
                    </form>
                    @else
                    <div class="text-sm text-gray-600">Please <a href="{{ route('login') }}" class="underline">sign in</a> to comment.</div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function closePostModal() {
            document.getElementById('postModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function openPostModal(id) {
            fetch(`/posts/${id}/json`)
                .then(res => res.json())
                .then(post => {
                    document.getElementById('postModalTitle').textContent = post.title || 'Untitled';
                    document.getElementById('postModalContent').textContent = post.content || '';

                    // Author with avatar and clickable name
                    const authorHtml = post.user && post.user.id ?
                        `<a href="#" class="user-link inline-flex items-center gap-2" data-user-id="${post.user.id}"><img src="${post.user.avatar || ''}" class="w-8 h-8 rounded-full" alt="avatar"> <span class="font-semibold">${post.user.name}</span></a>` :
                        (post.user ? `${post.user.name}` : 'Guest');
                    document.getElementById('postModalAuthor').innerHTML = authorHtml;
                    document.getElementById('postModalTime').textContent = post.created_at || '';

                    const commentsEl = document.getElementById('postModalComments');
                    commentsEl.innerHTML = '';
                    post.comments.forEach(c => {
                        const div = document.createElement('div');
                        div.className = 'p-2 border rounded flex items-start gap-3';

                        const avatar = c.user && c.user.avatar ? `<img src="${c.user.avatar}" class="w-8 h-8 rounded-full" alt="avatar">` : `<div class="w-8 h-8 rounded-full bg-gray-200"></div>`;
                        const userName = c.user && c.user.id ? `<a href="#" class="user-link font-semibold" data-user-id="${c.user.id}">${c.user.name}</a>` : (c.user ? c.user.name : 'Guest');

                        div.innerHTML = `${avatar}<div><div class="text-sm">${userName} <span class="text-xs text-gray-500">• ${c.created_at}</span></div><div class="mt-1 text-gray-700">${c.content}</div></div>`;
                        commentsEl.appendChild(div);
                    });

                    // store post id on form
                    const form = document.getElementById('postModalCommentForm');
                    if (form) {
                        form.dataset.postId = post.id;
                    }

                    document.getElementById('postModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });
        }

        // Delegate click on post elements
        document.addEventListener('click', function(e) {
            // Open modal when clicking elements with data-post-id
            const postEl = e.target.closest('[data-post-id]');
            if (postEl) {
                // prevent opening when clicking inside a form or button
                if (e.target.closest('form') || e.target.closest('button') || e.target.tagName === 'A') return;
                const id = postEl.getAttribute('data-post-id');
                if (id) {
                    openPostModal(id);
                }
            }

            // read more links
            if (e.target.matches('.read-more-link')) {
                e.preventDefault();
                const id = e.target.getAttribute('data-post-id');
                if (id) openPostModal(id);
            }
        });

        // Comment form submit via AJAX
        document.addEventListener('submit', function(e) {
            if (e.target && e.target.id === 'postModalCommentForm') {
                e.preventDefault();
                const form = e.target;
                const postId = form.dataset.postId;
                const content = document.getElementById('postModalComment').value.trim();
                if (!content) return;

                fetch(`/posts/${postId}/comments`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ content })
                }).then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                }).then(comment => {
                    const commentsEl = document.getElementById('postModalComments');
                    const div = document.createElement('div');
                    div.className = 'p-2 border rounded';
                    div.innerHTML = `<div class="text-sm font-semibold">${comment.user.name} <span class="text-xs text-gray-500">• ${comment.created_at}</span></div><div class="mt-1 text-gray-700">${comment.content}</div>`;
                    commentsEl.appendChild(div);
                    document.getElementById('postModalComment').value = '';
                }).catch(() => {
                    // On failure, redirect to login (if not authenticated) or reload
                    window.location.href = '{{ route('login') }}';
                });
            }
        });

        // Close modal on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closePostModal();
        });
    </script>
    @endunless

    @include('components.user-modal')

    @stack('scripts')
</body>
</html>