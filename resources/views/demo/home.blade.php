<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViiCheck - ระบบช่วยเหลือฉุกเฉินและติดต่อเจ้าของรถ</title>
    <meta name="description" content="ระบบช่วยเหลือฉุกเฉินและติดต่อเจ้าของรถที่ครอบคลุมทั่วประเทศไทย">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    /* Primary Colors */
    --primary: #db2d2e;
    --primary-dark: #b02426;
    --primary-light: #e55a5b;
    --primary-bg: rgba(219, 45, 46, 0.1);
    
    /* Neutral Colors */
    --white: #ffffff;
    --black: #000000;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    
    /* Background Colors */
    --bg-primary: var(--white);
    --bg-secondary: var(--gray-50);
    --bg-accent: var(--primary-bg);
    
    /* Text Colors */
    --text-primary: var(--gray-900);
    --text-secondary: var(--gray-600);
    --text-muted: var(--gray-500);
    --text-white: var(--white);
    
    /* Border Colors */
    --border-light: var(--gray-200);
    --border-medium: var(--gray-300);
    
    /* Shadows */
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --shadow-emergency: 0 10px 30px -5px rgba(219, 45, 46, 0.3);
    
    /* Gradients */
    --gradient-primary: linear-gradient(135deg, var(--primary), var(--primary-light));
    --gradient-hero: linear-gradient(135deg, rgba(219, 45, 46, 0.9), rgba(181, 36, 38, 0.9));
    
    /* Transitions */
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    
    /* Border Radius */
    --radius-sm: 6px;
    --radius-md: 8px;
    --radius-lg: 12px;
    --radius-xl: 16px;
    --radius-2xl: 20px;
    
    /* Spacing */
    --space-1: 0.25rem;
    --space-2: 0.5rem;
    --space-3: 0.75rem;
    --space-4: 1rem;
    --space-5: 1.25rem;
    --space-6: 1.5rem;
    --space-8: 2rem;
    --space-10: 2.5rem;
    --space-12: 3rem;
    --space-16: 4rem;
    --space-20: 5rem;
    --space-24: 6rem;
}

body {
    font-family: 'Prompt', sans-serif;
    line-height: 1.6;
    color: var(--text-primary);
    background-color: var(--bg-primary);
    overflow-x: hidden;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--space-4);
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-3) var(--space-6);
    border: none;
    border-radius: var(--radius-md);
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    font-size: 14px;
    gap: var(--space-2);
}

.btn-primary {
    background: var(--gradient-primary);
    color: var(--text-white);
    box-shadow: var(--shadow-md);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-emergency);
}

.btn-outline {
    background: transparent;
    color: var(--primary);
    border: 2px solid var(--primary);
}

.btn-outline:hover {
    background: var(--primary);
    color: var(--text-white);
}

.btn-large {
    padding: var(--space-4) var(--space-8);
    font-size: 16px;
}

/* Typography */
.text-gradient {
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    color: transparent;
}

/* Section Styles */
.section-header {
    text-align: center;
    margin-bottom: var(--space-16);
}

.section-title {
    font-size: clamp(2rem, 4vw, 2.5rem);
    font-weight: 700;
    margin-bottom: var(--space-4);
    color: var(--text-primary);
}

.section-description {
    font-size: 1.125rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
}

/* Navbar */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--border-light);
    transition: var(--transition);
}

.nav-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 64px;
}

.nav-logo {
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.logo-icon {
    width: 40px;
    height: 40px;
    background: var(--gradient-primary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-white);
}

.logo-text {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary);
}

.nav-menu {
    display: flex;
    gap: var(--space-8);
}

.nav-link {
    color: var(--text-primary);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
}

.nav-link:hover {
    color: var(--primary);
}

.nav-cta {
    display: flex;
    gap: var(--space-4);
}

.mobile-menu-btn {
    display: none;
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--text-primary);
}

.mobile-nav {
    display: none;
    padding: var(--space-4) 0;
    border-top: 1px solid var(--border-light);
    flex-direction: column;
    gap: var(--space-4);
}

.mobile-nav-link {
    color: var(--text-primary);
    text-decoration: none;
    font-weight: 500;
    padding: var(--space-2) 0;
}

