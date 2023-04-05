@component('mail::message')
# 昨日は {{$count}} 件の呟きが追加されました！
{{$toUser->name}}さんこんにちは!
昨日は{{$count}}件の呟きが追加されましたよ!最新のつぶやきを見に行きましょう！


@component('mail::button',['url'=>route('tweet.index')])
    つぶやきを観に行く
@endcomponent

@endcomponent
