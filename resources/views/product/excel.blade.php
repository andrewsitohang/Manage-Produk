<table>
    <thead>
        <tr>
            <th style="background-color: #FC544B;color: #ffffff;border: 1px solid #000000;font-weight: bold;">No</th>
            <th style="background-color: #FC544B;color: #ffffff;border: 1px solid #000000;font-weight: bold;">Nama Produk</th>
            <th style="background-color: #FC544B;color: #ffffff;border: 1px solid #000000;font-weight: bold;">Kategori Produk</th>
            <th style="background-color: #FC544B;color: #ffffff;border: 1px solid #000000;font-weight: bold;">Harga Barang</th>
            <th style="background-color: #FC544B;color: #ffffff;border: 1px solid #000000;font-weight: bold;">Harga Jual</th>
            <th style="background-color: #FC544B;color: #ffffff;border: 1px solid #000000;font-weight: bold;">Stok</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td style="border: 1px solid #000000;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000000;">{{ $item->name }}</td>
                <td style="border: 1px solid #000000;">{{ $item->category->name }}</td>
                <td style="border: 1px solid #000000;">{{ number_format($item->buy,0,'.',',') }}</td>
                <td style="border: 1px solid #000000;">{{ number_format($item->sell,0,'.',',') }}</td>
                <td style="border: 1px solid #000000;">{{ $item->stock }}</td>
            </tr>
        @endforeach
    </tbody>
</table>