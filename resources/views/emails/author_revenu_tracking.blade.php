<x-mail::message>
# Author Revenue

<p>Current Month Revenue :{{ $data['currentMonthRevenue'] }}</p>

<p>Current Year Revenue :{{ $data['currentYearRevenue'] }}</p>

<p>Total Revenue :{{ $data['totalRevenue'] }}</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
