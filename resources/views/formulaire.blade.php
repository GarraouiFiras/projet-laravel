<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Voiture - Showroom</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('assets/img/art.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
            padding: 20px;
        }

        .showroom-container {
            width: 100%;
            max-width: 900px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            animation: fadeIn 1s ease-in-out;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 150px;
            height: auto;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-title h2 {
            font-size: 2.2em;
            font-weight: 600;
            margin-bottom: 10px;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3));
        }

        .section-title p {
            font-size: 1.1em;
            color: rgba(255, 255, 255, 0.8);
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            margin-bottom: 22px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            font-size: 1em;
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            outline: none;
            border-color: #6c63ff;
            background-color: rgba(255, 255, 255, 0.25);
            box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3e%3cpath d='M7 10l5 5 5-5z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 20px;
        }

        /* Styles pour les options du select */
        select.form-control option {
            background-color: #2a2a2a;
            color: #fff;
            padding: 10px;
        }

        select.form-control option:hover {
            background-color: #6c63ff !important;
        }

        select.form-control option:checked {
            background-color: #4e46cc;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .file-label {
            display: block;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .btn-primary {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #6c63ff 0%, #4e46cc 100%);
            color: #fff;
            font-size: 1.1em;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(108, 99, 255, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(108, 99, 255, 0.4);
        }

        .btn-primary:active {
            transform: translateY(1px);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
        }

        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 15px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        input[type="file"] {
            opacity: 0.9;
            padding: 12px 0;
        }

        input[type="file"]::file-selector-button {
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            margin-right: 15px;
            transition: all 0.3s;
        }

        input[type="file"]::file-selector-button:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            
            .showroom-container {
                padding: 30px 20px;
                backdrop-filter: blur(5px);
            }

            .section-title h2 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="showroom-container">
        <!-- Logo -->
        <div class="logo">
            <img src="assets/img/logoo.png" alt="Logo Showroom">
        </div>

        <!-- Section Title -->
        <div class="section-title">
            <h2>Ajouter une Voiture au Showroom</h2>
            <p>Formulaire d'ajout du véhicule dans le showroom</p>
        </div>

        <!-- Car Form -->
        <form action="{{ route('produit.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" placeholder="Nom de la Voiture" required>
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="model" required>
                        <option value="" disabled selected>Sélectionnez un modèle</option>
                        @if(isset($models) && $models->count() > 0)
                            @foreach($models as $model)
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endforeach
                        @else
                            <option value="" disabled>Aucun modèle disponible</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="year" placeholder="Année de fabrication" required>
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="price" placeholder="Prix (TND)" required>
                </div>
                <div class="col-md-12">
                    <label class="file-label">Image du véhicule :</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control" name="description" rows="4" placeholder="Description technique et caractéristiques..."></textarea>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn-primary">
                        Ajouter la Voiture
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Script pour améliorer l'expérience du select -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('select.form-control');
            
            selects.forEach(select => {
                // Changement de style au focus
                select.addEventListener('focus', function() {
                    this.style.backgroundColor = 'rgba(255,255,255,0.3)';
                });
                
                // Retour au style normal quand perds le focus
                select.addEventListener('blur', function() {
                    this.style.backgroundColor = 'rgba(255,255,255,0.15)';
                });
                
                // Animation lors de l'ouverture
                select.addEventListener('mousedown', function() {
                    this.style.transform = 'scale(0.98)';
                });
                
                select.addEventListener('mouseup', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>