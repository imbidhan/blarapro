<script src="{{ asset('backend/js/babel-external-helpers/babel-external-helpers.js') }}"></script>

<script src="{{ asset('backend/js/jquery/jquery.js') }}"></script>

<script src="{{ asset('backend/js/popper-js/umd/popper.js') }}"></script>

<script src="{{ asset('backend/js/bootstrap/bootstrap.js') }}"></script>

<script src="{{ asset('backend/js/animsition/animsition.js') }}"></script>

<script src="{{ asset('backend/js/mousewheel/jquery.mousewheel.js') }}"></script>

<script src="{{ asset('backend/js/asscrollbar/jquery-asScrollbar.js') }}"></script>

<script src="{{ asset('backend/js/asscrollable/jquery-asScrollable.js') }}"></script>

<script src="{{ asset('backend/js/ashoverscroll/jquery-asHoverScroll.js') }}"></script>

<script src="{{ asset('backend/js/switchery/switchery.js') }}"></script>



<script src="{{ asset('backend/js/screenfull/screenfull.js') }}"></script>

<script src="{{ asset('backend/js/js/Component.js') }}"></script>

<script src="{{ asset('backend/js/js/Plugin.js') }}"></script>

<script src="{{ asset('backend/js/js/Base.js') }}"></script>

<script src="{{ asset('backend/js/js/Config.js') }}"></script>

<script src="{{ asset('backend/js/Section/Menubar.js') }}"></script>

<script src="{{ asset('backend/js/Section/GridMenu.js') }}"></script>

<script src="{{ asset('backend/js/Section/Sidebar.js') }}"></script>

<script src="{{ asset('backend/js/Section/PageAside.js') }}"></script>

<script src="{{ asset('backend/js/Plugin/menu.js') }}"></script>

<script src="{{ asset('backend/js/config/colors.js') }}"></script>

<script src="{{ asset('backend/js/config/tour.js') }}"></script>

<script src="{{ asset('backend/js/breakpoints/breakpoints.js') }}"></script>

<script src="{{ asset('backend/js/Site.js') }}"></script>

<script src="{{ asset('backend/js/Plugin/asscrollable.js') }}"></script>

<script src="{{ asset('backend/js/Plugin/slidepanel.js') }}"></script>

<script src="{{ asset('backend/js/Plugin/switchery.js') }}"></script>

<script src="{{ asset('backend/js/intro-js/intro.js') }}"></script>

<script src="{{ asset('backend/js/slidepanel/jquery-slidePanel.js') }}"></script>

<script src="{{ asset('backend/js/toastr/toastr.js') }}"></script>

    <script>
        Breakpoints();
    </script>

    <script>
        (function(document, window, $){

            'use strict';

            var Site = window.Site;
            $(document).ready(function(){
                Site.run();
            });

        })(document, window, jQuery);
    </script>

    {!! Toastr::message() !!}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}' , 'Error', {
                    closeButton:true,
                    progressBar:true,
                });
            @endforeach
        @endif
    </script>
