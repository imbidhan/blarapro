@extends("frontend.frontendMaster")

@section("mainMenu")
    @include("frontend.partials.header")
@endsection

@section("content")
    <!-- breadcrumb Start -->
    <section class="breadcrumbs-custom-wrap">
        <h1 class="text-center">
            <ul class="breadcroumbLink">
                <li><a href="{{ url("/") }}">Home</a></li>
                <li><a>/ edit profile</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title">Edit Profile </h3>
                            <?php
                                 $warning = Session::get('warning');
                                 $success = Session::get('success');
                             ?>
                            @if(isset($warning))
                                <div class="col-md-6 offset-md-3 alert alert-danger alert-dismissible fade show">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $warning }}
                                </div>
                            @endif

                            @if(isset($success))
                                <div class="col-md-6 offset-md-3 alert alert-success alert-dismissible fade show">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $success }}
                                </div>
                            @endif
                            <div class="customProfile">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <form action="{{ route("update_profile",["username"=>$user->username]) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="namename" style="display: block;text-align: left;">Username <span class="text-danger">*</span></label>
                                                <input id="namename" class="form-control" type="text" name="namename" placeholder="Name" value="{{ $user->username }}" readonly/>
                                            </div>
                                            <div class="form-group">
                                                <label for="country" style="display: block;text-align: left;">Country <span class="text-danger">*</span></label>
                                                <select required id="country" name="country" class="form-control" style="height:50px" >
                                                    <option value="">Select Country *</option>
                                                    <option @if ($user->country == 'Bangladesh') selected="selected" @endif value="Bangladesh">Bangladesh</option>
                                                    <option @if ($user->country == 'Afghanistan') selected="selected" @endif value="Afghanistan">Afghanistan</option>
                                                    <option @if ($user->country == 'Aland Islands') selected="selected" @endif value="Aland Islands">Åland Islands</option>
                                                    <option @if ($user->country == 'Albania') selected="selected" @endif value="Albania">Albania</option>
                                                    <option @if ($user->country == 'Algeria') selected="selected" @endif value="Algeria">Algeria</option>
                                                    <option @if ($user->country == 'American Samoa') selected="selected" @endif value="American Samoa">American Samoa</option>
                                                    <option @if ($user->country == 'Andorra') selected="selected" @endif value="Andorra">Andorra</option>
                                                    <option @if ($user->country == 'Angola') selected="selected" @endif value="Angola">Angola</option>
                                                    <option @if ($user->country == 'Anguilla') selected="selected" @endif value="Anguilla">Anguilla</option>
                                                    <option @if ($user->country == 'Antarctica') selected="selected" @endif value="Antarctica">Antarctica</option>
                                                    <option @if ($user->country == 'Antigua and Barbuda') selected="selected" @endif value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                    <option @if ($user->country == 'Argentina') selected="selected" @endif value="Argentina">Argentina</option>
                                                    <option @if ($user->country == 'Armenia') selected="selected" @endif value="Armenia">Armenia</option>
                                                    <option @if ($user->country == 'Aruba') selected="selected" @endif value="Aruba">Aruba</option>
                                                    <option @if ($user->country == 'Australia') selected="selected" @endif value="Australia">Australia</option>
                                                    <option @if ($user->country == 'Austria') selected="selected" @endif value="Austria">Austria</option>
                                                    <option @if ($user->country == 'Azerbaijan') selected="selected" @endif value="Azerbaijan">Azerbaijan</option>
                                                    <option @if ($user->country == 'Bahamas') selected="selected" @endif value="Bahamas">Bahamas</option>
                                                    <option @if ($user->country == 'Bahrain') selected="selected" @endif value="Bahrain">Bahrain</option>
                                                    <option @if ($user->country == 'Barbados') selected="selected" @endif value="Barbados">Barbados</option>
                                                    <option @if ($user->country == 'Belarus') selected="selected" @endif value="Belarus">Belarus</option>
                                                    <option @if ($user->country == 'Belgium') selected="selected" @endif value="Belgium">Belgium</option>
                                                    <option @if ($user->country == 'Belize') selected="selected" @endif value="Belize">Belize</option>
                                                    <option @if ($user->country == 'Benin') selected="selected" @endif value="Benin">Benin</option>
                                                    <option @if ($user->country == 'Bermuda') selected="selected" @endif value="Bermuda">Bermuda</option>
                                                    <option @if ($user->country == 'Bhutan') selected="selected" @endif value="Bhutan">Bhutan</option>
                                                    <option @if ($user->country == 'Bolivia') selected="selected" @endif value="Bolivia">Bolivia</option>
                                                    <option @if ($user->country == 'Bosnia and Herzegovina') selected="selected" @endif value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                    <option @if ($user->country == 'Botswana') selected="selected" @endif value="Botswana">Botswana</option>
                                                    <option @if ($user->country == 'Bouvet Island') selected="selected" @endif value="Bouvet Island">Bouvet Island</option>
                                                    <option @if ($user->country == 'Brazil') selected="selected" @endif value="Brazil">Brazil</option>
                                                    <option @if ($user->country == 'British Indian Ocean Territory') selected="selected" @endif value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                    <option @if ($user->country == 'Brunei Darussalam') selected="selected" @endif value="Brunei Darussalam">Brunei Darussalam</option>
                                                    <option @if ($user->country == 'Bulgaria') selected="selected" @endif value="Bulgaria">Bulgaria</option>
                                                    <option @if ($user->country == 'Burkina Faso') selected="selected" @endif value="Burkina Faso">Burkina Faso</option>
                                                    <option @if ($user->country == 'Burundi') selected="selected" @endif value="Burundi">Burundi</option>
                                                    <option @if ($user->country == 'Cambodia') selected="selected" @endif value="Cambodia">Cambodia</option>
                                                    <option @if ($user->country == 'Cameroon') selected="selected" @endif value="Cameroon">Cameroon</option>
                                                    <option @if ($user->country == 'Canada') selected="selected" @endif value="Canada">Canada</option>
                                                    <option @if ($user->country == 'Cape Verde') selected="selected" @endif value="Cape Verde">Cape Verde</option>
                                                    <option @if ($user->country == 'Cayman Islands') selected="selected" @endif value="Cayman Islands">Cayman Islands</option>
                                                    <option @if ($user->country == 'Central African Republic') selected="selected" @endif value="Central African Republic">Central African Republic</option>
                                                    <option @if ($user->country == 'Chad') selected="selected" @endif value="Chad">Chad</option>
                                                    <option @if ($user->country == 'Chile') selected="selected" @endif value="Chile">Chile</option>
                                                    <option @if ($user->country == 'China') selected="selected" @endif value="China">China</option>
                                                    <option @if ($user->country == 'Christmas Island') selected="selected" @endif value="Christmas Island">Christmas Island</option>
                                                    <option @if ($user->country == 'Cocos (Keeling) Islands') selected="selected" @endif value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                    <option @if ($user->country == 'Colombia') selected="selected" @endif value="Colombia">Colombia</option>
                                                    <option @if ($user->country == 'Comoros') selected="selected" @endif value="Comoros">Comoros</option>
                                                    <option @if ($user->country == 'Congo') selected="selected" @endif value="Congo">Congo</option>
                                                    <option @if ($user->country == 'Congo, The Democratic Republic of The') selected="selected" @endif value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                                    <option @if ($user->country == 'Cook Islands') selected="selected" @endif value="Cook Islands">Cook Islands</option>
                                                    <option @if ($user->country == 'Costa Rica') selected="selected" @endif value="Costa Rica">Costa Rica</option>
                                                    <option @if ($user->country == "Cote D'ivoire") selected="selected" @endif value="Cote D'ivoire">Cote D'ivoire</option>
                                                    <option @if ($user->country == 'Croatia') selected="selected" @endif value="Croatia">Croatia</option>
                                                    <option @if ($user->country == 'Cuba') selected="selected" @endif value="Cuba">Cuba</option>
                                                    <option @if ($user->country == 'Cyprus') selected="selected" @endif value="Cyprus">Cyprus</option>
                                                    <option @if ($user->country == 'Czech Republic') selected="selected" @endif value="Czech Republic">Czech Republic</option>
                                                    <option @if ($user->country == 'Denmark') selected="selected" @endif value="Denmark">Denmark</option>
                                                    <option @if ($user->country == 'Djibouti') selected="selected" @endif value="Djibouti">Djibouti</option>
                                                    <option @if ($user->country == 'Dominica') selected="selected" @endif value="Dominica">Dominica</option>
                                                    <option @if ($user->country == 'Dominican Republic') selected="selected" @endif value="Dominican Republic">Dominican Republic</option>
                                                    <option @if ($user->country == 'Ecuador') selected="selected" @endif value="Ecuador">Ecuador</option>
                                                    <option @if ($user->country == 'Egypt') selected="selected" @endif value="Egypt">Egypt</option>
                                                    <option @if ($user->country == 'El Salvador') selected="selected" @endif value="El Salvador">El Salvador</option>
                                                    <option @if ($user->country == 'Equatorial Guinea') selected="selected" @endif value="Equatorial Guinea">Equatorial Guinea</option>
                                                    <option @if ($user->country == 'Eritrea') selected="selected" @endif value="Eritrea">Eritrea</option>
                                                    <option @if ($user->country == 'Estonia') selected="selected" @endif value="Estonia">Estonia</option>
                                                    <option @if ($user->country == 'Ethiopia') selected="selected" @endif value="Ethiopia">Ethiopia</option>
                                                    <option @if ($user->country == 'Falkland Islands (Malvinas)') selected="selected" @endif value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                    <option @if ($user->country == 'Faroe Islands') selected="selected" @endif value="Faroe Islands">Faroe Islands</option>
                                                    <option @if ($user->country == 'Fiji') selected="selected" @endif value="Fiji">Fiji</option>
                                                    <option @if ($user->country == 'Finland') selected="selected" @endif value="Finland">Finland</option>
                                                    <option @if ($user->country == 'France') selected="selected" @endif value="France">France</option>
                                                    <option @if ($user->country == 'French Guiana') selected="selected" @endif value="French Guiana">French Guiana</option>
                                                    <option @if ($user->country == 'French Polynesia') selected="selected" @endif value="French Polynesia">French Polynesia</option>
                                                    <option @if ($user->country == 'French Southern Territories') selected="selected" @endif value="French Southern Territories">French Southern Territories</option>
                                                    <option @if ($user->country == 'Gabon') selected="selected" @endif value="Gabon">Gabon</option>
                                                    <option @if ($user->country == 'Gambia') selected="selected" @endif value="Gambia">Gambia</option>
                                                    <option @if ($user->country == 'Georgia') selected="selected" @endif value="Georgia">Georgia</option>
                                                    <option @if ($user->country == 'Germany') selected="selected" @endif value="Germany">Germany</option>
                                                    <option @if ($user->country == 'Ghana') selected="selected" @endif value="Ghana">Ghana</option>
                                                    <option @if ($user->country == 'Gibraltar') selected="selected" @endif value="Gibraltar">Gibraltar</option>
                                                    <option @if ($user->country == 'Greece') selected="selected" @endif value="Greece">Greece</option>
                                                    <option @if ($user->country == 'Greenland') selected="selected" @endif value="Greenland">Greenland</option>
                                                    <option @if ($user->country == 'Grenada') selected="selected" @endif value="Grenada">Grenada</option>
                                                    <option @if ($user->country == 'Guadeloupe') selected="selected" @endif value="Guadeloupe">Guadeloupe</option>
                                                    <option @if ($user->country == 'Guam') selected="selected" @endif value="Guam">Guam</option>
                                                    <option @if ($user->country == 'Guatemala') selected="selected" @endif value="Guatemala">Guatemala</option>
                                                    <option @if ($user->country == 'Guernsey') selected="selected" @endif value="Guernsey">Guernsey</option>
                                                    <option @if ($user->country == 'Guinea') selected="selected" @endif value="Guinea">Guinea</option>
                                                    <option @if ($user->country == 'Guinea-bissau') selected="selected" @endif value="Guinea-bissau">Guinea-bissau</option>
                                                    <option @if ($user->country == 'Guyana') selected="selected" @endif value="Guyana">Guyana</option>
                                                    <option @if ($user->country == 'Haiti') selected="selected" @endif value="Haiti">Haiti</option>
                                                    <option @if ($user->country == 'Heard Island and Mcdonald Islands') selected="selected" @endif value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                    <option @if ($user->country == 'Holy See (Vatican City State)') selected="selected" @endif value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                    <option @if ($user->country == 'Honduras') selected="selected" @endif value="Honduras">Honduras</option>
                                                    <option @if ($user->country == 'Hong Kong') selected="selected" @endif value="Hong Kong">Hong Kong</option>
                                                    <option @if ($user->country == 'Hungary') selected="selected" @endif value="Hungary">Hungary</option>
                                                    <option @if ($user->country == 'Iceland') selected="selected" @endif value="Iceland">Iceland</option>
                                                    <option @if ($user->country == 'India') selected="selected" @endif value="India">India</option>
                                                    <option @if ($user->country == 'Indonesia') selected="selected" @endif value="Indonesia">Indonesia</option>
                                                    <option @if ($user->country == 'Iran, Islamic Republic of') selected="selected" @endif value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                    <option @if ($user->country == 'Iraq') selected="selected" @endif value="Iraq">Iraq</option>
                                                    <option @if ($user->country == 'Ireland') selected="selected" @endif value="Ireland">Ireland</option>
                                                    <option @if ($user->country == 'Isle of Man') selected="selected" @endif value="Isle of Man">Isle of Man</option>
                                                    <option @if ($user->country == 'Israel') selected="selected" @endif value="Israel">Israel</option>
                                                    <option @if ($user->country == 'Italy') selected="selected" @endif value="Italy">Italy</option>
                                                    <option @if ($user->country == 'Jamaica') selected="selected" @endif value="Jamaica">Jamaica</option>
                                                    <option @if ($user->country == 'Japan') selected="selected" @endif value="Japan">Japan</option>
                                                    <option @if ($user->country == 'Jersey') selected="selected" @endif value="Jersey">Jersey</option>
                                                    <option @if ($user->country == 'Jordan') selected="selected" @endif value="Jordan">Jordan</option>
                                                    <option @if ($user->country == 'Kazakhstan') selected="selected" @endif value="Kazakhstan">Kazakhstan</option>
                                                    <option @if ($user->country == 'Kenya') selected="selected" @endif value="Kenya">Kenya</option>
                                                    <option @if ($user->country == 'Kiribati') selected="selected" @endif value="Kiribati">Kiribati</option>
                                                    <option @if ($user->country == "Korea, Democratic People's Republic of") selected="selected" @endif value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                    <option @if ($user->country == 'Korea, Republic of') selected="selected" @endif value="Korea, Republic of">Korea, Republic of</option>
                                                    <option @if ($user->country == 'Kuwait') selected="selected" @endif value="Kuwait">Kuwait</option>
                                                    <option @if ($user->country == 'Kyrgyzstan') selected="selected" @endif value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option @if ($user->country == "Lao People's Democratic Republic") selected="selected" @endif value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                    <option @if ($user->country == 'Latvia') selected="selected" @endif value="Latvia">Latvia</option>
                                                    <option @if ($user->country == 'Lebanon') selected="selected" @endif value="Lebanon">Lebanon</option>
                                                    <option @if ($user->country == 'Lesotho') selected="selected" @endif value="Lesotho">Lesotho</option>
                                                    <option @if ($user->country == 'Liberia') selected="selected" @endif value="Liberia">Liberia</option>
                                                    <option @if ($user->country == 'Libyan Arab Jamahiriya') selected="selected" @endif value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                    <option @if ($user->country == 'Liechtenstein') selected="selected" @endif value="Liechtenstein">Liechtenstein</option>
                                                    <option @if ($user->country == 'Lithuania') selected="selected" @endif value="Lithuania">Lithuania</option>
                                                    <option @if ($user->country == 'Luxembourg') selected="selected" @endif value="Luxembourg">Luxembourg</option>
                                                    <option @if ($user->country == 'Macao') selected="selected" @endif value="Macao">Macao</option>
                                                    <option @if ($user->country == 'Macedonia, The Former Yugoslav Republic of') selected="selected" @endif value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                    <option @if ($user->country == 'Madagascar') selected="selected" @endif value="Madagascar">Madagascar</option>
                                                    <option @if ($user->country == 'Malawi') selected="selected" @endif value="Malawi">Malawi</option>
                                                    <option @if ($user->country == 'Malaysia') selected="selected" @endif value="Malaysia">Malaysia</option>
                                                    <option @if ($user->country == 'Maldives') selected="selected" @endif value="Maldives">Maldives</option>
                                                    <option @if ($user->country == 'Mali') selected="selected" @endif value="Mali">Mali</option>
                                                    <option @if ($user->country == 'Malta') selected="selected" @endif value="Malta">Malta</option>
                                                    <option @if ($user->country == 'Marshall Islands') selected="selected" @endif value="Marshall Islands">Marshall Islands</option>
                                                    <option @if ($user->country == 'Martinique') selected="selected" @endif value="Martinique">Martinique</option>
                                                    <option @if ($user->country == 'Mauritania') selected="selected" @endif value="Mauritania">Mauritania</option>
                                                    <option @if ($user->country == 'Mauritius') selected="selected" @endif value="Mauritius">Mauritius</option>
                                                    <option @if ($user->country == 'Mayotte') selected="selected" @endif value="Mayotte">Mayotte</option>
                                                    <option @if ($user->country == 'Mexico') selected="selected" @endif value="Mexico">Mexico</option>
                                                    <option @if ($user->country == 'Micronesia, Federated States of') selected="selected" @endif value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                    <option @if ($user->country == 'Moldova, Republic of') selected="selected" @endif value="Moldova, Republic of">Moldova, Republic of</option>
                                                    <option @if ($user->country == 'Monaco') selected="selected" @endif value="Monaco">Monaco</option>
                                                    <option @if ($user->country == 'Mongolia') selected="selected" @endif value="Mongolia">Mongolia</option>
                                                    <option @if ($user->country == 'Montenegro') selected="selected" @endif value="Montenegro">Montenegro</option>
                                                    <option @if ($user->country == 'Montserrat') selected="selected" @endif value="Montserrat">Montserrat</option>
                                                    <option @if ($user->country == 'Morocco') selected="selected" @endif value="Morocco">Morocco</option>
                                                    <option @if ($user->country == 'Mozambique') selected="selected" @endif value="Mozambique">Mozambique</option>
                                                    <option @if ($user->country == 'Myanmar') selected="selected" @endif value="Myanmar">Myanmar</option>
                                                    <option @if ($user->country == 'Namibia') selected="selected" @endif value="Namibia">Namibia</option>
                                                    <option @if ($user->country == 'Nauru') selected="selected" @endif value="Nauru">Nauru</option>
                                                    <option @if ($user->country == 'Nepal') selected="selected" @endif value="Nepal">Nepal</option>
                                                    <option @if ($user->country == 'Netherlands') selected="selected" @endif value="Netherlands">Netherlands</option>
                                                    <option @if ($user->country == 'Netherlands Antilles') selected="selected" @endif value="Netherlands Antilles">Netherlands Antilles</option>
                                                    <option @if ($user->country == 'New Caledonia') selected="selected" @endif value="New Caledonia">New Caledonia</option>
                                                    <option @if ($user->country == 'New Zealand') selected="selected" @endif value="New Zealand">New Zealand</option>
                                                    <option @if ($user->country == 'Nicaragua') selected="selected" @endif value="Nicaragua">Nicaragua</option>
                                                    <option @if ($user->country == 'Niger') selected="selected" @endif value="Niger">Niger</option>
                                                    <option @if ($user->country == 'Nigeria') selected="selected" @endif value="Nigeria">Nigeria</option>
                                                    <option @if ($user->country == 'Niue') selected="selected" @endif value="Niue">Niue</option>
                                                    <option @if ($user->country == 'Norfolk Island') selected="selected" @endif value="Norfolk Island">Norfolk Island</option>
                                                    <option @if ($user->country == 'Northern Mariana Islands') selected="selected" @endif value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                    <option @if ($user->country == 'Norway') selected="selected" @endif value="Norway">Norway</option>
                                                    <option @if ($user->country == 'Oman') selected="selected" @endif value="Oman">Oman</option>
                                                    <option @if ($user->country == 'Pakistan') selected="selected" @endif value="Pakistan">Pakistan</option>
                                                    <option @if ($user->country == 'Palau') selected="selected" @endif value="Palau">Palau</option>
                                                    <option @if ($user->country == 'Palestinian Territory, Occupied') selected="selected" @endif value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                    <option @if ($user->country == 'Panama') selected="selected" @endif value="Panama">Panama</option>
                                                    <option @if ($user->country == 'Papua New Guinea') selected="selected" @endif value="Papua New Guinea">Papua New Guinea</option>
                                                    <option @if ($user->country == 'Paraguay') selected="selected" @endif value="Paraguay">Paraguay</option>
                                                    <option @if ($user->country == 'Peru') selected="selected" @endif value="Peru">Peru</option>
                                                    <option @if ($user->country == 'Philippines') selected="selected" @endif value="Philippines">Philippines</option>
                                                    <option @if ($user->country == 'Pitcairn') selected="selected" @endif value="Pitcairn">Pitcairn</option>
                                                    <option @if ($user->country == 'Poland') selected="selected" @endif value="Poland">Poland</option>
                                                    <option @if ($user->country == 'Portugal') selected="selected" @endif value="Portugal">Portugal</option>
                                                    <option @if ($user->country == 'Puerto Rico') selected="selected" @endif value="Puerto Rico">Puerto Rico</option>
                                                    <option @if ($user->country == 'Qatar') selected="selected" @endif value="Qatar">Qatar</option>
                                                    <option @if ($user->country == 'Reunion') selected="selected" @endif value="Reunion">Reunion</option>
                                                    <option @if ($user->country == 'Romania') selected="selected" @endif value="Romania">Romania</option>
                                                    <option @if ($user->country == 'Russian Federation') selected="selected" @endif value="Russian Federation">Russian Federation</option>
                                                    <option @if ($user->country == 'Rwanda') selected="selected" @endif value="Rwanda">Rwanda</option>
                                                    <option @if ($user->country == 'Saint Helena') selected="selected" @endif value="Saint Helena">Saint Helena</option>
                                                    <option @if ($user->country == 'Saint Kitts and Nevis') selected="selected" @endif value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                    <option @if ($user->country == 'Saint Lucia') selected="selected" @endif value="Saint Lucia">Saint Lucia</option>
                                                    <option @if ($user->country == 'Saint Pierre and Miquelon') selected="selected" @endif value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                    <option @if ($user->country == 'Saint Vincent and The Grenadines') selected="selected" @endif value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                    <option @if ($user->country == 'Samoa') selected="selected" @endif value="Samoa">Samoa</option>
                                                    <option @if ($user->country == 'San Marino') selected="selected" @endif value="San Marino">San Marino</option>
                                                    <option @if ($user->country == 'Sao Tome and Principe') selected="selected" @endif value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                    <option @if ($user->country == 'Saudi Arabia') selected="selected" @endif value="Saudi Arabia">Saudi Arabia</option>
                                                    <option @if ($user->country == 'Senegal') selected="selected" @endif value="Senegal">Senegal</option>
                                                    <option @if ($user->country == 'Serbia') selected="selected" @endif value="Serbia">Serbia</option>
                                                    <option @if ($user->country == 'Seychelles') selected="selected" @endif value="Seychelles">Seychelles</option>
                                                    <option @if ($user->country == 'Sierra Leone') selected="selected" @endif value="Sierra Leone">Sierra Leone</option>
                                                    <option @if ($user->country == 'Singapore') selected="selected" @endif value="Singapore">Singapore</option>
                                                    <option @if ($user->country == 'Slovakia') selected="selected" @endif value="Slovakia">Slovakia</option>
                                                    <option @if ($user->country == 'Slovenia') selected="selected" @endif value="Slovenia">Slovenia</option>
                                                    <option @if ($user->country == 'Solomon Islands') selected="selected" @endif value="Solomon Islands">Solomon Islands</option>
                                                    <option @if ($user->country == 'Somalia') selected="selected" @endif value="Somalia">Somalia</option>
                                                    <option @if ($user->country == 'South Africa') selected="selected" @endif value="South Africa">South Africa</option>
                                                    <option @if ($user->country == 'South Georgia and The South Sandwich Islands') selected="selected" @endif value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                    <option @if ($user->country == 'Spain') selected="selected" @endif value="Spain">Spain</option>
                                                    <option @if ($user->country == 'Sri Lanka') selected="selected" @endif value="Sri Lanka">Sri Lanka</option>
                                                    <option @if ($user->country == 'Sudan') selected="selected" @endif value="Sudan">Sudan</option>
                                                    <option @if ($user->country == 'Suriname') selected="selected" @endif value="Suriname">Suriname</option>
                                                    <option @if ($user->country == 'Svalbard and Jan Mayen') selected="selected" @endif value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                    <option @if ($user->country == 'Swaziland') selected="selected" @endif value="Swaziland">Swaziland</option>
                                                    <option @if ($user->country == 'Sweden') selected="selected" @endif value="Sweden">Sweden</option>
                                                    <option @if ($user->country == 'Switzerland') selected="selected" @endif value="Switzerland">Switzerland</option>
                                                    <option @if ($user->country == 'Syrian Arab Republic') selected="selected" @endif value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                    <option @if ($user->country == 'Taiwan, Province of China') selected="selected" @endif value="Taiwan, Province of China">Taiwan, Province of China</option>
                                                    <option @if ($user->country == 'Tajikistan') selected="selected" @endif value="Tajikistan">Tajikistan</option>
                                                    <option @if ($user->country == 'Tanzania, United Republic of') selected="selected" @endif value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                    <option @if ($user->country == 'Thailand') selected="selected" @endif value="Thailand">Thailand</option>
                                                    <option @if ($user->country == 'Timor-leste') selected="selected" @endif value="Timor-leste">Timor-leste</option>
                                                    <option @if ($user->country == 'Togo') selected="selected" @endif value="Togo">Togo</option>
                                                    <option @if ($user->country == 'Tokelau') selected="selected" @endif value="Tokelau">Tokelau</option>
                                                    <option @if ($user->country == 'Tonga') selected="selected" @endif value="Tonga">Tonga</option>
                                                    <option @if ($user->country == 'Trinidad and Tobago') selected="selected" @endif value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                    <option @if ($user->country == 'Tunisia') selected="selected" @endif value="Tunisia">Tunisia</option>
                                                    <option @if ($user->country == 'Turkey') selected="selected" @endif value="Turkey">Turkey</option>
                                                    <option @if ($user->country == 'Turkmenistan') selected="selected" @endif value="Turkmenistan">Turkmenistan</option>
                                                    <option @if ($user->country == 'Turks and Caicos Islands') selected="selected" @endif value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                    <option @if ($user->country == 'Tuvalu') selected="selected" @endif value="Tuvalu">Tuvalu</option>
                                                    <option @if ($user->country == 'Uganda') selected="selected" @endif value="Uganda">Uganda</option>
                                                    <option @if ($user->country == 'Ukraine') selected="selected" @endif value="Ukraine">Ukraine</option>
                                                    <option @if ($user->country == 'United Arab Emirates') selected="selected" @endif value="United Arab Emirates">United Arab Emirates</option>
                                                    <option @if ($user->country == 'United Kingdom') selected="selected" @endif value="United Kingdom">United Kingdom</option>
                                                    <option @if ($user->country == 'United States') selected="selected" @endif value="United States">United States</option>
                                                    <option @if ($user->country == 'United States Minor Outlying Islands') selected="selected" @endif value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                    <option @if ($user->country == 'Uruguay') selected="selected" @endif value="Uruguay">Uruguay</option>
                                                    <option @if ($user->country == 'Uzbekistan') selected="selected" @endif value="Uzbekistan">Uzbekistan</option>
                                                    <option @if ($user->country == 'Vanuatu') selected="selected" @endif value="Vanuatu">Vanuatu</option>
                                                    <option @if ($user->country == 'Venezuela') selected="selected" @endif value="Venezuela">Venezuela</option>
                                                    <option @if ($user->country == 'Viet Nam') selected="selected" @endif value="Viet Nam">Viet Nam</option>
                                                    <option @if ($user->country == 'Virgin Islands, British') selected="selected" @endif value="Virgin Islands, British">Virgin Islands, British</option>
                                                    <option @if ($user->country == 'Virgin Islands, U.S.') selected="selected" @endif value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                    <option @if ($user->country == 'Wallis and Futuna') selected="selected" @endif value="Wallis and Futuna">Wallis and Futuna</option>
                                                    <option @if ($user->country == 'Western Sahara') selected="selected" @endif value="Western Sahara">Western Sahara</option>
                                                    <option @if ($user->country == 'Yemen') selected="selected" @endif value="Yemen">Yemen</option>
                                                    <option @if ($user->country == 'Zambia') selected="selected" @endif value="Zambia">Zambia</option>
                                                    <option @if ($user->country == 'Zimbabwe') selected="selected" @endif value="Zimbabwe">Zimbabwe</option>
                                                </select>
                                                <p class="text-danger text-left">{{ $errors->has('country') ? $errors->first('country') : ' ' }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone" style="display: block;text-align: left;">Phone <span class="text-danger">*</span></label>
                                                <input required class="form-control" type="text" name="phone" value="{{ $user->phone }}"/>
                                                <p class="text-danger text-left">{{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-info" value="update"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section("main-footer")
    @include("frontend.partials.footer")
@endsection

@section("main-script")
    @include("frontend.partials.scriptFiles")
@endsection

@section("scriptExtra")

    <script type="text/javascript">
        $('#myAccount').addClass('active');
    </script>

@endsection

