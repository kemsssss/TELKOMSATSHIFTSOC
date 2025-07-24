<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - ITINTERN TELKOMSAT</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body { margin:0; font-family: 'Figtree', sans-serif; background: #fff5f5; }
        .header {
            background: #d32f2f;
            padding: 0 0 0 32px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo {
            font-weight: bold;
            font-size: 2rem;
            color: #fff;
            letter-spacing: 2px;
        }
        .nav {
            display: flex;
            gap: 32px;
            margin-right: 48px;
        }
        .nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            opacity: 0.8;
            transition: color 0.2s;
        }
        .nav a.active, .nav a:hover {
            color: #ffd6d6;
            opacity: 1;
        }
        .main {
            max-width: 900px;
            margin: 48px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(211,47,47,0.08);
            padding: 40px 32px;
        }
        .section-title {
            color: #d32f2f;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 24px;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 32px;
        }
        .menu-card {
            background: #fff5f5;
            border: 2px solid #ffd6d6;
            border-radius: 12px;
            padding: 32px 16px;
            text-align: center;
            color: #d32f2f;
            font-weight: bold;
            font-size: 1.1rem;
            transition: box-shadow 0.2s, border 0.2s;
            cursor: pointer;
        }
        .menu-card:hover {
            box-shadow: 0 2px 12px rgba(211,47,47,0.12);
            border: 2px solid #d32f2f;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">ITINTERN TELKOMSAT</div>
        <nav class="nav">
            <a href="#" class="active">Dashboard</a>
            <a href="#">Absen</a>
            <a href="#">Profile</a>
            <a href="#">Log Book</a>
            <a href="#">Logout</a>
        </nav>
    </div>
    <div class="main">
        <div class="section-title">Selamat Datang di Dashboard ITINTERN TELKOMSAT</div>
        <div class="menu-grid">
            <div class="menu-card">Absen</div>
            <div class="menu-card">Profile Data Diri</div>
            <div class="menu-card">Log Book Mingguan</div>
        </div>
    </div>
</body>
</html>
