<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITIntern Telkomsat</title>
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: #f9d784;
        }

        #preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: #0f2027;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f9d784;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .container {
            padding: 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .hero {
            text-align: center;
            margin-top: 100px;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero-desc {
            font-size: 1.25rem;
            margin-top: 1rem;
            margin-bottom: 2rem;
        }

        .hero-btn {
            background-color: #f9d784;
            color: #0f2027;
            padding: 16px 40px;
            font-size: 1.1rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .hero-btn:hover {
            background-color: #e6c26e;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 60px;
        }

        .feature-card {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid #f9d78444;
            padding: 20px;
            margin: 10px;
            border-radius: 12px;
            flex: 1 1 300px;
            max-width: 320px;
            text-align: center;
        }

        canvas {
            width: 100%;
            height: 400px;
            display: block;
        }

        footer {
            text-align: center;
            color: #f9d784;
            padding: 24px 0;
            border-top: 1px solid #f9d78433;
            background: #16222a;
            font-size: 0.95rem;
        }

        @media (max-width: 600px) {
            .hero-title {
                font-size: 2rem;
                text-align: center;
            }

            .hero-desc {
                font-size: 1rem;
                text-align: center;
            }

            .hero-btn {
                font-size: 1rem;
                padding: 14px 32px;
            }

            .features {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <div id="preloader">Loading...</div>

    <div class="container">
        <section class="hero" data-aos="fade-down">
            <h1 class="hero-title">Selamat Datang di ITIntern Telkomsat</h1>
            <p class="hero-desc">Platform informasi dan pelaporan kegiatan magang mahasiswa/i di lingkungan IT Telkomsat</p>
            <button class="hero-btn">Mulai Eksplorasi</button>
        </section>

        <section class="features" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-card">
                <h3>Agenda Magang</h3>
                <p>Jadwal kegiatan dan pelatihan selama magang.</p>
            </div>
            <div class="feature-card">
                <h3>Pelaporan Harian</h3>
                <p>Catat aktivitas dan progres magangmu dengan mudah.</p>
            </div>
            <div class="feature-card">
                <h3>3D Showcase</h3>
                <p>Visualisasi interaktif dari struktur organisasi atau proyek IT.</p>
            </div>
        </section>

        <section data-aos="fade-up" data-aos-delay="200">
            <canvas id="three-canvas"></canvas>
        </section>
    </div>

    <footer>
        © 2025 ITIntern Telkomsat - Developed by Kemal Rafdi Anshari
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
    <script>
        window.addEventListener("load", () => {
            const preloader = document.getElementById("preloader");
            preloader.style.opacity = "0";
            setTimeout(() => preloader.style.display = "none", 500);
        });
    </script>
</body>

</html>
