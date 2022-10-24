@component('mail::message')
# Introduction

Pesan ini akan diterima oleh ridwan maulana saat package-nya berhasil di tes oleh tim avana
{{$message}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
