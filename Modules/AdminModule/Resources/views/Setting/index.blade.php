@extends('admin.adminLayout')
@section('content')
<section id="layout">
  <div class="box box-solid" style="max-width: 300px;">
    <div class="box-body no-padding">
      <table id="layout-skins-list" class="table table-striped bring-up nth-2-center">
        <thead>
          <tr>
            <th style="width: 210px;">Skin Class</th>
            <th>Preview</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><code>skin-blue</code></td>
            <td><a href="#" data-skin="skin-blue" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-blue-light</code></td>
            <td><a href="#" data-skin="skin-blue-light" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-yellow</code></td>
            <td><a href="#" data-skin="skin-yellow" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-yellow-light</code></td>
            <td><a href="#" data-skin="skin-yellow-light" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-green</code></td>
            <td><a href="#" data-skin="skin-green" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-green-light</code></td>
            <td><a href="#" data-skin="skin-green-light" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-purple</code></td>
            <td><a href="#" data-skin="skin-purple" class="btn bg-purple btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-purple-light</code></td>
            <td><a href="#" data-skin="skin-purple-light" class="btn bg-purple btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-red</code></td>
            <td><a href="#" data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-red-light</code></td>
            <td><a href="#" data-skin="skin-red-light" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-black</code></td>
            <td><a href="#" data-skin="skin-black" class="btn bg-black btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
          <tr>
            <td><code>skin-black-light</code></td>
            <td><a href="#" data-skin="skin-black-light" class="btn bg-black btn-xs"><i class="fa fa-eye"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</section>
@endsection
@section('javascript')
@endsection