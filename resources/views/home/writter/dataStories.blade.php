@extends('layouts.writer')
@section('title', 'Data Stories')
@section('content')
    <div id="page1" class="tabcontent">
        <div class="nav">
            <div class="nav-area">
                <div class="nav-burger" onclick="toggleSidebar()">
                    <span class="material-symbols-outlined"> menu </span>
                </div>
                <div class="search-box">
                    <input type="text" name="" value="" placeholder="Cari Cerita Favorit Anda" />
                    <button type="submit" name="button">
                        <span class="material-symbols-outlined"> search </span>
                    </button>
                </div>
                <div class="nav-menu-dekstop">
                    <div class="notif">
                        <span class="material-symbols-outlined"> notifications </span>
                    </div>
                    <div class="akun">
                        <div class="dropdown">
                            <button onclick="toggleDropdown('dropdown2')" class="dropbtn">
                                <span class="material-symbols-outlined dropbtn ">
                                    person
                                </span>
                            </button>
                            <div id="dropdown2" class="dropdown-content">
                                <div class="akun1">
                                    <div class="akun2">
                                        <span class="material-symbols-outlined"> person </span>
                                        Profile
                                    </div>
                                    <div class="akun2">
                                        <span class="material-symbols-outlined">settings</span>
                                        Settings
                                    </div>
                                </div>
                                <div class="akun1">
                                    <div class="akun2">
                                        <span class="material-symbols-outlined"> help </span>
                                        Help Center
                                    </div>
                                    <div class="akun2">
                                        <span class="material-symbols-outlined"> security </span>
                                        Privacy & Safety
                                    </div>
                                </div>
                                <div class="akun1">
                                    <div class="akun2">
                                        <span class="material-symbols-outlined">login</span>
                                        Log Out
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3>Daftar Cerita</h3>
        <button type="submit" class="add">
            <a href="#">+ Buat Novel Baru</a>
        </button>
        <div class="page">
            <table>
                <tr>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Genre</th>
                    <th>Jumlah Chapter</th>
                    <th>Jumlah Halaman</th>
                    <th>Status Buku</th>
                    <th>Aksi</th>
                </tr>
                <tr>
                    <td class="cover">
                        <figure>
                            <img src="cover.webp" alt="" />
                        </figure>
                    </td>
                    <td>
                        <div class="text">Judul</div>
                    </td>
                    <td>
                        <div class="text">Genre</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Chapter</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Halaman</div>
                    </td>
                    <td>
                        <div class="text">Status Buku</div>
                    </td>
                    <td class="cover">
                        <div class="aksi">Kelola Cerita</div>
                    </td>
                </tr>
                <tr>
                    <td class="cover">
                        <figure>
                            <img src="cover.webp" alt="" />
                        </figure>
                    </td>
                    <td>
                        <div class="text">Judul</div>
                    </td>
                    <td>
                        <div class="text">Genre</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Chapter</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Halaman</div>
                    </td>
                    <td>
                        <div class="text">Status Buku</div>
                    </td>
                    <td class="cover">
                        <div class="aksi">Kelola Cerita</div>
                    </td>
                </tr>
                <tr>
                    <td class="cover">
                        <figure>
                            <img src="cover.webp" alt="" />
                        </figure>
                    </td>
                    <td>
                        <div class="text">Judul</div>
                    </td>
                    <td>
                        <div class="text">Genre</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Chapter</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Halaman</div>
                    </td>
                    <td>
                        <div class="text">Status Buku</div>
                    </td>
                    <td class="cover">
                        <div class="aksi">Kelola Cerita</div>
                    </td>
                </tr>
                <tr>
                    <td class="cover">
                        <figure>
                            <img src="cover.webp" alt="" />
                        </figure>
                    </td>
                    <td>
                        <div class="text">Judul</div>
                    </td>
                    <td>
                        <div class="text">Genre</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Chapter</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Halaman</div>
                    </td>
                    <td>
                        <div class="text">Status Buku</div>
                    </td>
                    <td class="cover">
                        <div class="aksi">Kelola Cerita</div>
                    </td>
                </tr>
                <tr>
                    <td class="cover">
                        <figure>
                            <img src="cover.webp" alt="" />
                        </figure>
                    </td>
                    <td>
                        <div class="text">Judul</div>
                    </td>
                    <td>
                        <div class="text">Genre</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Chapter</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Halaman</div>
                    </td>
                    <td>
                        <div class="text">Status Buku</div>
                    </td>
                    <td class="cover">
                        <div class="aksi">Kelola Cerita</div>
                    </td>
                </tr>
                <tr>
                    <td class="cover">
                        <figure>
                            <img src="cover.webp" alt="" />
                        </figure>
                    </td>
                    <td>
                        <div class="text">Judul</div>
                    </td>
                    <td>
                        <div class="text">Genre</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Chapter</div>
                    </td>
                    <td>
                        <div class="text">Jumlah Halaman</div>
                    </td>
                    <td>
                        <div class="text">Status Buku</div>
                    </td>
                    <td class="cover">
                        <div class="aksi">Kelola Cerita</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
