{{-- user info and avatar --}}
@php
    // Usuario actual con avatar resuelto por Chatify
    $theUser = Chatify::getUserWithAvatar(Auth::user());

    $avatarFile = $theUser->avatar ?? null;

    if ($avatarFile) {
        $avatarFile = ltrim($avatarFile, '/');

        // si ya viene como "storage/..." lo usamos tal cual
        if (strpos($avatarFile, 'storage/') === 0) {
            $avatarUrl = asset($avatarFile);
        } else {
            // si no viene con la carpeta, se la agregamos
            if (strpos($avatarFile, 'users-avatar/') === false) {
                $avatarFile = 'users-avatar/'.$avatarFile;
            }

            // URL pública real (public/storage/users-avatar/...)
            $avatarUrl = asset('storage/'.$avatarFile);
        }
    } else {
        // avatar por defecto de Chatify
        $avatarUrl = asset('chatify/images/avatar.png');
    }
@endphp

<div class="avatar av-l chatify-d-flex"
     style="background-image: url('{{ $avatarUrl }}');"></div>

<p class="info-name">{{ $theUser->name ?? config('chatify.name') }}</p>

<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">Delete Conversation</a>
</div>

{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Shared Photos</span></p>
    <div class="shared-photos-list"></div>
</div>
