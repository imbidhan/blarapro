const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/backend/css/bootstrap/bootstrap.css',
    'resources/backend/css/bootstrap/bootstrap-extend.css',
    'resources/backend/css/site.css',
    'resources/backend/css/animsition/animsition.css',
    'resources/backend/css/asscrollable/asScrollable.css',
    'resources/backend/css/switchery/switchery.css',
    'resources/backend/css/intro-js/introjs.css',
    'resources/backend/css/slidepanel/slidePanel.css',
    'resources/backend/css/flag-icon-css/flag-icon.css',
    'resources/backend/css/web-icons/web-icons.css',
    'resources/backend/css/brand-icons/brand-icons.css',
    'resources/backend/css/font-awesome/font-awesome.css',
    'resources/backend/css/toastr/toastr.css'
], 'public/css/all.css').version();

mix.styles([
    'resources/backend/css/datatable/datatable.css',
    'resources/backend/css/datatable/dataTables.bootstrap4.css',
    'resources/backend/css/datatable/dataTables.buttons.bootstrap4.css',
    'resources/backend/css/datatable/dataTables.responsive.bootstrap4.css',
], 'public/css/datatable.css').version();

mix.scripts([
    'resources/backend/js/babel-external-helpers/babel-external-helpers.js',
    'resources/backend/js/jquery/jquery.js',
    'resources/backend/js/popper-js/umd/popper.js',
    'resources/backend/js/bootstrap/bootstrap.js',
    'resources/backend/js/animsition/animsition.js',
    'resources/backend/js/mousewheel/jquery.mousewheel.js',
    'resources/backend/js/asscrollbar/jquery-asScrollbar.js',
    'resources/backend/js/asscrollable/jquery-asScrollable.js',
    'resources/backend/js/ashoverscroll/jquery-asHoverScroll.js',
    'resources/backend/js/switchery/switchery.js'
], 'public/js/all.js').version();


mix.scripts([
    'resources/backend/js/datatable/jquery.dataTables.js',
    'resources/backend/js/datatable/dataTables.bootstrap4.js',
    'resources/backend/js/datatable/dataTables.responsive.js',
    'resources/backend/js/datatable/responsive.bootstrap4.js',
    'resources/backend/js/datatable/dataTables.buttons.js',
    'resources/backend/js/datatable/buttons.html5.js',
    'resources/backend/js/datatable/buttons.print.js',
    'resources/backend/js/datatable/buttons.bootstrap4.js',
    'resources/backend/js/datatable/datatables.js',
    'resources/backend/js/datatable/datatable.js',
], 'public/js/datatable.js').version();


mix.scripts([
    'resources/backend/js/screenfull/screenfull.js',
    'resources/backend/js/js/Component.js',
    'resources/backend/js/js/Plugin.js',
    'resources/backend/js/js/Base.js',
    'resources/backend/js/js/Config.js',
    'resources/backend/js/Section/Menubar.js',
    'resources/backend/js/Section/GridMenu.js',
    'resources/backend/js/Section/Sidebar.js',
    'resources/backend/js/Section/PageAside.js',
    'resources/backend/js/Plugin/menu.js',
    'resources/backend/js/config/colors.js',
    'resources/backend/js/config/tour.js',
    'resources/backend/js/breakpoints/breakpoints.js',
    'resources/backend/js/Site.js',
    'resources/backend/js/Plugin/asscrollable.js',
    'resources/backend/js/Plugin/slidepanel.js',
    'resources/backend/js/Plugin/switchery.js',
    'resources/backend/js/intro-js/intro.js',
    'resources/backend/js/slidepanel/jquery-slidePanel.js',
    'resources/backend/js/toastr/toastr.js'
], 'public/js/custom.js').version();

mix.styles([
    'resources/frontend/css/fontawesome.min.css',
    'resources/frontend/css/flaticon.css',
    'resources/frontend/css/animate.css',
    'resources/frontend/css/bootstrap.css',
    'resources/frontend/css/dataTables.bootstrap4.min.css',
    'resources/frontend/css/slick.css',
    'resources/frontend/css/lightcase.css',
    'resources/frontend/css/reset.css',
    'resources/frontend/css/global.css',
    'resources/frontend/css/nav-core.css',
    'resources/frontend/css/nav-layout.css',
    'resources/frontend/css/style.css',
    'resources/frontend/css/responsive.css',
], 'public/css/frontend.css').version();

mix.scripts([
    'resources/frontend/js/jquery-3.3.1.min.js',
    'resources/frontend/js/bootstrap.min.js',
    'resources/frontend/js/slick.min.js',
    'resources/frontend/js/lightcase.js',
    'resources/frontend/js/wow.min.js',
    'resources/frontend/js/nav.jquery.min.js',
    'resources/frontend/js/main.js',
], 'public/js/frontend.js').version();

mix.scripts([
    'resources/frontend/js/jquery-3.3.1.min.js',
    'resources/frontend/js/bootstrap.min.js',
    'resources/frontend/js/slick.min.js',
    'resources/frontend/js/lightcase.js',
    'resources/frontend/js/wow.min.js',
    'resources/frontend/js/nav.jquery.min.js',
    'resources/frontend/js/main.js',
    'resources/frontend/js/home.js',
], 'public/js/frontendhome.js').version();

mix.scripts([
    'resources/frontend/js/jquery-3.3.1.min.js',
    'resources/frontend/js/bootstrap.min.js',
    'resources/frontend/js/slick.min.js',
    'resources/frontend/js/lightcase.js',
    'resources/frontend/js/wow.min.js',
    'resources/frontend/js/nav.jquery.min.js',
    'resources/frontend/js/main.js',
    'resources/frontend/js/inplay.js',
], 'public/js/frontendinplay.js').version();

mix.scripts([
    'resources/frontend/js/jquery-3.3.1.min.js',
    'resources/frontend/js/bootstrap.min.js',
    'resources/frontend/js/slick.min.js',
    'resources/frontend/js/lightcase.js',
    'resources/frontend/js/wow.min.js',
    'resources/frontend/js/nav.jquery.min.js',
    'resources/frontend/js/main.js',
    'resources/frontend/js/advance.js',
], 'public/js/frontendadvances.js').version();



