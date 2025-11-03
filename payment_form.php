<?php
// website name is doctors247
$website_title = "Doctor247";
$domain_name = "doctors247.sc";
$website_url = "WWW.DOCTORS247.SC";
$currency = "";
//ADDED
use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ . "/vendor/autoload.php";
//END

ini_set("display_errors", "on");
error_reporting(63);
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
global $wpdb;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['submit_check'] == "yes") {



    $booking_status = "success";
    // Wordpress global database variable
    // Get Form data in variables
    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);
    $email_address = test_input($_POST['email_address']);
    $phone_number = test_input($_POST['phone_number']);
    $vaccination_island = test_input($_POST['vaccination_island']);
    $test_date = test_input($_POST['test_date']);
    // $test_location = test_input($_POST['test_location']);
    $test_hotel = test_input($_POST['selected_hotel']);
    $selected_test = test_input($_POST['selected_test']);
    $selected_time_slot = test_input($_POST['selected_time_slot']);

    $selected_currency = test_input($_POST['selected_currency']);
    $card_cvv = test_input($_POST['selected_currency']);
    // get payment information
    $accountNumber = test_input($_POST['accountNumber']);
    $expirationMonth = test_input($_POST['expirationMonth']);
    $expirationYear = test_input($_POST['expirationYear']);
    $cardType = test_input($_POST['cardType']);
    $grand_total_amount_to_be_charged = test_input($_POST['grand_total_amount_to_be_charged']);

    $random_id = rand();



    // etl cyber source integration started
    require_once dirname(__FILE__) . "/lib/cybersource/cybersource.php";

    if ($selected_currency == "euro") { //if currency if euro


      if (!DBP_TEST_ENV) {
        //new site keys 
        $request = new CyberSource("absa_seytravel_eur_0981357", "jpwlcXvYQ0qlY0j8qqgYHIBDsqKyODJLB/zZg3Z61+Tpj5yG2rzNuKjnAnKiSYQ34J99B6xogm12uxYZAlrobUiSZ3X/26x5ll5kYqMWbsRWaMS78ShJTJIK5v/6+MjDuV4y/V53aYsthV2JGzWkPWx8SKQPr/pYmaddifG482SC+EY6iLyvcn7nSm6/2XiNRwdurvrmPzEImT8OGGukDxGAXVSbZ3Pfh5PtcFjzZVx0Rt8ms7qFOdalFkVZ684tfS3Nlk1d15vdQjV6odLuWmKFKYUpBrZXf4Q/v5DCj/h0/89it3Emerfui9mjix2y8kpTEV9sCsYw7Rkf6jeFvw==", "Live");
      } else {
        $request = new CyberSource("caliphsoft_web_test", "Q1zcCMzFHm0QjOSDQmfsECLQpP9V7AqfFcEkb761HZiruMA+PmiotFHSIEKl1om0JqYNJsa0MbvBuy9Pxoua6fFT1YKPlZ/xiLTjTj1Aie1nskvTlSudxD5eIA3MuenEVlhmuQ9+PKoBvQCRHSZZ4187cAPmI8qk5we5WaHnUm9nhI6xsDHBLgUvy57R8DAg1tvdeaEyORMC5pYpiHKrPOA/E+FQovRapllEgZiuEeI3BnxsscSrHVmdsmDHHXYDuG77JGIU4Zb8VRDnu3hq4kBLlkoNO+st9+zZx0cyM7P0P57lc4DMkvY07+wjFK7clG9qxl4K2r6SbrM4xl+trA==", "Test");
      }


      //old keys i think $request = new CyberSource("absa_seymedser_eur_0980284", "RI7DrCchKS7iInkmtlYEdFY/ylRUmDXHa4sAKlN2yD2+r0uEcbKBpdai8tBle/PsKC0nljo669wH1w6ebzD0XER9yxmPxf5aYE4tGhWOC0WLhF6s/oRUQwWmnQCYP7hIKAUgUtAfTdDhOqnx11/zaC675ClM/PTGDYaTZfTCFjNGFlclkogHcbt8oGXEJXNch45sS3l+nBQF8pPeanQrvPwWsG5wsQTwMayEDchFpg51SdJbnWHChvMoeaJ4MvwBd/PEqhlY0TyScdSlHdxgHaPPQ3MClMNYEKG0L3SMQpJHnXBkFicnjUcn0R2qVd3EobmKwClE5SgpXm9Px4TyAA==", "Live");



      $request->currency  = 'EUR';
    } else {
      // $request = new CyberSource("absa_seymedser_scr_0980318", "TyjfGjssAE6/UfRndDqk2jjTxHUaCm4rbQjKNnxMQ4YWdOI+DbmaWUxQxpKajHfiDYZuliw0J4ezMP8dgKYu1SscveV5dBO4nNTsRgZOmNv3Pt2GCjTPhh13coeOIu+EBj1duO8CYuIoFVrST0TeYfh0xrJWs6mN6lQmydQiywBxdbxzMey9FX9bqWnVDTIsaV/oQG9LZLHnI2R5CLA7uxDr0ZYO+t02jLCiZLRb82l/z9xGerM1OQaQgJthe6xoPhPargQrmWYVLzbBb1ZjQv/bLYAdn1SEQ9FLxvWl+sGh/ia0DUr3xTDFiiQAJO3sqw8Wy4hUdreF67swTJhrAA==", "Live");
      $request = new CyberSource("caliphsoft_web_test", "Q1zcCMzFHm0QjOSDQmfsECLQpP9V7AqfFcEkb761HZiruMA+PmiotFHSIEKl1om0JqYNJsa0MbvBuy9Pxoua6fFT1YKPlZ/xiLTjTj1Aie1nskvTlSudxD5eIA3MuenEVlhmuQ9+PKoBvQCRHSZZ4187cAPmI8qk5we5WaHnUm9nhI6xsDHBLgUvy57R8DAg1tvdeaEyORMC5pYpiHKrPOA/E+FQovRapllEgZiuEeI3BnxsscSrHVmdsmDHHXYDuG77JGIU4Zb8VRDnu3hq4kBLlkoNO+st9+zZx0cyM7P0P57lc4DMkvY07+wjFK7clG9qxl4K2r6SbrM4xl+trA==", "Test");

      $request->currency = 'SCR';
    }
    $request->reference_code = "Booking ID:" . $random_id;
    $billTo = new stdClass();
    $billTo->firstName = $first_name;
    $billTo->lastName = $last_name;
    $billTo->street1 = "test street";
    $billTo->city = "test district";
    $billTo->state = "NY";
    $billTo->postalCode = "13333";
    $billTo->country = "GH";
    $billTo->email = $email_address;
    $billTo->ipAddress = $_SERVER['REMOTE_ADDR'];
    $card = new stdClass();
    $card->accountNumber = $accountNumber;
    $card->fullName = $_POST['fullName'];
    $card->expirationMonth = $expirationMonth;
    $card->expirationYear = $expirationYear;
    $card->cvv = $card_cvv;
    $card->cardType = @$request->card_types[$cardType];
    $request->billTo = $billTo;
    $request->card = $card;
    $error = null;
    $success = null;



    try {
      $request->charge($grand_total_amount_to_be_charged);
      // $request->charge(1);
    } catch (Exception $exp) {
      $booking_status = "false";
      $error .= $exp->getMessage();
    }


    error_log(print_r($request, true));


    if ($request->response && $request->response->resMessage) {
      if (!$request->response->success) {
        $error .=  $request->response->resMessage;
        $booking_status = false;
      } else {

        $cybersource_payment_id =  $request->response->requestID;

        //***************************Payment Successful **********************/
        /**
         * Send Email to website admin
         * Send Email to Client
         * Save Custom post type
         */
        // success else part starts
        $success = "Thank you for booking an appointment!";

        $payment_status = "Paid";


        //$grand_total_amount_to_be_charged = (20 / 100) * $grand_total_amount_to_be_charged;
        // Create post title with user inserted data
        $title = $first_name . "" . $last_name . "" . $test_date;
        // Insert data as a custom post type
        $my_query = array(
          'post_title' => wp_strip_all_tags($title),
          'post_content' => "",
          'post_type' => 'bookings',
          'post_name' => wp_strip_all_tags($title),
          'post_status' => 'publish',
          'post_author' => 1
        );
        // create custom post type and get post id
        $post_id = wp_insert_post($my_query);
        $booking_date = date('Y-m-d');
        // Create an array of all bookings field to store in meta data
        $meta_data = array(
          'first_name' => $first_name,
          'last_name' => $last_name,
          'booking_date' => $booking_date,
          'email_address' => $email_address,
          'seychelles_island_to_perform_vaccine' => $vaccination_island,
          'test_date' => $test_date,
          // 'test_location' => $test_location,
          'payment_status' => $payment_status,
          'payment_currency' => $selected_currency,
          'hotel_name' => $test_hotel,
          'test_name' => $selected_test,
          'test_time' => $selected_time_slot,
          'phone_number' => $phone_number,
          'booking_id' => $cybersource_payment_id,
        );
        // selected_hotel

        if ($selected_currency != "euro") {
          $meta_data['home_address'] = $test_hotel;
        }
        // insert post meta data using loop
        foreach ($meta_data as $meta_key => $meta_value) {
          update_post_meta($post_id, $meta_key, $meta_value);
        }
        /**
         *  Update available_slots post meta
         * this custom post is created on register activation hook
         **/
        $args = array('post_type' => 'available_slots');
        $loop = new WP_Query($args);
        // Meta Information
        $available_slots_post_id = $loop->posts[0]->ID;
        $meta_key = $selected_time_slot;
        $meta_value = $test_date;
        // update meta
        if ($available_slots_post_id > 0) {
          update_post_meta($available_slots_post_id, $meta_key, $meta_value);
        }




        // @Send Email to Admin

        // ============================================
        // PREPARE BOOKING DATA ARRAY
        // ============================================
        $booking_data = array(
          'booking_id' => $random_id,
          'first_name' => $first_name,
          'last_name' => $last_name,
          'full_name' => $first_name . ' ' . $last_name,
          'email' => $email_address,
          'phone' => $phone_number,
          'booking_date' => $booking_date,
          'test_date' => $test_date,
          'time_slot' => $selected_time_slot,
          'hotel' => $test_hotel,
          'island' => $vaccination_island,
          'service' => $selected_test,
          'payment_status' => $payment_status,
          'currency' => $selected_currency,
          'website_title' => $website_title,
          'website_url' => $website_url,
          'domain' => $domain_name
        );


        $hotel_name = explode(',', $booking_data['hotel'])[0];
        $email_hotel_name = trim($hotel_name); // remove extra spaces

        $hotel_name = explode(',', $booking_data['service'])[0];
        $email_service = trim($hotel_name); // remove extra spaces


        // ============================================
        // ADMIN NOTIFICATION EMAIL (Table Format)
        // ============================================
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


      // code to uncomment *********************
    }
  }
}
?>

