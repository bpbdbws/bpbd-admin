<table border="1">
    <thead>
        <th>Nama</th>
        <th colspan="3">Hobi</th>
        <th>Alamat</th>
    </thead>
    <tbody>
        @foreach ($data as $item => $key)
        <tr>
            <td> {{ $key['nama'] }}</td>
                @for ($i = 0; $i < 3; $i++)
                    <td> {{ $key['hobi'][$i] }}</td>
                @endfor
            <td>{{ $key['alamat'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<h1>Coba lagi</h1>
@foreach ($dataCoba as $item)
    @foreach ($item['kabupaten'] as $data)
            {{ $data }}
    @endforeach
@endforeach
