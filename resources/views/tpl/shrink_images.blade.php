@push('js')
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

      $('.pic-container').css('width', 200);

      $('.fotorama').fotorama({
        width: 200,
        height: 150
      });
    });
  </script>
@endpush
