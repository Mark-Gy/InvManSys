<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<title> {{ config('app.name') }} </title>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href=" {{ asset('admin/plugins/fontawesome-free/css/all.min.css') }} ">
<!-- Theme style -->
<link rel="stylesheet" href=" {{ asset('admin/dist/css/adminlte.min.css') }} ">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<!-- DataTables -->
<link rel="stylesheet" href=" {{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
<link rel="stylesheet" href=" {{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">

<style>
  .select-container--default{
    height: 38px !important;
  }
</style>

@stack('css')