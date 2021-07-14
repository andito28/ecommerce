<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan penjualan</title>
    <style>
        body{
            font-size: 20px;
        }
    </style>
</head>
<body>

    <center>
    <table border="1" cellspacing="0" cellpadding="5" width="700px">
            <tr>
                <th>Tgl Transaksi</th>
                <th>Nama Produk</th>
                <th>qty</th>
                <th>Jumlah</th>
            </tr>

            @php
                $total = 0;
            @endphp

                @foreach($data as $detail)
                @foreach($detail->Order_detail as $data_detail)
                <tr>

                    <td>
                        {{date('d F Y',strtotime($detail->updated_at))}}
                    </td>

                    <td>
                        {{$data_detail->Product->name}}
                    </td>

                    <td>
                        {{$data_detail->qty}}
                    </td>

                    <td>
                        Rp. {{number_format($data_detail->Product->price * $data_detail->qty)}}
                    </td>
                </tr>


                @php
                $total += $data_detail->Product->price * $data_detail->qty;
                @endphp

                @endforeach
                @endforeach

                <tr>
                    <td colspan="2" align="center">Total</td>
                    <td colspan="2" align="center"><b> Rp. {{number_format($total)}}</b></td>
                </tr>

    </table>
</center>

<script>
    window.print();
</script>
</body>
</html>
