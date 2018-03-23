@section('hit')
<img src="{{ action('Mail@view', [$email->getTimestamp(), $email->id]) }}" height="1" width="1" alt="">
@endsection
