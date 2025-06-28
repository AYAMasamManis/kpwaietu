{{-- resources/views/partials/comment.blade.php --}}
<div class="comment-item" style="
    background-color: {{ $level % 2 == 0 ? '#fff' : '#f9f9f9' }};
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    margin-left: {{ $level * 20 }}px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
">
    <p>
        <strong>{{ $comment->user->name }}</strong>
        <span style="font-size: 0.8em; color: #777;">pada {{ $comment->created_at->format('d M Y H:i') }}</span>
    </p>
    <p>
        @if ($comment->trashed())
            <em style="color: #999;">Pesan ini sudah dihapus.</em>
        @else
            <?php
                $content = $comment->content;
                $content = preg_replace(
                    '/(https?:\/\/[^\s]+)/',
                    '<a href="$1" target="_blank" style="color: #C7A2A2; text-decoration: underline;">$1</a>',
                    $content
                );
            ?>
            {!! $content !!}
        @endif
    </p>

    @if ($comment->gambar && !$comment->trashed())
        <div class="comment-image mt-2">
            <img src="{{ asset('storage/komentar_gambar/' . $comment->gambar) }}" alt="Gambar Komentar" class="w-full h-auto rounded-lg mb-2 shadow-md border border-gray-200" style="max-width: 400px; display: block; margin-left: auto; margin-right: auto;" /> {{-- Styling gambar di komentar --}}
        </div>
    @endif

    <div class="comment-actions flex items-center mt-2">
        @auth
            {{-- Tombol Like --}}
            <form action="{{ route('forum.toggleLike', $comment) }}" method="POST" class="inline-block mr-2">
                @csrf
                <button type="submit" class="bg-transparent border-none text-red-500 cursor-pointer text-base">
                    ❤ <span class="text-gray-700 text-sm">{{ $comment->likes->count() }}</span>
                </button>
            </form>

            {{-- Tombol Balas --}}
            <a href="#" onclick="showReplyForm({{ $comment->id }})" class="text-blue-600 hover:underline text-sm mr-2">Balas</a>

            {{-- Tombol Hapus (Hanya Tampilkan jika user adalah pemilik komentar atau admin) --}}
            @if(Auth::id() == $comment->user_id || (Auth::user() && Auth::user()->role === 'admin'))
                <form action="{{ route('forum.destroy', $comment) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                </form>
            @endif

            {{-- Form Balasan (tersembunyi secara default) --}}
            <div id="reply-form-{{ $comment->id }}" style="display: none; margin-top: 15px; padding-left: 20px; border-left: 2px solid #ccc;">
                <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <textarea name="content" rows="2" placeholder="Balas komentar {{ $comment->user->name }}..." class="w-full border rounded px-4 py-2 mb-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 focus:ring-1" required></textarea>
                    <label for="reply_gambar_{{ $comment->id }}" class="block text-sm font-medium text-gray-700 mb-1">Unggah Gambar (Opsional):</label>
                    <input type="file" name="gambar" id="reply_gambar_{{ $comment->id }}" class="w-full border rounded px-4 py-2 mb-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 focus:ring-1">
                    @error('gambar')
                        <p style="color: red; font-size: 0.8em;">{{ $errors->first('gambar') }}</p> {{-- <<< UBAH KE $errors->first('gambar') --}}
                    @enderror
                    <button type="submit" class="cta-button bg-blue-600 px-3 py-1 text-sm">Kirim Balasan</button>
                    <button type="button" onclick="hideReplyForm({{ $comment->id }})" class="cta-button bg-gray-200 text-gray-800 px-3 py-1 text-sm ml-2">Batal</button>
                </form>
                @error('content')
                    <p style="color: red; font-size: 0.8em;">{{ $errors->first('content') }}</p> {{-- <<< UBAH KE $errors->first('content') --}}
                @enderror
            </div>
        @else
            <span class="text-sm text-gray-700 mr-2">❤ {{ $comment->likes->count() }}</span>
        @endauth
    </div>

    {{-- Tampilkan Balasan (rekursif) --}}
    @if ($comment->replies->count() > 0)
        <div class="replies mt-4 border-l pl-4 border-gray-200">
            @foreach ($comment->replies as $reply)
                {{-- Pastikan balasan yang dihapus juga ditampilkan (jika sudah diatur di controller) --}}
                @include('partials.comment', ['comment' => $reply, 'level' => $level + 1])
            @endforeach
        </div>
    @endif
</div>

<script>
    function showReplyForm(commentId) {
        document.getElementById('reply-form-' + commentId).style.display = 'block';
    }

    function hideReplyForm(commentId) {
        document.getElementById('reply-form-' + commentId).style.display = 'none';
        document.querySelector('#reply-form-' + commentId + ' textarea').value = ''; // Clear textarea
        // Clear file input as well
        const fileInput = document.getElementById('reply_gambar_' + commentId);
        if (fileInput) {
            fileInput.value = ''; // Clear selected file
        }
    }
</script>
