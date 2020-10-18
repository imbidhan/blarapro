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
                <li><a>/ registration</a></li>
            </ul>
        </h1>
    </section>
    <!-- banner-section start -->
    <section class="login-section" style="background:#f4f8f9 ;padding:20px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="registration-block text-center customRegistration" style="background: #000040;">
                        <div class="registration-block-inner">
                            <h3 class="title" style="color:#fff;">Create a new account</h3>

                            <?php $message = Session::get('message') ?>
                            <?php $success = Session::get('success') ?>
                            @if(isset($message))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $message }}
                                </div>
                            @endif

                            @if(isset($success))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $success }}
                                </div>
                            @endif
                            <p class="text-danger font-weight-bold mb-2 text-left joinMgs"> JOIN NOW! Please must be type below required (*) field </p>
                            <form action="{{ route("online_user_store") }}" method="POST" class="cmn-form registration-form" id="onlineUserFullForm">
                                @csrf
                                <div class="form-group customErrorFix">
                                    <input required type="text" name="username" id="username" placeholder="Username *" value="{{ old("username") }}" {{ $errors->has('username') ? 'autofocus' : ' ' }} >
                                    <p class="text-warning text-left allowCharacter">Allowed character a-b, A-B , 0-9, -, _</p>
                                    <p class="text-danger text-left">{{ $errors->has('username') ? $errors->first('username') : ' ' }}</p>
                                </div>
                                <div class="form-group customErrorFix">
                                    <input required type="email" name="email" id="email" placeholder="Email *" value="{{ old("email") }}" {{ $errors->has('email') ? 'autofocus' : ' ' }} >
                                    <p class="text-danger text-left">{{ $errors->has('email') ? $errors->first('email') : ' ' }}</p>
                                </div>
                                <div class="form-group customErrorFix">
                                    <input required type="password" name="password" id="password" placeholder="Password *" {{ $errors->has('password') ? 'autofocus' : ' ' }} >
                                    <p class="text-danger text-left">{{ $errors->has('password') ? $errors->first('password') : ' ' }}</p>
                                </div>
                                <div class="form-group customErrorFix">
                                    <input required type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-Password *" >
                                </div>
                                <div class="form-group customErrorFix">
                                    <select required id="country" name="country" class="form-control">
                                        <option value="">Select Country *</option>
                                        <option @if (old('country') == 'Bangladesh') selected="selected" @endif value="Bangladesh">Bangladesh</option>
                                        <option @if (old('country') == 'Afghanistan') selected="selected" @endif value="Afghanistan">Afghanistan</option>
                                        <option @if (old('country') == 'Aland Islands') selected="selected" @endif value="Aland Islands">Åland Islands</option>
                                        <option @if (old('country') == 'Albania') selected="selected" @endif value="Albania">Albania</option>
                                        <option @if (old('country') == 'Algeria') selected="selected" @endif value="Algeria">Algeria</option>
                                        <option @if (old('country') == 'American Samoa') selected="selected" @endif value="American Samoa">American Samoa</option>
                                        <option @if (old('country') == 'Andorra') selected="selected" @endif value="Andorra">Andorra</option>
                                        <option @if (old('country') == 'Angola') selected="selected" @endif value="Angola">Angola</option>
                                        <option @if (old('country') == 'Anguilla') selected="selected" @endif value="Anguilla">Anguilla</option>
                                        <option @if (old('country') == 'Antarctica') selected="selected" @endif value="Antarctica">Antarctica</option>
                                        <option @if (old('country') == 'Antigua and Barbuda') selected="selected" @endif value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option @if (old('country') == 'Argentina') selected="selected" @endif value="Argentina">Argentina</option>
                                        <option @if (old('country') == 'Armenia') selected="selected" @endif value="Armenia">Armenia</option>
                                        <option @if (old('country') == 'Aruba') selected="selected" @endif value="Aruba">Aruba</option>
                                        <option @if (old('country') == 'Australia') selected="selected" @endif value="Australia">Australia</option>
                                        <option @if (old('country') == 'Austria') selected="selected" @endif value="Austria">Austria</option>
                                        <option @if (old('country') == 'Azerbaijan') selected="selected" @endif value="Azerbaijan">Azerbaijan</option>
                                        <option @if (old('country') == 'Bahamas') selected="selected" @endif value="Bahamas">Bahamas</option>
                                        <option @if (old('country') == 'Bahrain') selected="selected" @endif value="Bahrain">Bahrain</option>
                                        <option @if (old('country') == 'Barbados') selected="selected" @endif value="Barbados">Barbados</option>
                                        <option @if (old('country') == 'Belarus') selected="selected" @endif value="Belarus">Belarus</option>
                                        <option @if (old('country') == 'Belgium') selected="selected" @endif value="Belgium">Belgium</option>
                                        <option @if (old('country') == 'Belize') selected="selected" @endif value="Belize">Belize</option>
                                        <option @if (old('country') == 'Benin') selected="selected" @endif value="Benin">Benin</option>
                                        <option @if (old('country') == 'Bermuda') selected="selected" @endif value="Bermuda">Bermuda</option>
                                        <option @if (old('country') == 'Bhutan') selected="selected" @endif value="Bhutan">Bhutan</option>
                                        <option @if (old('country') == 'Bolivia') selected="selected" @endif value="Bolivia">Bolivia</option>
                                        <option @if (old('country') == 'Bosnia and Herzegovina') selected="selected" @endif value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option @if (old('country') == 'Botswana') selected="selected" @endif value="Botswana">Botswana</option>
                                        <option @if (old('country') == 'Bouvet Island') selected="selected" @endif value="Bouvet Island">Bouvet Island</option>
                                        <option @if (old('country') == 'Brazil') selected="selected" @endif value="Brazil">Brazil</option>
                                        <option @if (old('country') == 'British Indian Ocean Territory') selected="selected" @endif value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option @if (old('country') == 'Brunei Darussalam') selected="selected" @endif value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option @if (old('country') == 'Bulgaria') selected="selected" @endif value="Bulgaria">Bulgaria</option>
                                        <option @if (old('country') == 'Burkina Faso') selected="selected" @endif value="Burkina Faso">Burkina Faso</option>
                                        <option @if (old('country') == 'Burundi') selected="selected" @endif value="Burundi">Burundi</option>
                                        <option @if (old('country') == 'Cambodia') selected="selected" @endif value="Cambodia">Cambodia</option>
                                        <option @if (old('country') == 'Cameroon') selected="selected" @endif value="Cameroon">Cameroon</option>
                                        <option @if (old('country') == 'Canada') selected="selected" @endif value="Canada">Canada</option>
                                        <option @if (old('country') == 'Cape Verde') selected="selected" @endif value="Cape Verde">Cape Verde</option>
                                        <option @if (old('country') == 'Cayman Islands') selected="selected" @endif value="Cayman Islands">Cayman Islands</option>
                                        <option @if (old('country') == 'Central African Republic') selected="selected" @endif value="Central African Republic">Central African Republic</option>
                                        <option @if (old('country') == 'Chad') selected="selected" @endif value="Chad">Chad</option>
                                        <option @if (old('country') == 'Chile') selected="selected" @endif value="Chile">Chile</option>
                                        <option @if (old('country') == 'China') selected="selected" @endif value="China">China</option>
                                        <option @if (old('country') == 'Christmas Island') selected="selected" @endif value="Christmas Island">Christmas Island</option>
                                        <option @if (old('country') == 'Cocos (Keeling) Islands') selected="selected" @endif value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option @if (old('country') == 'Colombia') selected="selected" @endif value="Colombia">Colombia</option>
                                        <option @if (old('country') == 'Comoros') selected="selected" @endif value="Comoros">Comoros</option>
                                        <option @if (old('country') == 'Congo') selected="selected" @endif value="Congo">Congo</option>
                                        <option @if (old('country') == 'Congo, The Democratic Republic of The') selected="selected" @endif value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option @if (old('country') == 'Cook Islands') selected="selected" @endif value="Cook Islands">Cook Islands</option>
                                        <option @if (old('country') == 'Costa Rica') selected="selected" @endif value="Costa Rica">Costa Rica</option>
                                        <option @if (old('country') == "Cote D'ivoire") selected="selected" @endif value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option @if (old('country') == 'Croatia') selected="selected" @endif value="Croatia">Croatia</option>
                                        <option @if (old('country') == 'Cuba') selected="selected" @endif value="Cuba">Cuba</option>
                                        <option @if (old('country') == 'Cyprus') selected="selected" @endif value="Cyprus">Cyprus</option>
                                        <option @if (old('country') == 'Czech Republic') selected="selected" @endif value="Czech Republic">Czech Republic</option>
                                        <option @if (old('country') == 'Denmark') selected="selected" @endif value="Denmark">Denmark</option>
                                        <option @if (old('country') == 'Djibouti') selected="selected" @endif value="Djibouti">Djibouti</option>
                                        <option @if (old('country') == 'Dominica') selected="selected" @endif value="Dominica">Dominica</option>
                                        <option @if (old('country') == 'Dominican Republic') selected="selected" @endif value="Dominican Republic">Dominican Republic</option>
                                        <option @if (old('country') == 'Ecuador') selected="selected" @endif value="Ecuador">Ecuador</option>
                                        <option @if (old('country') == 'Egypt') selected="selected" @endif value="Egypt">Egypt</option>
                                        <option @if (old('country') == 'El Salvador') selected="selected" @endif value="El Salvador">El Salvador</option>
                                        <option @if (old('country') == 'Equatorial Guinea') selected="selected" @endif value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option @if (old('country') == 'Eritrea') selected="selected" @endif value="Eritrea">Eritrea</option>
                                        <option @if (old('country') == 'Estonia') selected="selected" @endif value="Estonia">Estonia</option>
                                        <option @if (old('country') == 'Ethiopia') selected="selected" @endif value="Ethiopia">Ethiopia</option>
                                        <option @if (old('country') == 'Falkland Islands (Malvinas)') selected="selected" @endif value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option @if (old('country') == 'Faroe Islands') selected="selected" @endif value="Faroe Islands">Faroe Islands</option>
                                        <option @if (old('country') == 'Fiji') selected="selected" @endif value="Fiji">Fiji</option>
                                        <option @if (old('country') == 'Finland') selected="selected" @endif value="Finland">Finland</option>
                                        <option @if (old('country') == 'France') selected="selected" @endif value="France">France</option>
                                        <option @if (old('country') == 'French Guiana') selected="selected" @endif value="French Guiana">French Guiana</option>
                                        <option @if (old('country') == 'French Polynesia') selected="selected" @endif value="French Polynesia">French Polynesia</option>
                                        <option @if (old('country') == 'French Southern Territories') selected="selected" @endif value="French Southern Territories">French Southern Territories</option>
                                        <option @if (old('country') == 'Gabon') selected="selected" @endif value="Gabon">Gabon</option>
                                        <option @if (old('country') == 'Gambia') selected="selected" @endif value="Gambia">Gambia</option>
                                        <option @if (old('country') == 'Georgia') selected="selected" @endif value="Georgia">Georgia</option>
                                        <option @if (old('country') == 'Germany') selected="selected" @endif value="Germany">Germany</option>
                                        <option @if (old('country') == 'Ghana') selected="selected" @endif value="Ghana">Ghana</option>
                                        <option @if (old('country') == 'Gibraltar') selected="selected" @endif value="Gibraltar">Gibraltar</option>
                                        <option @if (old('country') == 'Greece') selected="selected" @endif value="Greece">Greece</option>
                                        <option @if (old('country') == 'Greenland') selected="selected" @endif value="Greenland">Greenland</option>
                                        <option @if (old('country') == 'Grenada') selected="selected" @endif value="Grenada">Grenada</option>
                                        <option @if (old('country') == 'Guadeloupe') selected="selected" @endif value="Guadeloupe">Guadeloupe</option>
                                        <option @if (old('country') == 'Guam') selected="selected" @endif value="Guam">Guam</option>
                                        <option @if (old('country') == 'Guatemala') selected="selected" @endif value="Guatemala">Guatemala</option>
                                        <option @if (old('country') == 'Guernsey') selected="selected" @endif value="Guernsey">Guernsey</option>
                                        <option @if (old('country') == 'Guinea') selected="selected" @endif value="Guinea">Guinea</option>
                                        <option @if (old('country') == 'Guinea-bissau') selected="selected" @endif value="Guinea-bissau">Guinea-bissau</option>
                                        <option @if (old('country') == 'Guyana') selected="selected" @endif value="Guyana">Guyana</option>
                                        <option @if (old('country') == 'Haiti') selected="selected" @endif value="Haiti">Haiti</option>
                                        <option @if (old('country') == 'Heard Island and Mcdonald Islands') selected="selected" @endif value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option @if (old('country') == 'Holy See (Vatican City State)') selected="selected" @endif value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option @if (old('country') == 'Honduras') selected="selected" @endif value="Honduras">Honduras</option>
                                        <option @if (old('country') == 'Hong Kong') selected="selected" @endif value="Hong Kong">Hong Kong</option>
                                        <option @if (old('country') == 'Hungary') selected="selected" @endif value="Hungary">Hungary</option>
                                        <option @if (old('country') == 'Iceland') selected="selected" @endif value="Iceland">Iceland</option>
                                        <option @if (old('country') == 'India') selected="selected" @endif value="India">India</option>
                                        <option @if (old('country') == 'Indonesia') selected="selected" @endif value="Indonesia">Indonesia</option>
                                        <option @if (old('country') == 'Iran, Islamic Republic of') selected="selected" @endif value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option @if (old('country') == 'Iraq') selected="selected" @endif value="Iraq">Iraq</option>
                                        <option @if (old('country') == 'Ireland') selected="selected" @endif value="Ireland">Ireland</option>
                                        <option @if (old('country') == 'Isle of Man') selected="selected" @endif value="Isle of Man">Isle of Man</option>
                                        <option @if (old('country') == 'Israel') selected="selected" @endif value="Israel">Israel</option>
                                        <option @if (old('country') == 'Italy') selected="selected" @endif value="Italy">Italy</option>
                                        <option @if (old('country') == 'Jamaica') selected="selected" @endif value="Jamaica">Jamaica</option>
                                        <option @if (old('country') == 'Japan') selected="selected" @endif value="Japan">Japan</option>
                                        <option @if (old('country') == 'Jersey') selected="selected" @endif value="Jersey">Jersey</option>
                                        <option @if (old('country') == 'Jordan') selected="selected" @endif value="Jordan">Jordan</option>
                                        <option @if (old('country') == 'Kazakhstan') selected="selected" @endif value="Kazakhstan">Kazakhstan</option>
                                        <option @if (old('country') == 'Kenya') selected="selected" @endif value="Kenya">Kenya</option>
                                        <option @if (old('country') == 'Kiribati') selected="selected" @endif value="Kiribati">Kiribati</option>
                                        <option @if (old('country') == "Korea, Democratic People's Republic of") selected="selected" @endif value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option @if (old('country') == 'Korea, Republic of') selected="selected" @endif value="Korea, Republic of">Korea, Republic of</option>
                                        <option @if (old('country') == 'Kuwait') selected="selected" @endif value="Kuwait">Kuwait</option>
                                        <option @if (old('country') == 'Kyrgyzstan') selected="selected" @endif value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option @if (old('country') == "Lao People's Democratic Republic") selected="selected" @endif value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option @if (old('country') == 'Latvia') selected="selected" @endif value="Latvia">Latvia</option>
                                        <option @if (old('country') == 'Lebanon') selected="selected" @endif value="Lebanon">Lebanon</option>
                                        <option @if (old('country') == 'Lesotho') selected="selected" @endif value="Lesotho">Lesotho</option>
                                        <option @if (old('country') == 'Liberia') selected="selected" @endif value="Liberia">Liberia</option>
                                        <option @if (old('country') == 'Libyan Arab Jamahiriya') selected="selected" @endif value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option @if (old('country') == 'Liechtenstein') selected="selected" @endif value="Liechtenstein">Liechtenstein</option>
                                        <option @if (old('country') == 'Lithuania') selected="selected" @endif value="Lithuania">Lithuania</option>
                                        <option @if (old('country') == 'Luxembourg') selected="selected" @endif value="Luxembourg">Luxembourg</option>
                                        <option @if (old('country') == 'Macao') selected="selected" @endif value="Macao">Macao</option>
                                        <option @if (old('country') == 'Macedonia, The Former Yugoslav Republic of') selected="selected" @endif value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                        <option @if (old('country') == 'Madagascar') selected="selected" @endif value="Madagascar">Madagascar</option>
                                        <option @if (old('country') == 'Malawi') selected="selected" @endif value="Malawi">Malawi</option>
                                        <option @if (old('country') == 'Malaysia') selected="selected" @endif value="Malaysia">Malaysia</option>
                                        <option @if (old('country') == 'Maldives') selected="selected" @endif value="Maldives">Maldives</option>
                                        <option @if (old('country') == 'Mali') selected="selected" @endif value="Mali">Mali</option>
                                        <option @if (old('country') == 'Malta') selected="selected" @endif value="Malta">Malta</option>
                                        <option @if (old('country') == 'Marshall Islands') selected="selected" @endif value="Marshall Islands">Marshall Islands</option>
                                        <option @if (old('country') == 'Martinique') selected="selected" @endif value="Martinique">Martinique</option>
                                        <option @if (old('country') == 'Mauritania') selected="selected" @endif value="Mauritania">Mauritania</option>
                                        <option @if (old('country') == 'Mauritius') selected="selected" @endif value="Mauritius">Mauritius</option>
                                        <option @if (old('country') == 'Mayotte') selected="selected" @endif value="Mayotte">Mayotte</option>
                                        <option @if (old('country') == 'Mexico') selected="selected" @endif value="Mexico">Mexico</option>
                                        <option @if (old('country') == 'Micronesia, Federated States of') selected="selected" @endif value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option @if (old('country') == 'Moldova, Republic of') selected="selected" @endif value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option @if (old('country') == 'Monaco') selected="selected" @endif value="Monaco">Monaco</option>
                                        <option @if (old('country') == 'Mongolia') selected="selected" @endif value="Mongolia">Mongolia</option>
                                        <option @if (old('country') == 'Montenegro') selected="selected" @endif value="Montenegro">Montenegro</option>
                                        <option @if (old('country') == 'Montserrat') selected="selected" @endif value="Montserrat">Montserrat</option>
                                        <option @if (old('country') == 'Morocco') selected="selected" @endif value="Morocco">Morocco</option>
                                        <option @if (old('country') == 'Mozambique') selected="selected" @endif value="Mozambique">Mozambique</option>
                                        <option @if (old('country') == 'Myanmar') selected="selected" @endif value="Myanmar">Myanmar</option>
                                        <option @if (old('country') == 'Namibia') selected="selected" @endif value="Namibia">Namibia</option>
                                        <option @if (old('country') == 'Nauru') selected="selected" @endif value="Nauru">Nauru</option>
                                        <option @if (old('country') == 'Nepal') selected="selected" @endif value="Nepal">Nepal</option>
                                        <option @if (old('country') == 'Netherlands') selected="selected" @endif value="Netherlands">Netherlands</option>
                                        <option @if (old('country') == 'Netherlands Antilles') selected="selected" @endif value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option @if (old('country') == 'New Caledonia') selected="selected" @endif value="New Caledonia">New Caledonia</option>
                                        <option @if (old('country') == 'New Zealand') selected="selected" @endif value="New Zealand">New Zealand</option>
                                        <option @if (old('country') == 'Nicaragua') selected="selected" @endif value="Nicaragua">Nicaragua</option>
                                        <option @if (old('country') == 'Niger') selected="selected" @endif value="Niger">Niger</option>
                                        <option @if (old('country') == 'Nigeria') selected="selected" @endif value="Nigeria">Nigeria</option>
                                        <option @if (old('country') == 'Niue') selected="selected" @endif value="Niue">Niue</option>
                                        <option @if (old('country') == 'Norfolk Island') selected="selected" @endif value="Norfolk Island">Norfolk Island</option>
                                        <option @if (old('country') == 'Northern Mariana Islands') selected="selected" @endif value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option @if (old('country') == 'Norway') selected="selected" @endif value="Norway">Norway</option>
                                        <option @if (old('country') == 'Oman') selected="selected" @endif value="Oman">Oman</option>
                                        <option @if (old('country') == 'Pakistan') selected="selected" @endif value="Pakistan">Pakistan</option>
                                        <option @if (old('country') == 'Palau') selected="selected" @endif value="Palau">Palau</option>
                                        <option @if (old('country') == 'Palestinian Territory, Occupied') selected="selected" @endif value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option @if (old('country') == 'Panama') selected="selected" @endif value="Panama">Panama</option>
                                        <option @if (old('country') == 'Papua New Guinea') selected="selected" @endif value="Papua New Guinea">Papua New Guinea</option>
                                        <option @if (old('country') == 'Paraguay') selected="selected" @endif value="Paraguay">Paraguay</option>
                                        <option @if (old('country') == 'Peru') selected="selected" @endif value="Peru">Peru</option>
                                        <option @if (old('country') == 'Philippines') selected="selected" @endif value="Philippines">Philippines</option>
                                        <option @if (old('country') == 'Pitcairn') selected="selected" @endif value="Pitcairn">Pitcairn</option>
                                        <option @if (old('country') == 'Poland') selected="selected" @endif value="Poland">Poland</option>
                                        <option @if (old('country') == 'Portugal') selected="selected" @endif value="Portugal">Portugal</option>
                                        <option @if (old('country') == 'Puerto Rico') selected="selected" @endif value="Puerto Rico">Puerto Rico</option>
                                        <option @if (old('country') == 'Qatar') selected="selected" @endif value="Qatar">Qatar</option>
                                        <option @if (old('country') == 'Reunion') selected="selected" @endif value="Reunion">Reunion</option>
                                        <option @if (old('country') == 'Romania') selected="selected" @endif value="Romania">Romania</option>
                                        <option @if (old('country') == 'Russian Federation') selected="selected" @endif value="Russian Federation">Russian Federation</option>
                                        <option @if (old('country') == 'Rwanda') selected="selected" @endif value="Rwanda">Rwanda</option>
                                        <option @if (old('country') == 'Saint Helena') selected="selected" @endif value="Saint Helena">Saint Helena</option>
                                        <option @if (old('country') == 'Saint Kitts and Nevis') selected="selected" @endif value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option @if (old('country') == 'Saint Lucia') selected="selected" @endif value="Saint Lucia">Saint Lucia</option>
                                        <option @if (old('country') == 'Saint Pierre and Miquelon') selected="selected" @endif value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option @if (old('country') == 'Saint Vincent and The Grenadines') selected="selected" @endif value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option @if (old('country') == 'Samoa') selected="selected" @endif value="Samoa">Samoa</option>
                                        <option @if (old('country') == 'San Marino') selected="selected" @endif value="San Marino">San Marino</option>
                                        <option @if (old('country') == 'Sao Tome and Principe') selected="selected" @endif value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option @if (old('country') == 'Saudi Arabia') selected="selected" @endif value="Saudi Arabia">Saudi Arabia</option>
                                        <option @if (old('country') == 'Senegal') selected="selected" @endif value="Senegal">Senegal</option>
                                        <option @if (old('country') == 'Serbia') selected="selected" @endif value="Serbia">Serbia</option>
                                        <option @if (old('country') == 'Seychelles') selected="selected" @endif value="Seychelles">Seychelles</option>
                                        <option @if (old('country') == 'Sierra Leone') selected="selected" @endif value="Sierra Leone">Sierra Leone</option>
                                        <option @if (old('country') == 'Singapore') selected="selected" @endif value="Singapore">Singapore</option>
                                        <option @if (old('country') == 'Slovakia') selected="selected" @endif value="Slovakia">Slovakia</option>
                                        <option @if (old('country') == 'Slovenia') selected="selected" @endif value="Slovenia">Slovenia</option>
                                        <option @if (old('country') == 'Solomon Islands') selected="selected" @endif value="Solomon Islands">Solomon Islands</option>
                                        <option @if (old('country') == 'Somalia') selected="selected" @endif value="Somalia">Somalia</option>
                                        <option @if (old('country') == 'South Africa') selected="selected" @endif value="South Africa">South Africa</option>
                                        <option @if (old('country') == 'South Georgia and The South Sandwich Islands') selected="selected" @endif value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                        <option @if (old('country') == 'Spain') selected="selected" @endif value="Spain">Spain</option>
                                        <option @if (old('country') == 'Sri Lanka') selected="selected" @endif value="Sri Lanka">Sri Lanka</option>
                                        <option @if (old('country') == 'Sudan') selected="selected" @endif value="Sudan">Sudan</option>
                                        <option @if (old('country') == 'Suriname') selected="selected" @endif value="Suriname">Suriname</option>
                                        <option @if (old('country') == 'Svalbard and Jan Mayen') selected="selected" @endif value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option @if (old('country') == 'Swaziland') selected="selected" @endif value="Swaziland">Swaziland</option>
                                        <option @if (old('country') == 'Sweden') selected="selected" @endif value="Sweden">Sweden</option>
                                        <option @if (old('country') == 'Switzerland') selected="selected" @endif value="Switzerland">Switzerland</option>
                                        <option @if (old('country') == 'Syrian Arab Republic') selected="selected" @endif value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option @if (old('country') == 'Taiwan, Province of China') selected="selected" @endif value="Taiwan, Province of China">Taiwan, Province of China</option>
                                        <option @if (old('country') == 'Tajikistan') selected="selected" @endif value="Tajikistan">Tajikistan</option>
                                        <option @if (old('country') == 'Tanzania, United Republic of') selected="selected" @endif value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option @if (old('country') == 'Thailand') selected="selected" @endif value="Thailand">Thailand</option>
                                        <option @if (old('country') == 'Timor-leste') selected="selected" @endif value="Timor-leste">Timor-leste</option>
                                        <option @if (old('country') == 'Togo') selected="selected" @endif value="Togo">Togo</option>
                                        <option @if (old('country') == 'Tokelau') selected="selected" @endif value="Tokelau">Tokelau</option>
                                        <option @if (old('country') == 'Tonga') selected="selected" @endif value="Tonga">Tonga</option>
                                        <option @if (old('country') == 'Trinidad and Tobago') selected="selected" @endif value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option @if (old('country') == 'Tunisia') selected="selected" @endif value="Tunisia">Tunisia</option>
                                        <option @if (old('country') == 'Turkey') selected="selected" @endif value="Turkey">Turkey</option>
                                        <option @if (old('country') == 'Turkmenistan') selected="selected" @endif value="Turkmenistan">Turkmenistan</option>
                                        <option @if (old('country') == 'Turks and Caicos Islands') selected="selected" @endif value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option @if (old('country') == 'Tuvalu') selected="selected" @endif value="Tuvalu">Tuvalu</option>
                                        <option @if (old('country') == 'Uganda') selected="selected" @endif value="Uganda">Uganda</option>
                                        <option @if (old('country') == 'Ukraine') selected="selected" @endif value="Ukraine">Ukraine</option>
                                        <option @if (old('country') == 'United Arab Emirates') selected="selected" @endif value="United Arab Emirates">United Arab Emirates</option>
                                        <option @if (old('country') == 'United Kingdom') selected="selected" @endif value="United Kingdom">United Kingdom</option>
                                        <option @if (old('country') == 'United States') selected="selected" @endif value="United States">United States</option>
                                        <option @if (old('country') == 'United States Minor Outlying Islands') selected="selected" @endif value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option @if (old('country') == 'Uruguay') selected="selected" @endif value="Uruguay">Uruguay</option>
                                        <option @if (old('country') == 'Uzbekistan') selected="selected" @endif value="Uzbekistan">Uzbekistan</option>
                                        <option @if (old('country') == 'Vanuatu') selected="selected" @endif value="Vanuatu">Vanuatu</option>
                                        <option @if (old('country') == 'Venezuela') selected="selected" @endif value="Venezuela">Venezuela</option>
                                        <option @if (old('country') == 'Viet Nam') selected="selected" @endif value="Viet Nam">Viet Nam</option>
                                        <option @if (old('country') == 'Virgin Islands, British') selected="selected" @endif value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option @if (old('country') == 'Virgin Islands, U.S.') selected="selected" @endif value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option @if (old('country') == 'Wallis and Futuna') selected="selected" @endif value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option @if (old('country') == 'Western Sahara') selected="selected" @endif value="Western Sahara">Western Sahara</option>
                                        <option @if (old('country') == 'Yemen') selected="selected" @endif value="Yemen">Yemen</option>
                                        <option @if (old('country') == 'Zambia') selected="selected" @endif value="Zambia">Zambia</option>
                                        <option @if (old('country') == 'Zimbabwe') selected="selected" @endif value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                    <p class="text-danger text-left">{{ $errors->has('country') ? $errors->first('country') : ' ' }}</p>
                                </div>
                                <div class="form-group customErrorFix">
                                    <input required type="number" name="phone" id="phone" placeholder="Phone Number *" value="{{ old("phone") }}" {{ $errors->has('phone') ? 'autofocus' : ' ' }} >
                                    <p class="text-danger text-left">{{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</p>
                                </div>
                                <div class="form-group customErrorFix">
                                    <input title="If you give sponsor, Sponsor should be that user username which is the first part of the email" type="text" name="sponsorName" id="sponsorName" placeholder="Sponsorname (optional)" value="{{ old("sponsorName") }}" {{ $errors->has('sponsorName') ? 'autofocus' : ' ' }} >
                                    <p class="text-danger text-left">{{ $errors->has('sponsorName') ? $errors->first('sponsorName') : ' ' }}</p>
                                </div>
                                <div class="form-group customErrorFix">
                                    <select required id="club" name="club_id" class="form-control">
                                        <option value="">Select Club *</option>
                                        @if($clubs)
                                            @foreach($clubs as $club)
                                                <option value="{{$club->id}}" @if (old('club_id') == $club->id) selected="selected" @endif>{{ucwords($club->clubName)}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="text-danger text-left">{{ $errors->has('club_id') ? $errors->first('club_id') : ' ' }}</p>
                                </div>
                                <div class="form-group customErrorFix">
                                    <button type="submit" class="submit-btn" id="onlineUserFormSubmit">Submit</button>
                                </div>
                            </form>
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
    {{--@include('backend.partials._formvalidation_script')
    <script src="{{ asset('/validation/babel-external-helpers.js') }}"></script>
    <script src="{{ asset('/validation/onlineUserValidation.js') }}"></script>--}}
    <script type="text/javascript">
        $('#userRegistration').addClass('active');
    </script>
@endsection
