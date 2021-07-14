@extends('template.admin')

@section('title')
    Dashboard | Laporan penjualan
@endsection


@section('content')
<div class="col col-md-12">
    <div class="card card-shadow">

        <div class="card-header">
            Laporan Penjualan
        </div>
        <div class="card-body">

            <div class="col col-md-12">
                <form action="{{route('filterTgl')}}" method="POST">
                    @csrf
                    <div class="table-responsive">
                    <table>
                        <tr>
                            <td><div class="form-group">
                                <label for="exampleInputEmail1"></label>
                                <input type="date" class="form-control" name="tgl1" value="{{old('tgl1')}}" aria-describedby="emailHelp">
                              </div></td>
                            <td><div class="form-group">
                                <label for="exampleInputEmail1"></label>
                                <input type="date" class="form-control" name="tgl2" value="{{old('tgl2')}}" aria-describedby="emailHelp">
                              </div></td>
                            <td><button type="submit" class="btn btn-primary btn-sm">tampilkan</button></td>
                        </tr>
                    </table>
                </div>
                  </form>
            </div>


            <div class="col col-md-12">
                  <div class="table-responsive">

                    {{-- <table class="table table-bordered" id="table-laporan">
                        <thead>
                            <tr>
                                <th>Tgl Transaksi</th>
                                <th>Nama Produk</th>
                                <th>qty</th>
                                <th>Jumlah</th>
                            </tr>
                            </thead>
                    </table> --}}

                    <table class="table table-bordered" id="table-laporan">

                        <thead>
                        <tr>
                            <th style="font-weight:bold;">No</th>
                            <th style="font-weight:bold;">Tgl Transaksi</th>
                            <th style="font-weight:bold;">Nama Produk</th>
                            <th style="font-weight:bold;">qty</th>
                            <th style="font-weight:bold;">Jumlah</th>
                        </tr>
                        </thead>

                        @php
                            $no = 1;
                            $total = 0;
                        @endphp

                        @foreach($data as $detail)
                        @foreach($detail->Order_detail as $data_detail)
                        <tr>

                            <td>
                                {{$no}}
                            </td>
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
                        $no++;
                        $total += $data_detail->Product->price * $data_detail->qty;
                        @endphp

                        @endforeach
                        @endforeach

                        <tfoot>
                            <tr>
                              <th colspan="4" align="center">Total :</th>
                              <th>Rp. {{number_format($total)}}</th>
                            </tr>
                          </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    //   $(function(){
    //                 $('#table-laporan').DataTable({
    //                     processing: true,
    //                     serverSide: true,
    //                     responsive: true,
    //                     "searching": false,
    //                     "paging":   false,
    //                     "ordering": false,
    //                     "info":     false,
    //                     ajax: "{{route('laporanPenjualan')}}",
    //                     columns : [
    //                         {data : 'id', name : 'id'},
    //                     ]
    //                 });
    //             });

    $(document).ready(function() {
    $('#table-laporan').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf','print'
        ]
    } );
} );
</script>
@endsection

