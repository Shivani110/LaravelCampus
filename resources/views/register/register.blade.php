<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="">
    <!-- Page Title  -->
    <title>Registration</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('/assets/assets/css/dashlite.css?ver=3.1.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('/assets/assets/css/theme.css?ver=3.1.2') }}">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
 
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-lg d-flex justify-content-center">
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                            </div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5">
                                    <a href="html/index.html" class="logo-link">
                                        <h3 class="logo-light text-light">Campus</h3>
                                    </a>
                                </div>
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h3 class="text-center">Campus</h3>
                                    <h5 class="nk-block-title">Register</h5>
                                </div>
                            </div><!-- .nk-block-head -->
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            <form action="{{ url('signup') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="r_name">Realname</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" id="r_name" name="r_name" value="">
                                    </div>
                                    @error('r_name')
                                    {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="nick">Nickname</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" id="nick" name="nick" value="">
                                    </div>
                                    @error('nick')
                                    {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" id="email" name="email" value="">
                                    </div>
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="phone">Phone number</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" id="phone" name="phone" value="">
                                    </div>
                                   @error('phone')
                                   {{ $message }}
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="u_name">Username</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" id="u_name" name="u_name" value="">
                                    </div>
                                   @error('u_name')
                                   {{ $message }}
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="form-control-wrap">
                                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your password">
                                    </div>
                                    @error('password')
                                    {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="role">Role</label>
                                    <div class="form-control-wrap">
                                        <select id="role" name="role" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">Student</option>
                                            <option value="2">College Authority/Staff</option>
                                            <option value="3">Sponsor</option>
                                            <option value="4">Alumni</option>
                                        </select>
                                    </div>
                                   @error('role')
                                   {{ $message }}
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block">Register</button>
                                </div> 
                            </form>
                            <div class="form-note-s2 pt-4"> Already have an account ? <a href="{{ url('/') }}"><strong>Sign In </strong></a>
                            </div>
                            <div class="nk-block nk-auth-footer">
                                <div class="mt-3">
                                    <p>&copy; 2023 Campus. All Rights Reserved.</p>
                                </div>
                            </div><!-- nk-block -->
                        </div><!-- nk-split-content -->
                    </div><!-- nk-split -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('/assets/assets/js/bundle.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('/assets/assets/js/scripts.js?ver=3.1.2') }}"></script>
    <!-- select region modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="region">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="title mb-4">Select Your Country</h5>
                    <div class="nk-country-region">
                        <ul class="country-list text-center gy-2">
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/arg.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Argentina</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/aus.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Australia</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/bangladesh.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Bangladesh</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/canada.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Canada <small>(English)</small></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/china.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Centrafricaine</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/china.png') }}" alt="" class="country-flag">
                                    <span class="country-name">China</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/french.png') }}" alt="" class="country-flag">
                                    <span class="country-name">France</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/germany.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Germany</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/iran.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Iran</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/italy.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Italy</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/mexico.png') }}" alt="" class="country-flag">
                                    <span class="country-name">México</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/philipine.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Philippines</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/portugal.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Portugal</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/s-africa.png') }}" alt="" class="country-flag">
                                    <span class="country-name">South Africa</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/spanish.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Spain</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/switzerland.png') }}" alt="" class="country-flag">
                                    <span class="country-name">Switzerland</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/uk.png') }}" alt="" class="country-flag">
                                    <span class="country-name">United Kingdom</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="{{ asset('/assets/images/flags/english.png') }}" alt="" class="country-flag">
                                    <span class="country-name">United State</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .modal-content -->
        </div><!-- .modla-dialog -->
    </div><!-- .modal -->

</html>