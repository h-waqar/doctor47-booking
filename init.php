<?php
/**
 * Plugin Name: Doctor Booking
 * Plugin URI:
 * Description: Create online booking form using cyber source payment gateway api
 * Version: 1.0
 * Author:
 * Author URI:
 */
//  [booking currency="scr"]


//ADDED
use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ . "/vendor/autoload.php";
//END
$website_title = "Doctor247";





function get_time_slots()
{
        // if you want to change timezone plz also change it in below function
        date_default_timezone_set("Asia/Karachi");

        $start_time = date('h:ia', strtotime('09:00am'));
        // $start_time = date('h:ia'); // current_time
        $end_time = '04:00pm';
        // Initialize the associative array
        $total_slots = array();
        // Set the current time to the start time
        $current_time = $start_time;
        // before increment rounded time
        $rounded_time = ceil(date('i', strtotime($current_time)) / 30) * 30;
        $rounded_time = date('H:', strtotime($current_time)) . str_pad($rounded_time, 2, '0', STR_PAD_LEFT);
        $current_time = $rounded_time;
        $c_time = strtotime('now');
        // Get the start and end time for the desired range
        $s_time = strtotime('today 09:00:00');
        $e_time = strtotime('today 16:00:00');
        // Loop through the time slots
        while (strtotime($current_time) < strtotime($end_time)) {
                // Add the time slot to the array
                if (strtotime($current_time) >= $s_time && strtotime($c_time) <= $e_time) {
                        $before_increment = date('h:ia', strtotime($current_time));
                        // $before_increment = str_replace('', '', date('h:ia', strtotime($current_time)));
                        $before_inc_value = date('h:i A', strtotime($current_time));
                        // Increment the time by 30 minutes
                        $current_time = date('h:ia', strtotime($current_time . ' +30 minutes'));
                        $after_increment = str_replace('', '', $current_time);
                        $after_inc_value = date('h:i A', strtotime($current_time));
                        $total_slots[$before_increment . "-" . $after_increment] = $before_inc_value . " - " . $after_inc_value;
                } else {
                        $current_time = date('h:ia', strtotime($current_time . ' +30 minutes'));
                }
        }
        return $total_slots;
}




function book_today_past_time_slots($booked_slots)
{

        // timezone function is used in two user defined functions. if you are changing here also change in second function
        date_default_timezone_set("Asia/Karachi");
        $start_time = date('h:ia', strtotime('09:00am'));
        // $start_time = date('h:ia'); // current_time

        if (strtotime('04:00pm') < strtotime(date('h:ia'))) {
                $end_time = '04:00pm';
        } else {

                $end_time = date('h:ia'); // current_time
                // $end_time = '01:00pm';
        }



        // Initialize the associative array

        // Set the current time to the start time
        $current_time = $start_time;
        // before increment rounded time
        $rounded_time = ceil(date('i', strtotime($current_time)) / 30) * 30;
        $rounded_time = date('H:', strtotime($current_time)) . str_pad($rounded_time, 2, '0', STR_PAD_LEFT);
        $current_time = $rounded_time;
        $c_time = strtotime('now');
        // Get the start and end time for the desired range
        $s_time = strtotime('today 09:00:00');
        $e_time = strtotime('today 16:00:00');
        // Loop through the time slots
        while (strtotime($current_time) < strtotime($end_time)) {
                // Add the time slot to the array

                if (strtotime($current_time) >= $s_time && strtotime($c_time) <= $e_time) {
                        $before_increment = date('h:ia', strtotime($current_time));

                        // Increment the time by 30 minutes
                        $current_time = date('h:ia', strtotime($current_time . ' +30 minutes'));
                        $after_increment = str_replace('', '', $current_time);


                        if (isset($booked_slots)) {
                                array_push($booked_slots, $before_increment . "-" . $after_increment);
                        } else {
                                // echo "Array is not set";
                        }
                } else {

                        $current_time = date('h:ia', strtotime($current_time . ' +30 minutes'));
                }
        }
        return $booked_slots;
}


function add_meta_box_doctor247()
{
        add_meta_box(
                "doctor247_pdf_metabox", // Metabox ID
                "Generate And Send PDF", // Title
                "generate_pdf_download_render_metabox", // Callback function to render the metabox
                "certificates", // Post type
                "side", // Position
                "core" // Priority
        );
}


