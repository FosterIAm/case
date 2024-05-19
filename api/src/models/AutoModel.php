<?php
namespace case\models;

use case\connector\Connector;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as MailException;

class AutoModel extends BaseModel
{    
    public function sendMessage()
    {
        $mail = new PHPMailer(true);
        $connector = new Connector;

        $sql = 'SELECT email
                FROM users;';
        
        $query = $connector->getQuery($sql);
        $data = $query->fetch();  

        $moneyModel = new MoneyModel();
        $rate = $moneyModel->getRate();
        $decoded = json_decode($rate);
        $decodedRate = (string)$decoded->{"result"};

        try {
            
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.elasticemail.com';                    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'Case@test.com';                     
            $mail->Password   = '373D36894E3D82A73D208BA02F1CE3FA2ABE';                   
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465; 
            $mail->setFrom('oles_l@i.ua');
            
            foreach($data as $email)
                $mail->addAddress($email);     

            
            $mail->isHTML(true);                                  
            $mail->Subject = 'UAH to USD';
            $mail->Body    = $decodedRate;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (MailException $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}