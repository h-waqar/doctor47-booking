
<?php
//
//ini_set( "display_errors", "on" );
//error_reporting( 63 );
//if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
//
//
//    $title = $_REQUEST[ "firstname" ] . " " . @$_POST[ "lastname" ] . "-" . $_REQUEST[ "Check-in-Date" ];
//    $my_query = array(
//        'post_title' => wp_strip_all_tags( $title ),
//        'post_content' => "",
//        'post_type' => 'bookings',
//        'post_name' => wp_strip_all_tags( $title ),
//        'post_status' => 'publish',
//        'post_author' => 1
//    );
//
//    $post_id = wp_insert_post( $my_query );
//    update_field( "check-in_date", $_REQUEST[ "Check-in-Date" ], $post_id );
//    update_field( "check-out_date", $_REQUEST[ "Check-out-Date" ], $post_id );
//    update_field( "villa_type", $_REQUEST[ "VillaType" ], $post_id );
//    update_field( "number_of_guests", $_REQUEST[ "NumberofGuests" ], $post_id );
//    update_field( "first_name", $_REQUEST[ "firstname" ], $post_id );
//    update_field( "last_name", $_REQUEST[ "lastname" ], $post_id );
//    update_field( "address_", $_REQUEST[ "street1" ], $post_id );
//    update_field( "city", $_REQUEST[ "city" ], $post_id );
//    update_field( "state", $_REQUEST[ "state" ], $post_id );
//    update_field( "postal_code", $_REQUEST[ "postalCode" ], $post_id );
//    update_field( "country", $_REQUEST[ "country" ], $post_id );
//    update_field( "email", $_REQUEST[ "email" ], $post_id );
//
//
//    require_once dirname( __FILE__ ) . "/lib/cybersource/cybersource.php";
//    if ( @$gateway_url == "ics2ws.ic3.com" )
//        $selected_url = "Live";
//    else
//        $selected_url = "Test";
//    $request = new CyberSource( "dddddd", "d+2hAKLTTm5x3uMgdaFfBV4ygh8dGCL2etxf6wGEJULN+zfE0XQzpSevdaMD0tUGNkm3W3VH3yeRF4h51erllx/jKAGPmWIY/2YW2JnM7CjL46ZJ3s5j67PTmr66LzqUorzToxgzevXNf0KviyHnAsSZf5sj2gwMyTyHzR0rYl354fVKMMkEY7iYksKNuQC+8Nn1M5CmTZrgJcaYWMXKQ6Od7G6JIAmfles8KkHmR7/UWYxYDRxJ6ebrl4uKZJTJfHaifTymn8vp+BHDyM7C8qGD+tmosA4M28cqFUFz7sLGaIzmLR8DfivNqUNNuKmg4A==", "ics2wstest.ic3.com" );
//    // $request->reference_code = "Order-" . $this->order['o_orderID'];
//    $billTo = new stdClass();
//    $billTo->firstName = @$_POST[ "firstname" ];
//    $billTo->lastName = @$_POST[ "lastname" ];
//    $billTo->street1 = @$_POST[ "street1" ];
//    $billTo->city = @$_POST[ "city" ];
//    $billTo->state = @$_POST[ "state" ];
//    $billTo->postalCode = @$_POST[ "postalCode" ];
//    $billTo->country = @$_POST[ "country" ];
//    $billTo->email = @$_POST[ "email" ];
//    $billTo->ipAddress = $_SERVER[ 'REMOTE_ADDR' ];
//
//    $card = new stdClass();
//    $card->accountNumber = @$_POST[ "accountNumber" ];
//    $card->fullName = @$_POST[ "fullName" ];
//    $card->expirationMonth = @$_POST[ "expirationMonth" ];
//    $card->expirationYear = @$_POST[ "expirationYear" ];
//    $card->cardType = @$request->card_types[ @$_POST[ "cardType" ] ];
//
//    $request->billTo = $billTo;
//    $request->card = $card;
//    // $error="";
//    try {
//        $request->charge( @$_REQUEST[ "amount" ] );
//    } catch ( Exception $exp ) {
//      
//        // $error
//        }
//        if ( $request->response && $request->response->resMessage )
//
//
//            echo( $request->response->resMessage );
//
//
//        // $return['errcode'] = $request->response->success;
//        // $return['errmsg'] = $request->response->resMessage;
//        // $return['res_code'] = $request->response->reasonCode;
//        // $return['tran_id'] = $request->response->requestID;
//
//        // $return['txn_gateway_id1'] = $request->response->requestID;
//
//        }
//        $args = array(
//            'posts_per_page' => -1, // -1 here will return all posts
//            'post_type' => 'blockeddates', //your custom post type
//            'post_status' => 'publish',
//        );
//        $blockeddates = get_posts( $args );
//        $disabled_dates = array();
//        foreach ( $blockeddates as $blockeddate ) {
//            $start_date = get_field( "start_date", $blockeddate->ID );
//            $end_date = get_field( "end_date", $blockeddate->ID );
//
//            $futuredate = date( "m/d/Y" );
//
//            if ( $end_date >= $futuredate ) {
//                $begin = new DateTime( $start_date );
//                $end = new DateTime( $end_date );
//                $daterange = new DatePeriod( $begin, new DateInterval( 'P1D' ), $end );
//                foreach ( $daterange as $date ) {
//                    $disabled_dates[] = $date->format( "m/d/Y" );
//                }
//            }
//        }
        ?>

        <head>
          
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

            <style>
                .error {
                    color: #FF0000;
                }
                
                * {
                    box-sizing: border-box;
                }
                
                h2 {
                    text-align: center;
                }
                
                input[type="text"],
                input[type="number"],
                select,
                textarea {
                    width: 100%;
                    padding: 12px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    resize: vertical;
                    margin-bottom: 10px;
                    transition: all ease 0.5s;
                    font-family: "Josefin Sans", Sans-serif;
                }
                
                input[type="text"]:focus,
                input[type="number"]:focus,
                select:focus,
                textarea:focus {
                    border-radius: 10px 0px 10px 0px;
                    border: 1px solid #FFC400;
                }
                
                label {
                    padding: 12px 12px 12px 0;
                    display: inline-block;
                }
                
                .container {
                    border-radius: 5px;
                    background-color: transparent;
                    padding: 20px;
                }
                
                .col-25 {
                    float: left;
                    width: 25%;
                    margin-top: 6px;
                }
                
                .error {
                    color: #FF0000;
                }
                
                .col-75 {
                    float: left;
                    width: 75%;
                    margin-top: 6px;
                }
                
                .col-37 {
                    float: left;
                    width: 37.5%;
                    margin-top: 6px;
                }
                
                .col-75-btn {
                    margin-left: 35%;
                    margin-top: 6px;
                }
                
                .col-50 {
                    float: left;
                    width: 50%;
                    margin-top: 6px;
                }
                
                .col-100 {
                    float: left;
                    width: 100%;
                    margin-top: 6px;
                }
                
                /* Clear floats after the columns */
                .row:after {
                    content: "";
                    display: table;
                    clear: both;
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
                
                input[type="submit"] {
                    font-family: "Hind", Sans-serif;
                    font-size: 14px;
                    font-weight: 400;
                    text-transform: uppercase;
                    letter-spacing: 2px;
                    fill: #FFFFFF;
                    color: #FFFFFF;
                    background-color: #0074C9;
                    border-radius: 10px 0px 10px 0px;
                    padding: 15px 40px 15px 40px;
                    border: 0;
                    transition: all ease 0.5s;
                }
                
                input[type="submit"]:hover {
                    background-color: #FFC400;
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
                    grid-template-columns: 1fr 1fr;
                }
                
                .villatype-row .col-50 {
                    float: none;
                    width: auto;
                    border: 1px solid #dcdcdc;
                    padding: 15px;
                    text-align: center;
                }
#firstdiv {
  display: block;
  
}
#seconddiv {
  display: none;

}
  
