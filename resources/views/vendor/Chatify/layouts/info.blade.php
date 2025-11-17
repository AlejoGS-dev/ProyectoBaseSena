{{-- user info and avatar --}}
@php
    $theUser = Chatify::getUserWithAvatar(Auth::user());
    $avatarFile = $theUser->avatar ?? null;

    if ($avatarFile) {
        $avatarFile = ltrim($avatarFile, '/');

        if ($avatarFile === 'avatar.png') {
            $avatarUrl = asset('chatify/images/avatar.png');
        } else {
            $avatarUrl = route('user.avatar', $avatarFile);
        }
    } else {
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
