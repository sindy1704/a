<html>
    <body>
        <div>
            <h1>Create Barang<h1>
            <form method="post" action="{{route('barang.store')}}">
                @csrf
                <div>
                    <label for="barcode">Barcode</label>
                    <input type="text" name="barcode"
                        value="{{old('barcode')|| $item->barcode }}" />
                </div>
                <div>
                <label for="nama">Nama</label>
                    <input type="text" name="nama"
                        value="{{ old('nama')|| $item->nama }}" />
                </div>
                <div>
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan"
                        value="{{ old('satuan')|| $item->satuan }}" />
                </div>
                <div>
                    <input type="submit" value="Simpan" />
            </div>
        </form>
    </body>    
 </html> 