.mobile-cta {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
    padding-top: var(--space-4);
}

/* Hero Section */
.hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: var(--text-white);
    overflow: hidden;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="1000" height="1000" fill="url(%23grid)"/></svg>');
    opacity: 0.5;
}

.hero-content {
    position: relative;
    z-index: 10;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: clamp(2.5rem, 6vw, 4rem);
    font-weight: 700;
    margin-bottom: var(--space-6);
    line-height: 1.1;
}

.hero-description {
    font-size: 1.25rem;
    margin-bottom: var(--space-8);
    opacity: 0.9;
    line-height: 1.6;
}

.hero-buttons {
    display: flex;
    gap: var(--space-4);
    justify-content: center;
    margin-bottom: var(--space-12);
    flex-wrap: wrap;
}

.hero-features {
    display: flex;
    gap: var(--space-8);
    justify-content: center;
    flex-wrap: wrap;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-weight: 500;
}

.feature-item i {
    font-size: 1.25rem;
    color: var(--primary-light);
}

/* Stats Section */
.stats {
    padding: var(--space-20) 0;
    background: linear-gradient(45deg, var(--bg-primary) 0%, var(--bg-secondary) 50%, var(--bg-primary) 100%);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-8);
    margin-bottom: var(--space-16);
}

.stat-card {
    background: var(--white);
    padding: var(--space-8);
    border-radius: var(--radius-2xl);
    text-align: center;
    box-shadow: var(--shadow-lg);
    transition: var(--transition);
    border: 1px solid var(--border-light);
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-emergency);
}

.stat-icon {
    width: 64px;
    height: 64px;
    background: var(--primary-bg);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto var(--space-6);
    font-size: 2rem;
    color: var(--primary);
    transition: var(--transition);
}

.stat-card:hover .stat-icon {
    transform: scale(1.1);
}

.stat-value {
    font-size: clamp(2rem, 4vw, 2.5rem);
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: var(--space-2);
    transition: var(--transition);
}

.stat-card:hover .stat-value {
    color: var(--primary);
}

.stat-label {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: var(--space-2);
}

.stat-description {
    color: var(--text-muted);
    font-size: 0.875rem;
}

.achievement-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    background: var(--gradient-primary);
    color: var(--text-white);
    padding: var(--space-4) var(--space-8);
    border-radius: 50px;
    font-weight: 600;
    max-width: fit-content;
    margin: 0 auto;
    box-shadow: var(--shadow-emergency);
}

/* Services Section */
.services {
    padding: var(--space-20) 0;
    background: var(--bg-primary);
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: var(--space-8);
}

.service-card {
    background: var(--white);
    border-radius: var(--radius-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    transition: var(--transition);
    border: 1px solid var(--border-light);
}

.service-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

.service-header {
    padding: var(--space-8);
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    gap: var(--space-4);
}

.service-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-primary);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-white);
    font-size: 1.5rem;
    flex-shrink: 0;
}

.service-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
}

.service-video {
    padding: var(--space-6);
}

.video-placeholder {
    aspect-ratio: 16/9;
    background: var(--gray-100);
    border-radius: var(--radius-lg);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    color: var(--text-secondary);
    cursor: pointer;
    transition: var(--transition);
}

.video-placeholder:hover {
    background: var(--primary-bg);
    color: var(--primary);
}

.video-placeholder i {
    font-size: 3rem;
}

.service-steps {
    padding: 0 var(--space-6) var(--space-6);
}

.service-steps h4 {
    font-weight: 600;
    margin-bottom: var(--space-4);
    color: var(--text-primary);
}

.service-steps ol {
    padding-left: var(--space-4);
    color: var(--text-secondary);
}

.service-steps li {
    margin-bottom: var(--space-2);
    line-height: 1.6;
}

.service-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: var(--space-4);
    padding: var(--space-6);
}

.gallery-item {
    aspect-ratio: 1;
}

.image-placeholder {
    width: 100%;
    height: 100%;
    background: var(--gray-100);
    border-radius: var(--radius-md);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: var(--space-1);
    color: var(--text-muted);
    font-size: 0.75rem;
    text-align: center;
    padding: var(--space-2);
    transition: var(--transition);
}

.image-placeholder:hover {
    background: var(--primary-bg);
    color: var(--primary);
}

