@component('mail::message')
# Laporan Bencana Masuk

Hello Administrator,
{{--
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Alamat</th>
            <th>Desc</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $details['title'] }}</td>
            <td>{{ $details['alamat'] }}</td>
            <td>{{ $details['deskripsi'] }}</td>
        </tr>
    </tbody>
</table> --}}
<table class="table-fixed" border="1">
    <thead>
      <tr>
        <th>Title</th>
        <th>Alamat</th>
        <th>Deskripsi</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $details['title'] }}</td>
            <td>{{ $details['alamat'] }}</td>
            <td>{{ $details['deskripsi'] }}</td>
        </tr>
    </tbody>
</table>

@component('mail::button', ['url' => 'https://bpbd.bsorumahinspirasi.com/'])
Administrator
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
