<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GF Showroom</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .car-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .car-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            transition: box-shadow 0.3s ease;
        }

        .car-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .car-details {
            margin-top: 10px;
        }

        .car-type {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .car-price {
            color: #e74c3c;
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .car-description {
            color: #555;
            font-size: 0.9em;
            line-height: 1.5;
        }

        .alert {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Nos Voitures</h1>

    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="car-container">
    @foreach ($cars as $car)
        <div class="car-card">
        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="img-fluid">

            <div class="car-details">
                <div class="car-type">{{ $car->name }}</div>
                <div class="car-price">{{ $car->price }}</div>
                <div class="car-description">{{ $car->description }}</div>
            </div>
        </div>
    @endforeach
</div>


</body>
</html>
