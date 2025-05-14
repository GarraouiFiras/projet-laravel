<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - GF Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Gp
  * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
  * Updated: Aug 15 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
      <h1 class="sitename">Showroom GF</h1>
      
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="#hero" class="active">Accueil</a></li>
        <li><a href="#about">À propos</a></li>
        <li><a href="/produit">Produits</a></li>
        <li><a href="#services">Showroom</a></li>
        <li><a href="#testimonials">Témoignages</a></li>
        <li><a href="#team">Équipe</a></li>
        <li><a href="#contact">Contact</a></li>
        <li class="dropdown"><a href="#"><span>Options</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="#">Nos Magasins</a></li>
            <li><a href="#">Catalogue</a></li>
            <li><a href="#">Services Personnalisés</a></li>
            @auth
      @if(auth()->user()->role === 'admin') <!-- Vérification du rôle admin -->
      <li><a href="{{ route('formulaire') }}">Ajouter une Voiture</a></li> <!-- Bouton Ajouter une Voiture -->
      <li><a href="/users">Users</a></li> <!-- Option Users -->
      <li><a href="/statistiques">Statistiques</a></li> <!-- Statistiques -->
      @endif
    @endauth 
          </ul>
        </li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    
    <a class="btn-getstarted" href="/signup">signUp</a>
    <a class="btn-getstarted" href="/login">Login</a> <!-- Bouton Login -->
    @auth
    <a class="btn-getstarted" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
@endauth
    @auth
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        <button type="submit" class="btn-getstarted">Logout</button>
    </form>
@endauth

  </div>
</header>


  <main class="main">

  <section id="hero" class="hero section dark-background">

  <img src="assets/img/art.jpg" alt="Showroom de voitures" data-aos="fade-in">

  <div class="container">
    <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
      <div class="col-xl-6 col-lg-8">
        <h2>Découvrez Nos Voitures de Luxe Au Showroom GF</h2>
        <p>Un large choix de véhicules premium, adaptés à vos besoins et à votre style</p>
      </div>
    </div>

    <div class="row gy-4 mt-5 justify-content-center" data-aos="fade-up" data-aos-delay="200">
      <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="icon-box">
          <i class="bi bi-speedometer2"></i>
          <h3><a href="">Performance</a></h3>
        </div>
      </div>
      <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="400">
        <div class="icon-box">
          <i class="bi bi-lightning"></i>
          <h3><a href="">Innovations</a></h3>
        </div>
      </div>
      <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="500">
        <div class="icon-box">
          <i class="bi bi-car-front"></i>
          <h3><a href="">Design Élégant</a></h3>
        </div>
      </div>
      <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="600">
        <div class="icon-box">
          <i class="bi bi-fuel-pump"></i>
          <h3><a href="">Efficacité Énergétique</a></h3>
        </div>
      </div>
      <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="700">
        <div class="icon-box">
          <i class="bi bi-stars"></i>
          <h3><a href="">Confort Luxueux</a></h3>
        </div>
      </div>
    </div>

  </div>

</section><!-- /Section Hero -->


   <!-- Section À propos -->
<section id="about" class="about section">

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="row gy-4">
    <div class="col-lg-6 order-1 order-lg-2">
      <img src="assets/img/art.jpg" class="img-fluid" alt="Showroom de voitures de luxe">
    </div>
    <div class="col-lg-6 order-2 order-lg-1 content">
      <h3>Bienvenue chez GF Showroom</h3>
      <p class="fst-italic">
        Chez GF Showroom, nous vous proposons une sélection exclusive de voitures de luxe, conçues pour offrir une expérience de conduite exceptionnelle.
      </p>
      <ul>
        <li><i class="bi bi-check2-all"></i> <span>Des modèles récents de marques prestigieuses, disponibles pour essai et achat.</span></li>
        <li><i class="bi bi-check2-all"></i> <span>Une équipe d'experts à votre disposition pour vous conseiller et répondre à toutes vos questions.</span></li>
        <li><i class="bi bi-check2-all"></i> <span>Un service personnalisé pour vous garantir une expérience d'achat unique et sur-mesure.</span></li>
      </ul>
      <p>
        Que vous soyez à la recherche d'une voiture sportive, d'un SUV spacieux ou d'une berline élégante, GF Showroom vous propose une gamme variée pour répondre à toutes vos attentes. Venez découvrir notre espace moderne, conçu pour mettre en valeur chaque véhicule.
      </p>
    </div>
  </div>

