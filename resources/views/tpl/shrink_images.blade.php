@section('js')
  @parent
  <script>
    $(document).ready(function() {
      $('img').each(function() {
        if ($(this).hasClass('fotorama__img')) {
          return true; // skip
        }

        var height = $(this).attr('height');

        if (height > 100) {
          var width = $(this).attr('width');

          $(this).height(height / 5).width(width / 5);
        }
      });

      $('.fotorama').fotorama({
        width: 200,
        height: 150
      });
    });
  </script>
@endsection
