<div class="sidebar">
    <h2 style="color: red; text-align: center;">MENU</h2>
    
    <a href="{{ url('/') }}">🏠 Dashboard</a>
    <a href="{{ url('/table') }}">📋 Daftar Berita Acara</a>
    <a href="{{ url('/petugas') }}">📋 Daftar Petugas</a>
    <a href="{{ url('/petugas/create') }}">➕ Tambah Petugas</a>
</div>

<style>
    .sidebar {
        width: 220px;
        background-color: #111;
        color: white;
        height: 100vh;
        padding-top: 20px;
        position: fixed;
    }

    .sidebar a {
        display: block;
        color: white;
        padding: 12px 20px;
        text-decoration: none;
    }

    .sidebar a:hover {
        background-color: #575757;
    }
</style>