.image-placeholder.large {
    aspect-ratio: 4/3;
    font-size: 1rem;
}

.image-placeholder i {
    font-size: 1.5rem;
}

.image-placeholder.large i {
    font-size: 3rem;
}

/* Awards Section */
.awards {
    padding: var(--space-20) 0;
    background: var(--bg-secondary);
}

.awards-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-12);
    align-items: center;
}

.award-image .image-placeholder {
    aspect-ratio: 4/3;
    background: var(--gray-100);
    border-radius: var(--radius-2xl);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: var(--space-4);
    color: var(--text-secondary);
    font-size: 1.125rem;
}

.awards-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-6);
}

.award-item {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-6);
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-md);
    transition: var(--transition);
}

.award-item:hover {
    transform: translateX(8px);
    box-shadow: var(--shadow-lg);
}

.award-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-white);
    font-size: 1.5rem;
    flex-shrink: 0;
}

.award-content h4 {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: var(--space-1);
}

.award-content p {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

/* Gallery Section */
.gallery {
    padding: var(--space-20) 0;
    background: var(--bg-primary);
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-6);
}

.gallery-grid .gallery-item {
    aspect-ratio: 4/3;
}

.gallery-grid .image-placeholder {
    transition: var(--transition);
    border: 2px solid transparent;
}

.gallery-grid .image-placeholder:hover {
    transform: scale(1.02);
    border-color: var(--primary);
    box-shadow: var(--shadow-emergency);
}

/* Partners Section */
.partners {
    padding: var(--space-20) 0;
    background: var(--bg-secondary);
}

.partners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-8);
}

.partner-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-8);
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-md);
    transition: var(--transition);
}

.partner-item:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.partner-logo {
    width: 80px;
    height: 80px;
    background: var(--primary-bg);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 2rem;
}

.partner-name {
    font-weight: 600;
    color: var(--text-primary);
    text-align: center;
}

/* Footer */
.footer {
    background: var(--gray-900);
    color: var(--gray-300);
    padding: var(--space-20) 0 var(--space-8);
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-12);
    margin-bottom: var(--space-12);
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    margin-bottom: var(--space-4);
}

.footer-logo .logo-text {
    color: var(--text-white);
}

.footer-description {
    margin-bottom: var(--space-6);
    line-height: 1.6;
}

.social-links {
    display: flex;
    gap: var(--space-3);
}

.social-link {
    width: 40px;
    height: 40px;
    background: var(--gray-800);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-400);
    text-decoration: none;
    transition: var(--transition);
}

.social-link:hover {
    background: var(--primary);
    color: var(--text-white);
    transform: translateY(-2px);
}

.footer-title {
    color: var(--text-white);
    font-weight: 600;
    margin-bottom: var(--space-4);
}

.footer-links {
    list-style: none;
}

.footer-links li {
    margin-bottom: var(--space-2);
}

.footer-links a {
    color: var(--gray-400);
    text-decoration: none;
    transition: var(--transition);
}

.footer-links a:hover {
    color: var(--primary);
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
}

.contact-item {
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

.contact-item i {
    color: var(--primary);
    width: 20px;
}

.footer-bottom {
    border-top: 1px solid var(--gray-800);
    padding-top: var(--space-8);
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--space-4);
}

.footer-bottom-links {
    display: flex;
    gap: var(--space-6);
}

.footer-bottom-links a {
    color: var(--gray-400);
    text-decoration: none;
    font-size: 0.875rem;
    transition: var(--transition);
}

.footer-bottom-links a:hover {
    color: var(--primary);
}

/* Responsive Design */
@media (max-width: 768px) {
    .nav-menu,
    .nav-cta {
        display: none;
    }
    
    .mobile-menu-btn {
        display: block;
    }
    
    .mobile-nav.active {
        display: flex;
    }
    
    .hero-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .hero-features {
        flex-direction: column;
        align-items: center;
        gap: var(--space-4);
    }
    
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: var(--space-4);
    }
    
    .services-grid {
        grid-template-columns: 1fr;
    }
    
    .awards-content {
        grid-template-columns: 1fr;
        gap: var(--space-8);
    }
    
    .gallery-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: var(--space-4);
    }
    
    .partners-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: var(--space-4);
    }
    
    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 var(--space-3);
    }
    
    .service-steps ol {
        padding-left: var(--space-3);
    }
    
    .award-item {
        flex-direction: column;
        text-align: center;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        gap: var(--space-8);
    }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