#thirddiv {
  display: none;
 
}
  
            </style>
            

        </head>

        <div>
    <input type="hidden" id="amount" name="amount" > 
</div>
       <form method="post" name="myForm" action="">
            <div id="firstdiv">
           

                <div class="row">
                    <h3 class="form_sec_title">Booking Details</h3>
                </div>
                <div class="row">

                    <div class="col-100">
                        <input type="text" id="Check-in-Date" name="Check-in-Date" min="<?php echo date(" m/d/Y "); ?>" max="" placeholder="Check-in Date" required>
                         <span  class ="error" id="lblCheck-in"> </span> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-100">
                        <input type="text" id="Check-out-Date" name="Check-out-Date"  min="<?php echo date(" m/d/Y "); ?>" placeholder="Check-out Date" required>
                        <span class="error" id="lblCheck-out"> </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-100">
                        <label >Villa Type</label>
                    </div>
                </div>
                <div class="row villatype-row">

                    <div class="col-50">
                        <b>Luxury 4 Bedroom Villa</b>
                        <input type="radio" id="VillaType4" name="VillaType" value="250" required>   <label for="VillaType4"> €250 per night 0-2 people</label>
       </div>
       <div class="col-50">
            <b>Luxury 8 Bedroom Villa</b>
            <input type="radio" id="VillaType8" name="VillaType" value="500" required>
           <label for="VillaType8"> €500 per night 0-2 people</label>

                </div>
                   
                </div>
                <span class="error" id="lblVillaType"> </span>
            
                <div class="row"> <small><em>3 people and above 10 euro each extra per person</em></small>
                </div>
                <div class="row">

                    <div class="col-100">
                        <input type="number" id="NumberofGuests" name="NumberofGuests" min="01" max="" onkeyup="work()"  onwheel="work()" placeholder="Number of Guests" required>

                        <span class="error" id="lblNumberofGuests"> </span>
                    </div>
                </div>
            
                <div class="row villatype-row">
                  
                        <div class="row">
                    <div class="col-50">
                         <input type="button" id="nfirst"  value="Next">
                    </div>
                </div>
                </div>
                          

            </div>
              <div id="seconddiv">
           
                <div class="row">
                    <h3 class="form_sec_title">Personal Information & Billing Details</h3>
                </div>
                <div class="row">

                    <div class="col-100">
                          <span  class ="error" id="lblfname"></span> 
                        <input type="text" id="fname" name="firstname" placeholder="First Name" required>
                    </div>
                </div>
                <div class="row">

                    <div class="col-100">
                         <span  class ="error" id="lbllname"></span> 
                        <input type="text" id="lname" name="lastname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="row">

                    <div class="col-100">
                              <span  class ="error" id="lblstreet1"></span> 
                        <input type="text" id="street1" name="street1" placeholder="Address" required>
                    </div>
                </div>
                <div class="row">

                    <div class="col-100">
                              <span  class ="error" id="lblcity"></span> 
                        <input type="text" id="city" name="city" placeholder="City" required>
                    </div>
                </div>
                <div class="row">

                    <div class="col-100">
                              <span  class ="error" id="lblstate"></span> 
                        <input type="text" id="state" name="state" placeholder="State" required>
                    </div>
                </div>
                <div class="row">

                    <div class="col-100">
                              <span  class ="error" id="lblpostalCode"></span> 
                        <input type="text" id="postalCode" name="postalCode" placeholder="PostalCode" required>
                    </div>
                </div>
                <div class="row">

                    <div class="col-100">

                        <select id="country" name="country">
                            <option value="">Select country</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AX">Aland Islands</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua and Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                            <option value="BA">Bosnia and Herzegovina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Congo, Democratic Republic of the Congo</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Cote D'Ivoire</option>
                            <option value="HR">Croatia</option>
                            <option value="CU">Cuba</option>
                            <option value="CW">Curacao</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GG">Guernsey</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">Heard Island and Mcdonald Islands</option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran, Islamic Republic of</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IM">Isle of Man</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JE">Jersey</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea, Democratic People's Republic of</option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="XK">Kosovo</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People's Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libyan Arab Jamahiriya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macao</option>
                            <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia, Federated States of</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="ME">Montenegro</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="AN">Netherlands Antilles</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PS">Palestinian Territory, Occupied</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Reunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="BL">Saint Barthelemy</option>
                            <option value="SH">Saint Helena</option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint Lucia</option>
                            <option value="MF">Saint Martin</option>
                            <option value="PM">Saint Pierre and Miquelon</option>
                            <option value="VC">Saint Vincent and the Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="RS">Serbia</option>
                            <option value="CS">Serbia and Montenegro</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SX">Sint Maarten</option>
                            <option value="SK">Slovakia</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                            <option value="SS">South Sudan</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TL">Timor-Leste</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UM">United States Minor Outlying Islands</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands, British</option>
                            <option value="VI">Virgin Islands, U.s.</option>
                            <option value="WF">Wallis and Futuna</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                        <span class="error" id="lblCountry"> </span>
                    </div>
                </div>
                <div class="row">

                    <div class="col-100">
                        <input type="text" id="email" name="email" placeholder="Email" required>
                        <span class="error" id="lblEmail"> </span>
                    </div>
                </div>
                 <div class="row villatype-row">
                   <div class="row">
                    <div class="col-50">
                        <input type="button" id="bsecond" value="Back">
                    </div>
                </div>
                        <div class="row">
                    <div class="col-50">
                        <input type="button" id="nsecond" value="Next">
                    </div>
                </div>
                </div>
                      

             </div>
              <div id="thirddiv">
                <div class="row">
                    <h3 class="form_sec_title">Payment Details</h3>
                </div>
                <div class="row">

                    <div class="col-100">
                        <input type="text" id="accountNumber" name="accountNumber" placeholder="Credit Card Number" required>
                        <span class="error" id="lblNumber"> </span>
                    </div>
                </div>

                <div class="row">

                    <div class="col-100">
                        <input type="text" id="fullName" name="fullName" placeholder="Card Holder Name" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-100">
                        <label for="expirationMonth">Expiration Date</label>
                    </div>
                    <div class="col-100">
                        <select id="month" name="expirationMonth" class="col-50" required>
                            <option value="">Choose Expiration Month</option>
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

                        <select id="year" name="expirationYear" class="col-50" required>
                            <option value="">Choose Expiration Year</option>
                            <?php

                            $start_year = date( "Y" );
                            for ( $x = $start_year; $x <= $start_year + 10; $x++ ) {
                                ?>
                            <option value="<?php echo  $x; ?>">
                                <?php echo $x; ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                        <span class="error" id="lblMonth"> </span><br>
                        <span class="error" id="lblYear"> </span>
                    </div>
                </div>


                <div class="row">

                    <div class="col-100">
                        <select id="cardType" name="cardType" required>
                            <option value="">Choose Card Type</option>
                            <option value="MasterCard">MasterCard</option>
                            <option value="AmericanExpress">American Express</option>
                            <option value="Visa">Visa</option>
                            <option value="Discover">Discover</option>
                        </select>
                        <span class="error" id="lblType"> </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-100">
                        <input type="submit" id="submit" onclick="return(validateForm());" value="Process Transection Now">
                    </div>
                </div>
                    <div class="row">
                    <div class="col-50">
                        <input type="button" id="bthird" value="Back">
                    </div>
                </div>
       

        </div>
               <div class="row"> <small><em>Added  € 75 per stay for cleaning fee.</em></small>
                </div>
                <div class="row">Total:  <span id='dvTotal'>Please select Vila Type and Number of Guests</span>
                </div>
               </form>   
            
     

        <script type='text/javascript'>
               var targetthird = document.getElementById("thirddiv");
    var targetfirst = document.getElementById("firstdiv");
    var targetsecond = document.getElementById("seconddiv");
    var fnextbtn = document.getElementById("nfirst");
      var snextbtn = document.getElementById("nsecond");
      var sbackbtn = document.getElementById("bsecond");
      var tbackbtn = document.getElementById("bthird");
  fnextbtn.onclick = function () {
      if(validatefirstdiv()){
        targetfirst.style.display = "none";
        targetsecond.style.display ="block";
    }
    };
  snextbtn.onclick = function () {
      if(validateseconddiv()){
         targetsecond.style.display = "none";
       targetthird.style.display ="block";
   }
    };
      sbackbtn.onclick = function () {
        targetfirst.style.display = "block";
        targetsecond.style.display ="none";
    };
     tbackbtn.onclick = function () {
         targetthird.style.display ="none";
        targetfirst.style.display = "none";
        targetsecond.style.display = "block";
    };
            var check_in = [
                "10/04/2022" 
            ];
           
             $( function() {
    $( "#Check-in-Date" ).datepicker({
      dateFormat: 'mm/dd/yy',
      beforeShowDay: function(date) {
    var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
    for (var i = 0; i < check_in.length; i++) {
      if (Array.isArray(check_in[i])) {
        var from = new Date(check_in[i][0]);
        var to = new Date(check_in[i][2]);
        var current = new Date(string);
      
        if (current >= from && current <= to) return false;
      }
    }
    return [check_in.indexOf(string) == -1]
  }
});
  });
  $( function() {
    $( "#Check-out-Date" ).datepicker({
      dateFormat: 'mm/dd/yy',
      beforeShowDay: function(date) {
    var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
    for (var i = 0; i < check_in.length; i++) {
      if (Array.isArray(check_in[i])) {
        var from = new Date(check_in[i][0]);
        var to = new Date(check_in[i][2]);
        var current = new Date(string);
      
        if (current >= from && current <= to) return false;
      }
    }
    return [check_in.indexOf(string) == -1]
  }
});
  });
     function dateRange(startDate, endDate, steps = 1) {
  const dateArray = [];
  let currentDate = new Date(startDate);

  while (currentDate <= new Date(endDate)) {
    dateArray.push(new Date(currentDate));
    // Use UTC date to prevent problems with time zones and DST
    currentDate.setUTCDate(currentDate.getUTCDate() + steps);
  }

  return dateArray;
}
            function getActualDays( date1, date2 ) {
                var date1 = new Date( date1 );
                var date2 = new Date( date2 );
                const dates = dateRange(date1, date2);
                var days=0;
                var lastIndex=dates.length-1;
                dates.forEach(function(item, index) 
                {
                    if (index === lastIndex) return;
                    
                    days+=1;
                    
                });
                return(days);         
            }
            function getDaysDIfference( date1, date2 ) {
                var date1 = new Date( date1 );
                var date2 = new Date( date2 );
                const dates = dateRange(date1, date2);
                var days=0;
                var lastIndex=dates.length-1;
                dates.forEach(function(item, index) 
                {
                    if (index === lastIndex) return;
                    var indate = item.toLocaleDateString("en-US");
                    const inMonth = indate.split("/");
                    var dateDay=parseInt(inMonth[1]);
                    var dateMonth=parseInt(inMonth[0]);
                    if((dateMonth==12 && dateDay>=25))
                    {
                        days+=1.8;
                    }
                    else if((dateMonth==12 && dateDay>14) || (dateMonth==1 && dateDay<=15))
                    {
                        days+=1.4;
                    }
                    else
                    {
                        days+=1;
                    }
                });
                return(days);
                
            }

            function work() {
                var radVal = document.myForm.VillaType.value;
                var outdate = document.getElementById("Check-out-Date").value;
                var indate = document.getElementById("Check-in-Date").value;  
                if ( radVal == "" || outdate== "" || indate=="") {
                    dvTotal.innerHTML = "Please enter villa type and valid dates";
                } 
                else { 
                if(true){
                    const radioButtons = document.querySelectorAll('input[name="VillaType"]');  
                    for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    var price = radioButton.value;
                }
            }  
                const parse = parseInt( price );
                var inc = 10;
                var number = document.getElementById("NumberofGuests").value;
                const numberparse = parseInt(number );
                var numdays = numberparse - 2;
                var dif = getDaysDIfference( indate, outdate );
                var difDays=getActualDays( indate, outdate );
                
                console.log(dif);
                if ( numberparse== 1 || numberparse == 2 ) {
                    if(dif != 0 && number != "" && numberparse != 0){
                    let cleanFee = 75;
                    let tot = parse * dif; 
                    let total = tot + cleanFee;
                    let sign ="€";
                    dvTotal.innerHTML =  sign.concat(" ", total.toFixed());
                    document.getElementById( "amount" ).value = total.toFixed() ;
                    }else{
                        dvTotal.innerHTML =  "Please select valid Dates"; 
                    }
                } else {
                    if(dif != 0 && number != "" && numberparse != 0){
                    let cleanFee = 75;
                    let tot = parse * dif;
                    let total = tot +  (inc * difDays * numdays) + cleanFee;
                    let sign ="€";
                    dvTotal.innerHTML =  sign.concat(" ", total.toFixed());
                    document.getElementById( "amount" ).value = total.toFixed();
                    }else if(number == "" || numberparse == 0){
                        dvTotal.innerHTML =  "Please select number of guests"; 
                    }else{
                        dvTotal.innerHTML =  "Please select valid Dates"; 
                    }
                } 
            }
        }
            }
    
            document.myForm.onclick = function () {
                work();
            }

            $( "#Check-in-Date" ).on( "change", function () {

                work();
            } );
            $( "#Check-out-Date" ).on( "change", function () {
                work();
            } );
    function validatefirstdiv()
    {  
        var returnvalue = true;
         var Checkin = document.getElementById( "Check-in-Date" ).value;
         var Checkout = document.getElementById( "Check-out-Date" ).value;
         var VillaType4 = document.getElementById( "VillaType4" ).value;
         var VillaType8 = document.getElementById( "VillaType8" ).value;
         var NumberofGuests = document.getElementById( "NumberofGuests" ).value;
               
                if ( Checkin == "" ) {
                    document.getElementById( "lblCheck-in" ).innerHTML = "Please select Checkin Date";
                    returnvalue = false;
                } else {
                    document.getElementById( "lblCheck-in" ).innerHTML = "";
                }
                
                if ( Checkout == "" ) {
                    document.getElementById( "lblCheck-out" ).innerHTML = "Please select Checkout Date";
                     returnvalue = false;
                } else {
                    document.getElementById( "lblCheck-out" ).innerHTML = "";
                }
                
                if ( VillaType4 == "" &&  VillaType8 == "" ) {
                    document.getElementById( "lblVillaType" ).innerHTML = "Please select Villa Type";
                     returnvalue = false;
                } else {
                    document.getElementById( "lblVillaType" ).innerHTML = "";
                }
                
                if ( NumberofGuests == "" ) {
                    document.getElementById( "lblNumberofGuests" ).innerHTML = "Please select Number of Guest";
                     returnvalue = false;
                } else {
                    document.getElementById( "lblNumberofGuests" ).innerHTML = "";
                }
                return returnvalue;
    }
     function ValidateEmail( mail ) {


                if ( /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( mail ) ) {
                    return ( true )
                }

                return ( false )
            }
    function validateseconddiv()
    { 
        var returnval = true;
        var fname = document.getElementById( "fname" ).value;
        var lname = document.getElementById( "lname" ).value;
        var address = document.getElementById( "street1" ).value;
        var city = document.getElementById( "city" ).value;
        var state = document.getElementById( "state" ).value;
         var code = document.getElementById( "postalCode" ).value;
               var country = document.getElementById( "country" ).value;
                  var email = document.getElementById( "email" ).value;
               
                if ( fname == "" ) {
                    document.getElementById( "lblfname" ).innerHTML = "*";
                    returnval = false;
                } else {
                    document.getElementById( "lblfname" ).innerHTML = "";
                }
                 if ( lname == "" ) {
                    document.getElementById( "lbllname" ).innerHTML = "*";
                    returnval = false;
                } else {
                    document.getElementById( "lbllname" ).innerHTML = "";
                }
                 
                 if ( address == "" ) {
                    document.getElementById( "lblstreet1" ).innerHTML = "*";
                    returnval = false;
                } else {
                    document.getElementById( "lblstreet1" ).innerHTML = "";
                }
                if (  city == "" ) {
                    document.getElementById( "lblcity" ).innerHTML = "*";
                    returnval = false;
                } else {
                    document.getElementById( "lblcity" ).innerHTML = "";
                }
                if ( state == "" ) {
                    document.getElementById( "lblstate" ).innerHTML = "*";
                    returnval = false;
                } else {
                    document.getElementById( "lblstate" ).innerHTML = "";
                }
                if ( code == "" ) {
                    document.getElementById( "lblpostalCode" ).innerHTML = "*";
                    returnval = false;
                } else {
                    document.getElementById( "lblpostalCode" ).innerHTML = "";
                }
                 if ( country == "" ) {
                    document.getElementById( "lblCountry" ).innerHTML = "Please select Country";
                    returnval = false;
                } else {
                    document.getElementById( "lblCountry" ).innerHTML = "";
                }

                if ( !ValidateEmail( email )) {
                    document.getElementById( "lblEmail" ).innerHTML = "Invalid email";
                    returnval = false;
                } else {
                    document.getElementById( "lblEmail" ).innerHTML = "";
                }
                  return returnval;
    }
     function ValidateCardNumber( number ) {
                //return(false);
                var ret = false;
                var type = "";
                if ( /^(?:5[1-5][0-9]{14})$/.test( number ) ) {
                    //type = MasterCard;

                    ret = true;
                } else if ( /^(?:3[47][0-9]{13})$/.test( number ) ) {
                    //type = Expres;
                    ret = true;
                } else if ( /^(?:4[0-9]{12}(?:[0-9]{3})?)$/.test( number ) ) {
                    ///type = Visa;
                    ret = true;
                } else if ( /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/.test( number ) ) {
                    //type = discover;
                    ret = true;
                }

                return ret;
            } 
    function validateForm() {

                var returnv = true;
                var month = document.getElementById( "month" ).value;
                var year = document.getElementById( "year" ).value;
                var cardType = document.getElementById( "cardType" ).value;
                var accountNumber = document.getElementById( "accountNumber" ).value;
                if ( month == "" ) {
                    document.getElementById( "lblMonth" ).innerHTML = "Please select Month";
                } else {
                    document.getElementById( "lblMonth" ).innerHTML = "";
                }
                if ( year == "" ) {
                    document.getElementById( "lblYear" ).innerHTML = "Please select year";
                } else {
                    document.getElementById( "lblYear" ).innerHTML = "";
                }
                if ( cardType == "" ) {
                    document.getElementById( "lblType" ).innerHTML = "Please select card type";
                } else {
                    document.getElementById( "lblType" ).innerHTML = "";
                }

             
                if ( !ValidateCardNumber( accountNumber ) ) {

                    document.getElementById( "lblNumber" ).innerHTML = "Invalid card number";
                    returnv = false;
                } else {
                    document.getElementById( "lblNumber" ).innerHTML = "";
                }
                return returnv;
            }
        </script>