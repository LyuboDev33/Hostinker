<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Потвърждение на акаунт</title>
</head>
<body style="margin:0; padding:0; background:#f4f6f9; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">

                <table
                    width="600"
                    cellpadding="0"
                    cellspacing="0"
                    style="background:#ffffff;
                        border-radius:10px;
                        padding:40px;
                        display: block;
                        box-shadow:0 5px 15px rgba(0,0,0,0.05);">

                    <!-- HEADER -->
                    <tr>
                        <td align="center" style="padding-bottom:20px;">
                            <h2 style="margin:0; color:#333;">
                                <img
                                 style="height: 130px !important;"
                                 src="{{ $appURL }}/assets/images/logo-dark.png" alt="Rabotazamen Logo">
                            </h2>
                        </td>
                    </tr>

                    <!-- TITLE -->
                    <tr>
                        <td style="padding-bottom:20px;">
                            <h3 style="margin:0; color:#222;">
                                Потвърдете своя акаунт
                            </h3>
                        </td>
                    </tr>

                    <!-- GREETING -->
                    <tr>
                        <td style="color:#555; font-size:15px; line-height:1.6;">
                            Здравейте, <strong>{{ $user->name ?? '' }}</strong>!
                            <br><br>
                            Благодарим ви, че се регистрирахте в <strong>Hosthinker</strong>.
                            <br>
                            Моля, потвърдете своя имейл адрес, за да активирате акаунта си.
                        </td>
                    </tr>

                    <!-- BUTTON -->
                    <tr>
                        <td align="center" style="padding:35px 0;">
                            <a href="{{ $url }}"
                               style="display:inline-block; background:#007bff; color:#ffffff; padding:14px 28px; text-decoration:none; border-radius:6px; font-weight:bold; font-size:15px;">
                                Потвърди акаунта
                            </a>
                        </td>
                    </tr>

                    <!-- FALLBACK -->
                    <tr>
                        <td style="font-size:13px; color:#888; line-height:1.5;">
                            Ако бутонът не работи, копирайте и поставете този линк в браузъра си:
                            <br><br>
                            <span style="word-break: break-all; color:#007bff;">
                                {{ $url }}
                            </span>
                        </td>
                    </tr>

                    <!-- WARNING -->
                    <tr>
                        <td style="padding-top:25px; font-size:13px; color:#999;">
                            Ако не сте създали акаунт, можете да игнорирате този имейл.
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="padding-top:30px; border-top:1px solid #eee; text-align:center; font-size:12px; color:#aaa;">
                            © {{ date('Y') }} Hosthinker. Всички права запазени.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