/* Scroll animations */
.animate-on-scroll {
    opacity: 0;
    animation: fadeInUp 0.6s ease-out forwards;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Loading states */
.loading {
    animation: pulse 1.5s ease-in-out infinite;
}
</style>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-content">
                <!-- Logo -->
                <div class="nav-logo">
                    <div class="logo-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <span class="logo-text">ViiCheck</span>
                </div>

                <!-- Desktop Navigation -->
                <div class="nav-menu" id="navMenu">
                    <a href="#home" class="nav-link">หน้าแรก</a>
                    <a href="#services" class="nav-link">บริการ</a>
                    <a href="#awards" class="nav-link">รางวัล</a>
                    <a href="#gallery" class="nav-link">ภาพการใช้งาน</a>
                    <a href="#contact" class="nav-link">ติดต่อ</a>
                </div>

                <!-- CTA Buttons -->
                <div class="nav-cta">
                    <button class="btn btn-outline">
                        <i class="fas fa-comment"></i>
                        ติดต่อเรา
                    </button>
                    <button class="btn btn-primary">
                        SOS ฉุกเฉิน
                    </button>
                </div>

                <!-- Mobile menu button -->
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div class="mobile-nav" id="mobileNav">
                <a href="#home" class="mobile-nav-link">หน้าแรก</a>
                <a href="#services" class="mobile-nav-link">บริการ</a>
                <a href="#awards" class="mobile-nav-link">รางวัล</a>
                <a href="#gallery" class="mobile-nav-link">ภาพการใช้งาน</a>
                <a href="#contact" class="mobile-nav-link">ติดต่อ</a>
                <div class="mobile-cta">
                    <button class="btn btn-outline">
                        <i class="fas fa-comment"></i>
                        ติดต่อเรา
                    </button>
                    <button class="btn btn-primary">
                        SOS ฉุกเฉิน
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    ระบบช่วยเหลือฉุกเฉิน<br>
                    <span class="text-gradient">ViiCheck</span>
                </h1>
                <p class="hero-description">
                    ระบบช่วยเหลือฉุกเฉินและติดต่อเจ้าของรถที่ครอบคลุมทั่วประเทศไทย<br>
                    พร้อมให้บริการ 24 ชั่วโมง เพื่อความปลอดภัยของคุณ
                </p>
                <div class="hero-buttons">
                    <button class="btn btn-primary btn-large">
                        <i class="fas fa-exclamation-triangle"></i>
                        เรียกความช่วยเหลือ
                    </button>
                    <button class="btn btn-outline btn-large">
                        <i class="fas fa-car"></i>
                        ติดต่อเจ้าของรถ
                    </button>
                </div>
                <div class="hero-features">
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>ปลอดภัย 100%</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-clock"></i>
                        <span>24 ชั่วโมง</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>77 จังหวัด</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">สถิติที่น่าภาคภูมิใจ</h2>
                <p class="section-description">
                    ตัวเลขที่แสดงถึงความเชื่อมั่นและประสิทธิภาพของระบบ ViiCheck
                </p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-value">150,000+</div>
                    <div class="stat-label">สมาชิก</div>
                    <div class="stat-description">ผู้ใช้งานที่ไว้วางใจ</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="stat-value">75,000+</div>
                    <div class="stat-label">ยานพาหนะ</div>
                    <div class="stat-description">ที่ลงทะเบียนในระบบ</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="stat-value">25,000+</div>
                    <div class="stat-label">ครั้งที่ให้การช่วยเหลือ</div>
                    <div class="stat-description">สถิติการช่วยเหลือสำเร็จ</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="stat-value">77</div>
                    <div class="stat-label">จังหวัดที่ครอบคลุม</div>
                    <div class="stat-description">ทั่วประเทศไทย</div>
                </div>
            </div>

            <div class="achievement-badge">
                <i class="fas fa-trophy"></i>
                ได้รับรางวัลระบบช่วยเหลือฉุกเฉินยอดเยี่ยม ประจำปี 2024
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">บริการของเรา</h2>
                <p class="section-description">
                    บริการครบครันเพื่อความปลอดภัยและความสะดวกสบายของคุณ
                </p>
            </div>

            <div class="services-grid">
                <!-- ViiSOS Service -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3 class="service-title">ระบบช่วยเหลือเหตุฉุกเฉิน ViiSOS</h3>
                    </div>
                    
                    <div class="service-video">
                        <div class="video-placeholder">
                            <i class="fas fa-play-circle"></i>
                            <span>วิดีโอสาธิต ViiSOS</span>
                        </div>
                    </div>

                    <div class="service-steps">
                        <h4>ขั้นตอนการใช้งาน:</h4>
                        <ol>
                            <li>สแกน QR CODE เพื่อเข้าสู่ Line Official ของ Viicheck</li>
                            <li>เลือกเมนู SOS</li>
                            <li>กดขอความช่วยเหลือจากเจ้าหน้าที่ได้เลย!!</li>
                        </ol>
                    </div>
                </div>

                <!-- ViiMOVE Service -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h3 class="service-title">ระบบติดต่อเจ้าของรถ ViiMOVE</h3>
                    </div>
                    
                    <div class="service-video">
                        <div class="video-placeholder">
                            <i class="fas fa-play-circle"></i>
                            <span>วิดีโอสาธิต ViiMOVE</span>
                        </div>
                    </div>

                    <div class="service-steps">
                        <h4>ขั้นตอนการใช้งาน:</h4>
                        <ol>
                            <li>สแกน QR CODE เพื่อเข้าสู่ Line Official ของ Viicheck</li>
                            <li>ลงทะเบียนในการใช้งาน Viicheck</li>
                            <li>กรอกข้อมูลรถของคุณเพื่อใช้บริการ Viicheck</li>
                            <li>ดาวน์โหลดและติดสติ๊กเกอร์</li>
                        </ol>
                    </div>
                </div>

                <!-- Repair Service -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3 class="service-title">ระบบแจ้งซ่อม</h3>
                    </div>
                    
                    <div class="service-gallery">
                        <div class="gallery-item">
                            <div class="image-placeholder">
                                <i class="fas fa-image"></i>
                                <span>ภาพการทำงาน 1</span>
                            </div>
                        </div>
                        <div class="gallery-item">
                            <div class="image-placeholder">
                                <i class="fas fa-image"></i>
                                <span>ภาพการทำงาน 2</span>
                            </div>
                        </div>
                        <div class="gallery-item">
                            <div class="image-placeholder">
                                <i class="fas fa-image"></i>
                                <span>ภาพการทำงาน 3</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Awards Section -->
    <section id="awards" class="awards">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">รางวัลและความสำเร็จ</h2>
                <p class="section-description">
                    รางวัลที่ได้รับซึ่งแสดงถึงคุณภาพและความน่าเชื่อถือของบริการ
                </p>
            </div>

            <div class="awards-content">
                <div class="award-image">
                    <div class="image-placeholder large">
                        <i class="fas fa-trophy"></i>
                        <span>ภาพการรับรางวัล</span>
                    </div>
                </div>
                
                <div class="awards-list">
                    <div class="award-item">
                        <div class="award-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <div class="award-content">
                            <h4>รางวัลระบบช่วยเหลือฉุกเฉินยอดเยี่ยม</h4>
                            <p>ประจำปี 2024</p>
                        </div>
                    </div>
                    
                    <div class="award-item">
                        <div class="award-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="award-content">
                            <h4>รางวัลนวัตกรรมเทคโนโลยี</h4>
                            <p>สำหรับระบบติดต่อเจ้าของรถ</p>
                        </div>
                    </div>
                    
                    <div class="award-item">
                        <div class="award-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="award-content">
                            <h4>รางวัลความปลอดภัยดีเด่น</h4>
                            <p>จากกรมการขนส่งทางบก</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">ภาพการใช้งาน</h2>
                <p class="section-description">
                    ภาพการใช้งานจริงจากผู้ใช้บริการทั่วประเทศ
                </p>
            </div>

            <div class="gallery-grid">
                <div class="gallery-item">
                    <div class="image-placeholder">
                        <i class="fas fa-image"></i>
                        <span>การใช้งาน ViiSOS</span>
                    </div>
                </div>
                <div class="gallery-item">
                    <div class="image-placeholder">
                        <i class="fas fa-image"></i>
                        <span>การใช้งาน ViiMOVE</span>
                    </div>
                </div>
                <div class="gallery-item">
                    <div class="image-placeholder">
                        <i class="fas fa-image"></i>
                        <span>ระบบแจ้งซ่อม</span>
                    </div>
                </div>
                <div class="gallery-item">
                    <div class="image-placeholder">
                        <i class="fas fa-image"></i>
                        <span>การติดสติ๊กเกอร์</span>
                    </div>
                </div>
                <div class="gallery-item">
                    <div class="image-placeholder">
                        <i class="fas fa-image"></i>
                        <span>การช่วยเหลือฉุกเฉิน</span>
                    </div>
                </div>
                <div class="gallery-item">
                    <div class="image-placeholder">
                        <i class="fas fa-image"></i>
                        <span>ผู้ใช้งานพึงพอใจ</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Powered by</h2>
                <p class="section-description">
                    พันธมิตรที่ไว้วางใจและสนับสนุนระบบ ViiCheck
                </p>
            </div>

            <div class="partners-grid">
                <div class="partner-item">
                    <div class="partner-logo">
                        <i class="fas fa-building"></i>
                    </div>
                    <span class="partner-name">บริษัท ABC จำกัด</span>
                </div>
                <div class="partner-item">
                    <div class="partner-logo">
                        <i class="fas fa-industry"></i>
                    </div>
                    <span class="partner-name">บริษัท XYZ จำกัด</span>
                </div>
                <div class="partner-item">
                    <div class="partner-logo">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <span class="partner-name">บริษัท DEF จำกัด</span>
                </div>
                <div class="partner-item">
                    <div class="partner-logo">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <span class="partner-name">บริษัท GHI จำกัด</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="logo-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <span class="logo-text">ViiCheck</span>
                    </div>
                    <p class="footer-description">
                        ระบบช่วยเหลือฉุกเฉินและติดต่อเจ้าของรถที่ครอบคลุมทั่วประเทศไทย
                        พร้อมให้บริการ 24 ชั่วโมง
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-line"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4 class="footer-title">บริการ</h4>
                    <ul class="footer-links">
                        <li><a href="#services">ViiSOS ฉุกเฉิน</a></li>
                        <li><a href="#services">ViiMOVE ติดต่อเจ้าของรถ</a></li>
                        <li><a href="#services">ระบบแจ้งซ่อม</a></li>
                        <li><a href="#gallery">ภาพการใช้งาน</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4 class="footer-title">เกี่ยวกับเรา</h4>
                    <ul class="footer-links">
                        <li><a href="#awards">รางวัลที่ได้รับ</a></li>
                        <li><a href="#home">เกี่ยวกับ ViiCheck</a></li>
                        <li><a href="#">ข่าวสาร</a></li>
                        <li><a href="#">ร่วมงานกับเรา</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4 class="footer-title">ติดต่อเรา</h4>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>1234 (24 ชั่วโมง)</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@viicheck.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>กรุงเทพมหานคร, ประเทศไทย</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; 2024 ViiCheck. สงวนลิขสิทธิ์.</p>
                    <div class="footer-bottom-links">
                        <a href="#">นโยบายความเป็นส่วนตัว</a>
                        <a href="#">เงื่อนไขการใช้งาน</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

   <script>
    // Mobile Navigation Toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileNav = document.getElementById('mobileNav');
    const navbar = document.getElementById('navbar');
    
    // Toggle mobile navigation
    mobileMenuBtn.addEventListener('click', function() {
        mobileNav.classList.toggle('active');
        const icon = mobileMenuBtn.querySelector('i');
        
        if (mobileNav.classList.contains('active')) {
            icon.className = 'fas fa-times';
        } else {
            icon.className = 'fas fa-bars';
        }
    });
    
    // Close mobile nav when clicking on links
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileNav.classList.remove('active');
            mobileMenuBtn.querySelector('i').className = 'fas fa-bars';
        });
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            navbar.style.boxShadow = 'none';
        }
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                const offsetTop = targetElement.offsetTop - 80; // Account for fixed navbar
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-on-scroll');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animateElements = document.querySelectorAll('.stat-card, .service-card, .award-item, .gallery-item, .partner-item');
    animateElements.forEach(el => {
        observer.observe(el);
    });
    
    // Stats counter animation
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);
        
        function updateCounter() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start).toLocaleString() + '+';
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString() + '+';
            }
        }
        
        updateCounter();
    }
    
    // Trigger counter animation when stats section is visible
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statValues = entry.target.querySelectorAll('.stat-value');
                statValues.forEach(statValue => {
                    const text = statValue.textContent;
                    const number = parseInt(text.replace(/[^0-9]/g, ''));
                    if (number > 1000) {
                        animateCounter(statValue, number);
                    }
                });
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    const statsSection = document.querySelector('.stats');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }
    
    // Video placeholder click handlers
    const videoPlaceholders = document.querySelectorAll('.video-placeholder');
    videoPlaceholders.forEach(placeholder => {
        placeholder.addEventListener('click', function() {
            // Here you would typically open a modal or redirect to video
            alert('วิดีโอสาธิตจะเปิดที่นี่');
        });
    });
    
    // Gallery item click handlers
    const galleryItems = document.querySelectorAll('.gallery-item');
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            // Here you would typically open a lightbox or larger view
            const itemText = this.querySelector('.image-placeholder span').textContent;
            alert(`เปิดภาพ: ${itemText}`);
        });
    });
    
    // Contact buttons functionality
    const contactButtons = document.querySelectorAll('.btn');
    contactButtons.forEach(button => {
        if (button.textContent.includes('ติดต่อเรา')) {
            button.addEventListener('click', function() {
                // Scroll to contact section
                const contactSection = document.querySelector('#contact');
                if (contactSection) {
                    const offsetTop = contactSection.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        }
        
        if (button.textContent.includes('SOS')) {
            button.addEventListener('click', function() {
                // Here you would typically trigger emergency call or redirect
                alert('เรียกความช่วยเหลือฉุกเฉิน!\nกำลังเชื่อมต่อกับศูนย์ควบคุม...');
            });
        }
    });
    
    // Form validation (if you add contact forms later)
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Loading states for interactive elements
    function showLoading(element) {
        element.classList.add('loading');
        element.style.pointerEvents = 'none';
    }
    
    function hideLoading(element) {
        element.classList.remove('loading');
        element.style.pointerEvents = 'auto';
    }
    
    // Parallax effect for hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('.hero-bg');
        if (parallax) {
            const speed = scrolled * 0.5;
            parallax.style.transform = `translateY(${speed}px)`;
        }
    });
    
    // Add hover effects for better UX
    const hoverElements = document.querySelectorAll('.stat-card, .service-card, .award-item, .partner-item');
    hoverElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Add loading state to page
    window.addEventListener('load', function() {
        document.body.classList.add('loaded');
    });
    
    // Error handling for missing elements
    function safeQuerySelector(selector) {
        const element = document.querySelector(selector);
        if (!element) {
            console.warn(`Element not found: ${selector}`);
        }
        return element;
    }
    
    // Initialize tooltips (if needed)
    function initTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip';
                tooltip.textContent = this.getAttribute('data-tooltip');
                document.body.appendChild(tooltip);
                
                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + rect.width / 2 - tooltip.offsetWidth / 2 + 'px';
                tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
            });
            
            element.addEventListener('mouseleave', function() {
                const tooltip = document.querySelector('.tooltip');
                if (tooltip) {
                    tooltip.remove();
                }
            });
        });
    }
    
    initTooltips();
    
    // Performance optimization: Debounce scroll events
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Apply debounce to scroll events
    const debouncedScrollHandler = debounce(function() {
        // Any expensive scroll operations here
    }, 10);
    
    window.addEventListener('scroll', debouncedScrollHandler);
});

// Utility functions
function formatNumber(num) {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M';
    } else if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'K';
    }
    return num.toString();
}

function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Export functions for potential use in other scripts
window.ViiCheckUtils = {
    formatNumber,
    isElementInViewport,
    validateEmail: function(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
};
   </script>
</body>
</html>