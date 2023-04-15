@section('hit')
<img src="{{ action([App\Http\Controllers\MailController::class, 'view'], [$email->getTimestamp(), $email->id]) }}" height="1" width="1" alt="">
@endsection
