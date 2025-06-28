<html>
    <body>
        <h1>Barang</h1>
        <a href="{{ route('barang.create') }}">Tambah Barang</a>
        <table>
            <tr>
                <td>Barcode</td>
                <td>Nama</td>
                <td>Satuan</td>
                <td>&nbsp;</td>
            </tr>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->barcode }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->satuan }}</td>
                <td>
                    <a href="{{ route('barang.show', $item->id) }}">show</a>
                </td>
            </tr>
            @endforeach 
        </table>
    </body>
</html>
