<!-- resources/views/produit/formulaire.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Voiture</title>
    <style>
        /* Styles pour la section Showroom */
        .showroom {
            padding: 60px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-title h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section-title p {
            font-size: 16px;
            color: #666;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Ajouter une Voiture au Showroom</h2>
            <p>Formulaire d'ajout du car dans le showroom</p>
        </div>

        <div class="container">
            <!-- Car Form -->
            <form action="{{ route('produit.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row gy-4">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" placeholder="Nom de la Voiture" required>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="model" required>
                            <option value="">Sélectionnez un modèle</option>
                            @if(isset($models) && $models->count() > 0)
                                @foreach($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            @else
                                <option value="">Aucun modèle disponible</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="year" placeholder="Année de la Voiture" required>
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="price" placeholder="Prix de la Voiture" required>
                    </div>
                    <div class="col-md-12">
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" name="description" rows="4" placeholder="Description de la Voiture"></textarea>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Ajouter la Voiture</button>
                    </div>
                </div>
            </form>
        </div>

   

</body>
</html>