</div>

</section><!-- /Section À propos -->


    <!-- Clients Section -->
<section id="clients" class="clients section">

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="swiper init-swiper">
    <script type="application/json" class="swiper-config">
      {
        "loop": true,
        "speed": 600,
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": "auto",
        "pagination": {
          "el": ".swiper-pagination",
          "type": "bullets",
          "clickable": true
        },
        "breakpoints": {
          "320": {
            "slidesPerView": 2,
            "spaceBetween": 40
          },
          "480": {
            "slidesPerView": 3,
            "spaceBetween": 60
          },
          "640": {
            "slidesPerView": 4,
            "spaceBetween": 80
          },
          "992": {
            "slidesPerView": 6,
            "spaceBetween": 120
          }
        }
      }
    </script>
    <div class="swiper-wrapper align-items-center">
      <!-- Remplace les images par des logos de marques de voitures -->
      <div class="swiper-slide"><img src="assets/img/clients/logo-toyota.png" class="img-fluid" alt="Toyota"></div>
      <div class="swiper-slide"><img src="assets/img/clients/logo-bmw.jpg" class="img-fluid" alt="BMW"></div>
      <div class="swiper-slide"><img src="assets/img/clients/logo-audi.png" class="img-fluid" alt="Audi"></div>
      <div class="swiper-slide"><img src="assets/img/clients/logo-mercedes.jpg" class="img-fluid" alt="Mercedes"></div>
      <div class="swiper-slide"><img src="assets/img/clients/logo-ford.jpg" class="img-fluid" alt="Ford"></div>
      <div class="swiper-slide"><img src="assets/img/clients/logo-honda.png" class="img-fluid" alt="Honda"></div>
      <div class="swiper-slide"><img src="assets/img/clients/logo-nissan.jpg" class="img-fluid" alt="Nissan"></div>
      <div class="swiper-slide"><img src="assets/img/clients/logo-volkswagen.jpg" class="img-fluid" alt="Volkswagen"></div>
    </div>
    <div class="swiper-pagination"></div>
  </div>

</div>

</section><!-- /Clients Section -->
    <!-- Features Section -->
<section id="features" class="features section">

<div class="container">

  <div class="row gy-4">
    <!-- Remplace l'image d'arrière-plan -->
    <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100">
      <img src="assets/img/showroom.jpg" alt="Intérieur du showroom">
    </div>
    <div class="col-lg-6">

      <!-- Feature 1 : Large sélection de véhicules -->
      <div class="features-item d-flex ps-0 ps-lg-3 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="200">
        <i class="bi bi-car-front flex-shrink-0"></i>
        <div>
          <h4>Large sélection de véhicules</h4>
          <p>Découvrez notre vaste collection de voitures neuves et d'occasion, toutes marques et modèles confondus.</p>
        </div>
      </div><!-- End Features Item-->

      <!-- Feature 2 : Services de maintenance professionnels -->
      <div class="features-item d-flex mt-5 ps-0 ps-lg-3" data-aos="fade-up" data-aos-delay="300">
        <i class="bi bi-gear flex-shrink-0"></i>
        <div>
          <h4>Services de maintenance</h4>
          <p>Profitez de services de maintenance professionnels pour garder votre véhicule en parfait état.</p>
        </div>
      </div><!-- End Features Item-->

      <!-- Feature 3 : Options de financement flexibles -->
      <div class="features-item d-flex mt-5 ps-0 ps-lg-3" data-aos="fade-up" data-aos-delay="400">
        <i class="bi bi-credit-card flex-shrink-0"></i>
        <div>
          <h4>Financement flexible</h4>
          <p>Nous proposons des options de financement adaptées à vos besoins pour faciliter votre achat.</p>
        </div>
      </div><!-- End Features Item-->

      <!-- Feature 4 : Équipe dédiée et expérimentée -->
      <div class="features-item d-flex mt-5 ps-0 ps-lg-3" data-aos="fade-up" data-aos-delay="500">
        <i class="bi bi-people flex-shrink-0"></i>
        <div>
          <h4>Équipe expérimentée</h4>
          <p>Notre équipe dédiée est à votre disposition pour vous guider et répondre à toutes vos questions.</p>
        </div>
      </div><!-- End Features Item-->

    </div>
  </div>

