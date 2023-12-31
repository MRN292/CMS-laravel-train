@extends('layouts.dashboard')



@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>آیکون‌ها</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">خانه</a></li>
                <li class="breadcrumb-item active">آیکون‌ها</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">آیکون‌ها</h3>
            </div> <!-- /.card-body -->
            <div class="card-body">
              <p>شما میتوانید از هر نوع فونتی که دوست دارید در AdminLTE 3 استفاده کنید.</p>
              <strong>پیشنهادات</strong>
              <div>
                <a href="https://fontawesome.com/">Font Awesome</a><br>
                <a href="https://useiconic.com/open/">Iconic Icons</a><br>
                <a href="http://ionicons.com/">Ion Icons</a><br>
              </div>
            </div><!-- /.card-body -->
          </div>
        </div><!-- /.container-fluid -->
      </section>


      
      <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>//
      <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
      <script src="{{ asset('js/demo.js') }}"></script>
      <script src="{{ asset('js/adminlte.js') }}"></script>
@endsection