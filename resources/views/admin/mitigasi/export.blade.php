<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->kategori }}</td>
            <td>{{ isset($item->deskripsi) ? $item->deskripsi : '-' }}</td>
            <td>{{ $item->longitude }}</td>
            <td>{{ $item->latitude }}</td>
            <td>{{ $item->waktu }}</td>
        </tr>
    @endforeach
    </tbody>
</table>