</div>

</section><!-- /Features Section -->
   <!-- Services Section -->
<section id="services" class="services section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Services</h2>
  <p>Découvrez nos services</p>
</div><!-- End Section Title -->

<div class="container">
  <div class="row gy-4">

    <!-- Premier item : Accessoires -->
    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
      <div class="service-item position-relative">
        <div class="icon">
          <i class="bi bi-car-front"></i>
        </div>
        <a href="{{ route('accessoires.index') }}" class="stretched-link"> <!-- Lien vers la page des accessoires -->
          <h3>Accessoires de voitures</h3>
        </a>
        <p>Découvrez notre large gamme d'accessoires pour personnaliser et améliorer votre véhicule.</p>
      </div>
    </div><!-- End Service Item -->

    @if(Auth::check() && (Auth::user()->role === 'gestionnaire' || Auth::user()->role === 'admin'))
    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
      <div class="service-item position-relative">
        <div class="icon">
          <i class="bi bi-gear"></i>
        </div>
        <a href="{{ route('accessoires.create') }}" class="stretched-link">
          <h3>Ajout des accessoires </h3>
        </a>
        <p>Ce formulaire vous permet d'ajouter un nouvel accessoire à la liste des produits disponibles.</p>
      </div>
    </div><!-- End Service Item -->
    @endif

    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
  <div class="service-item position-relative">
    <div class="icon">
      <i class="bi bi-person-check"></i>
    </div>
    <a href="{{ route('maintenance.create') }}" class="stretched-link"> <!-- Lien vers la page de maintenance -->
      <h3>Service après-vente</h3>
    </a>
    <p>Profitez d'un service de maintenance complet avec des techniciens spécialisés pour l'entretien de vos véhicules.</p>
  </div>
</div><!-- End Service Item -->

@if(Auth::check() && (Auth::user()->role === 'technicien' || Auth::user()->role === 'admin'))
<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
  <div class="service-item position-relative">
    <div class="icon">
      <i class="bi bi-headset"></i>
    </div>
    <a href="{{ route('maintenance.index') }}" class="stretched-link"> <!-- Lien vers la page de maintenance -->
      <h3>Rendez-vous de maintenance</h3>
    </a>
    <p>Consultez et gérez la gestion de toutes les Rendez-vous de maintenance</p>
  </div>
</div><!-- End Service Item -->
@endif

   

    @if(Auth::check() && (Auth::user()->role === 'vendeur' || Auth::user()->role === 'admin'))
    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
    <div class="service-item position-relative">
        <div class="icon">
            <i class="bi bi-cart-check"></i> <!-- Icône représentant les commandes -->
        </div>
        <a href="{{ route('commandes.index') }}" class="stretched-link">
            <h3>Commandes</h3>
        </a>
        <p>Consultez et gérez toutes vos commandes passées. Suivez l'état de vos achats et accédez aux détails.</p>
    </div>
</div><!-- End Service Item -->
@endif