function generate_pdf_download_render_metabox()
{
?>
<script>
function validatePdfForm() {
  let info = [];
  let els = document.getElementsByClassName('acf-input');


  for (var i = 0; i < els.length; i++) {
    let input = '';
    if (els[i].children[0].tagName == 'SELECT') {
      input = els[i].children[0];
      console.log(input);
      if (input.value == "") {
        input.style.borderColor = "red";
        alert("Please complete the form before PDF can be generated");
        return false;
      };

      info.push(input.value);
      continue;
    }

    input = els[i].children[0].children[0];
    if (input.value == "") {
      input.style.borderColor = "red";
      alert("Please complete the form before PDF can be generated")
      return false;
    }
    info.push(input.value)
  }

  return info;
} // function ends


function generatePdf($, e) {
  e.preventDefault();


  // form validatoin
  var info = validatePdfForm();

  if (info == false)
    return;


  // let info = [];
  // let els = document.getElementsByClassName('acf-input');
  // for (var i = 0; i < els.length; i++) {
  //         let input = '';

  //         if (!els[i].getAttribute('class') == 'acf-input-wrap') {
  //                 input = els[i].children[0];

  //                 if (input.value == "") {
  //                         input.style.borderColor = "red";
  //                         alert("Please complete the form before PDF can be generated")
  //                         return;
  //                 };

  //                 info.push(input.value);
  //         }

  //         input = els[i].children[0].children[0];
  //         if (input.value == "") {
  //                 input.style.borderColor = "red";
  //                 alert("Please complete the form before PDF can be generated")
  //                 return;
  //         }
  //         info.push(input.value)
  // }

  //  for(var i =0; i< els.length; i++){
  //    if(!els[i].getAttribute('class') == 'acf-input-wrap')
  //       info.push(els[i].children[0].value);

  //    info.push(els[i].children[0].children[0].value)
  // }

  $.ajax({
    url: ajaxurl, // this is the object instantiated in wp_localize_script function
    type: "POST",
    data: {
      action: "generate_pdf", // this is the function in your functions.php that will be triggered
      info: info,
      booking_id: <?php echo $_GET['post']; ?>,
    },

    success: function(response) {
      //Do something with the result from server
      var data = JSON.parse(response);
      console.log(data.file);

      window.open(data.file);
    },
  });

}









var booking_id = '1310563601';

function sendPdfMail($, e) {


  // form validatoin
  var info = validatePdfForm();
  if (info == false)
    return;


  e.preventDefault();

  $.ajax({
    url: ajaxurl, // this is the object instantiated in wp_localize_script function
    type: "POST",
    data: {
      action: "send_pdf_mail", // this is the function in your functions.php that
      booking_id: <?php echo $_GET['post']; ?>,
      info: info
    },

    success: function(response) {
      var res = JSON.parse(response);
      alert(res.message);

    },
  });

}
</script>

<?php

        echo '<div style="display: flex; justify-content: space-between">';
        echo '<button class="button button-primary" onclick="generatePdf(jQuery, event)"> Generate PDF</button>';

        echo '<button class="button button-primary" onclick="sendPdfMail(jQuery, event)"> Send PDF as Email </button>';
        echo '</div>';
}


function send_file()
{

        $path = plugin_dir_path(__FILE__);
        $filename = 'ahmed_raza.pdf';
        $file = $path . 'pdfs/' . $filename;

        if (!file_exists($file)) {
                wp_die(12344);
        }

        $basename = basename($filename);
        $filesize = filesize($filename);

        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header("Content-Disposition: attachment; filename=$basename");
        header("Content-Length: $filesize");
        header('Pragma: public');

        flush();
        //  wp_die(1234);
        readfile($file);
}


function custom_cybersource_ajax_denied()
{
}


function correct_date_format($str, $subst)
{
        $re = '/([0-9]{4})([0-9]{2})([0-9]{2})/m';
        $result = preg_replace($re, $subst, $str);

        return $result;
}

function change_format($date)
{
        $d = explode("/", $date);

        $months = [
                "",
                "January",
                "Feburary",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
        ];

        return $months[(int) $d[0]] . " " . $d[1] . ", " . $d[2];
}


