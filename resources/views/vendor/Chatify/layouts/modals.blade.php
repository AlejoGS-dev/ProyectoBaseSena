{{-- ---------------------- Image modal box ---------------------- --}}
<div id="imageModalBox" class="imageModal">
    <span class="imageModal-close">&times;</span>
    <img class="imageModal-content" id="imageModalBoxSrc">
</div>

{{-- ---------------------- Delete Modal ---------------------- --}}
<div class="app-modal" data-name="delete">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="delete" data-modal='0'>
            <div class="app-modal-header">Are you sure you want to delete this?</div>
            <div class="app-modal-body">You can not undo this action</div>
            <div class="app-modal-footer">
                <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
                <a href="javascript:void(0)" class="app-btn a-btn-danger delete">Delete</a>
            </div>
        </div>
    </div>
</div>

{{-- ---------------------- Alert Modal ---------------------- --}}
<div class="app-modal" data-name="alert">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="alert" data-modal='0'>
            <div class="app-modal-header"></div>
            <div class="app-modal-body"></div>
            <div class="app-modal-footer">
                <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
            </div>
        </div>
    </div>
</div>

{{-- ---------------------- Settings Modal ---------------------- --}}
<div class="app-modal" data-name="settings">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="settings" data-modal='0'>
            <form id="update-settings" action="{{ route('avatar.update') }}" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="app-modal-body">
                    {{-- Update profile avatar --}}
                    @php
                        $theUser = Chatify::getUserWithAvatar(Auth::user());
                        $avatarFile = $theUser->avatar ?? null;

                        if ($avatarFile) {
                            // quitar barras iniciales
                            $avatarFile = ltrim($avatarFile, '/');

                            // si ya viene como "storage/..." lo respetamos
                            if (strpos($avatarFile, 'storage/') === 0) {
                                $avatarUrl = asset($avatarFile);
                            } else {
                                // si no viene con la carpeta, se la agregamos
                                if (strpos($avatarFile, 'users-avatar/') === false) {
                                    $avatarFile = 'users-avatar/'.$avatarFile;
                                }

                                // URL pública final
                                $avatarUrl = asset('storage/'.$avatarFile);
                            }
                        } else {
                            // avatar por defecto
                            $avatarUrl = asset('chatify/images/avatar.png');
                        }
                    @endphp

                    <div class="avatar av-l upload-avatar-preview chatify-d-flex"
                        style="background-image: url('{{ $avatarUrl }}');">
                    </div>

                    <p class="upload-avatar-details"></p>

                    <label class="app-btn a-btn-primary update" style="background-color:{{ $messengerColor }}">
                        Upload New
                        <input class="upload-avatar chatify-d-none" accept="image/*" name="avatar" type="file" />
                    </label>

                    {{-- Divider --}}
                    <p class="divider"></p>

                    {{-- Dark/Light Mode --}}
                    <p class="app-modal-header">
                        Dark Mode
                        <span class="{{ Auth::user()->dark_mode ? 'fas' : 'far' }} fa-moon dark-mode-switch"
                              data-mode="{{ Auth::user()->dark_mode ? 1 : 0 }}">
                        </span>
                    </p>

                    {{-- Divider --}}
                    <p class="divider"></p>

                    {{-- Messenger colors --}}
                    <div class="update-messengerColor">
                        @foreach (config('chatify.colors') as $color)
                            <span style="background-color: {{ $color }}" data-color="{{ $color }}" class="color-btn"></span>
                            @if (($loop->index + 1) % 5 == 0)
                                <br>
                            @endif
                        @endforeach
                    </div>

                </div>

                <div class="app-modal-footer">
                    <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
                    <input type="submit" class="app-btn a-btn-success update" value="Save Changes" />
                </div>

            </form>
        </div>
    </div>
</div>
