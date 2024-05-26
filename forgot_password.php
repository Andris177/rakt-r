<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'db_connection.php'; // Ahol az adatbázis kapcsolódási fájlod található

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Ellenőrizd, hogy az e-mail cím létezik-e az adatbázisban
    $stmt = $conn->prepare("SELECT id FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generálj egy egyedi tokent
        $token = bin2hex(random_bytes(50));
        $token_valid_until = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Tárold a tokent és a lejárati időt az adatbázisban
        $stmt = $conn->prepare("UPDATE Users SET token = ?, token_valid_until = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $token_valid_until, $email);
        $stmt->execute();

        // Küldj egy e-mailt a felhasználónak a visszaállító linkkel
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.example.com'; // SMTP szerver címe
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your_email@example.com'; // SMTP felhasználónév
            $mail->Password   = 'your_email_password'; // SMTP jelszó
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('noreply@yourwebsite.com', 'Your Website');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Jelszó visszaállítás';
            $reset_link = "http://yourwebsite.com/reset_password.php?token=" . $token;
            $mail->Body    = 'Kérjük kattints a következő linkre a jelszó visszaállításához: <a href="' . $reset_link . '">' . $reset_link . '</a>';

            $mail->send();
            echo 'Jelszó visszaállító link elküldve az e-mail címedre.';
        } catch (Exception $e) {
            echo "Hiba történt az e-mail küldésekor. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Nincs ilyen e-mail cím regisztrálva.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Elfelejtett jelszó</title>
</head>
<body>
    <h2>Elfelejtetted a jelszavad?</h2>
    <form method="post" action="">
        <label for="email">E-mail cím:</label>
        <input type="email" name="email" required>
        <button type="submit">Küldés</button>
    </form>
</body>
</html>