function generate_pdf($booking_id)
{

        global $website_title;
        $full_name = $_POST['info'][0];
        $test_type = $_POST['info'][1];
        $gender = $_POST['info'][2];
        $dob = $_POST['info'][3];
        $document_type = $_POST['info'][4];
        $document_number = $_POST['info'][5];
        $sample_collection_date = $_POST['info'][6];
        $sample_type = $_POST['info'][7];
        $sample_ref_number = $_POST['info'][8];
        $final_finding = $_POST['info'][9];
        $report_date = $_POST['info'][10];
        $performed_by = $_POST['info'][11];
        $performed_by_number = $_POST['info'][12];
        // $approved_by = $_POST['info'][13];
        // $approved_by_number = $_POST['info'][14];
        $approved_by = "Consultant - S. Raza";
        $approved_by_number = "HPC20/0737";

        // $patient_email = $_POST['info'][15];

        $dir_path = __DIR__;


        $dob = correct_date_format($dob, "$1-$2-$3");
        $report_date = correct_date_format($report_date, "$2/$3/$1");
        $report_date = change_format($report_date);

        // wp_die($final_finding);

        $result_image = "minus.jpg";
        $findings_for_color = "#38761d";
        if ($final_finding == "Positive") {
                $result_image = "plus.jpg";
                $findings_for_color = "#e74c3c";
        }



        // send_file();
        $pdfHtml = '<table border="0" cellpadding="0" cellspacing="0" style="margin-bottom:0; padding:0 30px; width:100%">
   <tbody>
           <tr>
                   <td style="width:50%">
                   <table border="0" cellpadding="0" cellspacing="0">
                           <tbody>
                                   <tr>
                                           <td><img alt="" src="' . $dir_path . '/pdf_image.jpg" style="height:70px; width:192px" /></td>
                                   </tr>
                                   <tr>
                                           <td><span style="color:#000000"><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif">Commercial House, Eden Island</span></span></td>
                                   </tr>
                                   <tr>
                                           <td><span style="color:#000000"><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif">Mahe, Seychelles</span></span></td>
                                   </tr>
                                   <tr>
                                           <td><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif"><a href="https://seychellesmedicalservices.com">https://seychellesmedicalservices.com</a></span></td>
                                   </tr>
                                   <tr>
                                           <td><span style="color:#000000"><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif">Mobile: +248 4366999</span></span></td>
                                   </tr>
                           </tbody>
                   </table>
                   </td>
                   <td style="text-align:right; width:50%"><img alt="" src="' . $dir_path . '/qr.jpg" style="height:125px; padding:10px; width:124px" /></td>
           </tr>
   </tbody>
   </table>

   <table border="0" cellpadding="0" cellspacing="0" style="border-bottom:1px solid rgba(0,0,0,0.4); margin-top:15px; padding:15px 30px 15px 30px; width:100%">
   <tbody>
           <tr>
                   <td><span style="font-size:18px"><span style="color:#5c5c5c"><span style="font-family:Arial,Helvetica,sans-serif">MOLECULAR DIAGNOSIS REPORT</span></span></span></td>
           </tr>
           <tr>
                   <td><span style="font-size:18px"><span style="color:#434343"><span style="font-family:Arial,Helvetica,sans-serif"><strong>' . $test_type . '</strong></span></span></span></td>
           </tr>
   </tbody>
   </table>

   <table border="0" cellpadding="0" cellspacing="0" style="border-bottom:1px solid rgba(0,0,0,0.4); padding:0px 30px 10px 30px; width:100%">
   <tbody>
           <tr>
                   <td style="height:20px"><strong><span style="font-size:8px"><span style="color:#999999"><span style="font-family:Arial,Helvetica,sans-serif">PATIENT SURNAME / GIVEN NAME(S)</span></span></span></strong></td>
           </tr>
           <tr>
                   <td><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><strong>' . $full_name . '</strong></span></span></td>
           </tr>
           <tr>
                   <td>
                   <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                           <tbody>
                                   <tr>
                                           <td>
                                           <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                                   <tbody>
                                                           <tr>
                                                                   <td>
                                                                   <p><strong><span style="color:#808080"><span style="font-size:9px;font-family:Arial,Helvetica,sans-serif">GENDER</span></span></strong></p>

                                                                   <p><span style="font-size:16px;font-family:Arial,Helvetica,sans-serif"><strong>' . $gender . '</strong></span></p>
                                                                   </td>
                                                           </tr>
                                                   </tbody>
                                           </table>
                                           </td>

                                           <td style="width:33%">
                                           <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                                   <tbody>
                                                           <tr>
                                                                   <td>
                                                                   <p><span style="color:#808080"><strong><span style="font-size:9px;font-family:Arial,Helvetica,sans-serif">DATE OF BIRTH</span></strong></span></p>

                                                                   <p><span style="font-size:16px;font-family:Arial,Helvetica,sans-serif"><strong>' . $dob . '</strong></span></p>
                                                                   </td>
                                                           </tr>
                                                   </tbody>
                                           </table>
                                           </td>
                                           <td style="width:33%">
                                           <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                                   <tbody>
                                                           <tr>
                                                                   <td>
                                                                   <p><span style="color:#808080"><strong><span style="font-size:9px;font-family:Arial,Helvetica,sans-serif">DOCUMENT TYPE / DOCUMENT NUMBER</span></strong></span></p>

                                                                   <p><span style="font-size:16px;font-family:Arial,Helvetica,sans-serif"><strong>' . $document_type . ' / ' . $document_number . '</strong></span></p>
                                                                   </td>
                                                           </tr>
                                                   </tbody>
                                           </table>
                                           </td>
                                   </tr>
                           </tbody>
                   </table>
                   </td>
           </tr>
   </tbody>
   </table>

   <table border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; padding:0px 30px 10px 30px; width:100%">
   <tbody>
           <tr>
                   <td><span style="font-size:9px;font-family:Arial,Helvetica,sans-serif">SAMPLE COLLECTION DATE &amp; TIME</span></td>
           </tr>
           <tr>
                   <td><span style="font-size:16px;font-family:Arial,Helvetica,sans-serif"><strong>' . $sample_collection_date . '</strong></span></td>
           </tr>
   </tbody>
   </table>

   <table border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; padding:0px 30px 10px 30px; width:100%">
   <tbody>
           <tr>
                   <td><span style="color:#808080"><span style="font-size:9px"><span style="font-family:Arial,Helvetica,sans-serif">SAMPLE TYPE</span></span></span></td>
           </tr>
           <tr>
                   <td><span style="font-size:16px;font-family:Arial,Helvetica,sans-serif"><strong>' . $sample_type . '</strong></span></td>
           </tr>
   </tbody>
   </table>

   <table border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; padding:0px 30px 10px 30px; width:100%">
   <tbody>
           <tr>
                   <td><span style="color:#808080"><span style="font-size:9px"><span style="font-family:Arial,Helvetica,sans-serif"><strong>SAMPLE REFERENCE NO</strong></span></span></span></td>
           </tr>
           <tr>
                   <td><span style="font-size:16px;font-family:Arial,Helvetica,sans-serif"><strong>' . $sample_ref_number . '</strong></span></td>
           </tr>
   </tbody>
   </table>

   <p>&nbsp; &nbsp; <span style="color:#808080"><span style="font-size:9px;font-family:Arial,Helvetica,sans-serif"> INTERPRETATION / FINAL FINDINGS&nbsp;</span></span></p>

   <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
   <tbody>
           <tr>
                   <td style="text-align:center; width:10%">&nbsp;<img alt="" src="' . $dir_path . '/' . $result_image . '" style="height:35px; width:35px" /></td>
                   <td>
                   <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom:15px; padding:0 30px; width:100%">
                           <tbody>
                                   <tr>
                                           <td><span style="color:' . $findings_for_color . '"><strong><span style="font-size:18px;font-family:Arial,Helvetica,sans-serif">' . strtoupper($final_finding) . ' FINDINGS FOR</span></strong></span></td>
                                   </tr>
                                   <tr>
                                           <td><span style="color:#000000;font-family:Arial,Helvetica,sans-serif">' . str_replace("TESTING FOR", "", $test_type) . '</span></td>
                                   </tr>
                           </tbody>
                   </table>
                   </td>
           </tr>
   </tbody>
   </table>

   <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom:15px; margin-top:20px; padding-bottom:15px; padding:0 30px 15px 30px; width:100%">
   <tbody>
           <tr>
                   <td><span style="color:#000000"><span style="font-size:11px;font-family:Arial,Helvetica,sans-serif"><strong>PROCEDURE</strong></span></span></td>
           </tr>
           <tr>
                   <td>
                   <table border="0" cellpadding="0" cellspacing="0" style="padding-bottom:15px; width:100%">
                           <tbody>
                                   <tr>
                                           <td><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif"><span style="color:#000000">Detection of SARS-CoV2 Viral RNA performed on Real Time Polymerase Chain Reaction (RT-PCR). RNA is extracted by using abGenix RNA/DNA extractor system. Amplification of extracted RNA was performed by Macurra SARS-Cov-2 fluorescent PCR Kit by using abGenixQ Real-Time PCR system. Positive and negative controls are included in each run to confirm validity and accuracy of the test.</span></span></td>
                                   </tr>
                           </tbody>
                   </table>
                   </td>
           </tr>
           <tr>
                   <td><span style="color:#000000"><span style="font-size:11px;font-family:Arial,Helvetica,sans-serif"><strong>INTERPRETATION</strong></span></span></td>
           </tr>
           <tr>
                   <td>
                   <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom:10px; padding-bottom:15px; width:100%">
                           <tbody>
                                   <tr>
                                           <td><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif">This assay does qualitative detection for SARS-CoV2 Virus that covers three genes (E-Gene, N-Gene &amp; ORF1ab)</span></td>
                                   </tr>
                                   <tr>
                                           <td><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif">Both positive and negative controls for the tested virus showed expected result.</span></td>
                                   </tr>
                                   <tr>
                                           <td><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif">Not detected results may not always rule out current or future infection. Please correlate with clinical findings and repeat if necessary. Positive result indicates the RNA from SARS-CoV2 was detected and patient is infected</span></td>
                                   </tr>
                                   <tr>
                                           <td><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif">Negative result indicates SARS-Cov2-Virus not present in specimen above the limit of detection</span></td>
                                   </tr>
                           </tbody>
                   </table>
                   </td>
           </tr>
           <tr>
                   <td><span style="color:#000000"><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif"><strong>LIMITATIONS</strong></span></span></td>
           </tr>
           <tr>
                   <td><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif"><span style="color:#000000;">The detection of viral RNA is dependent on the viral load in the specimen representing an acute infection, that is early in the disease. Pre-analytical variables (i.e. specimen quality, handling/transport conditions) may also adversely affect the results &amp; analytical variables perhaps Virus mutation. The performance characteristics of this test has been validated in the molecular virology diagnostic unit of the Seychelles Medical Services, and is continuously monitored as part of quality assurance procedures, including enrolment with local Head</span></span></td>
           </tr>
   </tbody>
   </table>

   <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom:15px; padding:0 30px; width:100%">
   <tbody>
           <tr>
                   <td style="vertical-align:top; width:33%">
                   <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                           <tbody>
                                   <tr>
                                           <td style="vertical-align:top"><span style="color:#808080"><span style="font-size:10px;font-family:Arial,Helvetica,sans-serif">REPORT DATE</span></span></td>
                                   </tr>
                                   <tr>
                                           <td style="font-family:Arial,Helvetica,sans-serif"><strong>' . $report_date . '</strong></td>
                                   </tr>
                           </tbody>
                   </table>
                   </td>
                   <td style="width:33%">
                   <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                           <tbody>
                                   <tr>
                                           <td><span style="color:#808080;font-family:Arial,Helvetica,sans-serif"><span style="font-size:9px">PERFORMED</span></span></td>
                                   </tr>
                                   <tr>
                                           <td style="font-family:Arial,Helvetica,sans-serif"><strong>' . $performed_by . '</strong></td>
                                   </tr>
                                   <tr>
                                           <td style="font-family:Arial,Helvetica,sans-serif">' . $performed_by_number . '</td>
                                   </tr>
                           </tbody>
                   </table>
                   </td>
                   <td style="width:33%">
                   <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                           <tbody>
                                   <tr>
                                           <td><span style="color:#808080;font-family:Arial,Helvetica,sans-serif"><span style="font-size:9px">APPROVED</span></span></td>
                                   </tr>
                                   <tr>
                                           <td><strong style="font-family:Arial,Helvetica,sans-serif">' . $approved_by . '</strong></td>
                                   </tr>
                                   <tr>
                                           <td style="font-family:Arial,Helvetica,sans-serif">' . $approved_by_number . '</td>
                                   </tr>
                           </tbody>
                   </table>
                   </td>
           </tr>
   </tbody>
   </table>
   ';




        // New Code




        $random = $booking_id;
        $filename = 'file' . $random . '.pdf';






        //ADDED
        $options = new Options;
        $options->setChroot(__DIR__);
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->setPaper("A4", "portrait");
        $dompdf->loadHtml($pdfHtml);
        $dompdf->render();
        $dompdf->addInfo("Title", "$website_title <doctor@doctor247.sc>");
        $output = $dompdf->output();
        // file_put_contents(__DIR__ . "/service_required.pdf", $output);
        file_put_contents(__DIR__ . "/pdfs/" . $filename, $output);

        // $attachments = (__DIR__ . '/service_required.pdf');


        // New Code Ends











        $dir_url = plugin_dir_url(__FILE__);

        $file_url = $dir_url . 'pdfs/' . $filename;


        return $file_url;
}

function validate_request()
{
        $response = [
                "success" => false,
                "message" => "",
        ];

        if (!isset($_POST) && empty($_POST['info'])) {
                $response['message'] = "Invalid Request.";
                die(json_encode($response));
        }

        return $response;
}

function custom_cybersource_ajax()
{


        $response =  validate_request();
        // echo '<pre>';
        // print_r($_POST['info'][12]);
        // echo '</pre>';
        // wp_die();
        // die(json_encode($_POST['info']));


        $file_url =  generate_pdf($_POST['booking_id']);



        $response['success'] =  true;
        $response['message'] = "PDF file generated successfully";
        $response['file'] = $file_url;

        die(json_encode($response));
}

add_shortcode('checkout', 'custom_cybersource_checkout');
add_shortcode('procheckout', 'custom_cybersource_procheckout');
add_action("wp_ajax_myaction", "so_wp_ajax_function");
add_action("wp_ajax_nopriv_myaction", "so_wp_ajax_function");
add_action('wp_enqueue_scripts', 'so_enqueue_scripts');
add_action("add_meta_boxes", "add_meta_box_doctor247");



add_action("wp_ajax_nopriv_generate_pdf", "custom_cybersource_ajax_denied");
add_action("wp_ajax_generate_pdf", "custom_cybersource_ajax");


add_action("wp_ajax_nopriv_send_pdf_mail", "custom_cybersource_ajax_denied");
add_action("wp_ajax_send_pdf_mail", "custom_cybersource_certificate_mail");



function custom_cybersource_certificate_mail()
{

        global $website_title;

        $response = validate_request();

        $booking_id = $_POST['booking_id'];

        $etl_file_exist =  file_exists(__DIR__ . "/pdfs/file" . $booking_id . ".pdf");

        if (!$etl_file_exist)
                generate_pdf($_POST['booking_id']);
        // send certification email



        // check if email exist or not


        $patient_email = $_POST['info'][13];




        $to = $patient_email;
        $patient_name = $_POST['info'][0];

        $subject = "$patient_name, Your Test Report from $website_title Enclosed. Please Review";
        // $subject = 'Booking confirmation ' . $website_title;

        // $message = "Test Email from damsontech";

        // $message = "$checkin $checkout - Number Of Peoples: $numberofpeople - quote_amount: $quote_amount";


        $message = '
        <p style="color: #000000;">Dear ' . $patient_name . ',</p>
        <p style="color: #000000;">We hope this email finds you well.</p>
        <p style="color: #000000;">We are writing to provide you with the MOLECULAR DIAGNOSIS REPORT from Doctor247.sc. Attached to this email, you will find the PDF containing the detailed test results.</p>
        <p style="color: #000000;">Should you have any questions or require further clarification, please do not hesitate to reach out to us. Our team is available to assist you in any way possible.</p>
        <p style="color: #000000;">Thank you for your cooperation and timely attention to this matter.</p>
        <p style="color: #000000;"></p>
        <p style="color: #000000;">Best regards,</p>
        <p style="color: #000000;">' . $website_title . '</p>
        ';


        // $message = '

        // <p style="color: #000000;">Dear Valued Customer, for any assistance please write to us on <a href="mailto:doctor@doctor247.sc">doctor@doctor247.sc</a> or call us/whatsapp us on <a href="tel:+2482578899">tel:+2482578899</a></p>
        // <p style="color: #000000;">This is the result of your sample collection</p>
        // <p style="color: #000000;">Your satisfaction is our guarantee.</p>
        // <p style="color: #000000;">Thank you for choosing us as your trusted healthcare service provider.</p>
        // <p style="color: #000000;"><i><b>Important Notes :</b></i></p>
        // <p style="color: #000000;"><i>* It is recommended that you consult your Doctor/Physician for interpretation of test result</i></p>
        // <p style="color: #000000;"><i>* ' . $website_title . ' assumes no liability towards any delays</i></p>
        // <p style="color: #000000;"><i>* Maximum liability of ' . $website_title . ' should not exceed the amount charged by the service provider for the particular test(s)</i></p>
        // <p style="color: #000000;"><i>* The booking is non-refundable as per terms and conditions applied.</i></p>
        // <p style="color: #000000;"><i><span style="color:#007723;">Email</span> - <a href="mailto:doctor@doctor247.sc">doctor@doctor247.sc</a> <a href="https://www.doctor247.sc">www.doctor247.sc</a></i></p>';


        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . $website_title . ' <doctor@doctor247.sc>');
        //ADDED





        $attachments = (__DIR__ . "/pdfs/file" . $booking_id . ".pdf");

        //END
        wp_mail($to, $subject, $message, $headers, $attachments);

        $response['success'] =  true;
        $response['message'] = "Email has been sent successfully.";
        die(json_encode($response));




        // function  ends
}

