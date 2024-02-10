<x-mail::message>
# Purchase Book Notification

<p>Book Name : {{ $data['title'] }}</p>
<p>Book Price : {{ $data['price'] }}</p>
<p>Purchase date : {{ $data['purchase_date'] }}</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
