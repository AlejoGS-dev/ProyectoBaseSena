{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div class="saved-messages avatar av-m">
                    <span class="far fa-bookmark"></span>
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Contact list -------------------- --}}
@if($get == 'users' && !!$lastMessage)
@php
    $lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
    $lastMessageBody = strlen($lastMessageBody) > 30
        ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..'
        : $lastMessageBody;

    // Resolver avatar del usuario
    $avatarFile = $user->avatar ?? null;

    if ($avatarFile) {
        $avatarFile = ltrim($avatarFile, '/');

        // si ya viene como "storage/..." lo usamos tal cual
        if (strpos($avatarFile, 'storage/') === 0) {
            $avatarUrl = asset($avatarFile);
        } else {
            // si no trae la carpeta, se la agregamos
            if (strpos($avatarFile, 'users-avatar/') === false) {
                $avatarFile = 'users-avatar/'.$avatarFile;
            }
            // URL pública real (public/storage/users-avatar/...)
            $avatarUrl = asset('storage/'.$avatarFile);
        }
    } else {
        // avatar por defecto
        $avatarUrl = asset('chatify/images/avatar.png');
    }
@endphp

<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
            <div class="avatar av-m"
                 style="background-image: url('{{ $avatarUrl }}');">
            </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
                {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
                <span class="contact-item-time" data-time="{{ $lastMessage->created_at }}">
                    {{ $lastMessage->timeAgo }}
                </span>
            </p>
            <span>
                {!! $lastMessage->from_id == Auth::user()->id
                    ? '<span class="lastMessageIndicator">You :</span>'
                    : '' !!}

                @if($lastMessage->attachment == null)
                    {!! $lastMessageBody !!}
                @else
                    <span class="fas fa-file"></span> Attachment
                @endif
            </span>

            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
    </tr>
</table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
@php
    $avatarFile = $user->avatar ?? null;

    if ($avatarFile) {
        $avatarFile = ltrim($avatarFile, '/');

        if (strpos($avatarFile, 'storage/') === 0) {
            $avatarUrl = asset($avatarFile);
        } else {
            if (strpos($avatarFile, 'users-avatar/') === false) {
                $avatarFile = 'users-avatar/'.$avatarFile;
            }
            $avatarUrl = asset('storage/'.$avatarFile);
        }
    } else {
        $avatarUrl = asset('chatify/images/avatar.png');
    }
@endphp

<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
            <div class="avatar av-m"
                 style="background-image: url('{{ $avatarUrl }}');">
            </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
                {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
            </p>
        </td>
    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
    <div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif
