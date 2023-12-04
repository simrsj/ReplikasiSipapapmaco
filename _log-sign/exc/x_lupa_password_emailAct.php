<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/SM/vendor/phpmailer/src/Exception.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/SM/vendor/phpmailer/src/PHPMailer.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/SM/vendor/phpmailer/src/SMTP.php";

// echo "<pre>";
// echo print_r($_POST);
// echo "</pre>";

$sql_email = "SELECT * FROM tb_user WHERE email_user = '" . $_POST['email'] . "'";
try {
    $q_email = $conn->query($sql_email);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA EMAIL USER-');";
    echo "document.location.href='?error404';</script>";
}
$d_email = $q_email->fetch(PDO::FETCH_ASSOC);

$id_user = $d_email['id_user'];
$nama_user = $d_email['nama_user'];
$email_user = $_POST['email'];

$crypt = urlencode(base64_encode(date('Ymd') . '_' . $id_user . '_' .  $email_user .  '_' . $nama_user . '"'));

$urlserver = "http://namadomain.com"; //ISIKAN DOMAIN WEBSITE

$isi_email = "
<!DOCTYPE html>
<html>

<head>
    <title>SM - RESET PASSWORD</title>
    <style type='text/css'>
        .body {
            font-family: Arial, Helvetica, sans-serif;
            /* width: 100%; */
            /* max-width: 60%; */
            margin: auto;
            /* padding: 10px; */
            /* border: 2px solid #ccc !important; */
            /* border-radius: 16px; */
            background: rgb(236, 239, 244);
            word-wrap: break-word;
        }

        .container {
            width: 100%;
            /* margin: 0 auto; */
            padding: 10px 10px 10px 10px;
            /* Center the DIV horizontally */
            background: #fff;
            font-size: 12px;
            max-width: 60%;
        }

        .fixed-header,
        .fixed-footer {
            /* border-radius: 13px; */
            width: 100%;
            background: #4e73df;
            padding: 10px 10px 10px 10px;
            color: #fff;
            top: 50%;
            text-align: center;
            max-width: 60%;
            text-decoration: none;
        }

        .fixed-header {
            top: 0;
            font-size: 16px;
        }

        .fixed-footer {
            bottom: 0;
            font-size: 10px;
        }

        .btn {
            background-color: #4e73df;
            /* Green */
            border: none;
            color: white;
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .btn-primary {
            background-color: white;
            color: #4e73df;
            border: 2px solid #4e73df;
        }

        .btn-primary:hover {
            background-color: #4e73df;
            color: white;
        }
    </style>
</head>

<body>
    <div class='body'>
        <center>
            <div class='fixed-header'>
                <b>
                    SIPAPAP MACO<br>
                    (Sistem Informasi Pendaftaran Penjadwalan Praktikan Mahasiswa dan Co-Ass)

                </b>
            </div>
            <div class='container'>
                Silahkan Lakukan <i>Reset Password</i> dengan Menekan tombol dibawah : <br>
                <a class='btn btn-primary' href='" . $urlserver . "?forgot_pass_user&crypt=" . $crypt . "' target=' _blank'>Klik Disini</a>
            </div>
            <div class='fixed-footer '>
                RS Jiwa Provinsi Jawa Barat <?= date('Y') ?>
                RS Jiwa Provinsi Jawa Barat<br>Jl. Kolonel Maturi KM.7, Desa Jambudipa, Kec. Cisarua, Kab. Bandung Barat, 40551<br>
                www.rsj.jabarprov.go.id, email : rsj@jabarprov.go.id
            </div>
        </center>
    </div>
</body>

</html>
";

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->isSMTP();
    $mail->Host = 'namadomain.host.com'; //ISIKAN HOST EMAIL
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 0; //UBAH NOMOR SESUAI DENGAN PORT HOST EMAIL
    $mail->Username = 'namaemaildisini@email.com'; // ISIKAN EMAIL
    $mail->Password = 'isikanpassword'; // ISIKAN PASSWORD EMAIL

    // Sender and recipient settings
    $mail->setFrom('namaemaildisini@email.com', 'SIPAPAP MACO - RESET PASSWORD'); //ISIKAN EMAIL PENGIRIM
    $mail->addAddress($email_user, $nama_user);
    // $mail->addReplyTo("nama_email_tambahan@email.com", "RECEIVER");

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "RESET PASSWORD AKUN SIPAPAP MACO";
    $mail->Body = $isi_email;
    // $mail->AltBody = 'Teks Alternatif';
    // $mail->addAttachment('tambahan_file.nama_extensi');
    if ($mail->send()) {
        $sql_update = "UPDATE tb_user SET ";
        $sql_update .= " hash_password_user = '" . $crypt . "'";
        $sql_update .= " WHERE id_user = " . $id_user;
        // echo $sql_update . "<br>";
        $conn->query($sql_update);
        echo json_encode(['ket' => 'Sukses']);
    } else {
        echo json_encode(['ket' => 'Gagal']);
    }
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}
