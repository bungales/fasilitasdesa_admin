@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit User</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role <span class="text-danger">*</span></label>
                                <select name="role" class="form-select" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Foto Profil</label>
                                <div class="card border">
                                    <div class="card-body text-center p-3">
                                        <div class="mb-3 position-relative">
                                            <div id="profilePreview" class="mx-auto" style="width: 150px; height: 150px;">
                                                @if($user->profile_picture)
                                                    <img src="{{ $user->profile_picture_url }}"
                                                         class="img-fluid rounded-circle border"
                                                         style="width: 150px; height: 150px; object-fit: cover;"
                                                         id="previewImage">
                                                    <div id="placeholderAvatar" class="rounded-circle border d-none d-flex align-items-center justify-content-center mx-auto"
                                                         style="width: 150px; height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 60px; font-weight: bold;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                @else
                                                    <div id="placeholderAvatar" class="rounded-circle border d-flex align-items-center justify-content-center mx-auto"
                                                         style="width: 150px; height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 60px; font-weight: bold;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                    <img src=""
                                                         class="img-fluid rounded-circle border d-none"
                                                         style="width: 150px; height: 150px; object-fit: cover;"
                                                         id="previewImage">
                                                @endif
                                            </div>
                                            <small class="text-muted d-block mt-2">Klik untuk upload foto baru</small>
                                        </div>

                                        <input type="file"
                                               name="profile_picture"
                                               id="profilePictureInput"
                                               class="d-none"
                                               accept="image/*">

                                        <button type="button"
                                                class="btn btn-outline-primary btn-sm w-100 mb-2"
                                                onclick="document.getElementById('profilePictureInput').click()">
                                            <i class="bi bi-upload me-1"></i> Upload Foto Baru
                                        </button>

                                        @if($user->profile_picture)
                                            <div class="form-check mb-2">
                                                <input type="checkbox"
                                                       name="remove_profile_picture"
                                                       value="1"
                                                       id="removePicture"
                                                       class="form-check-input">
                                                <label for="removePicture" class="form-check-label text-danger">
                                                    <i class="bi bi-trash me-1"></i> Hapus foto profil
                                                </label>
                                            </div>
                                        @endif

                                        <button type="button"
                                                class="btn btn-outline-danger btn-sm w-100 d-none"
                                                id="removeNewImageBtn">
                                            <i class="bi bi-x-circle me-1"></i> Batalkan Foto Baru
                                        </button>

                                        <small class="text-muted d-block mt-2">
                                            <i class="bi bi-info-circle"></i> Maksimal 2MB, Format: JPG, PNG
                                        </small>
                                        @error('profile_picture') <small class="text-danger d-block">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-1"></i> Update
                        </button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary px-4">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('profilePictureInput');
            const previewImage = document.getElementById('previewImage');
            const placeholderAvatar = document.getElementById('placeholderAvatar');
            const removeNewImageBtn = document.getElementById('removeNewImageBtn');
            const removePictureCheckbox = document.getElementById('removePicture');
            const nameInput = document.querySelector('input[name="name"]');

            // Warna berdasarkan inisial
            function getColorForInitial(initial) {
                const colors = {
                    'A': '#FF6B6B', 'B': '#4ECDC4', 'C': '#45B7D1', 'D': '#96CEB4',
                    'E': '#FECA57', 'F': '#FF9FF3', 'G': '#54A0FF', 'H': '#5F27CD',
                    'I': '#00D2D3', 'J': '#FF9F43', 'K': '#EE5A24', 'L': '#C4E538',
                    'M': '#12CBC4', 'N': '#FDA7DF', 'O': '#ED4C67', 'P': '#B53471',
                    'Q': '#006266', 'R': '#1B1464', 'S': '#5758BB', 'T': '#6F1E51',
                    'U': '#EE5A24', 'V': '#C4E538', 'W': '#12CBC4', 'X': '#FDA7DF',
                    'Y': '#ED4C67', 'Z': '#B53471'
                };
                return colors[initial] || '#6C5CE7';
            }

            // Update placeholder avatar berdasarkan nama
            function updatePlaceholderAvatar() {
                if (placeholderAvatar) {
                    const name = nameInput.value.trim();
                    if (name) {
                        const initial = name.charAt(0).toUpperCase();
                        placeholderAvatar.textContent = initial;
                        const color = getColorForInitial(initial);
                        placeholderAvatar.style.background = `linear-gradient(135deg, ${color} 0%, ${color}80 100%)`;
                    }
                }
            }

            // Update placeholder saat nama diubah
            nameInput.addEventListener('input', updatePlaceholderAvatar);
            updatePlaceholderAvatar();

            // Handle file upload
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];

                    if (file) {
                        // Validasi
                        if (file.size > 2 * 1024 * 1024) {
                            alert('Ukuran file maksimal 2MB');
                            fileInput.value = '';
                            return;
                        }

                        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                        if (!validTypes.includes(file.type)) {
                            alert('Format file harus JPG, PNG, atau GIF');
                            fileInput.value = '';
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            previewImage.classList.remove('d-none');
                            if (placeholderAvatar) placeholderAvatar.classList.add('d-none');
                            removeNewImageBtn.classList.remove('d-none');

                            // Uncheck remove checkbox jika ada
                            if (removePictureCheckbox) {
                                removePictureCheckbox.checked = false;
                            }
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Handle remove new image
            if (removeNewImageBtn) {
                removeNewImageBtn.addEventListener('click', function() {
                    fileInput.value = '';
                    previewImage.src = '';
                    previewImage.classList.add('d-none');
                    if (placeholderAvatar) placeholderAvatar.classList.remove('d-none');
                    removeNewImageBtn.classList.add('d-none');
                    updatePlaceholderAvatar();
                });
            }

            // Handle remove checkbox
            if (removePictureCheckbox) {
                removePictureCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        // Tampilkan placeholder
                        previewImage.classList.add('d-none');
                        if (placeholderAvatar) placeholderAvatar.classList.remove('d-none');
                        updatePlaceholderAvatar();

                        // Reset file input
                        fileInput.value = '';
                        removeNewImageBtn.classList.add('d-none');
                    }
                });
            }
        });
    </script>

    <style>
        #profilePreview {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        #profilePreview:hover {
            transform: scale(1.05);
        }
        #placeholderAvatar {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        #placeholderAvatar:hover {
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
    </style>
@endsection
