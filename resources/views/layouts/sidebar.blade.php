<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard/profil') }}">
                <i class="fa-solid fa-house fa-fw mr-2"></i>
                <span class="menu-title">Profil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard/mahasiswa') }}">
                <i class="fa-solid fa-users fa-fw mr-2"></i>
                <span class="menu-title">Mahasiswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard/mata-kuliah') }}">
                <i class="fa-solid fa-shapes fa-fw mr-2"></i>
                <span class="menu-title">Mata Kuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#referensi" aria-expanded="false"
                aria-controls="referensi">
                <i class="fa-solid fa-file-lines fa-fw mr-2"></i>
                <span class="menu-title">Referensi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="referensi">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('dashboard/ref-agama') }}">Agama</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('dashboard/ref-alat-transportasi') }}">Alat
                            Transportasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('dashboard/ref-jalur-daftar') }}">Jalur
                            Daftar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('dashboard/ref-jenis-tinggal') }}">Jenis
                            Tinggal</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ url('dashboard/ref-jenjang-pendidikan') }}">Jenjang Pendidikan</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ url('dashboard/ref-kebutuhan-khusus') }}">Kebutuhan Khusus</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('dashboard/ref-negara') }}">Negara</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('dashboard/ref-pekerjaan') }}">Pekerjaan</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('dashboard/ref-pembiayaan') }}">Pembiayaan</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ url('dashboard/ref-penghasilan') }}">Penghasilan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('dashboard/ref-wilayah') }}">Wilayah</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#pengaturan" aria-expanded="false"
                aria-controls="pengaturan">
                <i class="fa-solid fa-gears fa-fw mr-2"></i>
                <span class="menu-title">Pengaturan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="pengaturan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('dashboard/sandbox') }}">Sandbox</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard/log-import') }}">
                <i class="fa-solid fa-clock-rotate-left fa-fw mr-2"></i>
                <span class="menu-title">Log Import</span>
            </a>
        </li>
    </ul>
</nav>
