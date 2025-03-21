<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Inscrição</title>
</head>

<body style="background-color: #f4f4f4; margin: 0; padding: 0; font-family: Arial, sans-serif;">

<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin: 20px auto; max-width: 600px; background-color: #ffffff; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
    <!-- Cabeçalho -->
    <tr>
        <td style="background-color: #FF9800; padding: 20px; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
            <h1 style="color: #ffffff; font-size: 24px; margin: 0;">🎉 Confirmação de Inscrição 🎉</h1>
        </td>
    </tr>

    <!-- Corpo do E-mail -->
    <tr>
        <td style="padding: 20px; text-align: center;">
            <h2 style="color: #333; font-size: 22px; margin-bottom: 10px;">Olá, <span style="color: #FF9800;">{{ $fullName }}</span>! 👋</h2>
            <p style="color: #555; font-size: 16px; line-height: 1.5;">
                Muito obrigado por se inscrever no evento <strong style="color: #FF9800;">{{ $eventName }}</strong>. <br>
                Sua inscrição foi confirmada com sucesso! 🎊
            </p>
        </td>
    </tr>

    <!-- Botão de Ação -->
    <tr>
        <td style="text-align: center; padding: 20px;">
            <a href="https://oliveira.run.place/about" style="background-color: #FF9800; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 6px; font-size: 16px; font-weight: bold; display: inline-block;">
                Ver Detalhes do Evento
            </a>
        </td>
    </tr>

    <!-- Rodapé -->
    <tr>
        <td style="background-color: #f4f4f4; text-align: center; padding: 15px; font-size: 14px; color: #666; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
            <p>Se precisar de ajuda, entre em contacto conosco em <a href="mailto:contacto@oliveira.run.place" style="color: #FF9800; text-decoration: none;">contacto@oliveira.run.place</a></p>
            <p style="margin-top: 8px;">&copy; 2025 Caminhada Colorida de Oliveira. Todos os direitos reservados.</p>
        </td>
    </tr>
</table>

</body>
</html>
