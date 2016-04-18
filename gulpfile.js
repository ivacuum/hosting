process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

elixir.config.publicPath = 'public/build';
elixir.config.sourcemaps = false;
elixir.config.versioning.buildFolder = '';

elixir(function(mix) {
  mix.sass('app.scss')

      .styles([
          'bower/bootstrap/dist/css/bootstrap.css',
          'bower/bootstrap/dist/css/bootstrap-theme.css',
          'bower/nprogress/nprogress.css',
          'bower/fotorama/fotorama.css',
      ], 'public/build/css/vendor.css', './resources/assets')

      .styles([
        'bower/fancytree/dist/skin-lion/ui.fancytree.min.css'
      ], 'public/build/css/acp.css', './resources/assets')

      .browserify('app.js')

      .copy('resources/assets/bower/fotorama/*.png', 'public/build/css')
      .copy('resources/assets/bower/fancytree/dist/skin-lion/*.gif', 'public/build/css')

      .scripts([
          'bower/jquery/dist/jquery.min.js',
          'bower/bootstrap/dist/js/bootstrap.min.js',
          'bower/nprogress/nprogress.js',
          'js/fotorama.js',
          'bower/fotorama/fotorama.js',
          'bower/jquery.scrollTo/jquery.scrollTo.min.js',
          'bower/floatThead/dist/jquery.floatThead.min.js',
          'bower/jquery-pjax/jquery.pjax.js'
      ], 'public/build/js/vendor.js', './resources/assets')

      .scripts([
          'bower/jquery-ui/jquery-ui.min.js',
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