<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap");
    /* Sidebar Styles go here  */
    /* ******************** Variable Styles *********************** */

    /* === Root Variable (from user) === */
    :root {
      --bs-primary-color: #3c72c8;
      --bs-white: #ffffff;

      --bs-bg-light: #eff6ff;

      --bs-text-primary: #333;
      --bs-text-secondary: #444;
      --bs-text-muted: #555;
      --bs-link-color: #3c72c7;

      /* Text Sizes */
      --bs-heading: 40px;
      --bs-text: 16px;
      --bs-font-primary: "Montserrat", sans-serif;
    }

    .bs-label {
      padding: 0 !important;
      font-size: 1rem !important;
      color: var(--bs-text-secondary);
    }

    .card-img-wrapper {
      width: fit-content;
      position: absolute;
      top: 0px;
      right: -22px;
      scale: 0.8;
    }

    .payment-row-exp select {
      background: transparent;
    }

    .card-img-wrapper svg {
      width: 60px;
      height: 45px;
    }

    .card-img-wrapper svg:nth-of-type(2) {
      height: 47px !important;
      width: 49px !important;
    }

    .card-img-wrapper svg:nth-of-type(3) {
      width: 50px;
    }

    /* ******************** Side Bar Style *********************** */

    /* .bs-navmenu {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
} */
    .bs-navmenu ul {
      position: relative !important;
      list-style-type: none !important;
    }

    .bs-navmenu ul::after {
      content: "" !important;
      position: absolute !important;
      border-left: dotted grey 3px !important;
      height: calc(100% - 52px) !important;
      left: 38px !important;
      top: 0 !important;
      /* z-index: -2 !important; */
      margin-top: 29px !important;
    }

    .bs-navmenu ul li {
      padding: 10px 0 10px 18px !important;
      font-size: 1rem;
      font-family: 'Montserrat';
    }

    .bs-navmenu ul li a {
      text-decoration: none !important;
      position: relative !important;
      color: gray !important;
      font-size: 1rem !important;
      line-height: 1rem !important;
      font-weight: 500 !important;
      width: 200px !important;
      display: block !important;
      cursor: context-menu !important;
      font-family: 'Montserrat';
    }

    .bs-navmenu ul li a::before {
      content: "" !important;
      position: absolute !important;
      background: #fff !important;
      width: 16px !important;
      height: 16px !important;
      left: -26px !important;
      top: 50% !important;
      transform: translateY(-50%) !important;
      border-radius: 50px !important;
      border: 1px solid grey !important;
      z-index: 1;
    }

    .bs-navmenu ul li a.bs-active::after {
      content: "" !important;
      position: absolute !important;
      width: 3px !important;
      height: 151% !important;
      left: -10% !important;
      background: var(--bs-primary-color) !important;
      top: -15px !important;
      z-index: 8 !important;
      margin-top: 28px !important;
    }

    .bs-navmenu ul li a.bs-active {
      font-weight: 700 !important;
      color: var(--bs-primary-color) !important;
    }

    .bs-navmenu ul li a.bs-active:before {
      content: "" !important;
      color: white !important;
      font-weight: 300 !important;
      font-size: 20px !important;
      border-color: var(--bs-primary-color) !important;
      background: var(--bs-primary-color) !important;
    }

    .bs-navmenu ul li a.bs-active:focus::before {
      content: "" !important;
      border-color: var(--bs-primary-color) !important;
      background: var(--bs-primary-color) !important;
    }

    .bs-last::after {
      display: none !important;
    }


    /* Sidebar Styles ENDS  here  */
    /* Input Field Styles --> */
    .input-wrapper input,
    select {
      border: 1px solid black !important;
      border-radius: 0 !important;
      max-height: 50px !important;
    }

    /* <-- Input Field Styles  */

    /* Summary Styles -->  */
    /* Make sure your @import and :root variables
  are loaded before this CSS.
*/

    /* Main card container */
    .summary-card {
      font-family: var(--bs-font-primary, "Montserrat", sans-serif);
      border: 1px solid var(--bs-primary-color);
      border-radius: 8px;
      overflow: hidden;
      /* max-width: 450px; */
      margin: 1.5em 0;
      /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07); */
      background-color: var(--bs-white, #ffffff);
    }

    /* Card Header (Blue bar) */
    .summary-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: var(--bs-primary-color, #3c72c8);
      color: var(--bs-white, #ffffff);
      padding: 1rem 1.25rem;
      font-size: 1.25rem;
      font-weight: 700;
      /* Bolder total */
    }

    /* Card Body (White area with line items) */
    .summary-body {
      padding: 0.75rem 1.25rem;
      .
      /* Padding for the rows */
      color: var(--bs-text-primary, #333);
      background: var(--bs-bg-light);
    }

    /* Each line item row */
    .summary-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 0;
      /* Vertical padding for spacing */
      font-size: 1rem;
    }

    .summary-row>span {
      font-weight: bold;
      font-size: 1rem;
      color: black;
    }

    /* Add a border between rows, but not after the last one */
    .summary-row:not(:last-child) {
      border-bottom: 1px solid var(--bs-bg-light, #f0f0f0);
    }

    /* Label (left side) of a row */
    .summary-row span:first-child {
      color: black;
    }

    /* Value (right side) of a row */
    .summary-row span:last-child {
      font-weight: 600;
      color: var(--bs-text-secondary, #444);
    }

    /* <-Summary Styles end  */


    .error {
      color: #ff0000;
    }

    /* * {
            box-sizing: border-box;
            font-family: "Montserrat", Sans-serif !important;
        } */

    .sec_heading {
      margin-bottom: 25px;
    }

    .sec_heading h4 {
      color: black !important;
      /* color: var(--bs-primary-color); */
      position: relative;
      font-family: var(--bs-font-primary);
      font-size: var(--bs-heading);
      font-weight: 700;
      /* padding-bottom: 15px; */
    }

    .sec_heading h6 {
      font-family: var(--bs-font-primary);
      color: var(--bs-text-secondary)
    }

    /* .sec_heading h4:after {
    content: "";
    position: absolute;
    background: #003F87;
    width: 50px;
    height: 2px;
    left: 0;
    bottom: 0;
  } */

    h2 {
      text-align: center;
    }

    #BookingFormEt input[type="text"],
    #BookingFormEt input[type="number"],
    #BookingFormEt input[type="date"],
    #BookingFormEt select,
    #BookingFormEt textarea {
      width: 100%;
      height: 60px;
      padding-left: 24px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
      margin-bottom: 10px;
      transition: all ease 0.5s;
      font-family: "Josefin Sans", Sans-serif;
      font-size: 1rem;
      background-color: white;
    }

    #BookingFormEt input[type="text"]:focus,
    #BookingFormEt input[type="number"]:focus,
    #BookingFormEt select:focus,
    #BookingFormEt textarea:focus #BookingFormEt button:focus {
      border: 1px solid #003f87;
      outline: none;
    }

    #BookingFormEt label {
      padding: 12px 12px 12px 0;
      display: inline-block;
      font-size: 18px;
      color: rgba(0, 0, 0, 0, 0.9);
    }

    .container {
      border-radius: 5px;
      background-color: transparent;

    }

    #BookingFormEt .col-25 {
      float: left;
      width: 25%;
      margin-top: 6px;
    }

    .error {
      color: #ff0000;
    }

    #BookingFormEt .col-75 {
      float: left;
      width: 75%;
      margin-top: 6px;
    }

    #BookingFormEt .col-37 {
      float: left;
      width: 37.5%;
      margin-top: 6px;
    }

    #BookingFormEt .col-75-btn {
      margin-left: 35%;
      margin-top: 6px;
    }

    .col-50,
    .col-half {
      float: left;
      width: 50%;
      margin-top: 6px;
    }

    .col-half {
      width: calc(50% - 7px);
    }

    .col-half1 {
      width: calc(50% - 7px);
    }

    .col-100 {
      float: left;
      width: 100%;
      margin-top: 15px;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    select option {
      height: 30px;
      font-size: 17px;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {

      .col-25,
      .col-75 {
        width: 100%;
        margin-top: 0;
      }
    }

    .datepicker-dropdown {
      z-index: 1000 !important;
    }




    /* #BookingFormEt input[type="submit"],
  #prevBtn,
  #nextBtn {
    font-size: 16px;
    font-weight: 600;
    fill: #003F87;
    color: #fff;
    background-color: #003F87;
    border-radius: 10px;
    padding: 15px 40px 15px 40px;
    transition: all ease 0.5s;
    cursor: pointer;
    border: none;

    width: auto;
    margin-left: 15px;
    font-size: 18px;
    margin-bottom: 30px;
  } */

    .bs-btn-next {
      background-color: var(--bs-primary-color) !important;
      border-radius: 12px !important;
      padding: 0.75rem 2rem !important;
      color: white !important;
      font-weight: bold !important;
      border: 0 !important;
      cursor: pointer !important;
    }

    .bs-btn-prev {
      background: var(--bs-bg-light) !important;
      border-radius: 12px !important;
      padding: 0.75rem 2rem !important;
      font-weight: bold !important;
      border: 0 !important;
      margin-right: 0.5rem;
      color: var(--bs-text-secondary) !important;
      cursor: pointer !important;
    }


    #BookingFormEt input[type="submit"]:hover {
      background-color: #D62828;
      outline: none;
      border: none;
    }

    h3.form_sec_title {
      color: #404040;
      font-family: "Josefin Sans", Sans-serif;
      font-size: 20px;
      font-weight: 500;
      margin-top: 25px;
    }

    .villatype-row {
      gap: 15px;
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
    }


    /* background color for body */
    /* background-color: #edf3fa; */

    .villatype-row .col-33 {
      float: none;
      width: auto;
      border: 1px solid #dcdcdc;
      padding: 15px;
      text-align: center;
    }

    #regForm {
      background-color: #aa7a7a;
      margin: 100px auto;
      font-family: Raleway;
      padding: 40px;
      width: 70%;
      min-width: 300px;
    }

    /* Mark input boxes that gets an error on validation: */
    #BookingFormEt input.invalid {
      background-color: #ffdddd;
    }

    #BookingFormEt {
      background: white;

      width: 100%;
    }

    /* Hide all steps by default: */
    .tab {
      display: none;
      /* padding: 30px 0; */
    }

    /* #prevBtn,
  #nextBtn {
    margin-top: 30px;
  } */

    #BookingFormEt button:hover {
      opacity: 0.8;
    }

    #BookingFormEt #prevBtn {
      background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 19%;
      margin: 0 2px;
      box-sizing: border-box;
      background-color: #bbbbbb;
      border: none;
      /* border-radius: 50%; */
      display: inline-block;
      opacity: 0.5;
    }

    .step.active {
      opacity: 1;
    }

    .step p {
      margin-top: 25px;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #0074c9;
    }

    .form-row {
      display: inline-flex;
      justify-content: center;
      flex-direction: row;
      width: 100%;
    }

    .form-row .input-wrapper {
      width: 50%;
      padding: 0 10px !important;
      position: relative;
    }

    .form-row .input-wrapper>span {
      color: rgba(0, 0, 0, 0.5);
      position: absolute;
      left: 35px;
      top: 27px;
      width: auto;
      /* transform: translate(-50%, 0); */
      pointer-events: none;
      z-index: 1;
      font-size: 18px;
    }

    .form-row .input-wrapper p {
      color: red;
      font-size: 12px;
      margin-left: 5px;
      display: none;
    }

    .form-row .input-wrapper span .required_sign {
      color: red;
    }

    .form-row .input-wrapper input {
      padding-left: 50px;
      max-height: 50px;
    }

    .hide {
      display: none;
    }

    /*
.form-row .input-wrapper input:focus-visible {
    border: 4px solid orange;
} */
    .input-gender-wrapper {
      /* display: none; */
      position: relative;
    }

    .input-gender-wrapper input:before {
      content: "Male";
      width: 50%;
      height: 50px;
      position: absolute;
      border: 1px solid black;
    }

    .flex-left {
      justify-content: left;
    }

    .text-bold {
      font-weight: bold;
    }

    .test-center-heading {
      text-align: center;
      /* background-color: rgba(0, 63, 135, 0.9); */
      margin-top: 20px;
    }

    .test-center-heading h4 {
      background-color: orange;
      display: inline-block;
      font-size: 1.4rem;
      background-color: rgba(0, 63, 135, 0.9);
      color: white;
      padding: 10px 50px;
      border-radius: 50px;
      box-shadow: 10px 10px 10px -1px rgba(10, 99, 169, 0.16), -10px -10px 10px -1px rgba(255, 255, 255, 0.7);
      border-top: 1px solid rgba(255, 255, 255, 0.65);
      border-left: 1px solid rgba(255, 255, 255, 0.65);
    }

    .w-100 {
      width: 100%;
    }

    .mt-50 {
      margin-top: 50%;
    }

    .mt-10 {
      margin-top: 10%;
    }

    .slot-row {
      margin-top: 10px;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      align-items: center;
    }

    .slot-row .slot {
      border: 1px solid #003f87;
      margin: 5px;
      border-radius: 50px;
      padding: 10px 25px;
      cursor: pointer;
    }

    /* Active Slot Style */
    .slot-row .slot p {
      color: #003f87;
      margin-top: 5px;
      margin-bottom: 5px;
      font-size: 16px;
    }

    .slot-row .slot.active {
      background-color: #003f87;
    }

    .slot-row .slot.active p {
      color: white;
    }

    .slot-row .slot.disabled {
      border: 1px solid rgba(0, 0, 0, 0.5);
      pointer-events: none;
    }

    .slot-row .slot.disabled p {
      color: rgba(0, 0, 0, 0.5);
      pointer-events: none;
    }

    .overview-row {
      /* margin-top: 40px; */
      background-color: white;
      /* box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.1);
            padding: 20px;*/
      margin-bottom: 40px;
      border-radius: 10px;
    }

    .overview-row table {
      width: 100%;
    }

    .overview-row table,
    .overview-row table th,
    .overview-row table td {
      border-collapse: collapse;
      padding: 15px;
      border: 1px solid rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .overview-row h5 {
      font-weight: bold;
      margin-bottom: 10px;
    }

    .text-vaccinated {
      margin: 50px 0 0 0;
      color: rgba(0, 63, 135, 0.9);
      display: inline-block;
    }

    .text-personal-info {
      color: rgba(0, 63, 135, 0.9);
      display: inline-block;
      margin: 0 10px 15px 0;
      font-weight: bold;
    }

    .text-personal-info h5 {
      margin: 0;
    }

    .text-danger {
      color: red;
    }

    .text-vaccinated h6 {
      font-weight: bold;
      margin: 0;
    }

    #inputWrapperDateOfLastVaccination,
    #inputWrapperVaccineBrand,
    #inputWrapperNumberOfDosesReceived {
      display: none;
    }

    #lblTestDate {
      font-weight: bold;
    }

    .shadow-container {
      margin-bottom: 20px;
    }

    .success-message {
      width: 100%;
      background-color: #23C552;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px 0;
      margin-bottom: 20px;
      border-radius: 20px;
      color: white;
    }

    .error-message {
      width: 100%;
      background-color: red;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px 0;
      margin-bottom: 20px;
      border-radius: 20px;
      color: white;
    }

    .success-message p {
      font-size: 1.2rem;
    }

    .success-message P {
      margin: auto;
    }

    .w-100 {
      width: 100%;
    }

    /* .testing-center input {
            width: 100%;
            display: block;
            flex-direction: column;
        } */
    .form-row.testing-center {
      flex-direction: column;
      margin-bottom: 20px;
    }

    .form-row.testing-center input {
      width: 100%;
    }

    .text-available-slots {
      margin-top: 50px;
    }

    .text-available-slots h5 {
      margin: 0;
    }

    .health-care-worker-wrapper {
      width: 50%;
    }

    .payment-details input,
    select {
      max-height: 50px;
    }

    .payment-details #cardCvv,
    input,
    select {
      border: 1px solid black !important;
      border-radius: 0 !important;
    }

    .payment-details .first-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .payment-details .first-row .account-number {
      width: 40%;
      margin: 10px;
    }

    .payment-details .first-row .card-holder-name {
      width: 60%;
      margin: 10px;
    }

    .payment-details .second-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .payment-details .second-row select {
      margin: 0 10px;
    }

    .payment-row-exp {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 20px;
    }

    .payment-details {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    @media (max-width: 767px) {
      .test-center-heading h4 {
        border-radius: 5px;
        font-size: 20px;
      }

      .step {
        width: 17%;
        height: 8px;
      }

      .step p {
        display: block;
        font-size: 10px;
        margin-top: 15px;
      }

      .test_box_wrapper {
        grid-template-columns: 1fr !important;
      }

      .slot-row .slot {
        width: 100%;
        text-align: center;
        padding: 6px 12px;
      }

      .payment-details .second-row {
        flex-direction: column;
      }

      .payment-details .first-row {
        flex-direction: column;
      }

      .payment-details .first-row .account-number {
        width: 100%;
      }

      .payment-details .first-row .card-holder-name {
        width: 100%;
        margin: 0;
      }

      .form-row .input-wrapper {
        width: 100%;
        padding: 10px;
        position: relative;
      }

      .form-row {
        flex-direction: column;
      }

      .container {
        padding: 5px;
      }

      form input {
        width: 100%;
      }

      .form-row .input-wrapper input {
        width: 15px;
      }

      .health-care-worker-wrapper {
        width: 100%;
      }
    }



    /* Three Main Boxes for (Select Test) Code Starts */

    @import url("https://fonts.googleapis.com/css?family=Inter:400'");



    .etl_middle {
      width: 100%;
      text-align: center;
      /* Made by */
    }

    .etl_middle h1 {
      font-family: "Inter", sans-serif;
      color: #fff;
    }


    .etl_middle input[type=radio] {
      display: none;
    }

    .etl_middle input[type=radio]:checked+.etl_box {
      background-color: var(--bs-bg-light);
      border: 1px solid var(--bs-primary-color);
    }

    .etl_middle input[type=radio]:checked+.etl_box p {}

    .etl_middle input[type=radio]:checked+.etl_box span {
      /*color: white;
            transform: translateY(70px);*/
    }

    .etl_middle input[type=radio]:checked+.etl_box span:before {
      transform: translateY(0px);
      opacity: 1;
    }

    .test_box_wrapper {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 25px;
    }

    .test_box_wrapper label {
      border: 1px solid #dcdcdc;
      padding: 0 !important;
    }

    .test_box_wrapper label:hover {
      cursor: pointer;
    }

    .test_box_wrapper label p {
      color: #003F87;
      font-size: 20px;
      margin: 0 0 5px 0;
    }

    .test_box_wrapper label span {
      color: #000;
      font-size: 15px;
      display: block;
    }

    .etl_middle input[type=radio]:checked+.etl_box {
      color: #fff;
    }

    .test_box_wrapper label .etl_box {
      padding: 30px;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    /*.etl_middle .etl_box {
            width: 31%;
            height: 120px;
            background-color: #fff;
            transition: all 250ms ease;
            will-change: transition;
            display: inline-block;
            text-align: center;
            cursor: pointer;
            position: relative;
            font-family: "Inter", sans-serif;
            font-weight: 900;
            border: 1px solid rgba(0, 0, 0, 0.3);
        }

        .etl_middle .etl_box:active {
            transform: translateY(10px);
        }

        .etl_middle .etl_box span {
            position: absolute;
            transform: translate(0, 60px);
            left: 0;
            right: 0;
            top: -12px;
            transition: all 300ms ease;
            font-size: 1.1em;
            user-select: none;
            color: #003F87;
            display:block;
            font-weight: bold;
        }

        .etl_middle .etl_box span:before {
            font-size: 0.8em;
            font-family: FontAwesome;
            display: block;
            transform: translateY(-80px);
            opacity: 0;
            transition: all 300ms ease-in-out;
            font-weight: normal;
            color: white;
        }

        .etl_middle .front-end span:before {
            content: "";
            font-family: "FontAwesome";
            font-size: 0.7em;

        }

        .etl_middle .back-end span:before {
            content: "";
            font-size: 0.7em;
        }

        .etl_middle p {
            color: #fff;
            font-family: "Inter", sans-serif;
            font-weight: 400;
        }

        .etl_middle p a {
            text-decoration: underline;
            font-weight: bold;
            color: #fff;
        }

        .etl_middle p span:after {
            content: "";
            font-family: FontAwesome;
            color: yellow;
        }

        #etlMiddle label {
            display: inline;
            top: -20px;

        }
        */
    #errorVacIsland {
      color: #7a7a7a;
      font-size: 15px;
      margin-left: 5px;
      display: block;
      margin-top: -6px;
      font-style: italic;
    }



    .payment-details label {
      padding: 0 !important;
      margin-bottom: 7;
    }

    button.bs-btn-prev:focus {
      outline: none;
    }

    .thank-you-page {
      margin: auto;
    }

    .thank-you-page .thank-you-main-heading {
      font-size: 5rem;
      font-weight: bold;
      font-family: Montserrat;
    }

    .thank-you-page .thank-you-text {
      font-size: 22px;
      font-family: Montserrat;
    }

    .thank-you-page svg {
      max-width: 500px;
    }

    /* mobile_device */
    @media (max-width: 767px) {
      .etl_middle .etl_box {
        width: 98%;
        margin: 5px 0;
      }

      .thank-you-page svg {
        max-width: 100%;
      }

      .thank-you-page .thank-you-main-heading {
        font-size: 3rem;
      }

      .payment-row-exp {
        grid-template-columns: 1fr;
        gap: 5px;
      }

      .thank-you-text {
        font-size: 1rem;
      }

      .payment-details {
        grid-template-columns: 1fr;
        gap: 0px;
      }

      .heading_which_island {
        margin-top: 40px;
        font-size: 36px;
      }

      #sidebar_ProgressBar {
        display: none;
      }
    }

    .summary_table td {
      color: rgba(0, 0, 0, 0.9);
    }

    /* #completeAddress {
            width: 100%;
        } */

    #wrapCompleteAdress {
      padding: 0;
      width: 100%;
    }

    .db-services-option {
      font-size: 1.2rem !important;
      margin-top: 2rem;
      margin-bottom: 0;
      color: rgba(0, 0, 0, 0.8) !important;
    }


    /* .elementor-element-populated {
            background-color: #edf3fa;
        } */

    /* Three Boxes (Select Test) Code Ends */
  </style>
