<!doctype html>
<!--suppress HtmlDeprecatedAttribute -->
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
</head>
<body>
  <style>
    @media only screen and (max-width: 600px) {
      .wrapper { margin: 0; }
      .inner-body { width: 100% !important; }
      .footer { width: 100% !important; }
    }

    @media only screen and (max-width: 500px) {
      .button { width: 100% !important; }
    }
  </style>

  <table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table class="content" width="100%" cellpadding="0" cellspacing="0">
          {{-- $header ?? '' --}}

          <!-- Email Body -->
          <tr>
            <td class="body" width="100%" cellpadding="0" cellspacing="0">
              <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                  <td class="content-cell">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}

                    {{ $subcopy ?? '' }}
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          {{-- $footer ?? '' --}}
        </table>
      </td>
    </tr>
  </table>
@yield('hit')
</body>
</html>
