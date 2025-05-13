<?php
namespace JCRI\services;

use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class SendNotification {
    private Mailer $mailer;
    public function __construct() {
        // Production emailer
        // $host = 'smtp.example.com';  // Actual SMTP Address
        // $port = 587;                 // Common ports: 25, 465, 587
        // $encryption = 'tls';         // 'tls', 'ssl', or null/false for no encryption
        // $username = 'your_username'; // smtp username
        // $password = 'your_password'; // smtp password
        // // Set authentication if required
        // $transport->setUsername($username);
        // $transport->setPassword($password);
        // $transport = new EsmtpTransport($host, $port, $encryption);
        
        // Local emailer
        $transport = new EsmtpTransport('localhost', 1025, false);
        $this->mailer = new Mailer($transport);

        // Mail content call to action button redirect URL
        $this->frontend_url = "http://localhost/JCRI";
    }
    
    /**
     * Send an email notification
     * @param string $to Recipient email address
     * @param string $subject Email subject
     * @param string $textContent Plain text content
     * @param string|null $htmlContent HTML content (optional)
     * @param string $from Sender email address (optional)
     * @param string $fromName Sender name (optional)
     * @return bool True if email was sent successfully
     */
    public function sendEmail(
        string $to, 
        string $subject, 
        string $textContent, 
        ?string $htmlContent = null, 
        string $from = 'noreply@example.com', 
        string $fromName = 'JCRI Notification'
    ): bool {
        try {
            $email = (new Email())
                ->from(new Address($from, $fromName))
                ->to($to)
                ->subject($subject)
                ->text($textContent);
            if ($htmlContent) {
                $email->html($htmlContent);
            }
            $this->mailer->send($email);
            
            return true;
        } catch (\Exception $e) {
            error_log('Email sending failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send a job posting notification using the job details template
     * @param string $to Recipient email
     * @param array $jobData Job details array
     * @return bool True if email was sent successfully
     */
    public function sendTemplatedEmail(
        string $to, 
        array $jobData
    ): bool {
        $subject = 'Job Opportunity: ' . $jobData['title'];
        $textContent = "Job Details\n\n";
        $textContent .= "Date Posted: " . $jobData['datePosted'] . "\n";
        $textContent .= "Position: " . $jobData['title'] . "\n";
        $textContent .= "Company: " . $jobData['company'] . ", " . $jobData['location'] . "\n\n";
        $textContent .= "Job Details:\n";
        $textContent .= "Job Setting: " . $jobData['setting'] . "\n";
        $textContent .= "Salary: ₱ " . $jobData['salary'] . "\n";
        if (isset($jobData['sex'])) {
            $textContent .= "Preferred Sex: " . $jobData['sex'] . "\n";
        }
        $textContent .= "\nQualification/Work Experience:\n";
        $textContent .= $jobData['experience'] . "\n\n";
        $textContent .= "Job Description:\n";
        $textContent .= $jobData['description'] . "\n";
        
        $htmlContent = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset=\"UTF-8\">
            <title>{$subject}</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #0056a4; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; }
                .job-title { font-size: 24px; margin-bottom: 5px; }
                .company { color: #555; margin-bottom: 20px; }
                .section { margin-bottom: 20px; }
                .section-title { font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 10px; }
                .detail-label { font-weight: bold; min-width: 150px; display: inline-block; }
                .detail-row { margin-bottom: 8px; }
                .apply-button { background-color: #4698db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; margin-top: 15px; }
                .icon { vertical-align: middle; margin-right: 10px; }
            </style>
        </head>
        <body>
            <div class=\"container\">
                <div class=\"header\">
                    <h1>Job Details</h1>
                </div>
                
                <div class=\"content\">
                    <div class=\"section\">
                        <p>Date Posted: {$jobData['datePosted']}</p>
                        
                        <table>
                            <tr>
                                <td>
                                    <h2 class=\"job-title\">{$jobData['title']}</h2>
                                    <p class=\"company\">{$jobData['company']}, {$jobData['location']}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class=\"section\">
                        <h3 class=\"section-title\">Job Details:</h3>
                        <div class=\"detail-row\">
                            <span class=\"detail-label\">Job Setting:</span> {$jobData['setting']}
                        </div>
                        <div class=\"detail-row\">
                            <span class=\"detail-label\">Salary:</span> ₱ {$jobData['salary']}
                        </div>";
        
        if (isset($jobData['sex'])) {
            $htmlContent .= "
                        <div class=\"detail-row\">
                            <span class=\"detail-label\">Preferred Sex:</span> {$jobData['sex']}
                        </div>";
        }
        
        $htmlContent .= "
                    </div>
                    
                    <div class=\"section\">
                        <h3 class=\"section-title\">Qualification/Work Experience:</h3>
                        <p>{$jobData['experience']}</p>
                    </div>
                    
                    <div class=\"section\">
                        <h3 class=\"section-title\">Job Description:</h3>
                        <p>{$jobData['description']}</p>
                    </div>
                    
                    <a href=\"{$this->frontend_url}/index.php?q=apply&job={$jobData['id']}\" class=\"apply-button\">Apply Now!</a>
                </div>
            </div>
        </body>
        </html>";
        
        return $this->sendEmail($to, $subject, $textContent, $htmlContent);
    }
}