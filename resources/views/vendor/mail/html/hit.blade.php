@section('hit')
<img src="{{ action([App\Http\Controllers\Mail::class, 'view'], [$email->getTimestamp(), $email->id]) }}" height="1" width="1" alt="">
@endsection
