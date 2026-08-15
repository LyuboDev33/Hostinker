<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <title>Смяна на парола</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px;">

    <div style="max-width:600px; margin:0 auto; background:#ffffff; padding:30px; border-radius:8px;">

        <img style="height: 130px !important;" src="{{ $appURL }}/assets/img/logo-b.png"
            alt="Laso Logo">

        <h2 style="margin-bottom:20px;">Смяна на парола</h2>

        <p>Здравейте, {{ $user->name ?? '' }}</p>

        <p>
            Получихме заявка за смяна на вашата парола.
        </p>

        <p style="text-align:center; margin:30px 0;">
            <a href="{{ $url }}"
                style="background-image: linear-gradient(to right, #ef326f, #fe6c4e, #ef326f, #fe6c4e);
                   color: white; padding:12px 20px; text-decoration:none; border-radius:5px;">
                Смени паролата
            </a>
        </p>

        <p>Линкът изтича след 60 минути.</p>

        <p>Ако не сте поискали това, игнорирайте този имейл.</p>

        <hr style="margin:30px 0;">

        <p style="font-size:12px; color:#999;">
            © {{ date('Y') }} Laso. Всички права запазени.
        </p>

    </div>

</body>

</html>