</head>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<form method="post" name="myForm" action="" id="myBookingForm">
  <input type="hidden" name="amount" id="amount" value="<?php if (isset($_REQUEST[" amount "])) {
                                                          echo ($_REQUEST["amount "]);
                                                        } else {
                                                          echo "test ";
                                                        } ?>">
  <!-- @TODO  -->
  <div class="container d-flex" id="BookingFormEt" style="">
    <?php if (isset($success) && $success != null) { ?>




      <?php include_once('includes/thank-you.php');  ?>




    <?php } else if (isset($error) && $error != null) { ?>
      <div class="error-message">
        <p><?php echo $error; ?> <a href="<?php echo get_site_url(); ?>">Home</a>
        </p>
      </div>
    <?php  } else {
    ?>
      <!-- @Sidebar -->
      <section id="sidebar_ProgressBar">
        <div class="cs-container overflow-hidden">
          <nav class="bs-navmenu">
            <ul>
              <li>
                <a href="#" id="bsNavIntroduction" class="bs-active">Personal Details</a>
              </li>
              <li>
                <a href="#" id="bsNavBasicInfo">Service Type</a>
              </li>
              <li>
                <a href="#" id="bsNavYourGp">Service Information</a>
              </li>
              <li>
                <a href="#" id="bsNavReviewSubmit">Order Summary</a>
              </li>
              <li>
                <a href="#" id="bsNavCheckout" class="bs-last">Payment Detail</a>
              </li>
            </ul>
          </nav>
        </div>
      </section>


      <div class="dmt-container-paper-details" id="BookingFormEt">
        <!-- Circles which indicates the steps of the form: -->
        <div class="d-none"
          style="text-align:center;margin-top:40px; display: flex; margin: 35px auto; justify-content: space-between;">
          <span class="step">
            <p>1) Personal Details</p>
          </span>
          <span class="step">
            <p>2) Service Type</p>
          </span>
          <span class="step">
            <p>3) Service Information</p>
          </span>
          <span class="step">
            <p>3) Order Summary</p>
          </span>
          <span class="step">
            <p>3) Payment Detail</p>
          </span>
          <!-- <span class="step">4</span> -->
        </div>
        <form method="post" name="myForm" enctype="multipart/form-data">

          <input type="hidden" name="amount" id="amount" value="<?php if (
                                                                  isset($_REQUEST["amount"])
                                                                ) {
                                                                  echo $_REQUEST["amount"];
                                                                } ?>">
          <!-- @personal  -->
          <div class="tab">
            <!-- Tab 1 Content -->
            <div class="shadow-container">
              <div class="sec_heading">
                <h4>Personal Information</h4>
                <h6>Tell us a bit about yourself so we can confirm your appointment.</h6>
              </div>
              <div class="form-row">
                <div class="input-wrapper">
                  <label for="firstName" class="bs-label">First name</label>
                  <input type="text" onfocus=active_input(this) onfocusout=inactive_input(this) data-value="First Name"
                    id="firstName" name="first_name" placeholder="First name"
                    value="<?php
                            if (isset($_POST['first_name'])) {
                              echo $_POST['first_name'];
                            }
                            ?>"
                    required>
                  <?php
                  // if (!isset($_POST['first_name'])) {
                  //     echo '<span>First Name <span class="required_sign">*</span></span>';
                  // } else if (isset($_POST['first_name'])) {
                  //     if (empty(trim($_POST['first_name']))) {
                  //         echo '<span>First Name <span class="required_sign">*</span></span>';
                  //     } else {
                  //         echo '<span><span class="required_sign"></span></span>';
                  //     }
                  // }
                  ?>
                  <p></p>
                </div>
                <div class="input-wrapper">
                  <label for="lastName" class="bs-label">Last name</label>
                  <input type="text" onfocus=active_input(this) onfocusout=inactive_input(this) data-value="Last Name"
                    id="lastName" name="last_name" placeholder="Last name" required
                    value="<?php
                            if (isset($_POST['last_name'])) {
                              echo $_POST['last_name'];
                            }
                            ?>">
                  <?php
                  // if (!isset($_POST['last_name'])) {
                  //     echo '<span>Last Name <span class="required_sign">*</span></span>';
                  // } else if (isset($_POST['last_name'])) {
                  //     if (empty(trim($_POST['last_name']))) {
                  //         echo '<span>Last Name <span class="required_sign">*</span></span>';
                  //     } else {
                  //         echo '<span><span class="required_sign"></span></span>';
                  //     }
                  // }
                  ?>
                  <p></p>
                </div>

                <!-- min="<?php // echo date(" m/d/Y ");
                          ?>" -->

              </div>
              <!-- Second Row -->
              <div class="form-row">

                <div class="input-wrapper">
                  <label for="emailAddress" class="bs-label">Email address</label>
                  <input type="text" onfocus=active_input(this) onfocusout=inactive_input(this) id="emailAddress"
                    name="email_address" data-value="Email Address" placeholder="Email address" required
                    value="<?php
                            if (isset($_POST['email_address'])) {
                              echo $_POST['email_address'];
                            }
                            ?>">
                  <?php
                  // if (!isset($_POST['email_address'])) {
                  //     echo '<span>Email Address <span class="required_sign">*</span></span>';
                  // } else if (isset($_POST['email_address'])) {
                  //     if (empty(trim($_POST['email_address']))) {
                  //         echo '<span>Email Address <span class="required_sign">*</span></span>';
                  //     } else {
                  //         echo '<span><span class="required_sign"></span></span>';
                  //     }
                  // }
                  ?>
                  <p id="emailErrorPlaceholder"></p>
                </div>
                <div class="input-wrapper">
                  <label for="phoneNumber" class="bs-label">Contact number</label>
                  <input type="text" onfocus=active_input(this) onfocusout=inactive_input(this)
                    data-value="Contact Number" placeholder="Contact number" id="phoneNumber" name="phone_number" required
                    value="<?php
                            if (isset($_POST['phone_number'])) {
                              echo $_POST['phone_number'];
                            }
                            ?>">
                  <?php
                  // if (!isset($_POST['phone_number'])) {
                  //     echo '<span>Contact Number <span class="required_sign">*</span></span>';
                  // } else if (isset($_POST['phone_number'])) {
                  //     if (empty(trim($_POST['phone_number']))) {
                  //         echo '<span>Contact Number <span class="required_sign">*</span></span>';
                  //     } else {
                  //         echo '<span><span class="required_sign"></span></span>';
                  //     }
                  // }
                  ?>
                  <p></p>
                </div>

              </div>

              <!-- form row ends -->
            </div>

          </div>



          <!-- Tab 1 Content Ends -->
          <div class="tab">
            <!-- Tab 2 Content Starts -->
            <!-- Select Test Three Boxes start -->
            <div class="etl_middle sec_heading h4" id="etlMiddle">

              <h4 style="text-align: left; margin-bottom: 25px;">What service would you like to book?</h4>
              <div class="test_box_wrapper">
                <!-- <label>
                <input type="radio" name="radioSelectedTest" onclick="ListenTest(this);" value="antigen-test"
                  id="inputPCRAntigen" />
                <div class="front-end etl_box">
                  <p>PCR/Antigen Test</p>
                  
                </div>
              </label> -->

                <label>
                  <input type="radio" name="radioSelectedTest" onclick="ListenTest(this);" value="doctor-visit"
                    id="inputDoctorVisit" />
                  <div class="front-end etl_box">
                    <p>Doctor visit</p>
                    <span>Mahe Island</span>
                  </div>
                </label>


                <label>
                  <input type="radio" name="radioSelectedTest" onclick="ListenTest(this);" value="doctor-tele"
                    id="inputDoctorTel" />
                  <div class="back-end etl_box">
                    <p>Doctor Teleconsultation</p>
                    <span>All Islands</span>
                  </div>
                </label>
              </div>
              <!---Test Box Wrapper-->
            </div>
            <!-- Select Test Three Boxes Ends -->
          </div>
          <!-- Tab 2 Content Ends -->
          <div class="tab">
            <!-- Tab 3 Content Starts here -->

            <!-- Here you have to display the Login and Register Form  -->


            <!-- Form Row Ends -->
            <div class="sec_heading heading_which_island m-0" id="titleSelectIsland">
              <h4 id="headingWhichIsland"></h4>
            </div>
            <input type="text" id="vacIslandValue" name="vac_island_value" hidden>
            <?php
            // $j = 1;
            // $args = array('post_type' => 'testprice');
            // $loop = new WP_Query($args);
            // $posts_array = $loop->posts;
            ?>
            <?php if (isset($etl_currency) && $etl_currency == "scr") {
              $currency = "scr";
              $currency_sign = "SCR";
            } else {
              $currency = "euro";
              $currency_sign = '&euro;';
            } ?>
            <input type="text" name="selected_currency" id="selectedCurrency" value="<?php echo $currency; ?>" hidden>
            <div class="form-row flex-left" id="wrapSelectIsland">
              <div class="input-wrapper">
                <!-- <label for="" class="text-bold">Vaccination</label> -->
                <!-- <select class="island_test" id="vaccinationIsland" name="vaccination_island" onchange="getData(this)" data-value="Island"> -->
                <!-- <label for="vaccinationIsland">Choose island</label> -->
                <select class="island_test" id="vaccinationIsland" name="vaccination_island" data-value="Island"
                  onchange="handleIslandChange(this)">
                  <!-- <option value="default">Select</option> -->
                  <?php
                  // foreach ($posts_array as $key => $value) {
                  //     $island_name = $value->post_title;

                  //     if ($island_name != "Mahe Island") {
                  //         // $island_name = explode(" ", $island_name)[0];
                  //         $island_name = "Praslin Island";
                  //         echo "<option value='$island_name,$value->ID,$j' id='maheIslandOption'>$island_name</option>";
                  //     } else {
                  //         echo "<option value='$island_name,$value->ID,$j'>$island_name</option>";
                  //     }


                  //     $j++;
                  // }
                  ?>



                  <option value="default">Select</option>
                  <option value="Praslin Island,4738,1" id="maheIslandOption" style="display: block;">Praslin Island
                  </option>
                  <option value="Mahe Island,4737,2">Mahe Island</option>




                </select>
                <p></p>
                <p id="errorVacIsland">*If you require a COVID 19 test on an Island other than Mahe or Praslin, please
                  call us to book on +248 2 578 899</p>
              </div>
            </div>
            <!-- if user have selected the isaland and select the data the page will be refreshed then we have to get tests again using getData function which is using ajax -->
            <?php
            if (isset($_POST['vaccination_island'])) {
            ?>
              <script>
                $(document).ready(function() {
                  let vaccinationIsland = document.getElementById('vaccinationIsland');
                  let selectedTest = document.getElementById('selectedTest');
                  getData(vaccinationIsland);

                  document.getElementById('selectedTest').value = '<?php echo $_POST['vaccination_island']; ?>';
                  // updatePayment(document.getElementById('selectedTest'));
                });
              </script>
            <?php
            }
            ?>
            <div class="sec_heading" style="margin-bottom: 10px; padding-left: 5px;">
              <h4 id="titleServiceOptions" class="db-services-option">Choose Test Options</h4>
            </div>
            <?php
            if (isset($_POST['test_date'])) {
              $selected_test_date = $_POST['test_date'];
            } else {
              $selected_test_date = date('Y-m-d');
            }
            ?>
            <div class="form-row testing-center">
              <!-- <h6 id="labelDate">Which date would you like us to perform your Covid 19 Test on?</h6> -->
              <div class="input-wrapper w-100" style="padding: 0; width: 100%">
                <input autocomplete="off" type="text" id="testDate" name="test_date" placeholder="Selected test date"
                  value="<?php echo $selected_test_date; ?>">
                <!-- onchange="get_bs_time_slots(this.value)" -->
              </div>
              <!-- <div class="input-wrapper w-100" style="padding: 0; width: 100%; display:none;">
                                <select id="testLocation" name="test_location">
                                    <option value="">Please select island to see available test locations</option>
                                </select>
                            </div> -->
              <script>
                // let testingCenters = {
                //     "Mahe": [
                //         "Eden Island - “The Blue Building” next to Bravo Restaurant (Mahe)",

                //     ],
                //     "Praslin": [
                //         "Praslin Island (Les Lauriers Hotel)",
                //         "Praslin Island - Diamond Plaza Grand Anse (Praslin Island)"
                //     ],
                //     "La": [
                //         "Praslin Island (Les Lauriers Hotel)",
                //         "Praslin Island - Diamond Plaza Grand Anse (Praslin Island)"
                //     ],
                //     "St": [
                //         "No test center at this island"
                //     ],
                //     "Silhouette": [
                //         "Hilton Seychelles Labriz Silhouette Island"
                //     ],
                //     "All": [
                //         "No test center at this island"
                //     ]
                // }
                // var testingOptions = '';
                // var select = document.getElementById('testLocation');

                // function updateTestCenter(element) {
                //     var selectedValue = element.value;
                //     selectedValue = selectedValue.split(" ");
                //     selectedValue = selectedValue[0].trim();
                //     $('#testLocation')
                //         .empty();
                //     var testingCentersArray = testingCenters[selectedValue];
                //     for (let i = 0; i < testingCentersArray.length; i++) {
                //         option = document.createElement('option');
                //         option.value = option.text = testingCentersArray[i];
                //         select.add(option);
                //     }
                //     validateSelectOption(element);
                // }
              </script>


              <script>
                <?php

                // praslin-la-digue-islands

                $h = 1;
                $j = 1;
                $args_hotels = array('post_type' => 'locations', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'tax_query' => array(array(
                  'taxonomy' => 'regions',
                  'field'    => 'slug', // term_id, slug
                  'terms'    => 'mahe-island',
                ),));
                $loop_hotels = new WP_Query($args_hotels);
                $posts_array_hotels = $loop_hotels->posts;

                $maheHotels = "<option value=\"default\">Select your hotel / guest house (we come to you)</option>";
                foreach ($posts_array_hotels as $key_hotels => $value_hotels) {
                  $maheHotels .= '<option value="' .  str_replace("'", "\'", $value_hotels->post_title) . ',' . $value_hotels->ID . ',' . $j . '">' . str_replace("'", "\'", $value_hotels->post_title) . '</option>';
                  $h++;
                }

                $maheHotels .= "<option value=\"Other\">Other</option>";



                $h = 1;
                $args_hotels = array('post_type' => 'locations', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'tax_query' => array(array(
                  'taxonomy' => 'regions',
                  'field'    => 'slug', // term_id, slug
                  'terms'    => 'praslin-island',
                ),));
                $loop_hotels = new WP_Query($args_hotels);
                $posts_array_hotels = $loop_hotels->posts;


                $praslin_hotels = "<option value=\"default\">Select your hotel / guest house (we come to you)</option>";

                foreach ($posts_array_hotels as $key_hotels => $value_hotels) {
                  $praslin_hotels .= '<option value="' .  str_replace("'", "\'", $value_hotels->post_title) . ',' . $value_hotels->ID . ',' . $j . '">' . str_replace("'", "\'", $value_hotels->post_title) . '</option>';
                  $h++;
                }
                $praslin_hotels .= "<option value=\"Other\">Other</option>";

                // wp_die($praslin_hotels);


                ?>


                var MaheHotels = '<?php echo $maheHotels; ?>';
                var PraslinHotels = '<?php echo $praslin_hotels; ?>';

                console.log(MaheHotels);
                console.log(PraslinHotels);
              </script>


              <?php if ($currency == "euro") { ?>
                <div class="input-wrapper w-100" style="padding: 0; width: 100%" id="wrapHotelSelect">
                  <select class="hotel_selection" id="selectedHotel" name="selected_hotel">
                    <option value="default">Select your hotel / guest house (we come to you)</option>





                  </select>
                  <p></p>
                </div>

              <?php } else { ?>

                <div class="input-wrapper" id="wrapCompleteAdress">
                  <input type="text" onfocus=active_input(this) onfocusout=inactive_input(this) data-value="Home Address"
                    id="completeAddress" name="selected_hotel"
                    value="<?php
                            if (isset($_POST['selected_hotel'])) {
                              echo $_POST['selected_hotel'];
                            }
                            ?>"
                    required>
                  <?php
                  if (!isset($_POST['selected_hotel'])) {
                    echo '<span style="top: 19px;">Home Address <span class="required_sign">*</span></span>';
                  } else if (isset($_POST['selected_hotel'])) {
                    if (empty(trim($_POST['selected_hotel']))) {
                      echo '<span style="top: 19px;" >Complete <span class="required_sign">*</span></span>';
                    } else {
                      echo '<span style="top: 19px;" ><span class="required_sign"></span></span>';
                    }
                  }
                  ?>
                  <p></p>
                </div>


              <?php } ?>

              <div class="input-wrapper w-100" style="padding: 0; width: 100%">
                <select class="tests_selection" id="selectedTest" name="selected_test" onchange="updatePayment(this)"
                  data-value="Test Detail">
                  <option value="">Select which type of test you require</option>
                  <!-- <option value="Pcr Test -  Express Service, 575">Pcr Test - Express Service</option>
                            <option value="Pcr Test -  Emergency Service, 190">Pcr Test - Emergency Service</option> -->



                  <?php if (isset($etl_currency) && $etl_currency == "scr") { ?>
                  <?php } else { ?>
                  <?php  } ?>

                  <?php if (isset($_GET['dc'])) { ?>
                    <option value="Late Night Call, 500">Doctor Book</option>
                  <?php } ?>

                </select>
                <p></p>
              </div>

            </div>
            <!-- Form Row Ends  -->
            <?php

            ?>

            <div class="text-available-slots" id="titleTimeSlots">
              <div class="sec_heading">
                <p class="bs-label">Available Time Slots <span
                    id="timeSlotDate"><?php echo date('d M-Y', strtotime($selected_test_date)); ?></span></p>
              </div><span id="errorTimeSlot" class="text-danger hide">(Please select a time slot)</span>
            </div>
            <div class="slot-row" id="wrapTimeSlots">

            </div>
            <input type="text" name="selected_time_slot" id="selectedTimeSlot" hidden>





          </div>
          <!-- Tab 3 Content Ends Here -->
          <div class="tab">
            <!-- Tab 4 Content Starts here -->
            <div class="overview-row table-responsive">
              <div class="sec_heading">
                <h4>Order Summary</h4>
              </div>
              <div class="summary-card">

                <div class="summary-header">
                  <span>Total</span>
                  <span>
                    <?php echo $currency_sign; ?> <span id="etlTestPriceGrandTotal">0</span>
                  </span>
                </div>

                <div class="summary-body">
                  <div class="summary-row">
                    <span>Services</span>
                    <span id="etlTestName">-</span>
                  </div>

                  <div class="summary-row">
                    <span>Sub total</span>
                    <span>
                      <?php echo $currency_sign; ?> <span id="etlTestPrice">0</span>
                    </span>
                  </div>

                  <div class="summary-row">
                    <span>Total</span>
                    <span>
                      <?php echo $currency_sign; ?> <span id="etlTestPriceTotal">0</span>
                    </span>
                  </div>

                </div>
              </div>
            </div>



          </div> <!-- Tab 4 Content Ends -->

          <!-- Tab 5 Content Starts here -->
          <!-- @checkout -->
          <div class="tab">

            <div class="sec_heading">
              <h4>Make Payment</h4>
            </div>
            <div>
              <!-- <label class="form_sec_title">Payment Details</label> -->
            </div>
            <div class="payment-details">
              <span>
                <label for="">Credit card number</label>
                <div style="position:relative">
                  <input data-value="Credit Card Number" onfocus=active_input(this) onfocusout=inactive_input(this)
                    type="text" id="accountNumber" name="accountNumber" placeholder="Credit card number">
                  <!-- Card Images Start -->
                  <div class="card-img-wrapper">

                    <!-- VISA CARD SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="512" height="512" x="0" y="0"
                      viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                      <g>
                        <path
                          d="M512 402.281c0 16.716-13.55 30.267-30.265 30.267H30.265C13.55 432.549 0 418.997 0 402.281V109.717c0-16.716 13.55-30.266 30.265-30.266h451.47c16.716 0 30.265 13.551 30.265 30.266v292.564z"
                          style="" fill="#ffffff" data-original="#ffffff" class=""></path>
                        <path
                          d="m113.64 258.035-12.022-57.671c-2.055-7.953-8.035-10.319-15.507-10.632H30.993l-.491 2.635c42.929 10.407 71.334 35.513 83.138 65.668z"
                          style="" fill="#f79f1a" data-original="#f79f1a" class=""></path>
                        <path
                          d="M241.354 190.892h-35.613l-22.242 130.527h35.554zM135.345 321.288l56.01-130.307h-37.691l-34.843 89.028-3.719-13.442c-6.83-16.171-26.35-39.446-49.266-54.098l31.85 108.863 37.659-.044zM342.931 278.75c.132-14.819-9.383-26.122-29.887-35.458-12.461-6.03-20.056-10.051-19.965-16.17 0-5.406 6.432-11.213 20.368-11.213 11.661-.179 20.057 2.367 26.624 5.003l3.218 1.475 4.826-28.277c-7.059-2.637-18.094-5.451-31.895-5.451-35.157 0-59.904 17.691-60.128 43.064-.224 18.763 17.692 29.216 31.181 35.469 13.847 6.374 18.493 10.453 18.404 16.171-.089 8.743-11.035 12.73-21.264 12.73-14.25 0-21.8-1.965-33.509-6.843l-4.55-2.09-4.998 29.249c8.303 3.629 23.668 6.801 39.618 6.933 37.387 0 61.689-17.466 61.957-44.592zM385.233 301.855c4.065 0 40.382.045 45.566.045 1.072 4.545 4.333 19.565 4.333 19.565h33.011L439.33 191.027h-27.472c-8.533 0-14.874 2.323-18.628 10.809l-52.845 119.629h37.392c-.003 0 6.071-16.079 7.456-19.61zm24.389-63.21c-.176.357 2.95-7.549 4.737-12.463l2.411 11.256s6.792 31.182 8.22 37.704h-29.528c2.949-7.504 14.16-36.497 14.16-36.497zM481.735 79.451H30.265C13.55 79.451 0 93.001 0 109.717v31.412h512v-31.412c0-16.716-13.549-30.266-30.265-30.266z"
                          style="" fill="#059bbf" data-original="#059bbf"></path>
                        <path
                          d="M481.735 432.549H30.265C13.55 432.549 0 418.998 0 402.283v-31.412h512v31.412c0 16.715-13.549 30.266-30.265 30.266z"
                          style="" fill="#f79f1a" data-original="#f79f1a" class=""></path>
                        <path
                          d="M21.517 402.281V109.717c0-16.716 13.551-30.266 30.267-30.266h-21.52C13.55 79.451 0 93.001 0 109.717v292.565c0 16.716 13.55 30.267 30.265 30.267h21.52c-16.716 0-30.268-13.552-30.268-30.268z"
                          style="opacity:0.15;enable-background:new ;" fill="#202121" data-original="#202121" class="">
                        </path>
                      </g>
                    </svg>

                    <!-- MasterCard -->
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="512" height="512" x="0" y="0"
                      viewBox="0 0 160 100" style="enable-background:new 0 0 512 512" xml:space="preserve">
                      <g>
                        <g fill="none" fill-rule="evenodd">
                          <path fill="#265697"
                            d="M148 0H8C4 0 0 4 0 8v80c0 8 4 12 12 12h136c8 0 12-4 12-12V12c0-8-4-12-12-12zm0 0"
                            opacity="1" data-original="#265697"></path>
                          <path fill="#dfac16"
                            d="M149.545 50.5c.007 23.238-18.625 42.08-41.615 42.085-22.991.006-41.631-18.826-41.637-42.064V50.5c-.006-23.237 18.626-42.08 41.615-42.086 22.99-.006 41.631 18.827 41.637 42.065zm0 0"
                            opacity="1" data-original="#dfac16"></path>
                          <path fill="#bf3126"
                            d="M51.813 8.425c-22.854.147-41.359 18.94-41.359 42.075 0 23.225 18.649 42.075 41.627 42.075 10.784 0 20.614-4.155 28.011-10.963l-.003-.002h.009a42.283 42.283 0 0 0 4.226-4.505h-8.529a41.082 41.082 0 0 1-3.103-4.335H87.4a42.29 42.29 0 0 0 2.423-4.505h-19.56a41.763 41.763 0 0 1-1.74-4.42h23.042A42.384 42.384 0 0 0 93.707 50.5a42.6 42.6 0 0 0-.959-9.01H67.302c.315-1.494.713-2.97 1.187-4.42h23.05a42.346 42.346 0 0 0-1.794-4.505H70.26a40.506 40.506 0 0 1 2.389-4.42h14.697a42.154 42.154 0 0 0-3.23-4.505h-8.195a38.848 38.848 0 0 1 4.176-4.25C72.7 12.58 62.868 8.425 52.08 8.425h-.268s.09 0 0 0zm0 0"
                            opacity="1" data-original="#bf3126"></path>
                          <g fill="#fff">
                            <path
                              d="m67.05 61.212.554-3.808c-.303 0-.748.132-1.142.132-1.543 0-1.713-.83-1.614-1.443l1.246-7.77h2.345l.566-4.211h-2.211l.45-2.62h-4.432c-.098.1-2.616 14.732-2.616 16.514 0 2.637 1.465 3.812 3.531 3.793 1.618-.013 2.878-.466 3.323-.587 0 0-.445.121 0 0zM68.454 53.952c0 6.331 4.134 7.835 7.656 7.835 3.251 0 4.682-.734 4.682-.734l.78-4.32s-2.473 1.1-4.706 1.1c-4.76 0-3.926-3.586-3.926-3.586h9.007s.582-2.903.582-4.086c0-2.952-1.454-6.548-6.32-6.548-4.456 0-7.755 4.854-7.755 10.34zm7.772-6.327c2.501 0 2.04 2.84 2.04 3.07h-4.92c0-.293.464-3.07 2.88-3.07zM104.292 61.21l.793-4.883s-2.175 1.102-3.667 1.102c-3.144 0-4.405-2.427-4.405-5.034 0-5.288 2.705-8.198 5.716-8.198 2.259 0 4.071 1.282 4.071 1.282l.724-4.745s-2.688-1.1-4.992-1.1c-5.117 0-10.094 4.487-10.094 12.913 0 5.587 2.688 9.277 7.977 9.277 1.495 0 3.877-.614 3.877-.614zM42.673 43.682c-3.039 0-5.369.988-5.369.988l-.643 3.859s1.923-.79 4.83-.79c1.65 0 2.857.188 2.857 1.543 0 .824-.148 1.128-.148 1.128s-1.301-.11-1.904-.11c-3.833 0-7.86 1.653-7.86 6.638 0 3.928 2.642 4.83 4.279 4.83 3.127 0 4.475-2.051 4.547-2.058l-.146 1.712h3.902l1.741-12.337c0-5.234-4.517-5.403-6.086-5.403zm.95 10.046c.084.753-.468 4.286-3.136 4.286-1.377 0-1.735-1.063-1.735-1.692 0-1.226.66-2.698 3.907-2.698.755.001.836.083.964.104 0 0-.128-.021 0 0zM52.907 61.677c.999 0 6.706.257 6.706-5.696 0-5.565-5.283-4.465-5.283-6.7 0-1.114.86-1.464 2.435-1.464.625 0 3.028.2 3.028.2l.56-3.955s-1.556-.352-4.09-.352c-3.278 0-6.606 1.323-6.606 5.85 0 5.128 5.549 4.614 5.549 6.774 0 1.442-1.55 1.56-2.745 1.56-2.068 0-3.93-.717-3.936-.683l-.591 3.915c.107.034 1.255.551 4.973.551zM141.004 40.133l-.956 5.996s-1.668-2.33-4.28-2.33c-4.06 0-7.445 4.95-7.445 10.636 0 3.67 1.805 7.267 5.496 7.267 2.655 0 4.126-1.87 4.126-1.87l-.195 1.597h4.311l3.386-21.303zm-2.058 11.69c0 2.367-1.159 5.528-3.562 5.528-1.595 0-2.342-1.354-2.342-3.478 0-3.473 1.543-5.764 3.49-5.764 1.596 0 2.414 1.107 2.414 3.715zM18.675 61.448l2.698-16.084.396 16.084h3.054l5.696-16.084-2.523 16.084h4.537l3.495-21.332H29.01l-4.37 13.088-.227-13.088h-6.467l-3.545 21.332zM86.961 61.477c1.29-7.415 1.53-13.436 4.608-12.334.54-2.87 1.06-3.98 1.647-5.195 0 0-.275-.059-.854-.059-1.985 0-3.456 2.741-3.456 2.741l.396-2.517h-4.127L82.41 61.477zM114.519 43.682c-3.04 0-5.37.988-5.37.988l-.642 3.859s1.923-.79 4.83-.79c1.65 0 2.856.188 2.856 1.543 0 .824-.147 1.128-.147 1.128s-1.301-.11-1.905-.11c-3.832 0-7.859 1.653-7.859 6.638 0 3.928 2.641 4.83 4.278 4.83 3.127 0 4.475-2.051 4.547-2.058l-.145 1.712h3.902l1.74-12.337c.001-5.234-4.516-5.403-6.085-5.403zm.95 10.046c.085.753-.467 4.286-3.137 4.286-1.376 0-1.733-1.063-1.733-1.692 0-1.226.659-2.698 3.906-2.698.755.001.836.083.964.104 0 0-.128-.021 0 0zM124.172 61.477c1.29-7.415 1.53-13.436 4.607-12.334.54-2.87 1.06-3.98 1.648-5.195 0 0-.276-.059-.854-.059-1.985 0-3.456 2.741-3.456 2.741l.395-2.517h-4.126l-2.765 17.364zm0 0"
                              fill="#ffffff" opacity="1" data-original="#ffffff"></path>
                          </g>
                        </g>
                      </g>
                    </svg>

                    <!-- UnionPay -->
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="512" height="512" x="0" y="0"
                      viewBox="0 0 120 76" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                      <g
                        transform="matrix(1.5000000000000009,0,0,1.5000000000000009,-30.000249862670984,-19.00000000000005)">
                        <g fill="none" fill-rule="evenodd">
                          <path
                            d="M111.999 0H8C3.582 0 0 3.59 0 8.008v59.984C0 72.415 3.591 76 8.001 76H112c4.419 0 8.001-3.59 8.001-8.008V8.008C120 3.585 116.409 0 111.999 0z"
                            opacity="1" data-original="#f4f4f4" class=""></path>
                          <path fill="#22abbb"
                            d="m93.102 12.313-18.105-.005h-.004l-.042.003c-2.487.085-5.584 2.319-6.149 5.072L60.24 59.795c-.564 2.78.971 5.042 3.44 5.083H82.7c2.432-.134 4.794-2.342 5.349-5.064L96.61 17.4c.573-2.808-.999-5.088-3.509-5.088"
                            opacity="1" data-original="#22abbb" class=""></path>
                          <path fill="#227fbb"
                            d="m61.538 59.796 8.708-42.408c.574-2.753 3.724-4.987 6.254-5.072l-7.321-.005-13.19-.003c-2.537.057-5.728 2.306-6.302 5.08l-8.71 42.408c-.576 2.78.987 5.04 3.497 5.082h20.563c-2.511-.041-4.072-2.303-3.499-5.082"
                            opacity="1" data-original="#227fbb" class=""></path>
                          <path fill="#e94b35"
                            d="m41.41 59.796 8.622-42.404c.568-2.773 3.727-5.022 6.239-5.079l-16.728-.005c-2.525 0-5.763 2.274-6.34 5.084l-8.622 42.404a5.868 5.868 0 0 0-.1.761v.787c.17 2.025 1.561 3.5 3.561 3.534h16.83c-2.485-.041-4.033-2.303-3.462-5.082"
                            opacity="1" data-original="#e94b35" class=""></path>
                          <g fill="#fff">
                            <path
                              d="M55.012 42.872h.331c.305 0 .51-.125.605-.372l.86-1.573h2.304l-.48 1.035h2.762l-.35 1.586h-3.287c-.379.696-.845 1.023-1.405.984H54.64l.372-1.66zm-.477 2.385h5.63l-.358 1.407h-2.265l-.345 1.359H59.4l-.359 1.407h-2.203l-.512 2.007c-.127.335.04.486.497.452h1.796l-.333 1.307H54.84c-.654 0-.878-.4-.673-1.205l.654-2.561h-1.408l.358-1.407h1.408l.346-1.359h-1.347l.358-1.407zm8.87-4.296-.086.889s1.034-.923 1.973-.923h3.47l-1.327 5.711c-.11.653-.582.978-1.416.978h-3.932l-.92 4.01c-.054.215.021.326.22.326h.773l-.284 1.244h-1.967c-.755 0-1.07-.27-.945-.812l2.603-11.423h1.839zm2.9 1.41h-3.29l-.393 1.443s.548-.415 1.463-.43c.913-.015 1.956 0 1.956 0zm-1.23 3.603c.251.024.392-.044.409-.205l.207-.512h-3.398l-.285.717zm-2.318 1.448h1.764l-.032 1.01h.47c.237 0 .355-.1.355-.298l.139-.654h1.466l-.195.953c-.166.794-.605 1.209-1.319 1.25h-.94l-.004 1.726c-.018.277.171.418.56.418h.884l-.285 1.367H63.5c-.593.037-.884-.337-.878-1.131l.135-4.64zM41.534 33.075c-.24 1.36-.796 2.405-1.66 3.148-.854.73-1.957 1.095-3.308 1.095-1.271 0-2.203-.374-2.797-1.123-.413-.533-.618-1.21-.618-2.027 0-.338.035-.702.105-1.093l1.439-8.027h2.173l-1.42 7.936c-.043.22-.06.424-.058.608-.002.407.085.74.262 1 .257.386.675.578 1.256.578.67 0 1.22-.19 1.648-.57.428-.38.707-.917.832-1.616l1.424-7.936h2.163zM51.075 30.1h1.723l-1.35 7.218h-1.72zm.785-2.887h1.552l-.29 2.166H51.57zM53.457 37.271c-.436-.518-.657-1.218-.659-2.106 0-.152.007-.325.024-.514a6.91 6.91 0 0 1 .065-.55c.198-1.226.62-2.2 1.27-2.918.648-.72 1.43-1.083 2.346-1.083.75 0 1.345.261 1.781.782.435.524.654 1.232.654 2.131 0 .154-.01.332-.026.524-.02.194-.042.38-.07.564-.193 1.207-.614 2.17-1.263 2.875-.65.71-1.43 1.064-2.34 1.064-.753 0-1.346-.256-1.782-.769m3.218-1.598c.308-.373.529-.938.663-1.69a3.631 3.631 0 0 0 .065-.698c0-.438-.1-.778-.3-1.018-.2-.242-.483-.362-.85-.362-.483 0-.878.19-1.187.57-.311.38-.532.955-.67 1.72-.02.118-.036.235-.05.35a2.84 2.84 0 0 0-.012.328c0 .435.1.77.3 1.007.2.238.481.355.852.355.487 0 .88-.187 1.189-.562M70.493 42.665l.416-1.738h2.098l-.09.638s1.072-.638 1.845-.638h2.595l-.413 1.738h-.408l-1.958 8.197h.409l-.389 1.628h-.408l-.17.706h-2.032l.17-.706h-4.01l.39-1.628h.402l1.96-8.197h-.407zm2.42.427-.468 2.165s.8-.407 1.49-.522c.153-.756.352-1.643.352-1.643h-1.374zM71.685 46.7l-.468 2.165s.884-.553 1.491-.6c.176-.836.351-1.565.351-1.565h-1.374zm.999 4.33.375-2.165h-1.464l-.378 2.165zm4.673-10.104h2.213l.094.939c-.014.239.11.353.372.353h.39l-.395 1.591h-1.627c-.621.037-.94-.236-.97-.825zm-.251 3.608h6.39l-.374 1.478h-2.035l-.35 1.374h2.034l-.378 1.476H80.13l-.512.865h1.108l.256 1.731c.03.172.168.256.402.256h.344l-.362 1.426h-1.218c-.632.035-.958-.202-.985-.712l-.293-1.58-1.009 1.681c-.238.476-.604.697-1.098.663H74.9l.362-1.426h.58c.239 0 .437-.119.616-.357l1.578-2.547h-2.035l.377-1.476h2.207l.351-1.374h-2.209zM43.561 30.279h1.488l-.17 1.016.214-.29c.482-.605 1.068-.905 1.76-.905.626 0 1.078.214 1.361.642.28.43.355 1.022.223 1.783l-.82 4.793h-1.529l.74-4.345c.077-.448.056-.783-.062-.999-.116-.215-.339-.322-.659-.322-.393 0-.725.144-.994.429-.271.287-.45.686-.538 1.194l-.682 4.043h-1.532zM61.366 30.279h1.49l-.17 1.016.212-.29c.483-.605 1.07-.905 1.76-.905.627 0 1.08.214 1.36.642.278.43.359 1.022.223 1.783l-.817 4.793h-1.531l.74-4.345c.076-.448.055-.783-.061-.999-.12-.215-.339-.322-.658-.322-.394 0-.724.144-.997.429-.27.287-.45.686-.535 1.194l-.685 4.043h-1.531l1.2-7.04M68.987 25.048h4.475c.86 0 1.526.238 1.983.704.456.473.684 1.15.684 2.033v.027c0 .168-.01.357-.022.562-.022.203-.05.408-.088.622-.197 1.168-.655 2.107-1.362 2.82-.71.709-1.55 1.066-2.517 1.066h-2.4l-.743 4.436H66.92l2.068-12.27m1.002 6.135h2.204c.574 0 1.03-.177 1.362-.526.33-.354.548-.893.67-1.625.018-.135.03-.257.045-.369.008-.106.017-.212.017-.314 0-.524-.14-.903-.422-1.14-.28-.241-.722-.356-1.333-.356h-1.871l-.672 4.33M85.445 38.711c-.643 1.622-1.255 2.567-1.614 3.007-.36.435-1.073 1.446-2.79 1.37l.147-1.238c1.445-.528 2.227-2.91 2.672-3.965l-.53-7.767 1.117-.018h.938l.1 4.873 1.758-4.873h1.78l-3.578 8.611M79.993 31.02l-.705.607c-.737-.721-1.41-1.168-2.709-.414-1.769 1.026-3.247 8.898 1.624 6.306l.277.411 1.916.062 1.259-7.153-1.662.181m-.958 3.809c-.336 1.174-1.085 1.95-1.672 1.73-.587-.216-.797-1.349-.457-2.526.335-1.177 1.09-1.95 1.672-1.73.587.216.799 1.349.457 2.526"
                              fill="#ffffff" opacity="1" data-original="#ffffff" class=""></path>
                          </g>
                        </g>
                      </g>
                    </svg>

                    <!-- American Express -->
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="512" height="512" x="0" y="0"
                      viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                      <g>
                        <path
                          d="M512 402.281c0 16.716-13.55 30.267-30.265 30.267H30.265C13.55 432.549 0 418.997 0 402.281V109.717c0-16.715 13.55-30.266 30.265-30.266h451.47c16.716 0 30.265 13.551 30.265 30.266v292.564z"
                          style="" fill="#306fc5" data-original="#306fc5" class=""></path>
                        <path
                          d="M21.517 402.281V109.717c0-16.715 13.552-30.266 30.267-30.266h-21.52C13.55 79.451 0 93.001 0 109.717v292.565c0 16.716 13.55 30.267 30.265 30.267h21.52c-16.715 0-30.268-13.552-30.268-30.268z"
                          style="opacity:0.15;enable-background:new ;" fill="#202121" data-original="#202121"></path>
                        <path
                          d="M74.59 220.748h15.298l-7.647-19.47zM155.946 286.107v9.041h25.729v9.737h-25.729v10.433h28.509l13.211-14.606-12.515-14.605zM356.898 201.278l-8.345 19.47h15.995zM230.348 320.875v-39.634l-18.08 19.471zM264.42 292.368c-.696-4.172-3.48-6.261-7.654-6.261h-14.599v12.516h15.299c4.171.001 6.954-2.084 6.954-6.255zM313.09 297.236c1.391-.697 2.089-2.785 2.089-4.867.696-2.779-.698-4.172-2.089-4.868-1.387-.696-3.476-.696-5.559-.696h-13.91v11.127h13.909c2.083 0 4.172 0 5.56-.696z"
                          style="" fill="#ffffff" data-original="#ffffff" class=""></path>
                        <path
                          d="M413.217 183.198v8.344l-4.169-8.344H376.37v8.344l-4.174-8.344h-44.502c-7.648 0-13.909 1.392-19.469 4.173v-4.173h-31.289v4.173c-3.476-2.78-7.648-4.173-13.211-4.173h-111.95l-7.652 17.384-7.647-17.384H101.014v8.344l-3.477-8.344H66.942l-13.909 32.68-15.991 35.462-.294.697h36.201l.252-.697 4.174-10.428h9.039l4.172 11.125h40.326v-8.344l3.479 8.343h20.163l3.475-8.343v8.344h96.654v-18.08h1.394c1.389 0 1.389 0 1.389 2.087v15.297h50.065v-4.172c4.172 2.089 10.426 4.172 18.771 4.172h20.863l4.172-11.123h9.732l4.172 11.123h40.328v-10.428l6.261 10.428h32.68v-68.143h-31.293zm-235.716 58.411H166.375v-38.245l-.696 1.595v-.019l-16.176 36.669H139.255l-16.687-38.245v38.245h-23.64l-4.867-10.43H70.417l-4.868 10.43H53.326l20.57-48.675h17.382l19.469 46.587v-46.587h18.422l.328.697h.024l8.773 19.094 6.3 14.306.223-.721 13.906-33.375H177.5v48.674h.001zm47.98-38.245h-27.119v9.039h26.423v9.734h-26.423v9.738h27.119v10.427h-38.939v-49.367h38.939v10.429zm49.595 17.93c.018.016.041.027.063.042.263.278.488.557.68.824 1.332 1.746 2.409 4.343 2.463 8.151l.011.197c0 .038.007.071.007.11l-.002.06c.016.383.026.774.026 1.197v9.735h-10.428v-5.565c0-2.781 0-6.954-2.089-9.735a6.33 6.33 0 0 0-2.046-1.398c-1.042-.675-3.017-.686-6.295-.686h-12.52v17.384h-11.818v-48.675h26.425c6.254 0 10.428 0 13.906 2.086 3.407 2.046 5.465 5.439 5.543 10.812-.161 7.4-4.911 11.46-8.326 12.829 0 0 2.32.467 4.4 2.632zm23.415 20.315h-11.822v-48.675h11.822v48.675zm135.592 0h-15.3l-22.25-36.855v30.595l-.073-.072v6.362h-11.747v-.029h-11.822l-4.172-10.43H344.38l-4.172 11.123h-13.211c-5.559 0-12.517-1.389-16.687-5.561-4.172-4.172-6.256-9.735-6.256-18.773 0-6.953 1.389-13.911 6.256-19.472 3.474-4.175 9.735-5.562 17.382-5.562h11.128v10.429h-11.128c-4.172 0-6.254.693-9.041 2.783-2.082 2.085-3.474 6.256-3.474 11.123 0 5.564.696 9.04 3.474 11.821 2.091 2.089 4.87 2.785 8.346 2.785h4.867l15.991-38.243h17.385l19.472 46.587v-46.586h17.382l20.161 34.07v-34.07h11.826v47.977h.002v-.002z"
                          style="" fill="#ffffff" data-original="#ffffff" class=""></path>
                        <path
                          d="M265.161 213.207c.203-.217.387-.463.543-.745.63-.997 1.352-2.793.963-5.244a3.884 3.884 0 0 0-.105-.634c-.013-.056-.011-.105-.026-.161l-.007.001c-.346-1.191-1.229-1.923-2.11-2.367-1.394-.693-3.48-.693-5.565-.693h-13.909v11.127h13.909c2.085 0 4.172 0 5.565-.697.209-.106.395-.25.574-.413l.002.009c.001-.001.072-.075.166-.183zM475.105 311.144c0-4.867-1.389-9.736-3.474-13.212v-31.289h-.032v-2.089h-33.483c-4.336 0-9.598 4.171-9.598 4.171v-4.171h-31.984c-4.87 0-11.124 1.392-13.909 4.171v-4.171h-57.016v4.17c-4.169-3.474-11.824-4.171-15.298-4.171h-37.549v4.17c-3.476-3.474-11.824-4.171-15.998-4.171H215.05l-9.737 10.431-9.04-10.431h-62.578v70.233h61.19l10.054-10.057 8.715 10.057h38.942v-15.992h3.479c4.863 0 11.124 0 15.991-2.089v18.776h31.291V317.4h1.387c2.089 0 2.089 0 2.089 2.086v15.994h94.563c6.263 0 12.517-1.394 15.993-4.175v4.175h29.902c6.254 0 12.517-.695 16.689-3.478 6.402-3.841 10.437-10.64 11.037-18.749.028-.24.063-.48.085-.721l-.041-.039c.026-.45.044-.895.044-1.349zm-219.029-4.171h-13.91v18.077h-22.855l-13.302-15.299-.046.051-.65-.748-15.297 15.996h-44.501v-48.673h45.197l12.348 13.525 2.596 2.832.352-.365 14.604-15.991h36.852c7.152 0 15.161 1.765 18.196 9.042.365 1.441.577 3.043.577 4.863 0 13.906-9.735 16.69-20.161 16.69zm69.533-.697c1.389 2.081 2.085 4.867 2.085 9.041v9.732h-11.819v-6.256c0-2.786 0-7.65-2.089-9.739-1.387-2.081-4.172-2.081-8.341-2.081H292.93v18.077h-11.82v-49.369h26.421c5.559 0 10.426 0 13.909 2.084 3.474 2.088 6.254 5.565 6.254 11.128 0 7.647-4.865 11.819-8.343 13.212 3.478 1.385 5.563 2.78 6.258 4.171zm47.98-20.169h-27.122v9.04h26.424v9.737h-26.424v9.736h27.122v10.429H334.65V275.68h38.939v10.427zm29.202 38.943h-22.252v-10.429h22.252c2.082 0 3.476 0 4.87-1.392.696-.697 1.387-2.085 1.387-3.477 0-1.394-.691-2.778-1.387-3.475-.698-.695-2.091-1.391-4.176-1.391-11.126-.696-24.337 0-24.337-15.296 0-6.954 4.172-14.604 16.689-14.604h22.945v11.819h-21.554c-2.085 0-3.478 0-4.87.696-1.387.697-1.387 2.089-1.387 3.478 0 2.087 1.387 2.783 2.778 3.473 1.394.697 2.783.697 4.172.697h6.259c6.259 0 10.43 1.391 13.211 4.173 2.087 2.087 3.478 5.564 3.478 10.43 0 10.427-6.258 15.298-18.078 15.298zm59.799-4.871c-2.778 2.785-7.648 4.871-14.604 4.871H425.74v-10.429h22.245c2.087 0 3.481 0 4.87-1.392.693-.697 1.391-2.085 1.391-3.477 0-1.394-.698-2.778-1.391-3.475-.696-.695-2.085-1.391-4.172-1.391-11.122-.696-24.337 0-24.337-15.295 0-6.609 3.781-12.579 13.106-14.352a25.917 25.917 0 0 1 3.583-.253h22.948v11.819H442.426c-2.087 0-3.476 0-4.865.696-.7.697-1.396 2.089-1.396 3.478 0 2.087.696 2.783 2.785 3.473 1.389.697 2.78.697 4.172.697h6.256c3.039 0 5.337.375 7.44 1.114 1.926.697 8.302 3.549 9.728 10.994.124.78.215 1.594.215 2.495 0 4.173-1.391 7.649-4.171 10.427z"
                          style="" fill="#ffffff" data-original="#ffffff" class=""></path>
                      </g>
                    </svg>

                  </div> <!-- Card Images End -->
                  <span></span>
                  <p></p>
                </div>
              </span>
              <div class="">
                <label for="fullName">Card holder name</label>
                <input data-value="Card Holder Name" type="text" id="fullName" name="fullName"
                  placeholder="Card holder name">
                <span></span>
                <p></p>
              </div>
            </div>
            <div class="">
              <!-- <label for="expirationMonth">Expiration Date</label> -->
            </div>
            <div class="payment-row-exp">
              <span>
                <label for="month" class="bs-label">Expiration Month</label>
                <select id="month" name="expirationMonth" class="col-50">
                  <option value="">Expiration month</option>
                  <option value="01">January</option>
                  <option value="02">February</option>
                  <option value="03">March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
              </span>
              <span>
                <label for="year" class="bs-label">Expiration year</label>
                <select id="year" name="expirationYear" class="col-50">
                  <option value="">Expiration year</option>
                  <?php
                  $start_year = date("Y");
                  for ($x = $start_year; $x <= $start_year + 10; $x++) {
                  ?>
                    <option value="<?php echo  $x; ?>">
                      <?php echo $x; ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
              </span>
              <span>
                <label for="cardType" class="bs-label">Card type</label>
                <select id="cardType" name="cardType" style="margin-top: 6px">
                  <option value="">Card type</option>
                  <option value="MasterCard">MasterCard</option>
                  <option value="AmericanExpress">American Express</option>
                  <option value="Visa">Visa</option>
                  <option value="Discover">Discover</option>
                </select>
              </span>
              <span>
                <label for="cardCvv" class="bs-label">Card CVV</label>
                <input data-value="CVV" onfocus=active_input(this) onfocusout=inactive_input(this) type="text"
                  id="cardCvv" name="card_cvv" placeholder="Enter card cvv no" style="max-height:50px">
              </span>
            </div>
            <input type="text" id="grandTotalAmountToBeCharged" name="grand_total_amount_to_be_charged" value="0" hidden>
            <!-- <div class="row">
                        <div class="col-100">
                            <select id="cardType" name="cardType">
                                <option value="">Choose Card Type</option>
                                <option value="MasterCard">MasterCard</option>
                                <option value="AmericanExpress">American Express</option>
                                <option value="Visa">Visa</option>
                                <option value="Discover">Discover</option>
                            </select>
                            <span class="error" id="lblType"> </span>
                        </div>
                    </div> -->
            <input type="text" value="no" hidden id="submitCheck" name="submit_check">
            <div class="row">
              <div class="col-100">
                <!-- <input type="submit" class="bs-btn-next" id="submitForm" onclick="return validateForm()" value="Book Now"> -->
              </div>
            </div>



          </div><!-- Tab 5 Content Ends -->
          <div style="overflow:auto;">
            <div style="">
              <button type="button" id="prevBtn" class="bs-btn-prev" onclick="nextPrev(-1)">Previous</button>
              <button type="button" id="nextBtn" class="bs-btn-next" onclick="nextPrev(1)">Continue</button>
              <input type="submit" class="bs-btn-next" id="submitForm" onclick="return validateForm()" value="Book Now">
            </div>
          </div>


        </form>
      </div>


















</form>
<input type="text" id="extraAmountToAdd" value="0" hidden>
<?php } ?>
</div>

