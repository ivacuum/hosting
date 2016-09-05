process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

elixir.config.publicPath = 'public/build';
elixir.config.sourcemaps = false;
elixir.config.versioning.buildFolder = '';

/*
elixir.config.js.browserify.transformers.push({
  name: 'vueify',

  options: {}
});
*/

elixir(function(mix) {
  mix.sass('app.scss')

    .styles([
      'bower/nprogress/nprogress.css',
      'bower/fotorama/fotorama.css'
    ], 'public/build/css/vendor.css', './resources/assets')

    .styles([
      'bower/fancytree/dist/skin-lion/ui.fancytree.min.css'
    ], 'public/build/css/acp.css', './resources/assets')

    .webpack('app.js')

    .copy('resources/assets/bower/fotorama/*.png', 'public/build/css')
    .copy('resources/assets/bower/fancytree/dist/skin-lion/*.gif', 'public/build/css')

    .scripts([
      'bower/autosize/dist/autosize.min.js',
      'bower/jquery/dist/jquery.min.js',
      'bower/bootstrap-sass/assets/javascripts/bootstrap/transition.js',
      'bower/bootstrap-sass/assets/javascripts/bootstrap/alert.js',
      'bower/bootstrap-sass/assets/javascripts/bootstrap/collapse.js',
      'bower/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js',
      'bower/bootstrap-sass/assets/javascripts/bootstrap/modal.js',
      'bower/bootstrap-sass/assets/javascripts/bootstrap/tooltip.js',
      'bower/bootstrap-sass/assets/javascripts/bootstrap/affix.js',
      'bower/nprogress/nprogress.js',
      'js/fotorama-settings.js',
      'bower/fotorama/fotorama.js',
      'bower/jquery.scrollTo/jquery.scrollTo.min.js',
      'bower/floatThead/dist/jquery.floatThead.min.js',
      'bower/jquery-pjax/jquery.pjax.js'
    ], 'public/build/js/vendor.js', './resources/assets')

    .scripts([
      'bower/jquery-ui/ui/minified/core.js',
      'bower/jquery-ui/ui/minified/widget.js',
      'bower/jquery-ui/ui/widgets/mouse.js',
      'bower/jquery-ui/ui/minified/position.js',
      'bower/jquery-ui/ui/widgets/selectable.js',
      'bower/jquery-ui/ui/widgets/draggable.js',
      'bower/jquery-ui/ui/widgets/droppable.js',
      'bower/jquery-ui/ui/widgets/sortable.js',
      'bower/fancytree/dist/jquery.fancytree-all.min.js'
    ], 'public/build/js/acp.js', './resources/assets');

  if (elixir.config.production) {
    mix.version([
      'css/acp.css',
      'css/app.css',
      'css/vendor.css',
      'js/acp.js',
      'js/app.js',
      'js/vendor.js'
    ]);
  }
});
