
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation vétérinaire planifiée</title>
</head>
<body>
    <h1>Consultation vétérinaire planifiée</h1>
    <p>Bonjour,</p>
    <p>Votre alerte pour l'animal a été prise en compte. Une consultation a été planifiée :</p>
    <p><strong>Date et Heure :</strong> {{ \Carbon\Carbon::parse($meetingDate)->format('d/m/Y H:i') }}</p>
    {{-- <p><strong>Date et heure :</strong> {{ $meetingDateTime }}</p> --}}
    <p>Voici le lien pour rejoindre la réunion Google Meet : <a href="{{ $meetingUrl }}">{{ $meetingUrl}}</a></p>
    <p>Merci,</p>
    <p>Votre équipe vétérinaire</p>
</body>
</html>
