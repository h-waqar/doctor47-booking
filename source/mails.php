<php
        
        $admin_message = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: "Segoe UI", Arial, sans-serif; color: #333; background-color: #f7f9fb; margin: 0; padding: 20px; }
        .email-wrapper { background: #fff; border-radius: 10px; max-width: 720px; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.05); overflow: hidden; }
        .header { background-color: #3c72c8; color: #fff; padding: 25px 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 600; }
        .content { padding: 25px 35px; }
        h2 { color: #3c72c8; font-size: 20px; margin-bottom: 10px; }
        table { border-collapse: collapse; width: 100%; margin: 20px 0; border-radius: 8px; overflow: hidden; }
        td { padding: 10px 15px; border: 1px solid rgba(0,0,0,0.15); }
        .label { width: 35%; font-weight: 600; background-color: #f2f5f9; }
        .value { width: 65%; background: #fff; }
        .footer { background-color: #f2f5f9; padding: 20px; text-align: center; font-size: 13px; color: #666; }
        .icon { font-size: 18px; vertical-align: middle; margin-right: 6px; }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <h1>📩 New Booking Received</h1>
        </div>
        <div class="content">
            <p>Dear Administrator,</p>
            <p>🎉 You have received a new booking through <strong>' . esc_html($booking_data['website_title']) . '</strong>. Below are the details of the recent booking request:</p>

            <table>
                <tr>
                    <td class="label">📋 Booking ID</td>
                    <td class="value">' . esc_html($booking_data['booking_id']) . '</td>
                </tr>
                <tr>
                    <td class="label">👤 First Name</td>
                    <td class="value">' . esc_html($booking_data['first_name']) . '</td>
                </tr>
                <tr>
                    <td class="label">👤 Last Name</td>
                    <td class="value">' . esc_html($booking_data['last_name']) . '</td>
                </tr>
                <tr>
                    <td class="label">📅 Booking Date</td>
                    <td class="value">' . esc_html($booking_data['booking_date']) . '</td>
                </tr>
                <tr>
                    <td class="label">✉️ Email Address</td>
                    <td class="value">' . esc_html($booking_data['email']) . '</td>
                </tr>
                <tr>
                    <td class="label">📞 Phone Number</td>
                    <td class="value">' . esc_html($booking_data['phone']) . '</td>
                </tr>
                <tr>
                    <td class="label">🏨 Hotel / Home Address</td>
                    <td class="value">' . esc_html($email_hotel_name) . '</td>
                </tr>
                <tr>
                    <td class="label">🌴 Island</td>
                    <td class="value">Mahee Island</td>
                </tr>
                <tr>
                    <td class="label">💊 Selected Test/Service</td>
                    <td class="value">' . esc_html($email_service) . '</td>
                </tr>
                <tr>
                    <td class="label">📆 Appointment Date</td>
                    <td class="value">' . esc_html($booking_data['test_date']) . '</td>
                </tr>
                <tr>
                    <td class="label">💳 Payment Amount</td>
                    <td class="value">€' . $grand_total_amount_to_be_charged . '</td>
                </tr>
            </table>

            <p>🔍 For complete details, visit your WordPress admin dashboard or check your bookings section on the website.</p>
            <p>Thank you for using <strong>' . esc_html($booking_data['website_title']) . '</strong>.</p>
        </div>
        <div class="footer">
            <p>© ' . date('Y') . ' ' . esc_html(get_bloginfo('name')) . '. All rights reserved.</p>
            <p>📍 <a href="' . esc_url(home_url()) . '" style="color:#3c72c8; text-decoration:none;">Visit Website</a></p>
        </div>
    </div>
</body>
</html>
';



        $service_full = $booking_data['service'];
        $service_parts = explode(',', $service_full);
        $service_clean = trim($service_parts[0]); // Take only text before first comma
        $admin_email = get_option('admin_email');

        // ============================================
        // CUSTOMER CONFIRMATION EMAIL (Clean Format)
        // ============================================
        $customer_message = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .company-name {
            font-weight: bold;
        }
        .booking-section li {
            margin: 5px 0;
        }
        .tagline {
            font-style: italic;
            margin-top: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="greeting">
        <p>Dear ' . $booking_data['full_name'] . ',</p>
    </div>

    <div class="intro">


                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:615px" align="center">
                              <tbody>
                                <tr>
                                  <td role="modules-container" style="padding:0;color:#000;text-align:left" bgcolor="#FFFFFF" width="100%" align="left">





                                    <table role="module" border="0" cellpadding="0" cellspacing="0" width="100%" style="display:none!important;opacity:0;color:transparent;height:0;width:0">
                                      <tbody><tr><td role="module-content"><p>Thank you for purchasing Medical Protection with Seychelles Medical</p></td></tr></tbody>
                                    </table>

                                    <table role="module" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed">
                                      <tbody><tr><td style="font-size:6px;line-height:10px;padding:18px 0" valign="top" align="center">
                                        <img border="0" style="display:block;width:100%;height:auto" width="615" alt="Medical Protection" src="https://cdn.mcauto-images-production.sendgrid.net/2be3c6b0d2805038/1977b2b5-9a58-4053-a3a0-02d2b3c5d87c/550x64.jpg">
                                      </td></tr></tbody>
                                    </table>

                                  </td>
                                </tr>
                              </tbody>
                            </table>



        <p>Thank you for choosing <span class="company-name">' . esc_html(get_bloginfo('name')) . '</span>.</p>

        <p>Your doctor appointment has been successfully booked. Below are your booking details:</p>
        <p>Please call +248 257 8899 to confirm your booking with ' . esc_html(get_bloginfo('name')) . '</p>
    </div>

    <div class="booking-section">
        <h3>Booking Details:</h3>
        <ul>
            <li><strong>Booking ID:</strong> #' . $booking_data['booking_id'] . '</li>
            <li><strong>Patient Name:</strong> ' . $booking_data['full_name'] . '</li>
            <li><strong>Service Type:</strong> ' .  esc_html($service_clean) . '</li>
            <li><strong>Doctor Name:</strong> [To be assigned]</li>
            <li><strong>Date & Time:</strong> ' . $booking_data['test_date'] . ', ' . $booking_data['time_slot'] . '</li>
            <li><strong>Location:</strong> ' . $booking_data['hotel'] . ')</li>
            <li><strong>Consultation Fee:</strong> €' . $grand_total_amount_to_be_charged . '</li>
        </ul>
    </div>

    <div class="info-text">
        <p>Our medical representative will contact you shortly to confirm the visit or provide the online consultation link.</p>
    </div>

    <div class="contact-info">
        <p>If you need to make any changes or cancel your booking, please contact us at:</p>
        <div class="contact-item">📞 <strong>+248 257 8899</strong></div>
        <div class="contact-item">✉️ <strong>' . $admin_email . '</strong></div>
    </div>

    <div class="info-text">
        <p>We appreciate your trust in us and wish you a speedy recovery.</p>
    </div>

    <div class="footer">
        <p>Warm regards,</p>
        <p><strong>' . esc_html(get_bloginfo('name')) . ' Team</strong></p>
        <p class="tagline">Your Health, Our Priority</p>
    </div>
</body>
</html>
';

        // ============================================
        // SEND EMAILS
        // ============================================
        $headers = array(
          'Content-Type: text/html; charset=UTF-8',
          'From: ' . $booking_data['website_title'] . ' <doctor@doctor247.sc>'
        );

        // Send admin notifications
        $admin_subject = 'New Booking on ' . $booking_data['website_title'];


        if (!DBP_TEST_ENV) {
          $admin_emails = array(
            // @mails
            'charlotte.hawkes@globaloceaninvest.com',
            // 'doctor@doctor247.sc',
            // 'help@doctor247.dc'
          );
        } else {
          $admin_emails = array(
            // @mails for devs if in testing mode
            'youcanserve81@gmail.com'
          );
        }


        foreach ($admin_emails as $admin_email) {
          wp_mail($admin_email, $admin_subject, $admin_message, $headers);
        }

        // Send customer confirmation
        $customer_subject = '🩺 Booking Confirmation — ' . get_bloginfo('name');
        wp_mail($booking_data['email'], $customer_subject, $customer_message, $headers);

        // ============================================
        // EXISTING PDF GENERATION CODE
        // ============================================
        // Your existing PDF code continues below...
        $pdfHtml = '<table align="center" border="0" cellspacing="0" style="border-collapse:collapse; height:2px; width:100%">
    <tbody>
    <tr>
        <td rowspan="6" style="width:50%">&nbsp;&nbsp;&nbsp;&nbsp; <img alt="" src="./pdf_image.jpg" style="height:66px; width:188px" /></td>
    </tr>
    <tr>
        <td style="text-align:right; width:50%"><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:14px"><strong>' . $booking_data['website_title'] . ' &nbsp; </strong></span></span></td>
    </tr>
    <tr>
        <td style="text-align:right; width:50%"><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:11px">&nbsp;&nbsp; Blue Building, Commercial House&nbsp;&nbsp;&nbsp; </span></span></td>
    </tr>
    <tr>
        <td style="text-align:right; width:50%"><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:11px">1 Eden Island, Mahe, Seychelles&nbsp;&nbsp;&nbsp;</span></span></td>
    </tr>
    <tr>
        <td style="text-align:right; width:50%">&nbsp;</td>
    </tr>
</tbody>
</table>

<p style="text-align:center"><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:18px"><span style="color:#27ae60"><strong>APPOINTMENT CONFIRMATION</strong></span></span></span></p>
<table cellpadding="13" cellspacing="0" style="border-collapse:collapse; width:100%">
    <tbody>
        <tr>
            <td style="width:50%"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">NAME</span></strong></td>
            <td style="width:50%"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $booking_data['full_name'] . '</span></td>
        </tr>
        <tr>
            <td style="width:50%;background-color:#eeeeee;"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">BOOKING DATE</span></strong></td>
            <td style="width:50%;background-color:#eeeeee;"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $booking_data['booking_date'] . '</span></td>
        </tr>
        <tr>
            <td style="width:50%"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">EMAIL</span></strong></td>
            <td style="width:50%"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $booking_data['email'] . '</span></td>
        </tr>
        <tr>
            <td style="width:50%;background-color:#eeeeee;"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">TEST HOTEL</span></strong></td>
            <td style="width:50%;background-color:#eeeeee;"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $booking_data['hotel'] . '</span></td>
        </tr>
        <tr>
            <td style="width:50%"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">PHONE</span></strong></td>
            <td style="width:50%"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $booking_data['phone'] . '</span></td>
        </tr>
        <tr>
            <td style="width:50%;background-color:#eeeeee;"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">SELECTED TEST</span></strong></td>
            <td style="width:50%;background-color:#eeeeee;"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $booking_data['service'] . '</span></td>
        </tr>
        <tr>
            <td style="width:50%"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif"><strong>TIME SLOT</strong></span></td>
            <td style="width:50%"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $booking_data['time_slot'] . '</span></td>
        </tr>
        <tr>
            <td style="width:50%;background-color:#eeeeee;"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">PAYMENT</span></strong></td>
            <td style="width:50%;background-color:#eeeeee;"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $booking_data['payment_status'] . '</span></td>
        </tr>
    </tbody>
</table>

<p>&nbsp;</p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><strong>Dear Customer,</strong></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:12px">Thank you for booking with us. Any assistance please email us on doctor@doctor247.sc or call us/whatsapp us on tel:+248 257 8899</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:12px">Please present a copy of this appointment letter along with your original passport/national identity document for verification purposes during your sample collection.</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:12px">Thank you for choosing us as your trusted healthcare service provider.</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><strong>Important Notes :</strong></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:11px"><strong>*</strong> It is recommended that you consult your Doctor/Physician if you need interpretation of your test result</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:11px"><strong>*</strong> ' . $booking_data['website_title'] . ' assumes no liability towards any delays in processing your sample.</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:11px"><strong>*</strong> Maximum liability of ' . $booking_data['website_title'] . ' should not exceed the amount charged by the service provider for the particular test(s)</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:11px"><strong>*</strong> This booking is non-refundable as per terms and conditions applied.</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><strong>Email </strong>- <a href="mailto:doctor@doctor247.sc">doctor@doctor247.sc</a></span></p>

<table cellpadding="10" cellspacing="0" style="border-collapse:collapse; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center; width:50%"><span style="font-size:20px"><strong>' . $booking_data['domain'] . '</strong></span></td>
            <td style="text-align:center; width:50%"><span style="font-size:18px"><strong>' . $booking_data['website_url'] . '</strong></span></td>
        </tr>
    </tbody>
</table>
';

        // Generate PDF
        $options = new Options;
        $options->setChroot(__DIR__);
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->setPaper("A4", "portrait");
        $dompdf->loadHtml($pdfHtml);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents(__DIR__ . "/service_required.pdf", $output);

        // Send PDF attachment email
        $pdf_message = '
<p style="color: #000000;">Dear Valued Customer, for any assistance please write to us on <a href="mailto:doctor@doctor247.sc">doctor@doctor247.sc</a> or call us/whatsapp us on <a href="tel:+2482578899">tel:+2482578899</a></p>
<p style="color: #000000;">Please present a copy of this appointment letter along with the original passport/national identity document for verification purposes during your sample collection.</p>
<p style="color: #000000;">Your satisfaction is our guarantee.</p>
<p style="color: #000000;">Thank you for choosing us as your trusted healthcare service provider.</p>
<p style="color: #000000;"><i><b>Important Notes :</b></i></p>
<p style="color: #000000;"><i>* It is recommended that you consult your Doctor/Physician for interpretation of test result</i></p>
<p style="color: #000000;"><i>* ' . $booking_data['website_title'] . ' assumes no liability towards any delays</i></p>
<p style="color: #000000;"><i>* Maximum liability of ' . $booking_data['website_title'] . ' should not exceed the amount charged by the service provider for the particular test(s)</i></p>
<p style="color: #000000;"><i>* The booking is non-refundable as per terms and conditions applied.</i></p>
<p style="color: #000000;"><i><span style="color:#007723;">Email</span> - <a href="mailto:doctor@doctor247.sc">doctor@doctor247.sc</a> <a href="https://www.doctor247.sc">www.doctor247.sc</a></i></p>
';

        $attachments = (__DIR__ . '/service_required.pdf');
        // wp_mail($booking_data['email'], 'Booking confirmation ' . $booking_data['website_title'], $pdf_message, $headers, $attachments);

        // Email code ends

      } // success else part ends...
 if ($booking_status !== "false") {
            // if (!$request->response->success) {
            //     $error .=  $request->response->resMessage;
            //     $booking_status = false;
            // } else {


        $hotel_name = explode(',', $booking_data['hotel'])[0];
        $email_hotel_name = trim($hotel_name); // remove extra spaces

        $hotel_name = explode(',', $booking_data['service'])[0];
        $email_service = trim($hotel_name); // remove extra spaces



            // code to uncomment *********************
        // }