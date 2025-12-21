<!-- User modal (reusable) -->
<div id="userModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-black flex items-center justify-center" id="userModalAvatarContainer">
                    <img id="userModalAvatar" src="" alt="avatar" class="w-full h-full object-cover">
                </div>
                <div>
                    <h2 id="userModalName" class="text-xl font-bold">User</h2>
                    <p id="userModalPosts" class="text-sm text-gray-500">0 posts</p>
                </div>
            </div>
            <button type="button" onclick="closeUserModal()" class="text-gray-500">Close</button>
        </div>

        <div class="mb-4">
            <h3 class="font-bold mb-2">Hobbies</h3>
            <div id="userModalHobbies" class="flex flex-wrap gap-2">
                <!-- hobbies will be populated here -->
            </div>
        </div>

        <div class="flex justify-end gap-3">
            @auth
                @if(auth()->user()->is_admin)
                    <form method="POST" id="userModalBanForm" action="#" onsubmit="return confirm(document.getElementById('userModalBanButton').textContent.trim().startsWith('Unban') ? 'Unban this user?' : 'Ban this user?');">
                        @csrf
                        <button type="submit" id="userModalBanButton" class="px-4 py-2 rounded-full font-bold border-2 bg-red-100 text-red-800 border-red-300">Ban User</button>
                    </form>
                @endif
            @endauth
            <button type="button" onclick="closeUserModal()" class="px-4 py-2 rounded-lg border border-black">Close</button>
        </div>
    </div>
</div>

<script>
    function openUserModal() {
        document.getElementById('userModal').classList.remove('hidden');
    }
    function closeUserModal() {
        document.getElementById('userModal').classList.add('hidden');
    }

    document.addEventListener('click', function(e) {
        const link = e.target.closest('.user-link');
        if (!link) return;
        e.preventDefault();
        const userId = link.dataset.userId;
        if (!userId) return;

        fetch(`/users/${userId}/json`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('userModalAvatar').src = data.avatar || '';
                document.getElementById('userModalName').textContent = data.username || 'User';
                document.getElementById('userModalPosts').textContent = (data.posts_count || 0) + ' posts';

                const hobbiesEl = document.getElementById('userModalHobbies');
                hobbiesEl.innerHTML = '';
                (data.hobbies || []).forEach(function(h) {
                    const span = document.createElement('span');
                    span.className = 'px-3 py-1 bg-white border border-black rounded-lg text-xs font-bold shadow-[2px_2px_0px_rgba(0,0,0,1)]';
                    span.textContent = h;
                    hobbiesEl.appendChild(span);
                });

                // Update ban form action + button text
                const banForm = document.getElementById('userModalBanForm');
                const banButton = document.getElementById('userModalBanButton');
                if (banForm && banButton) {
                    banForm.action = `/users/${userId}/ban`;
                    banButton.textContent = data.is_banned ? 'Unban User' : 'Ban User';
                    if (data.is_banned) {
                        banButton.classList.remove('bg-red-100','text-red-800');
                        banButton.classList.add('bg-green-100','text-green-800','border-green-300');
                    } else {
                        banButton.classList.add('bg-red-100','text-red-800');
                        banButton.classList.remove('bg-green-100','text-green-800','border-green-300');
                    }
                }

                openUserModal();
            }).catch(err => {
                console.error(err);
            });
    });
</script>