function so_enqueue_scripts()
{
  // wp_die(plugins_url('main.css', __FILE__));
        // wp_enqueue_style(
        //         'dmt-main',
        //         plugins_url('sidebar.css', __FILE__),
        //         array('bootstrap'),
        //         '1.2',
        //         'all'
        // );
        wp_register_script(
                'ajaxHandle',
                plugins_url('js/jquery.ajax.js', __FILE__),
                array(),
                '1.2',
                true
        );
        wp_enqueue_script('ajaxHandle');
        wp_localize_script(
                'ajaxHandle',
                'ajax_object',
                array('ajaxurl' => admin_url('admin-ajax.php'))
        );
}

function custom_cybersource_checkout($atts)
{
        ob_start();
        if (isset($atts['currency'])) {
                $etl_currency = $atts['currency'];
        }

        include("payment_form.php");
        return ob_get_clean();
}
function custom_cybersource_procheckout($atts)
{
        ob_start();
        if (isset($atts['currency'])) {
                $etl_currency = $atts['currency'];
        }

        include("payment_pform.php");
        return ob_get_clean();
}


// Add the custom columns to the book post type:
add_filter('manage_bookings_posts_columns', 'set_custom_edit_bookings_columns');
function set_custom_edit_bookings_columns($columns)
{
        $columns['booking_id'] = __('Booking ID', 'domain');
        return $columns;
}

