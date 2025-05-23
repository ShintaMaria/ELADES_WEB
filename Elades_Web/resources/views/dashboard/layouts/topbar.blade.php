 <!-- Content Wrapper -->
 <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

        <!-- Notifikasi Icon -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-bell"></i>
                @if($jumlahNotifikasi > 0)
                    <span class="badge badge-danger navbar-badge">{{ $jumlahNotifikasi }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right p-2" style="width: 350px;">
                <span class="dropdown-header font-weight-bold">Notifikasi Surat dan Pengaduan Masuk</span>
                <div class="dropdown-divider"></div>

                <div style="max-height: 350px; overflow-y: auto;">
                 @foreach($notifikasi->take(10) as $item)
                    <a href="#" class="dropdown-item">
                    <strong>{{ ucfirst($item->nama) }}</strong><br>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</small><br>
                    <span class="badge badge-primary">{{ $item->kode }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                 @endforeach
                </div>
                <form action="{{ route('notifikasi.clear') }}" method="POST" class="text-center mt-2">
                    @csrf
                    <button type="submit" class="btn btn-block btn-light">Tandai Semua Telah Dibaca</button>
                </form>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>



            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                    @if(Auth::user()->gambar)
                        {{-- jika ada gambar, tampilkan gambar profil --}}
                        <img class="img-profile rounded-circle"
                                src="{{ asset('storage/gambar_profil/' . Auth::user()->gambar) }}"
                                style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #dee2e6;">
                    @else
                        {{-- jika tidak ada gambar, tampilkan icon user --}}
                        <div class="d-flex justify-content-center align-items-center rounded-circle"
                                style="width: 40px; height: 40px; background-color: #e9ecef; border: 2px solid #dee2e6;">
                            <i class="fas fa-user text-secondary"></i>
                        </div>
                    @endif

                    </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "LogOut" Jika Anda Yakin Untuk Keluar</div>
                <div class="modal-footer">
                    <form action="{{ Route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" >Logout</b>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('styles')
<style>
@keyframes badge-pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.3);
    }
    100% {
        transform: scale(1);
    }
}

.badge-animation {
    animation: badge-pulse 0.5s ease;
}

#notification-items {
    max-height: 300px;
    overflow-y: auto;
}

.notification-icon {
    position: relative;
}

.mark-as-read {
    visibility: hidden;
    opacity: 0;
    transition: visibility 0s, opacity 0.2s linear;
}

.dropdown-item:hover .mark-as-read {
    visibility: visible;
    opacity: 1;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadNotifications();

    // Set up a refresh interval (every 60 seconds)
    setInterval(loadNotifications, 60000);
});

function loadNotifications() {
    fetch('{{ route("notifications.get") }}')
        .then(response => response.json())
        .then(data => {
            updateNotificationBadge(data.count);
            updateNotificationDropdown(data.notifications);
        })
        .catch(error => console.error('Error loading notifications:', error));
}

function updateNotificationBadge(count) {
    const badge = document.getElementById('notification-count');

    if (count > 0) {
        badge.textContent = count > 9 ? '9+' : count;
        badge.classList.remove('d-none');
    } else {
        badge.classList.add('d-none');
    }

    // Add animation effect
    badge.classList.add('badge-animation');
    setTimeout(() => {
        badge.classList.remove('badge-animation');
    }, 1000);
}

function updateNotificationDropdown(notifications) {
    const container = document.getElementById('notification-items');
    container.innerHTML = '';

    if (notifications.length === 0) {
        container.innerHTML = '<div class="dropdown-item text-center">Tidak ada notifikasi baru</div>';
        return;
    }

    notifications.forEach(notification => {
        const date = new Date(notification.tanggal);
        const formattedDate = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;

        // Determine icon and color based on notification code
        let iconClass = 'fas fa-file-alt';
        let bgClass = 'bg-primary';

        // You can customize icons and colors based on notification type
        switch(notification.kode.toLowerCase()) {
            case 'keamanan':
                iconClass = 'fas fa-shield-alt';
                bgClass = 'bg-danger';
                break;
            case 'penghasilan orang tua':
                iconClass = 'fas fa-money-bill';
                bgClass = 'bg-success';
                break;
            default:
                iconClass = 'fas fa-file-alt';
                bgClass = 'bg-primary';
        }

        const item = document.createElement('a');
        item.className = 'dropdown-item d-flex align-items-center';
        item.href = '#';
        item.innerHTML = `
            <div class="mr-3">
                <div class="icon-circle ${bgClass}">
                    <i class="${iconClass} text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">${formattedDate}</div>
                <span class="font-weight-bold">${notification.kode}</span>
                <div>${notification.nama}</div>
            </div>
            <div class="ml-auto">
                <button class="btn btn-sm btn-light mark-as-read" data-id="${notification.id}"
                        title="Tandai telah dibaca">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        `;

        container.appendChild(item);
    });

    // Add event listeners for mark as read buttons
    document.querySelectorAll('.mark-as-read').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = this.getAttribute('data-id');
            markAsRead(id);
        });
    });
}

function markAsRead(id) {
    fetch('{{ route("notifications.mark-as-read") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id: id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadNotifications();
        }
    })
    .catch(error => console.error('Error marking notification as read:', error));
}

function markAllAsRead() {
    fetch('{{ route("notifications.mark-all-as-read") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadNotifications();
        }
    })
    .catch(error => console.error('Error marking all notifications as read:', error));
}
</script>
@endpush
