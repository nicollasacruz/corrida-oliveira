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
        <td style="background-color: #005fe0; padding: 20px; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
            <h1 style="color: #ffffff; font-size: 24px; margin: 0;">🎉 Confirmação de Inscrição 🎉</h1>
        </td>
    </tr>

    <!-- Corpo do E-mail -->
    <tr>
        <td style="padding: 20px; text-align: center;">
            <h2 style="color: #333; font-size: 22px; margin-bottom: 10px;">Olá, <span style="color: #005fe0;">{{ $fullName }}</span>! 👋</h2>
            <span style="color: #005fe0; font-size: 22px">Sua inscrição foi confirmada com sucesso! 🎊</span>
            <p style="color: #555; font-size: 16px; line-height: 1.5;">
                É com prazer que confirmamos a sua inscrição no evento <strong style="color: #005fe0;">{{ $eventName }}</strong>. <br>
            </p>
            <p style="color: #555; font-size: 16px; line-height: 1.5;">
                Estamos ansiosos para contar com a sua participação neste evento cheio de energia e diversão! 🏃‍♂️🏃‍♀️
            </p>
            <p style="color: #555; font-size: 16px; line-height: 1.5;">
                Informamos que o pagamento e o levantamento do seu kit poderão ser efetuados nos seguintes dias e horários:
                <br />
                22 e 23 de Maio de 2025, das 21h às 22h30 na Junta de Freguesia de Oliveira
                <br />
                Também poderá contactar com algum membro da Associação de Pais de Oliveira que ele fará a entrega.
                <br />
                Caso tenha alguma dúvida ou necessite de mais informações, não hesite em contactar-nos.
                <br /><br />
                Agradecemos a sua participação e estamos certos de que será uma experiência inesquecível!
            </p>
        </td>
    </tr>

    <!-- Botão de Ação -->
    <tr>
        <td style="text-align: center; padding: 20px;">
            <a href="https://oliveira.run.place/about" style="background-color: #005fe0; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 6px; font-size: 16px; font-weight: bold; display: inline-block;">
                Ver Detalhes do Evento
            </a>
        </td>
    </tr>

    <!-- Rodapé -->
    <tr>
        <td style="background-color: #f4f4f4; text-align: center; padding: 15px; font-size: 14px; color: #666; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
            <p>Se precisar de ajuda, entre em contacto conosco em <a href="mailto:contacto@oliveira.run.place" style="color: #005fe0; text-decoration: none;">contacto@oliveira.run.place</a></p>
            <p style="margin-top: 8px;">&copy; 2025 Caminhada Colorida de Oliveira. Todos os direitos reservados.</p>
        </td>
    </tr>
</table>

<span class="">Atenciosamente,</span>
<br />
<strong class="">Elisabete Bandeira</strong>
<br />
<span class="">Tesoureira</span>
<br />
<strong class="">Associação de Pais de Oliveira</strong>

</body>
</html>
