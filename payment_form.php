<?php

// website name is doctors247
$website_title = "Doctor247";
$domain_name = "doctors247.sc";
$website_url = "WWW.DOCTORS247.SC";
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
            //new site keys $request = new CyberSource("absa_seytravel_eur_0981357", "jpwlcXvYQ0qlY0j8qqgYHIBDsqKyODJLB/zZg3Z61+Tpj5yG2rzNuKjnAnKiSYQ34J99B6xogm12uxYZAlrobUiSZ3X/26x5ll5kYqMWbsRWaMS78ShJTJIK5v/6+MjDuV4y/V53aYsthV2JGzWkPWx8SKQPr/pYmaddifG482SC+EY6iLyvcn7nSm6/2XiNRwdurvrmPzEImT8OGGukDxGAXVSbZ3Pfh5PtcFjzZVx0Rt8ms7qFOdalFkVZ684tfS3Nlk1d15vdQjV6odLuWmKFKYUpBrZXf4Q/v5DCj/h0/89it3Emerfui9mjix2y8kpTEV9sCsYw7Rkf6jeFvw==", "Live");

            // $request = new CyberSource("absa_seymedser_eur_0980284", "RI7DrCchKS7iInkmtlYEdFY/ylRUmDXHa4sAKlN2yD2+r0uEcbKBpdai8tBle/PsKC0nljo669wH1w6ebzD0XER9yxmPxf5aYE4tGhWOC0WLhF6s/oRUQwWmnQCYP7hIKAUgUtAfTdDhOqnx11/zaC675ClM/PTGDYaTZfTCFjNGFlclkogHcbt8oGXEJXNch45sS3l+nBQF8pPeanQrvPwWsG5wsQTwMayEDchFpg51SdJbnWHChvMoeaJ4MvwBd/PEqhlY0TyScdSlHdxgHaPPQ3MClMNYEKG0L3SMQpJHnXBkFicnjUcn0R2qVd3EobmKwClE5SgpXm9Px4TyAA==", "Live");

            $request = new CyberSource("caliphsoft_web_test", "Q1zcCMzFHm0QjOSDQmfsECLQpP9V7AqfFcEkb761HZiruMA+PmiotFHSIEKl1om0JqYNJsa0MbvBuy9Pxoua6fFT1YKPlZ/xiLTjTj1Aie1nskvTlSudxD5eIA3MuenEVlhmuQ9+PKoBvQCRHSZZ4187cAPmI8qk5we5WaHnUm9nhI6xsDHBLgUvy57R8DAg1tvdeaEyORMC5pYpiHKrPOA/E+FQovRapllEgZiuEeI3BnxsscSrHVmdsmDHHXYDuG77JGIU4Zb8VRDnu3hq4kBLlkoNO+st9+zZx0cyM7P0P57lc4DMkvY07+wjFK7clG9qxl4K2r6SbrM4xl+trA==", "Test");

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
        } catch (Exception $exp) {
            $booking_status = "false";
            $error .= $exp->getMessage();
        }




        if ($request->response && $request->response->resMessage) {
            if (!$request->response->success) {
                $error .=  $request->response->resMessage;
                $booking_status = false;
            } else {





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
                    'booking_id' => $random_id,
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


                // // Send Email to Admin


                $to = 'charlotte.hawkes@globaloceaninvest.com';
                $admin_one = 'doctor@doctor247.sc';
                $admin_two = 'help@doctor247.dc';

                // $subject = 'You have new Booking on Seychelles Medical Services.';
                $subject = 'You have new Booking on ' . $website_title . '.';


                // $message = "Test Email from damsontech";

                // $message = "$checkin $checkout - Number Of Peoples: $numberofpeople - quote_amount: $quote_amount";

                $message = '<h1 style="color: #5e9ca0;">Booking detail on ' . $website_title . ' are following.</h1>

        <table style="border-collapse: collapse; width: 71.4489%; height: 198px; border:1px solid rgba(0,0,0,0.3);" border="1">

        <tbody>

        <tr style="height: 18px;">

        <td style="width: 21.875%; height: 18px; padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>First Name</strong></td>

        <td style="width: 49.5739%; height: 18px; padding: 15px;border-color: rgba(0,0,0,0.3);">' . $first_name . ' </td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Last Name</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $last_name . '</td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Booking Date</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $booking_date . '</td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Email Address</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $email_address . '</td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Hotel / Home Address</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $test_hotel . '</td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Payment Status</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $payment_status . '</td>

        </tr>


        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Payment Currency</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $selected_currency . '</td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Vaccination Island</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $vaccination_island . '</td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Test Date</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $test_date . '</td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Test Hotel</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $test_hotel . '</td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Selected Test</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $selected_test . '</td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Selected Time Slot</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $selected_time_slot . '</td>

        </tr>

        <tr style="height: 18px;padding: 15px;">

        <td style="width: 21.875%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);"><strong>Phone Number</strong></td>

        <td style="width: 49.5739%; height: 18px;padding: 15px;border-color: rgba(0,0,0,0.3);">' . $phone_number . '</td>

        </tr>

        </tbody>

        </table>';


                $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . $website_title . ' <doctor@doctor247.sc>');

                wp_mail($to, $subject, $message, $headers);
                wp_mail($admin_one, $subject, $message, $headers);
                wp_mail($admin_two, $subject, $message, $headers);

                // Email code ends

                // // Send Email to Customer

                $to = $email_address;

                $subject = 'Booking confirmation ' . $website_title;

                // $message = "Test Email from damsontech";

                // $message = "$checkin $checkout - Number Of Peoples: $numberofpeople - quote_amount: $quote_amount";

                $pdfHtml = '<table align="center" border="0" cellspacing="0" style="border-collapse:collapse; height:2px; width:100%">
		<tbody>
		<tr>
			<td rowspan="6" style="width:50%">&nbsp;&nbsp;&nbsp;&nbsp; <img alt="" src="./pdf_image.jpg" style="height:66px; width:188px" /></td>
		</tr>
		<tr>
			<td style="text-align:right; width:50%"><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:14px"><strong>' . $website_title . ' &nbsp; </strong></span></span></td>
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
			<td style="width:50%"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $first_name . ' ' . $last_name . '</span></td>
		</tr>
        <tr>
			<td style="width:50%;background-color:#eeeeee;"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">BOOKING DATE</span></strong></td>
			<td style="width:50%;background-color:#eeeeee;"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $booking_date . '</span></td>
		</tr>
		<tr>
			<td style="width:50%"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">EMAIL</span></strong></td>
			<td style="width:50%"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $email_address . '</span></td>
		</tr>
        <tr>
			<td style="width:50%;background-color:#eeeeee;"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">TEST HOTEL</span></strong></td>
			<td style="width:50%;background-color:#eeeeee;"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $test_hotel . '</span></td>
		</tr>
		<tr>
			<td style="width:50%"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">PHONE</span></strong></td>
			<td style="width:50%"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $phone_number . '</span></td>
		</tr>

        <tr>
			<td style="width:50%;background-color:#eeeeee;"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">SELECTED TEST</span></strong></td>
			<td style="width:50%;background-color:#eeeeee;"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $selected_test . '</span></td>
		</tr>
		<tr>
			<td style="width:50%"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif"><strong>TIME SLOT</strong></span></td>
			<td style="width:50%"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $selected_time_slot . '</span></td>
		</tr>
		<tr>
			<td style="width:50%;background-color:#eeeeee;"><strong><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">PAYMENT</span></strong></td>
			<td style="width:50%;background-color:#eeeeee;"><span style="font-size:14px;font-family:Arial,Helvetica,sans-serif">' . $payment_status . '</span></td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><strong>Dear Customer,</strong></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:12px">Thank you for booking with us.&nbsp; Any assistance please email us on doctor@doctor247.sc or call us/whatsapp us on tel:+248 257 8899</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:12px">Please present a copy of this appointment letter along with your original passport/national identity document for verification purposes during your sample collection.</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:12px">Thank you for choosing us as your trusted healthcare service provider.</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><strong>Important Notes :</strong></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:11px"><strong>*</strong> It is recommended that you consult your Doctor/Physician if you need interpretation of your test result</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:11px"><strong>*</strong> ' . $website_title . ' assumes no liability towards any delays in processing your sample.</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:11px"><strong>*</strong> Maximum liability of ' . $website_title . ' should not exceed the amount charged by the service provider for the particular test(s)</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:11px"><strong>*</strong> This booking is non-refundable as per terms and conditions applied.</span></span></p>

<p><span style="font-family:Arial,Helvetica,sans-serif"><strong>Email </strong>-<a href="&lt;a href=&quot;mailto: doctor@doctor247.sc&quot;&gt;doctor247.sc&lt;/a&gt;"> doctor@doctor247.sc</a></span></p>

<table cellpadding="10" cellspacing="0" style="border-collapse:collapse; width:100%">
	<tbody>
		<tr>
			<td style="text-align:center; width:50%"><span style="font-size:20px"><strong>' . $domain_name . '</strong></span></td>
			<td style="text-align:center; width:50%"><span style="font-size:18px"><strong>' . $website_url . '</strong></span></td>
		</tr>
	</tbody>
</table>
';

                $message = '

        <p style="color: #000000;">Dear Valued Customer, for any assistance please write to us on <a href="mailto:doctor@doctor247.sc">doctor@doctor247.sc</a> or call us/whatsapp us on <a href="tel:+2482578899">tel:+2482578899</a></p>
        <p style="color: #000000;">Please present a copy of this appointment letter along with the original passport/national identity document for verification purposes during your sample collection.</p>
        <p style="color: #000000;">Your satisfaction is our guarantee.</p>
        <p style="color: #000000;">Thank you for choosing us as your trusted healthcare service provider.</p>
        <p style="color: #000000;"><i><b>Important Notes :</b></i></p>
        <p style="color: #000000;"><i>* It is recommended that you consult your Doctor/Physician for interpretation of test result</i></p>
        <p style="color: #000000;"><i>* '.$website_title.' assumes no liability towards any delays</i></p>
        <p style="color: #000000;"><i>* Maximum liability of '.$website_title.' should not exceed the amount charged by the service provider for the particular test(s)</i></p>
        <p style="color: #000000;"><i>* The booking is non-refundable as per terms and conditions applied.</i></p>
        <p style="color: #000000;"><i><span style="color:#007723;">Email</span> - <a href="mailto:doctor@doctor247.sc">doctor@doctor247.sc</a> <a href="https://www.doctor247.sc">www.doctor247.sc</a></i></p>';


                $headers = array('Content-Type: text/html; charset=UTF-8', 'From: '.$website_title.' <doctor@doctor247.sc>');
                //ADDED
                $options = new Options;
                $options->setChroot(__DIR__);
                $options->setIsRemoteEnabled(true);
                $dompdf = new Dompdf($options);
                $dompdf->setPaper("A4", "portrait");
                $dompdf->loadHtml($pdfHtml);
                $dompdf->render();
                // $dompdf->addInfo("Title", "$website_title <doctor@doctor247.sc>");
                $output = $dompdf->output();
                file_put_contents(__DIR__ . "/service_required.pdf", $output);

                $attachments = (__DIR__ . '/service_required.pdf');

                //END
                wp_mail($to, $subject, $message, $headers, $attachments);

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
    --bs-heading: 64px;
    --bs-text: 16px;
    --bs-font-primary: "Montserrat", sans-serif;
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
  }

  .bs-navmenu ul li a {
    text-decoration: none !important;
    position: relative !important;
    color: gray !important;
    font-size: 0.8rem !important;
    line-height: 1rem !important;
    font-weight: 500 !important;
    width: 200px !important;
    display: block !important;
    cursor: context-menu !important;
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
    /* Padding for the rows */
    color: var(--bs-text-primary, #333);
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

  /* Add a border between rows, but not after the last one */
  .summary-row:not(:last-child) {
    border-bottom: 1px solid var(--bs-bg-light, #f0f0f0);
  }

  /* Label (left side) of a row */
  .summary-row span:first-child {
    color: var(--bs-text-muted, #555);
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
    padding-bottom: 15px;
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
    font-size: 19px;
  }

  #BookingFormEt input[type="text"]:focus,
  #BookingFormEt input[type="number"]:focus,
  #BookingFormEt select:focus,
  #BookingFormEt textarea:focus {
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
    padding: 70px;
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

  #prevBtn,
  #nextBtn {
    margin-top: 30px;
  }

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
    padding: 10px;
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
    margin-bottom: 30px;
    /* border-bottom: 1px solid #ccc; */
    padding-bottom: 25px;
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
      padding: 15px;
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
    background-color: #d5e1d5;
    border: 1px solid #008000;
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
    grid-template-columns: 1fr 1fr 1fr;
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

  @media (max-width: 767px) {
    .etl_middle .etl_box {
      width: 98%;
      margin: 5px 0;
    }

    .payment-row-exp {
      grid-template-columns: 1fr;
      gap: 5px;
    }

    .payment-details {
      grid-template-columns: 1fr;
      gap: 0px;
    }

    .heading_which_island {
      margin-top: 40px;
      font-size: 36px;
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
  <div class="container px-4 d-flex" id="BookingFormEt" style="">
    <?php if (isset($success) && $success != null) { ?>
    <div class="success-message">
      <p><?php echo $success; ?> <a href="<?php echo get_site_url(); ?>">Home</a>
      </p>
    </div>
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
        <div class="tab">
          <!-- Tab 1 Content -->
          <div class="shadow-container">
            <div class="sec_heading">
              <h4>Personal Information</h4>
            </div>
            <div class="form-row">
              <div class="input-wrapper">
                <input type="text" onfocus=active_input(this) onfocusout=inactive_input(this) data-value="First Name"
                  id="firstName" name="first_name"
                  value="<?php
                                                                                                                                                                                    if (isset($_POST['first_name'])) {
                                                                                                                                                                                        echo $_POST['first_name'];
                                                                                                                                                                                    }
                                                                                                                                                                                    ?>"
                  required>
                <?php
                                    if (!isset($_POST['first_name'])) {
                                        echo '<span>First Name <span class="required_sign">*</span></span>';
                                    } else if (isset($_POST['first_name'])) {
                                        if (empty(trim($_POST['first_name']))) {
                                            echo '<span>First Name <span class="required_sign">*</span></span>';
                                        } else {
                                            echo '<span><span class="required_sign"></span></span>';
                                        }
                                    }
                                    ?>
                <p></p>
              </div>
              <div class="input-wrapper">
                <input type="text" onfocus=active_input(this) onfocusout=inactive_input(this) data-value="Last Name"
                  id="lastName" name="last_name" required
                  value="<?php
                                                                                                                                                                                        if (isset($_POST['last_name'])) {
                                                                                                                                                                                            echo $_POST['last_name'];
                                                                                                                                                                                        }
                                                                                                                                                                                        ?>">
                <?php
                                    if (!isset($_POST['last_name'])) {
                                        echo '<span>Last Name <span class="required_sign">*</span></span>';
                                    } else if (isset($_POST['last_name'])) {
                                        if (empty(trim($_POST['last_name']))) {
                                            echo '<span>Last Name <span class="required_sign">*</span></span>';
                                        } else {
                                            echo '<span><span class="required_sign"></span></span>';
                                        }
                                    }
                                    ?>
                <p></p>
              </div>

              <!-- min="<?php // echo date(" m/d/Y ");
                                            ?>" -->

            </div>
            <!-- Second Row -->
            <div class="form-row">

              <div class="input-wrapper">
                <input type="text" onfocus=active_input(this) onfocusout=inactive_input(this) id="emailAddress"
                  name="email_address" data-value="Email Address" required
                  value="<?php
                                                                                                                                                                                                    if (isset($_POST['email_address'])) {
                                                                                                                                                                                                        echo $_POST['email_address'];
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>">
                <?php
                                    if (!isset($_POST['email_address'])) {
                                        echo '<span>Email Address <span class="required_sign">*</span></span>';
                                    } else if (isset($_POST['email_address'])) {
                                        if (empty(trim($_POST['email_address']))) {
                                            echo '<span>Email Address <span class="required_sign">*</span></span>';
                                        } else {
                                            echo '<span><span class="required_sign"></span></span>';
                                        }
                                    }
                                    ?>
                <p id="emailErrorPlaceholder"></p>
              </div>
              <div class="input-wrapper">
                <input type="text" onfocus=active_input(this) onfocusout=inactive_input(this)
                  data-value="Contact Number" id="phoneNumber" name="phone_number" required
                  value="<?php
                                                                                                                                                                                                    if (isset($_POST['phone_number'])) {
                                                                                                                                                                                                        echo $_POST['phone_number'];
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>">
                <?php
                                    if (!isset($_POST['phone_number'])) {
                                        echo '<span>Contact Number <span class="required_sign">*</span></span>';
                                    } else if (isset($_POST['phone_number'])) {
                                        if (empty(trim($_POST['phone_number']))) {
                                            echo '<span>Contact Number <span class="required_sign">*</span></span>';
                                        } else {
                                            echo '<span><span class="required_sign"></span></span>';
                                        }
                                    }
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
              <label>
                <input type="radio" name="radioSelectedTest" onclick="ListenTest(this);" value="antigen-test"
                  id="inputPCRAntigen" />
                <div class="front-end etl_box">
                  <p>PCR/Antigen Test</p>
                  <!-- <span>&nbsp;</span> -->
                </div>
              </label>

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
          <div class="sec_heading heading_which_island" id="titleSelectIsland">
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
          <div class="sec_heading">
            <h4 id="titleServiceOptions">Choose Test Options</h4>
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
              <input autocomplete="off" type="text" id="testDate" name="test_date" placeholder="Selected Test Date"
                value="<?php echo $selected_test_date; ?>" onchange="get_time_slots(this.value)">
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

                <?php if ($_GET['dc']) { ?>
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
              <h4>Available Time Slots <span
                  id="timeSlotDate"><?php echo date('d M-Y', strtotime($selected_test_date)); ?></span> </h4>
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
                  <span>Price</span>
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
        <div class="tab">

          <div class="sec_heading">
            <h4>Make Payment</h4>
          </div>
          <div class="">
            <label class="form_sec_title">Payment Details</label>
          </div>
          <div class="payment-details">
            <div class="">
              <input data-value="Credit Card Number" onfocus=active_input(this) onfocusout=inactive_input(this)
                type="text" id="accountNumber" name="accountNumber" placeholder="Credit Card Number"
                value="<?php
                                                                                                                                                                                                                                if (isset($_POST['accountNumber'])) {
                                                                                                                                                                                                                                    echo $_POST['accountNumber'];
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                ?>">
              <span></span>
              <p></p>
            </div>
            <div class="">
              <input data-value="Card Holder Name" type="text" id="fullName" name="fullName"
                placeholder="Card Holder Name"
                value="<?php
                                                                                                                                                        if (isset($_POST['fullName'])) {
                                                                                                                                                            echo $_POST['fullName'];
                                                                                                                                                        }
                                                                                                                                                        ?>">
              <span></span>
              <p></p>
            </div>
          </div>
          <div class="">
            <label for="expirationMonth">Expiration Date</label>
          </div>
          <div class="payment-row-exp">
            <select id="month" name="expirationMonth" class="col-50">
              <option value="">Expiration Month</option>
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
            <select id="year" name="expirationYear" class="col-50">
              <option value="">Expiration Year</option>
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
            <select id="cardType" name="cardType" style="margin-top: 6px">
              <option value="">Card Type</option>
              <option value="MasterCard">MasterCard</option>
              <option value="AmericanExpress">American Express</option>
              <option value="Visa">Visa</option>
              <option value="Discover">Discover</option>

            </select>
            <input data-value="CVV" onfocus=active_input(this) onfocusout=inactive_input(this) type="text" id="cardCvv"
              name="card_cvv" placeholder="Card CVV No"
              value="<?php
                                                                                                                                                                                            if (isset($_POST['card_cvv'])) {
                                                                                                                                                                                                echo $_POST['card_cvv'];
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>">
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

      "name": "1 Hour In Person Call Out (Day) - (€375)",

      "price": 375

    }, {

      "name": "1 Hour In Person Call Out (Night) - (€475)",

      "price": 475

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
  get_time_slots('<?php echo date('Y-m-d'); ?>');







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
      // return false;
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