<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
    <div class="service-item position-relative">
        <div class="icon">
            <i class="bi bi-cart-plus"></i> <!-- Icône représentant les commandes -->
        </div>
        <a href="{{ route('commandes.create') }}" class="stretched-link">
            <h3>Passer une commande</h3>
        </a>
        <p>
            Créez une nouvelle commande en sélectionnant les accessoires de votre choix.
        </p>
    </div>
</div><!-- End Service Item -->

  </div>

</div>

</section><!-- /Services Section -->

   <!-- Call To Action Section -->
<section id="call-to-action" class="call-to-action section dark-background">

<!-- Remplace l'image d'arrière-plan -->
<img src="assets/img/cta-bg.jpg" alt="Extérieur du showroom">

<div class="container">
  <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
    <div class="col-xl-10">
      <div class="text-center">
        <!-- Titre accrocheur -->
        <h3>Suivez-nous sur Facebook</h3>

        <!-- Description invitante -->
        <p>Restez connecté avec nous sur Facebook pour découvrir nos dernières offres, promotions et actualités.</p>

        <!-- Bouton avec un lien vers la page Facebook -->
        <a class="cta-btn" href="https://www.facebook.com/profile.php?id=100027746166131" target="_blank">Visitez notre page Facebook</a>
      </div>
    </div>
  </div>
</div>
    </section><!-- /Call To Action Section -->

   

    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center justify-content-between">

          <div class="col-lg-5">
            <img src="assets/img/stats-img.jpg" alt="" class="img-fluid">
          </div>

          <!-- Contenu -->
      <div class="col-lg-6">
        <h3 class="fw-bold fs-2 mb-3">Des chiffres qui parlent d'eux-mêmes</h3>
        <p>
          Depuis notre lancement, nous avons aidé des milliers de clients à trouver la voiture de leurs rêves. Découvrez quelques-unes de nos réalisations.
        </p>

        <!-- Statistiques -->
        <div class="row gy-4">
          <!-- Clients satisfaits -->
          <div class="col-lg-6">
            <div class="stats-item d-flex">
              <i class="bi bi-emoji-smile flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="1500" data-purecounter-duration="1" class="purecounter"></span>
                <p><strong>Clients satisfaits</strong> <span>qui nous font confiance</span></p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <!-- Voitures vendues -->
          <div class="col-lg-6">
            <div class="stats-item d-flex">
              <i class="bi bi-car-front flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="750" data-purecounter-duration="1" class="purecounter"></span>
                <p><strong>Voitures vendues</strong> <span>dans toute la région</span></p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <!-- Années d'expérience -->
          <div class="col-lg-6">
            <div class="stats-item d-flex">
              <i class="bi bi-calendar-check flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1" class="purecounter"></span>
                <p><strong>Années d'expérience</strong> <span>au service de nos clients</span></p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <!-- Partenaires -->
          <div class="col-lg-6">
            <div class="stats-item d-flex">
              <i class="bi bi-handshake flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>
                <p><strong>Partenaires</strong> <span>de confiance</span></p>
              </div>
            </div>
          </div><!-- End Stats Item -->
        </div>
      </div>
    </div>
  </div>

  </section><!-- /Stats Section -->

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section dark-background">

  <img src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          }
        }
      </script>
      <div class="swiper-wrapper">

        <!-- Administrateur -->
        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/firas.jpg" class="testimonial-img" alt="">
            <h3>Administrateur</h3>
            <h4>Gestion du système</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>
                Gère l’ensemble du système :<br>
                - Ajout, modification, suppression des véhicules, accessoires et services de maintenance.<br>
                - Gestion des utilisateurs (clients et employés).<br>
                - Supervision des commandes et des réservations.<br>
                - Accès aux statistiques et aux rapports de vente.
              </span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <!-- Vendeur -->
        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/majd.jpg" class="testimonial-img" alt="">
            <h3>Vendeur</h3>
            <h4>Équipe du showroom</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>
                Rôle principal :<br>
                - Gère les commandes.<br>
                - Assiste les clients dans leurs achats.<br>
                - Fournit des informations sur les véhicules et accessoires.
              </span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <!-- Technicien -->
        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/mohamed.jpg" class="testimonial-img" alt="">
            <h3>Technicien</h3>
            <h4>Équipe du showroom</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>
                Rôle principal :<br>
                - Assure la gestion des services de maintenance.<br>
                - Diagnostique et répare les véhicules.<br>
                - Garantit la qualité des services offerts.
              </span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <!-- Gestionnaire des accessoires -->
        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/amin.jpg" class="testimonial-img" alt="">
            <h3>Gestionnaire des accessoires</h3>
            <h4>Équipe du showroom</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>
                Rôle principal :<br>
                - Ajoute et met à jour les accessoires disponibles à la vente.<br>
                - Gère les stocks et les commandes d’accessoires.<br>
                - Assure la disponibilité des produits pour les clients.
              </span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

      </div>
      <div class="swiper-pagination"></div>
    </div>

  </div>

