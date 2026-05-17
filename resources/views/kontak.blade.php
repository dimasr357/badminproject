<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontak Kami - Badminton Sport Center</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Instrument Sans', sans-serif;
                line-height: 1.6;
                color: #333;
                background: #f8f9fa;
            }
            
            .header {
                background: white;
                padding: 1rem 2rem;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
            }
            
            .header-content {
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .logo {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-weight: 700;
                font-size: 1.5rem;
                color: #333;
                text-decoration: none;
            }
            
            .logo-icon {
                width: 30px;
                height: 30px;
                background: #333;
                border-radius: 50%;
                position: relative;
            }
            
            .logo-icon::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 20px;
                height: 20px;
                background: white;
                border-radius: 50%;
            }
            
            .nav-menu {
                display: flex;
                list-style: none;
                gap: 2rem;
                align-items: center;
            }
            
            .nav-menu a {
                text-decoration: none;
                color: #333;
                font-weight: 500;
                transition: color 0.3s ease;
            }
            
            .nav-menu a:hover,
            .nav-menu a.active {
                color: #22c55e;
            }
            
            .login-btn {
                background: #22c55e;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: background-color 0.3s ease;
            }
            
            .login-btn:hover {
                background: #16a34a;
            }

            .logout-btn {
                background: #ef4444;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: background-color 0.3s ease;
                border: none;
                cursor: pointer;
            }
            
            .logout-btn:hover {
                background: #dc2626;
            }

            .user-info {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .user-name {
                font-weight: 600;
                color: #333;
            }

            /* Main Content Styles */
            .main-content {
                margin-top: 70px; /* Match fixed header height */
                padding-top: 0;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            /* Maps Section */
            .maps-section {
                background: #f8f9fa;
                padding: 0;
                margin-bottom: 0;
            }

            .google-maps {
                width: 100%;
                height: 400px;
                background: #e9ecef;
                position: relative;
                overflow: hidden;
            }

            .google-maps iframe {
                width: 100%;
                height: 100%;
                border: 0;
            }

            /* Contact Section */
            .contact-section {
                background: #f8f9fa;
                padding: 3rem 0;
                min-height: calc(100vh - 70px - 400px);
            }

            .contact-container {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 3rem;
                align-items: start;
            }

            .contact-info-box {
                background: white;
                padding: 2rem;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            }

            .contact-info-box h3 {
                color: #495057;
                font-size: 1.5rem;
                margin-bottom: 2rem;
                text-align: center;
            }

            .contact-item {
                display: flex;
                align-items: center;
                margin-bottom: 2rem;
                padding: 1rem;
                background: #f8f9fa;
                border-radius: 8px;
                transition: transform 0.2s ease;
            }

            .contact-item:hover {
                transform: translateY(-2px);
            }

            .contact-icon {
                width: 50px;
                height: 50px;
                background: #28a745;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                color: white;
                font-size: 1.2rem;
            }

            .contact-details h4 {
                color: #495057;
                margin-bottom: 0.5rem;
                font-size: 1.1rem;
            }

            .contact-details p {
                color: #6c757d;
                margin: 0;
            }

            /* Contact Form */
            .contact-form {
                background: white;
                padding: 2rem;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            }

            .contact-form h3 {
                color: #495057;
                font-size: 1.5rem;
                margin-bottom: 2rem;
                text-align: center;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-group label {
                display: block;
                margin-bottom: 0.5rem;
                color: #495057;
                font-weight: 500;
            }

            .form-control {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 2px solid #e9ecef;
                border-radius: 8px;
                font-size: 1rem;
                transition: border-color 0.2s ease;
            }

            .form-control:focus {
                outline: none;
                border-color: #28a745;
                box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
            }

            .form-control.textarea {
                min-height: 120px;
                resize: vertical;
            }

            .btn-submit {
                background: #28a745;
                color: white;
                border: none;
                padding: 1rem 2rem;
                border-radius: 8px;
                font-size: 1rem;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.2s ease;
                width: 100%;
            }

            .btn-submit:hover {
                background: #218838;
            }

            .btn-submit i {
                margin-right: 0.5rem;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .nav-menu {
                    display: none;
                }

                .contact-container {
                    grid-template-columns: 1fr;
                    gap: 2rem;
                }

                .page-header h1 {
                    font-size: 2rem;
                }

                .google-maps {
                    height: 300px;
                }
            }

            @media (max-width: 480px) {
                .container {
                    padding: 0 15px;
                }

                .page-header {
                    padding: 2rem 0;
                }

                .maps-section,
                .contact-section {
                    padding: 2rem 0;
                }

                .contact-info-box,
                .contact-form {
                    padding: 1.5rem;
                }
            }
        </style>
    @endif
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="{{ url('/') }}" class="logo">
                <div class="logo-icon"></div>
                Badminton Sport Center
            </a>
            
            <x-navigation />
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">


        <!-- Maps Section -->
        <section class="maps-section">
            <div class="google-maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.2524887695517!2d107.07374097475522!3d-6.739023693257234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69b3004a973ceb%3A0x49aaa1d6327f7c73!2sDESA%20KONOHA!5e0!3m2!1sid!2sid!4v1754877927343!5m2!1sid!2sid" width="1000" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="container">
                <div class="contact-container">
                    <!-- Contact Information -->
                    <div class="contact-info-box">
                        <h3>Informasi Kontak</h3>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Alamat</h4>
                                <p>Badminton Sport Center, Konoha, KN 12121213</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Telepon</h4>
                                <p>+62 831-6981-4681</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email</h4>
                                <p>badminton@example.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form">
                        <h3>Kirim Pesan</h3>
                        <form id="contactForm" action="#" method="POST">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email Anda" required>
                            </div>

                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="tel" id="telepon" name="telepon" class="form-control" placeholder="Nomor Telepon">
                            </div>

                            <div class="form-group">
                                <label for="pesan">Pesan</label>
                                <textarea id="pesan" name="pesan" class="form-control textarea" placeholder="Tulis pesan Anda di sini..." required></textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fab fa-whatsapp"></i>
                                Kirim via WhatsApp
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    @include('components.footer')

    <script>
        // Set custom validation messages in Indonesian
        document.addEventListener('DOMContentLoaded', function() {
            const namaInput = document.getElementById('nama');
            const emailInput = document.getElementById('email');
            const pesanInput = document.getElementById('pesan');
            
            // Nama validation
            namaInput.addEventListener('invalid', function() {
                if (this.validity.valueMissing) {
                    this.setCustomValidity('Mohon isi nama lengkap Anda.');
                }
            });
            namaInput.addEventListener('input', function() {
                this.setCustomValidity('');
            });
            
            // Email validation
            emailInput.addEventListener('invalid', function() {
                if (this.validity.valueMissing) {
                    this.setCustomValidity('Mohon isi alamat email Anda.');
                } else if (this.validity.typeMismatch) {
                    this.setCustomValidity('Mohon masukkan alamat email yang valid.');
                }
            });
            emailInput.addEventListener('input', function() {
                this.setCustomValidity('');
            });
            
            // Pesan validation
            pesanInput.addEventListener('invalid', function() {
                if (this.validity.valueMissing) {
                    this.setCustomValidity('Mohon isi pesan Anda.');
                }
            });
            pesanInput.addEventListener('input', function() {
                this.setCustomValidity('');
            });
        });
        
        // Form submission handling
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const telepon = document.getElementById('telepon').value;
            const pesan = document.getElementById('pesan').value;
            
            // Create WhatsApp message
            const message = `Halo! Saya ${nama} ingin menghubungi Badminton Sport Center.\n\nEmail: ${email}\nTelepon: ${telepon}\n\nPesan:\n${pesan}`;
            
            // WhatsApp API URL (6283169814681)
            const whatsappUrl = `https://wa.me/6283169814681?text=${encodeURIComponent(message)}`;
            
            // Open WhatsApp
            window.open(whatsappUrl, '_blank');
        });

        // Add some interactivity to contact items
        document.querySelectorAll('.contact-item').forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-2px)';
                }, 150);
            });
        });
    </script>
</body>
</html>
