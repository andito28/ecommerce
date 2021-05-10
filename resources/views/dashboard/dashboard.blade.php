@extends('template.admin')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="col col-md-12">

        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <div class="col-xl-3 col-md-6">
              <!-- Widget Linearea One-->
              <div class="card card-shadow" id="widgetLineareaOne">
                <div class="card-block p-20 pt-10">
                  <div class="clearfix">
                    <div class="grey-800 float-left py-10">
                      <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>USER
                    </div>
                    <span class="float-right grey-700 font-size-30">1,253</span>
                  </div>
                  <div class="mb-20 grey-500">
                    Jumlah User
                  </div>
                </div>
              </div>
              <!-- End Widget Linearea One -->
            </div>
            <div class="col-xl-3 col-md-6">
              <!-- Widget Linearea Two -->
              <div class="card card-shadow" id="widgetLineareaTwo">
                <div class="card-block p-20 pt-10">
                  <div class="clearfix">
                    <div class="grey-800 float-left py-10">
                      <i class="icon md-flash grey-600 font-size-24 vertical-align-bottom mr-5"></i>PRODUCT
                    </div>
                    <span class="float-right grey-700 font-size-30">2,425</span>
                  </div>
                  <div class="mb-20 grey-500">
                    Jumlah Product
                  </div>
                </div>
              </div>
              <!-- End Widget Linearea Two -->
            </div>
            <div class="col-xl-3 col-md-6">
              <!-- Widget Linearea Three -->
              <div class="card card-shadow" id="widgetLineareaThree">
                <div class="card-block p-20 pt-10">
                  <div class="clearfix">
                    <div class="grey-800 float-left py-10">
                      <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>PESANAN
                    </div>
                    <span class="float-right grey-700 font-size-30">1,864</span>
                  </div>
                  <div class="mb-20 grey-500">
                    Jumlah Pesanan Hari ini
                  </div>
                </div>
              </div>
              <!-- End Widget Linearea Three -->
            </div>
            <div class="col-xl-3 col-md-6">
              <!-- Widget Linearea Four -->
              <div class="card card-shadow" id="widgetLineareaFour">
                <div class="card-block p-20 pt-10">
                  <div class="clearfix">
                    <div class="grey-800 float-left py-10">
                      <i class="icon md-view-list grey-600 font-size-24 vertical-align-bottom mr-5"></i>CATEGORI
                    </div>
                    <span class="float-right grey-700 font-size-30">845</span>
                  </div>
                  <div class="mb-20 grey-500">
                    Jumlah Categori
                  </div>
                </div>
              </div>
              <!-- End Widget Linearea Four -->
            </div>

            <div class="col-xl-12">
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">Table Tools</h3>
                </header>
                <div class="panel-body">
                  test
                </div>
              </div>

            </div>
          </div>

        {{-- <div class="card card-shadow">

            <div class="card-header bg-primary text-white">
                HALAMAN DASHBOARD
            </div>

            <div class="card-body">
                <p class="text">ini adalah halaman dashboard</p>
             </div>
        </div> --}}

    </div>
@endsection