// Add the data to the custom columns for the book post type:
add_action('manage_bookings_posts_custom_column', 'custom_bookings_column', 10, 2);
function custom_bookings_column($column, $post_id)
{
        switch ($column) {

                case 'booking_id':
                        echo ($post_id);

                        break;
        }
}




function etl_get_test($posts, $i, $currency)
{

        foreach ($posts as $post) {

                $base_key_test_type = "test_pricing_euro_" . $i . "_test_type";

                if ($post['meta_key'] ==  $base_key_test_type) {
                        $test_type = $post['meta_value'];
                }

                $base_test_package_name = "test_pricing_euro_" . $i . "_test_package_name";

                if ($post['meta_key'] == $base_test_package_name) {
                        $test_package_name = $post['meta_value'];
                }

                $base_result_duration_info = "test_pricing_euro_" . $i . "_result_duration_info";
                if ($post['meta_key'] == $base_result_duration_info) {
                        $result_duration_info = $post['meta_value'];
                }



                // check if currency is scr
                if ($currency == "scr") {


                        $base_euro_online_price = "test_pricing_euro_" . $i . "_scr_online_price";
                        if ($post['meta_key'] == $base_euro_online_price) {
                                $euro_online_price = $post['meta_value'];
                        }
                } else {
                        $base_euro_online_price = "test_pricing_euro_" . $i . "_euro_online_price";
                        if ($post['meta_key'] == $base_euro_online_price) {
                                $euro_online_price = $post['meta_value'];
                        }
                }
        }

        if (isset($test_type) || isset($test_package_name) || isset($result_duration_info)) {

                $complete_test_name = ucfirst($test_type) . " Test - " . $test_package_name . " - " . $result_duration_info;

                $euro_online_price = explode(" ", $euro_online_price);
                $euro_online_price = $euro_online_price[1];

                // if user price of test will be empty then we will set the online euro price to zero
                if (empty($euro_online_price)) {
                        $euro_online_price = 0;
                }
                return "<option value='$complete_test_name, $euro_online_price'>$complete_test_name</option>";
        } else {
                return false;
        }
}





