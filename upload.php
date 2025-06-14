<?php
$uploadDir = "uploads/";

if (!isset($_FILES['selfie']) || $_FILES['selfie']['error'] != 0) {
    die("Fehler beim Hochladen.");
}

$filename = uniqid("selfie_") . "." . pathinfo($_FILES['selfie']['name'], PATHINFO_EXTENSION);
$filepath = $uploadDir . basename($filename);

if (move_uploaded_file($_FILES['selfie']['tmp_name'], $filepath)) {
    // E-Mail an Betreiber
    $to = "DEINE_EMAIL@domain.de";
    $subject = "📷 Neues Selfie eingegangen";
    $message = "Ein Selfie wurde erfolgreich hochgeladen: $filename";
    $headers = "From: info@deineseite.de";

    mail($to, $subject, $message, $headers);

    // Weiterleitung zur nächsten Seite
    header("Location: weiter3.html");
    exit;
} else {
    echo "Fehler beim Speichern des Bildes.";
}
?>