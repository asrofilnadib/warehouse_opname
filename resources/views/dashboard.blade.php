{{--@dd($barangKeluarMasuk)--}}
@include('template.header')
@include('template.navbar')
<div class="content-wrap">
  <div class="main">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
          <div class="page-header">
            <div class="page-title">
              <h1>Hello, {{ Auth::user()->name }} !</h1>
            </div>
          </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
          <div class="page-header">
            <div class="page-title">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Home</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /# column -->
      </div>
      <!-- /# row -->

      <div class="container-fluid">
        <div class="card-group">
          <div class="card col-5">
            <div class="card-body">
              <form action="{{ route('dashboard') }}" method="get">
                @csrf
                <div class="row">
                  <div class="col-6 px-4 py-0">
                    <h5 class="card-title-form mb-3">Tanggal Dari</h5>
                    <input type="date" id="from" class="form-control" name="from" @if(request())
                      value="{{ old('from', request()->input('from')) }}" @else
                             value="{{ old('from')  }}"
                      @endif>
                  </div>
                  <div class="col-6 px-4 py-0">
                    <h5 class="card-title-form mb-3">Tanggal Sampai</h5>
                    <input type="date" id="to" class="form-control" name="to" @if(request())
                      value="{{ old('to', request()->input('to')) }}" @else
                             value="{{ old('to')  }}"
                      @endif>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 d-flex justify-content-end mt-3">
                    <button type="submit" name="search" class="btn btn-dark"><i class="bi bi-search me-1"></i> Search
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="card ml-auto col-3">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
              <h2 class="text-dark mb-1 font-weight-medium">{{ $transaksi->count() }}</h2>
              <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate text-center">Total Transaksi Barang</h6>
            </div>
          </div>

          <div class="card col-3">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
              <h2 class="text-dark mb-1 font-weight-medium">{{ $barang->count() }}</h2>
              <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate text-center">Total Barang</h6>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start">
                <h4 class="card-title mb-0">Table Data barang</h4>
                <div class="ml-auto">
                  <div class="dropdown sub-dropdown">
                    <button class="btn btn-link text-muted dropdown-toggle" type="button"
                            id="dd1" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                      <i data-feather="more-vertical"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                      <a class="dropdown-item" href="#">Insert</a>
                      <a class="dropdown-item" href="#">Update</a>
                      <a class="dropdown-item" href="#">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
              <table id="tableBarang" class="table table-borderless datatable">
                <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Jenis Barang</th>
                  <th scope="col">Satuan</th>
                  <th scope="col">Stock</th>
                </tr>
                </thead>
                <tbody>
                @foreach($barang as $item)
                  <tr>
                    <th scope="row"><a href="#">{{ $item->id }}</a></th>
                    <td>{{ $item->nama_barang }}</td>
                    <td><a href="#" class="">{{ $item->nama_konversi }}</a></td>
                    <td>{{ $item->satuan->name }}</td>
                    <td><span class="">{{ $item->stock }}</span></td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              {{--<ul class="list-inline text-center mt-4 mb-0">
                <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
              </ul>--}}
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Barang Keluar dan Masuk</h4>
              <div id="barangChart" class="mt-2" style="height:283px; width:100%;"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  const data = JSON.parse(`<?php echo $barangKeluarMasuk ?>`)
                  // console.log(data)
                  new ApexCharts(document.querySelector("#barangChart"), {
                    series: [
                      data.data[0],
                      data.data[1]
                    ],
                    chart: {
                      width: 320,
                      type: 'pie',
                      toolbar: {
                        show: true
                      }
                    },
                    legend: {
                      show: true,
                      position: 'top',
                    },
                    colors: ['#FF204E', '#008DDA'],
                    responsive: [{
                      breakpoint: 500,
                      options: {
                        chart: {
                          width: 210
                        },
                        legend: {
                          position: 'bottom'
                        }
                      }
                    }],
                    labels: [
                      data.label[0],
                      data.label[1],
                    ]
                  }).render();
                });
              </script>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@extends('template.footer')