function so_wp_ajax_function()
{
        global $wpdb;
        $selectedDate =  $_POST['selectedDate'];


        // get the id of custom post type
        $args = array('post_type' => 'available_slots');
        $slot_post_id;
        $loop = new WP_Query($args);
        $slot_post_id = $loop->posts[0]->ID;
        // get booked slots for selected date
        $posts = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE post_id=$slot_post_id AND meta_value='$selectedDate'", ARRAY_A);
        // empty array to store booked slots for selected date
        $booked_slots = array();
        foreach ($posts as $post_key => $post_value) {
                array_push($booked_slots, $post_value['meta_key']);
        }

        if (date('Y-m-d', strtotime($selectedDate)) == date('Y-m-d')) {
                $total_slots = get_time_slots();
                $booked_slots = book_today_past_time_slots($booked_slots);
        } else {
                $total_slots = array(
                        '09:00am-09:30am' => '09:00 AM - 09:30 AM',
                        '09:30am-10:00am' => '09:30 AM - 10:00 AM',

                        '10:00am-10:30am' => '10:00 AM - 10:30 AM',
                        '10:30am-11:00am' => '10:30 AM - 11:00 AM',
                        '11:00am-11:30am' => '11:00 AM - 11:30 AM',
                        '11:30am-12:00pm' => '11:30 AM - 12:00 PM',
                        '12:30pm-01:00pm' => '12:30 PM - 01:00 PM',
                        '01:00pm-01:30pm' => '01:00 PM - 01:30 PM',
                        '01:30pm-02:00pm' => '01:30 PM - 02:00 PM',
                        '02:00pm-02:30pm' => '02:00 PM - 02:30 PM',
                        '02:30pm-03:00pm' => '02:30 PM - 03:00 PM',
                        '03:00pm-03:30pm' => '03:00 PM - 03:30 PM',
                        '03:30pm-04:00pm' => '03:30 PM - 04:00 PM',
                );
        }


        $etl_html = "";

        foreach ($total_slots as $slot_key => $slot_value) {


                if (in_array($slot_key, $booked_slots)) {
                        $etl_html .= '<div time-slot="' . $slot_key . '" class="slot disabled">';
                } else {
                        $etl_html .= '<div time-slot="' . $slot_key . '" class="slot">';
                }
                $etl_html .= '<p>' . $slot_value . '</p>';
                $etl_html .= '</div>';
        }



        echo $etl_html;

        ob_get_clean();

        wp_die(); // ajax call must die to avoid trailing 0 in your response







} // so_wp_ajax_function ends //************************************ */





// function so_wp_ajax_function()
// {

//    global $wpdb;
//    $etl_currency =  $_POST['selectedCurrency'];
//    $island_id =  $_POST['islandId'];

//    $posts = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE post_id=$island_id", ARRAY_A);
//    // print_r($posts);
//    // echo $_POST['selectedCurrency'];

//    $i = 1;
//    // call the user defined function get_test to get a single option value from

//    /**
//     * Use a do while loop
//     * and a function with inner foreach loop to get the available options of user selected isaland
//     */
//    do {
//       $function_response = etl_get_test($posts, $i, $etl_currency);
//       if ($function_response != false) {
//          echo $function_response;

//          $i++;
//       }
//    } while ($function_response != false);




//    ob_get_clean();

//    wp_die(); // ajax call must die to avoid trailing 0 in your response
// }

















register_activation_hook(__FILE__, 'etl_activate_plugin');

function etl_activate_plugin()
{
        /**
         * *Create a custom post type
         *  this post types meta data will be used to save aviailable slots in database
         */

        $custom_post_query = array(
                'post_title' => 'Available Slots',
                'post_content' => "",
                'post_type' => 'available_slots',
                'post_name' => 'available_slots',
                'post_status' => 'publish',
                'post_author' => 1
        );
        wp_insert_post($custom_post_query);
}