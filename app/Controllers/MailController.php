<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Validation\Validator;

class MailController extends Controller
{

    public function send()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'min:3'],
            'message' => ['required', 'min:3'],
        ]);

        if($errors) {
            $_SESSION['errors'][] = $errors;
            $url = URL;
            $this->redirect($url);
        }else{
            // Create a new instance
            $mail = new PHPMailer(true);

            try {
                // SMTP server configuration
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = '35af76a202727f';
                $mail->Password = '95e8d666a9f367';

                // Mail parameters
                $to = "lisa.vincent31150@gmail.com";
                $subject = "Nouvelle demande de contact";
                $content = "Nom : " . $_POST['name'] . "\n";
                $content .= "Email : " . $_POST['email'] . "\n";
                $content .= "Message : " . $_POST['message'];

                // Configuration of from and to addresses
                $mail->setFrom($_POST['email'], $_POST['name']);
                $mail->addAddress($to);

                // Message Content
                $mail->isHTML(false);
                $mail->Subject = $subject;
                $mail->Body = $content;

                // Sending Mail
                $mail->send();

                $_SESSION['message'] = 'Votre email a été envoyé avec succès !';
                $url = URL.'?success=true';
                $this->redirect($url);
            } catch (Exception $e) {
                $_SESSION['errors'][] = 'Oups ! On dirait qu\'une erreur s\'est produite : ' . $mail->ErrorInfo;
                $url = URL;
                $this->redirect($url);
            }
        }
    }
}

?>