</section><!-- /Testimonials Section -->

<section id="team" class="team section ">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Équipe</h2>
    <p>Notre équipe</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
        <div class="team-member">
          <div class="member-img">
            <img src="assets/img/team/firas.jpg" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Mouhamed Firas Garraoui</h4>
            <span>Administrateur</span>
          </div>
        </div>
      </div><!-- End Team Member -->

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
        <div class="team-member">
          <div class="member-img">
            <img src="assets/img/team/amin.jpg" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Amin Ben Ali</h4>
            <span>Gestionnaire des accessoires</span>
          </div>
        </div>
      </div><!-- End Team Member -->

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
        <div class="team-member">
          <div class="member-img">
            <img src="assets/img/team/majd.jpg" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Majd Abbassi</h4>
            <span>Vendeur</span>
          </div>
        </div>
      </div><!-- End Team Member -->

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
        <div class="team-member">
          <div class="member-img">
            <img src="assets/img/team/baaq.jpg" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Mouhamed Abbassi</h4>
            <span>Technicien</span>
          </div>
        </div>
      </div><!-- End Team Member -->

    </div>

  </div>

</section><!-- /Team Section -->


    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3236.7439739699375!2d10.018308215338953!3d35.51288998023279!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13029929a1b8c07d%3A0xaecbc4e94793b177!2sHajeb%20Layoun%2C%20Tunisia!5e0!3m2!1sen!2sus!4v1697131981002!5m2!1sen!2sus" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div><!-- End Google Maps -->

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>Kairouan,Hajeb Layoun,3160 </p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>29574024</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>mohamedgarraoui268@gmail.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
              <span class="sitename">GF</span>
            </a>
            <div class="footer-contact pt-3">
              <p>kairouan</p>
              <p>Hajeb Layoun</p>
              <p class="mt-3"><strong>Phone:</strong> <span>+29574024</span></p>
              <p><strong>Email:</strong> <span>mohamedgarraoui268@gmail.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href="https://www.facebook.com/profile.php?id=100027746166131"><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Our Services</h4>
            <ul>
               <li><i class="bi bi-chevron-right"></i> <a href="#"> Car Sales</a></li>
               <li><i class="bi bi-chevron-right"></i> <a href="#"> Vehicle Maintenance</a></li>
               <li><i class="bi bi-chevron-right"></i> <a href="#"> Car Accessories</a></li>
               <li><i class="bi bi-chevron-right"></i> <a href="#"> Customization Services</a></li>
               <li><i class="bi bi-chevron-right"></i> <a href="#"> Vehicle Leasing</a></li>
            </ul>

          </div>

          <div class="col-lg-4 col-md-12 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Subscribe to our showroom and receive the latest news about our products and services!</p>
            <form action="forms/newsletter.php" method="post" class="php-email-form">
              <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="copyright">
      <div class="container text-center">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">GF</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you've purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
          Designed by <a href="https://bootstrapmade.com/">Garraoui Firas</a>
        </div>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>