<script>
  var currentTab = 0; // Current tab is set to be the first tab (0)



  function getExtraAmountToAdd() {
    var amount = document.getElementById('extraAmountToAdd').value;
    return parseInt(amount);
  }


  function setExtraAmountToAdd(amount) {

    const myInput = document.getElementById("extraAmountToAdd");
    myInput.value = amount;

  }


  function ifPraslin() {
    var elem = document.getElementById('vaccinationIsland');
    var islandId = elem.value.split(",")[1];
    var inputPCRAntigen = document.getElementById('inputPCRAntigen');
    if (islandId == 4738) {
      return true;
    }
    return false;
  }


  function handleIslandChange(elem) {


    var selectedHotel = document.getElementById('selectedHotel');

    if (ifPraslin()) {
      // user selected praslin & La Digue  Island
      setExtraAmountToAdd(100);
      selectedHotel.innerHTML = PraslinHotels;
    } else {
      // user select Mahe (or other probably mahe)



      setExtraAmountToAdd(0);
      // MaheHotels
      selectedHotel.innerHTML = MaheHotels;

    }

    ListenTest(get_selected_service_type());


  }


  function addExtraAmount(array) {
    function replacePrice(element) {
      const previousPrice = element.price;
      element.price += getExtraAmountToAdd();
      element.name = element.name.replace(previousPrice, element.price);
      return element;
    }



    return array.map(replacePrice);
  }



  function getTestArray(arrayType) {



    <?php if ($currency == "euro") { ?>

      var returnArray = null;



      pcrArray = [{

        "name": "Antibody Express Service - Results within 15 mins - (€120)",

        "price": 120

      }, {

        "name": "Antigen Express Service - Results within 15 mins - (€120)",

        "price": 120

      }, {

        "name": "PCR Test Express Plus - Results within 12 hrs - (€190)",

        "price": 190

      }, {

        "name": "PCR Test Emergency Service - Results within 2-4 hrs - (€575)",

        "price": 575

      }, {

        "name": "Combination Express PCR and Antigen or Antibody - (€250)",

        "price": 250

      }]

      visitArray = [{

          "name": "Next Day In Person Consultation - (€150)",

          "price": 150

        }, {

          "name": "Same Day In Person Consultation - (€175)",

          "price": 175

        },

        {

          "name": "1 Hour In Person Call Out (Day) - (€275)",

          "price": 275

        }, {

          "name": "1 Hour In Person Call Out (Night) - (€375)",

          "price": 375

        }

      ]

      teleArray = [{

          "name": "Next Day Video Consultation - (€100)",

          "price": 100

        }, {

          "name": "Same Day Video Consultation - (€125)",

          "price": 125

        },

        {

          "name": "1 Hour Video Consultation Call Out (Day) - (€300)",

          "price": 300

        }, {

          "name": "1 Hour Video Consultation Call Out (Night) - (€400)",

          "price": 400

        }

      ];


    <?php } else { ?>


      // currency is SCR
      pcrArray = [{

        "name": "Antibody Express Service - Results within 15 mins - (SCR 1200)",

        "price": 1200

      }, {

        "name": "Antigen Express Service - Results within 15 mins - (SCR 1200)",

        "price": 1200

      }, {

        "name": "PCR Test Express Plus - Results within 12 hrs - (SCR 1200)",

        "price": 1200

      }, {

        "name": "Combination Express PCR and Antigen or Antibody - (SCR 1,500)",

        "price": 1500

      }]

      visitArray = [{

          "name": "Next Day In Person Consultation - (SCR 500)",

          "price": 500

        }, {

          "name": "Same Day In Person Consultation - (SCR 750)",

          "price": 750

        },

        {

          "name": "1 Hour In Person Call Out (Day) - (SCR 1500)",

          "price": 1500

        }, {

          "name": "1 Hour In Person Call Out (Night) - (SCR 2000)",

          "price": 2000

        }

      ]

      teleArray = [{

          "name": "Next Day Video Consultation - (SCR 250)",

          "price": 250

        }, {

          "name": "Same Day Video Consultation - (SCR 350)",

          "price": 350

        },

        {

          "name": "1 Hour Video Consultation Call Out (Day) - (SCR 750)",

          "price": 750

        }, {

          "name": "1 Hour Video Consultation Call Out (Night) - (SCR 1000)",

          "price": 1000

        }

      ];




    <?php } ?>







    switch (arrayType) {
      case 'pcrArray':
        returnArray = pcrArray;
        break;

      case 'visitArray':
        returnArray = visitArray;
        break;


      case 'teleArray':
        returnArray = teleArray;
        break;
    }




    if (ifPraslin()) {
      // island is not praslin remove emergeycy service
      return removeEmergency(addExtraAmount(returnArray));

    }



    return addExtraAmount(returnArray);




  }


  function removeEmergency(array) {
    function filterArray(e) {
      return !e.name.includes('Emergency')

    }
    return array.filter(filterArray);

  }




  function submitTheForm(element) {
    document.getElementById('vacIslandValue').value = element.value;
    let form = document.getElementById("myBookingForm");
    form.submit();
  }
  $(document).ready(function() {
    //get_bs_time_slots('<?php echo date('Y-m-d'); ?>');







    // var vaccinationIsland = document.getElementById('vaccinationIsland');
    // var selectedTest = document.getElementById('selectedTest');

  });



  function set_on_click_on_time_slots() {
    var acc = document.getElementsByClassName('slot');
    var i;
    let selectedTimeSlot = document.getElementById('selectedTimeSlot');
    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
          to highlight the button that controls the panel */
        for (a = 0; a < acc.length; a++) {
          acc[a].classList.remove('active');
        }

        this.classList.toggle("active");
        this.parentElement.classList.toggle("active");
        var inputDataValue = this.getAttribute('time-slot');


        selectedTimeSlot.value = inputDataValue;
        var errorTimeSlot = document.getElementById('errorTimeSlot');
        errorTimeSlot.style.display = "none";
      });
    }
  }

  function updatePayment(element) {

    validateSelectOption(element);
    var selectedValue = element.value;
    var selectedValue = selectedValue.split(",");
    var testName = selectedValue[0];
    var testPrice = selectedValue[1];
    var etlTestName = document.getElementById('etlTestName');
    var etlTestPrice = document.getElementById('etlTestPrice');
    var etlTestPriceTotal = document.getElementById('etlTestPriceTotal');
    var etlTestPriceGrandTotal = document.getElementById('etlTestPriceGrandTotal');
    var grandTotalAmountToBeCharged = document.getElementById('grandTotalAmountToBeCharged');
    // testPrice = parseInt(testPrice) + getExtraAmountToAdd();
    etlTestName.innerHTML = testName;
    etlTestPrice.innerHTML = testPrice;
    etlTestPriceTotal.innerHTML = testPrice;
    etlTestPriceGrandTotal.innerHTML = testPrice;
    // etl 20% add discount
    // var etlTotalAfterDiscount = document.getElementById('etlTotalAfterDiscount');
    // var discountAmount = testPrice * (0 / 100);
    // etlTotalAfterDiscount.innerHTML = testPrice;
    grandTotalAmountToBeCharged.value = testPrice;
  }



  function get_selected_service_type() {
    const radios = document.getElementsByName('radioSelectedTest');
    let selectedOption = null;

    for (let i = 0; i < radios.length; i++) {
      if (radios[i].checked) {
        selectedOption = radios[i];
        break;
      }
    }

    return selectedOption;
  }


  ListenTest(get_selected_service_type());


  function ListenTest(elem) {

    if (!elem) {
      return;
    }
    // price was 120



    var headingWhichIsland = document.getElementById('headingWhichIsland');






    <?php if ($currency == "euro") { ?>
      var wrapHotelSelect = document.getElementById('wrapHotelSelect');

    <?php } else { ?>
      var wrapCompleteAdress = document.getElementById('wrapCompleteAdress');
    <?php } ?>



    var wrapSelectIsland = document.getElementById('wrapSelectIsland');
    var titleSelectIsland = document.getElementById('titleSelectIsland');

    var titleTimeSlots = document.getElementById('titleTimeSlots');
    var wrapTimeSlots = document.getElementById('wrapTimeSlots');

    var errorVacIsland = document.getElementById('errorVacIsland');

    var titleServiceOptions = document.getElementById('titleServiceOptions');







    // var optionsHTML = "<option value=''>Please make a selection of test</option>";




    var vaccinationIsland = document.getElementById('vaccinationIsland');

    // var labelDate = document.getElementById('labelDate');

    // selectedTest.innerHTML = "<option>Please select an Island to see Tests</option>";


    var maheIslandOption = document.getElementById('maheIslandOption');
    // if (vaccinationIsland.value != "default") {




    switch (elem.value) {

      case 'antigen-test':
        titleServiceOptions.innerHTML = "Which date would you like us to perform your Covid 19 Test?";
        var optionsHTML = "<option value='default'>Select which type of test you require</option>";

        // labelDate.innerHTML = "Which date would you like us to perform your Covid 19 Test on?";

        optionsHTML = getTestArray('pcrArray').reduce((str, el) => str +
          `<option value="${el.name+','+el.price}">${el.name}</option>'`, optionsHTML);


        headingWhichIsland.innerHTML = "Which Island in Seychelles would you like us to perform your Covid 19 Test on?";
        // headingWhichIsland.innerHTML = "Which date would you like us to perform your Covid 19 Test?";


        errorVacIsland.style.display = "block";

        // display timeslots if hidden
        titleTimeSlots.style.display = "block";
        wrapTimeSlots.style.display = "flex";

        // show hotel and island if hidden
        <?php if ($currency == "euro") { ?>
          wrapHotelSelect.style.display = "block";
        <?php } else { ?>
          wrapCompleteAdress.style.display = "block";
        <?php } ?>


        maheIslandOption.style.display = "block";


        wrapSelectIsland.style.display = "block";
        titleSelectIsland.style.display = "block";

        break;



      case 'doctor-visit':


        maheIslandOption.style.visibility = "hidden";

        errorVacIsland.style.display = "block";
        errorVacIsland.innerHTML =
          "*If you require a doctors visit on an Island other than Mahe please call us to book on +248 2 578 899";

        headingWhichIsland.innerHTML = "Which Island in Seychelles would you like the Doctor to visit you on?";

        titleServiceOptions.innerHTML = "Which date would you like the doctor to visit you?";
        var optionsHTML = "<option value='default'> Select which Doctor service you require</option>";

        optionsHTML = getTestArray('visitArray').reduce((str, el) => str +
          `<option value="${el.name+','+el.price}">${el.name}</option>'`, optionsHTML);

        // headingWhichIsland.innerHTML = "";

        // hide time slots
        titleTimeSlots.style.display = "none";
        wrapTimeSlots.style.display = "none";
        // errorVacIsland.style.display = "none";

        // labelDate.innerHTML = "Which date would you like the doctor visit you on?";

        // show hotel and island if hidden

        <?php if ($currency == "euro") { ?>
          wrapHotelSelect.style.display = "block";
        <?php } else { ?>
          wrapCompleteAdress.style.display = "block";
        <?php } ?>



        wrapSelectIsland.style.display = "block";
        titleSelectIsland.style.display = "block";
        // headingWhichIsland.style.display = "block";





        // temporary solution for island
        // var optionHTML = '<option value="default">Select</option>';
        var optionHTML = "<option value='\\default\\'>Select</option>";
        optionHTML += "<option value='\\34,something,32\\'>Mahe Island</option>";
        vaccinationIsland.innerHTML = optionHTML;
        // document.getElementById('vaccinationIsland').innerHTML = '<option>Something</option>';

        // vaccinationIsland.innerHTML += "<option value='\\34,something,32\\'>Something</option>";



        break;
      case 'doctor-tele':
        maheIslandOption.style.display = "block";

        titleServiceOptions.innerHTML = "Please choose which Teleconsultation you require.";


        // labelDate.innerHTML = "Which date would you like the doctor tele consultation on?";
        var optionsHTML = "<option value='default'>Select which Teleconsultation service you require.</option>";

        optionsHTML = getTestArray('teleArray').reduce((str, el) => str +
          `<option value="${el.name+','+el.price}">${el.name}</option>'`, optionsHTML);

        headingWhichIsland.innerHTML = "";

        // hide island and hotel

        <?php if ($currency == "euro") { ?>
          wrapHotelSelect.style.display = "none";
        <?php } else { ?>
          wrapCompleteAdress.style.display = "none";
        <?php } ?>



        wrapSelectIsland.style.display = "none";
        titleSelectIsland.style.display = "none";
        // hide time slots
        titleTimeSlots.style.display = "none";
        wrapTimeSlots.style.display = "none";
        errorVacIsland.style.display = "none";

        break;

    }
    //} // end if

    document.getElementById('selectedTest').innerHTML = optionsHTML;
    document.getElementById('etlTestPriceTotal').innerHTML = 0;
    document.getElementById('etlTestPriceGrandTotal').innerHTML = 0;
    document.getElementById('etlTestPrice').innerHTML = 0;
    document.getElementById('etlTestName').innerHTML = '-';


    // updatePayment()
  }

  function validateFullForm() {
    var submitCheck = document.getElementById('submitCheck');
    submitCheck.value = "yes";
    return true;
  }
  // jquery date picker code for date of birth input starts
  $(function() {
    $("#dateOfBirth").datepicker({
      changeMonth: true,
      changeYear: true,
      minDate: new Date(1905, 2 - 1, 26),
      maxDate: "+1D",
      yearRange: '1905:2023',
      onSelect: function(dateText) {
        var errorDateOfBirth = document.getElementById("errorDateOfBirth");
        var subErrorDateOfBirth = document.getElementById('subErrorDateOfBirth');
        errorDateOfBirth.style.display = "none";
        subErrorDateOfBirth.style.display = "none";
      }
    });
  });

  $(function() {
    $("#dateOfLastVaccination").datepicker({
      onSelect: function(dateText) {
        var errorDateOfLastVaccination = document.getElementById("errorDateOfLastVaccination");
        var subErrorDateOfLastVaccination = document.getElementById('subErrorDateOfLastVaccination');
        errorDateOfLastVaccination.style.display = "none";
        subErrorDateOfLastVaccination.style.display = "none";
      }
    });
  });
  var dateToday = new Date();

  // jquery date picker code for date of birth input ends
  $('#testDate').datepicker({
    format: 'mm/dd/yyyy',
    startDate: new Date(),
    autoclose: true,
    minDate: dateToday,
    todayHighlight: true
  }).on("changeDate", function(e) {
    var errorDateOfBirth = document.getElementById("errorDateOfBirth");
    var subErrorDateOfBirth = document.getElementById('subErrorDateOfBirth');
    errorDateOfBirth.style.display = "none";
    subErrorDateOfBirth.style.display = "none";
  });

  function selectElement(id, valueToSelect) {
    let element = document.getElementById(id);
    element.value = valueToSelect;
  }
  <?php

  if (isset($_POST['selected_test'])) {
    echo "selectElement('selectedTest', '" . $_POST['selected_test'] . "');";
  ?>

    currentTab = 2; // Current tab is set to be the first tab (0)
    // showTab(currentTab); // Display the current tab

  <?php
  }
  if (isset($_POST['expirationMonth'])) {
    echo "selectElement('month', '" . $_POST['expirationMonth'] . "');";
  }
  if (isset($_POST['cardType'])) {
    echo "selectElement('cardType', '" . $_POST['cardType'] . "');";
  }
  if (isset($_POST['expirationYear'])) {
    echo "selectElement('year', '" . $_POST['expirationYear'] . "');";
  }
  // if (isset($_POST['vaccination_island'])) {
  //     echo "getData(vaccinationIsland);";
  // }
  // main if start



  ?>
  // document.getElementById('inputWrapperNumberOfDosesReceived').style.display = 'block'
  // Available Slot javascript code


  function validateForm() {
    var returnValue = true;
    var email;

    // Declare and intialize input fields
    var firstName = document.getElementById("firstName");
    var lastName = document.getElementById("lastName");
    var emailAddress = document.getElementById("emailAddress");
    var phoneNumber = document.getElementById("phoneNumber");
    var testDate = document.getElementById("testDate");
    var testLocation = document.getElementById("testLocation");
    var selectedTest = document.getElementById("selectedTest");
    var selectedTimeSlot = document.getElementById("selectedTimeSlot");
    var month = document.getElementById("month").value;
    var year = document.getElementById("year").value;
    var cardType = document.getElementById("cardType").value;
    var accountNumber = document.getElementById("accountNumber");
    var fullName = document.getElementById("fullName");
    var errorTimeSlot = document.getElementById('errorTimeSlot');
    returnValue = emptyInput(firstName);
    returnValue = emptyInput(lastName);
    returnValue = emptyInput(emailAddress);
    returnValue = emptyInput(phoneNumber);
    returnValue = checkEmptySelectInput(selectedTest);
    returnValue = emptyInput(testDate);
    returnValue = ValidateEmail(emailAddress);
    returnValue = ValidateCardNumber(accountNumber);
    returnValue = emptyInput(fullName);
    returnValue = emptyInput(accountNumber);
    if (selectedTimeSlot.value == "") {
      errorTimeSlot.style.display = "block";
    } else {
      errorTimeSlot.style.display = "none";
    }
    // etl because the form is submiting in a same page thats why use this trick to avoid form submit when user will select date and page will refresh
    if (returnValue == true) {
      var submitCheck = document.getElementById('submitCheck');
      submitCheck.value = "yes";
    }
    return returnValue;
  }

  function checkEmptySelectInput(element) {
    var inputValue = element.value;
    if (inputValue == "" || inputValue == "default") {
      var selectedInputError = element.nextElementSibling;
      // Display error message on p element
      selectedInputError.style.display = "block";
      // get value of selected input
      var inputDataValue = element.getAttribute('data-value');
      // Set Error Message
      selectedInputError.innerHTML = inputDataValue + " is required";
      return false;
    } else {
      return true;
    }
  }

  function emptyInput(element) {
    if (element.value == "") {
      var selectetInputPlaceHolder = element.nextElementSibling;
      var inputValue = element.value;
      var selectedInputError = selectetInputPlaceHolder.nextElementSibling;
      selectetInputPlaceHolder.style.display = "block";
      selectetInputPlaceHolder.style.color = "red";
      // Display error message on p element
      selectedInputError.style.display = "block";
      selectedInputError.style.color = "red";
      // get value of selected input
      var inputDataValue = element.getAttribute('data-value');
      // Set Error Message
      selectedInputError.innerHTML = inputDataValue + " is required";
      return false;
    } else {
      return true;
    }
  }

  function validateSelectOption(element) {

    if (typeof element === "undefined" || element === null) {

      return;
    }
    var selectedInputError = element.nextElementSibling;
    if (element.value == "") {
      // Display error message on p element
      selectedInputError.style.display = "block";
      // get value of selected input
      var inputDataValue = element.getAttribute('data-value');
      // Set Error Message
      selectedInputError.innerHTML = inputDataValue + " is required";
    } else {
      // hide error message
      selectedInputError.style.display = "none";
    }
  }
  //on date change submit form to get the available slots of that date
  function submitFormOnDateChanged(dateValue) {
    let form = document.getElementById("myBookingForm");
    form.submit();
  }


  // When user will click on the input field this function will be called to hide placeholder which is a span element
  function active_input(element) {
    var selectetInputPlaceHolder = element.nextElementSibling;
    selectetInputPlaceHolder.style.display = "none";
  }

  function active_date_input(element) {
    // element.type = 'date';
    var selectetInputPlaceHolder = element.nextElementSibling;
    selectetInputPlaceHolder.style.display = "none";
  }
  // etl: this function is to display custom placeholder (which is a span element) if user did not type any thing
  function inactive_input(element) {
    var selectetInputPlaceHolder = element.nextElementSibling;
    var inputValue = element.value;
    var selectedInputError = selectetInputPlaceHolder.nextElementSibling;
    if (inputValue == "") {
      selectetInputPlaceHolder.style.display = "block";
      selectetInputPlaceHolder.style.color = "red";
      // Display error message on p element
      selectedInputError.style.display = "block";
      selectedInputError.style.color = "red";
      // get value of selected input
      var inputDataValue = element.getAttribute('data-value');
      // Set Error Message
      selectedInputError.innerHTML = inputDataValue + " is required";
    } else {
      // hide error message
      selectedInputError.style.display = "none";
    }
  }

  function inactive_date_input(element) {
    var selectetInputPlaceHolder = element.nextElementSibling;
    var inputValue = element.value;
    var selectedInputError = selectetInputPlaceHolder.nextElementSibling;
    if (inputValue == "") {
      selectetInputPlaceHolder.style.display = "block";
      selectetInputPlaceHolder.style.color = "red";
      // Display error message on p element
      selectedInputError.style.display = "block";
      // get value of selected input
      var inputDataValue = element.getAttribute('data-value');
      // Set Error Message
      selectedInputError.innerHTML = inputDataValue + " is required";
    } else {
      // hide error message
      selectedInputError.style.display = "none";
      selectetInputPlaceHolder.style.display = "none";
    }
  }

  function ValidateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
      return (true)
    }
    return (false)
  }

  function ValidateCardNumber(number) {
    //return(false);
    var ret = false;
    var type = "";
    if (/^(?:5[1-5][0-9]{14})$/.test(number)) {
      //type = MasterCard;
      ret = true;
    } else if (/^(?:3[47][0-9]{13})$/.test(number)) {
      //type = Expres;
      ret = true;
    } else if (/^(?:4[0-9]{12}(?:[0-9]{3})?)$/.test(number)) {
      ///type = Visa;
      ret = true;
    } else if (/^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/.test(number)) {
      //type = discover;
      ret = true;
    }
    return ret;
  }




  // ********** The Below code is for multi step form **********./


  //  the below two lines are initialized on the starting of script tag
  // var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab

  function showTab(n) {
    // var el = document.getElementById("dmtHomeForm");
    // if (el) return;
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");

    if (n === 4) {
      console.log('Hiding prevBtn via inline style -----');
      document.getElementById('submitForm').style.display = 'inline-block';
    } else {
      document.getElementById('submitForm').style.display = 'none';
    }


    x[n].style.display = "block";

    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == x.length - 1) {
      // document.getElementById("nextBtn").innerHTML = "Submit";
      // document.getElementById("nextBtn"). = "Submit";
      jQuery("#nextBtn").hide();
    } else {
      jQuery("#nextBtn").show();
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n);
  }

  function nextPrev(n) {

    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:

    // if n is equal to 1 means user have click on next tab so validate the form
    if (n == 1) {
      if (!valForm()) {
        // @validate
        return false;
      }
    }

    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
      // ... the form gets submitted:
      document.getElementById("regForm").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }

  function valForm() {
    // This function deals with validation of the form fields
    // return true;
    var x,
      y,
      i,
      valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");

    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
      // If a field is empty...
      if (y[i].value == "") {


        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false
        valid = false;
      }
    }



    if (currentTab == 0) {
      // emailvalidation
      var emailAddress = document.getElementById('emailAddress');
      if (!ValidateEmail(emailAddress.value)) {


        if (emailAddress.value) {

          var emailErrorPlaceholder = document.getElementById('emailErrorPlaceholder');
          valid = false;
          emailAddress.className += " invalid";
          emailErrorPlaceholder.innerHTML = "Please Enter a Valid Email";
          emailErrorPlaceholder.style.display = "block";
        }

      }
    }

    const radios = document.getElementsByName('radioSelectedTest');
    let selectedOption = null;

    for (let i = 0; i < radios.length; i++) {
      if (radios[i].checked) {
        selectedOption = radios[i].value;
        break;
      }
    }



    if (currentTab == 1) {
      // tab one validation





      if (selectedOption) {

      } else {
        alert("Please select your desired service.");
        return false;
      }










    } // (currentTab == 1) ends





    // console.log(valid);




    // currentTab == 2 means the user is filling test information
    if (currentTab == 2) {
      valid = true;




      // console.log(selectedOption);
      // return valid;



      // if (selectedOption == 'antigen-test') {

      // }
      if (selectedOption == 'doctor-tele') {
        valid = valid_tele_consultation_options();
      } else {
        valid = valid_antigen_test_options();
      }





    } // endif currenttab = 2






    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }

  // function fixStepIndicator(n) {
  //   // This function removes the "active" class of all steps...
  //   var i,
  //     x = document.getElementsByClassName("step");
  //   for (i = 0; i < x.length; i++) {
  //     x[i].className = x[i].className.replace(" active", "");
  //   }
  //   //... and adds the "active" class on the current step:
  //   x[n].className += " active";
  // }

  // @Navigation
  function fixStepIndicator(n) {
    const steps = document.querySelectorAll('#sidebar_ProgressBar .bs-navmenu a');

    // Loop through all steps
    steps.forEach((step, index) => {
      if (step == 5) {
        document.getElementById('prevBtn').classList.add('d-none');
      } else {
        document.getElementById('prevBtn').classList.remove('d-none');
      }

      if (index <= n) {
        step.classList.add('bs-active');
      } else {
        step.classList.remove('bs-active');
      }
    });
  }


  var vaccinationIsland = document.getElementById('vaccinationIsland');
  var selectedHotel = document.getElementById('selectedHotel');
  var testDate = document.getElementById('testDate');
  var selectedTest = document.getElementById('selectedTest');




  function valid_antigen_test_options() {
    valid = true;


    // check for user have selected the island or not
    if (vaccinationIsland.value == "default") {
      valid = false;
      vaccinationIsland.style.border = "1px solid red";
    } else {


      vaccinationIsland.style.border = "1px solid #ccc";
    }


    // check if user have selected the hotel
    if (selectedHotel.value == "default") {
      valid = false;
      selectedHotel.style.border = "1px solid red";
    } else {
      selectedHotel.style.border = "1px solid #ccc";
    }




    if (selectedTest.value == "default") {
      valid = false;
      selectedTest.style.border = "1px solid red";
    } else {
      selectedTest.style.border = "1px solid #ccc";
    }


    return valid;

  } // function ends


  function valid_tele_consultation_options() {
    valid = true;
    if (selectedTest.value == "default") {
      valid = false;
      selectedTest.style.border = "1px solid red";
    } else {
      selectedTest.style.border = "1px solid #ccc";
    }
    return valid;
  }
</script>