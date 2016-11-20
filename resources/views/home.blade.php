@extends('app')
@section('pageName')
    Home
    @stop
    @section('breadcrumbs')
    {!! Breadcrumbs::render('home') !!}
    @stop


@section('content')

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Notification Category</h4>
      </div>
      <div class="modal-body">
        <select id="category">
          <option value="post">Posts</option>
          <option value="comments">Comments</option>
          <option value="templates">Templates</option>
          <option value="events">Events</option>
          <option value="gallery">Gallery</option>
          <option value="sites">Sites</option>
          <option value="orders">Orders</option>

        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="add">Add</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Notification Category</h4>
      </div>
      <div class="modal-body">
        <select id="delcategory">

          <option value="post">Posts</option>
          <option value="comments">Comments</option>
          <option value="templates">Templates</option>
          <option value="events">Events</option>
          <option value="gallery">Gallery</option>
          <option value="sites">Sites</option>
          <option value="orders">Orders</option>

        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="delete">Delete</button>
      </div>

    </div>
  </div>
</div>

<button type="button" class="btn btn-warning btn-sm" id="myBtn"><span class="glyphicon glyphicon-plus"></span></button>
<button type="button" class="btn btn-warning btn-sm" id="deletebtn"><span class="glyphicon glyphicon-trash"></span></button>

<br>
<br>
<br>

<div id="row">

</div>


<script>
$(document).ready(function(){

  getdata();

  var category;
  var content;
  var url;
  var data;

  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
  $("#deletebtn").click(function(){
      $("#delModal").modal();
  });

  $("#delete").click(function(){

      category=$("#delcategory").val();
      url='{!!url('/home/delete')!!}';
      $.ajax({
        url:url,
        type:'GET',
        data:{cat:category},
        success:function(d){
          if(d=="t")
          {
            window.location.reload();
          }
          else {

            sweetAlert("Oops...", "No entry to delete!", "error");
          }
        }
      });
  });


  $("#add").click(function(){
    category=$('#category').val();

    switch (category) {

      case 'post':
          content='<div class="col-lg-4 col-xs-7">'+
              '<div class="small-box bg-aqua">'+
                  '<div class="inner">'+
                      '<h3>{{$count['post']}}</h3>'+
                      '<p>Posts</p>'+
                  '</div>'+
                  '<div class="icon">'+
                      '<i class="fa fa-pencil-square-o" ></i>'+
                  '</div>'+
                  '<a href="{{route('post.create')}}" class="small-box-footer">'+
                      'More info <i class="fa fa-arrow-circle-right"></i>'+
                  '</a>'+
              '</div>'+
          '</div>';

          url='{!!url('/home/store')!!}';
          $.ajax({
            url:url,
            type:'GET',
            cache:false,
            data:{cat:category,con:content},
            success:function(d){
              if(d=="f")
              {
                sweetAlert("Oops...", "You have already added!", "error");
              }
              else {

                var obj=$.parseJSON(d);
                $.each(obj,function(key,val){
                $("#row").append(val.description);

            });
          }
            }
          });
        break;

      case 'comments':

      content='<div class="col-lg-4 col-xs-7">'+
          '<div class="small-box bg-lime">'+
              '<div class="inner">'+
                  '<h3>{{$count['comments']}}</h3>'+
                  '<p>Comments</p>'+
              '</div>'+
              '<div class="icon">'+
                  '<i class="fa fa-comment-o"></i>'+
              '</div>'+
              '<a href="{{route('showallcomments.show')}}" class="small-box-footer">'+
                  'More info <i class="fa fa-arrow-circle-right"></i>'+
              '</a>'+
          '</div>'+
      '</div>';

      url='{!!url('/home/store')!!}';
      $.ajax({
        url:url,
        type:'GET',
        cache:false,
        data:{cat:category,con:content},
        success:function(d){

          if(d=="f")
          {
            sweetAlert("Oops...", "You have already added!", "error");
          }
          else {
            var obj=$.parseJSON(d);
            $.each(obj,function(key,val){
            $("#row").append(val.description);

            });

          }

        }
      });
        break;

      case 'templates':

      content='<div class="col-lg-4 col-xs-7">'+
          '<div class="small-box bg-yellow">'+
              '<div class="inner">'+
                  '<h3>{{$count['templates']}}</h3>'+
                  '<p>Templates</p>'+
              '</div>'+
              '<div class="icon">'+
                  '<i class="fa fa-file-text-o"></i>'+
              '</div>'+
              '<a href="{{url('/temp_store')}}" class="small-box-footer">'+
                  'More info <i class="fa fa-arrow-circle-right"></i>'+
              '</a>'+
          '</div>'+
      '</div>';

      url='{!!url('/home/store')!!}';
      $.ajax({
        url:url,
        type:'GET',
        cache:false,
        data:{cat:category,con:content},
        success:function(d){

          if(d=="f")
          {
            sweetAlert("Oops...", "You have already added!", "error");
          }
          else {
            var obj=$.parseJSON(d);
            $.each(obj,function(key,val){
            $("#row").append(val.description);
          });
          }

        }
      });
      break;

      case 'events':

      content='<div class="col-lg-4 col-xs-7">'+
          '<div class="small-box bg-red">'+
              '<div class="inner">'+
                  '<h3>{{$count['events']}}</h3>'+
                  '<p>Events</p>'+
              '</div>'+
              '<div class="icon">'+
                  '<i class="fa fa-calendar" aria-hidden="true"></i>'+
              '</div>'+
              '<a href="#" class="small-box-footer">'+
                  'More info <i class="fa fa-arrow-circle-right"></i>'+
              '</a>'+
          '</div>'+
      '</div>';

      url='{!!url('/home/store')!!}';
      $.ajax({
        url:url,
        type:'GET',
        cache:false,
        data:{cat:category,con:content},
        success:function(d){

          if(d=="f")
          {
            sweetAlert("Oops...", "You have already added!", "error");
          }
          else {

            var obj=$.parseJSON(d);
            $.each(obj,function(key,val){
            $("#row").append(val.description);
          });
          }

        }
      });
      break;

      case 'gallery':

      content='<div class="col-lg-4 col-xs-7">'+
          '<div class="small-box bg-fuchsia">'+
              '<div class="inner">'+
                  '<h3>{{$count['galery']}}</h3>'+
                  '<p>Gallery</p>'+
              '</div>'+
              '<div class="icon">'+
                  '<i class="fa fa-file-image-o" ></i>'+
              '</div>'+
              '<a href="{{url('gallery/list')}}" class="small-box-footer">'+
                  'More info <i class="fa fa-arrow-circle-right"></i>'+
              '</a>'+
          '</div>'+
      '</div>';

      url='{!!url('/home/store')!!}';
      $.ajax({
        url:url,
        type:'GET',
        cache:false,
        data:{cat:category,con:content},
        success:function(d){

          if(d=="f")
          {
            sweetAlert("Oops...", "You have already added!", "error");
          }
          else {
            var obj=$.parseJSON(d);
            $.each(obj,function(key,val){
            $("#row").append(val.description);
          });
          }

        }
      });
      break;

      case 'sites':

      content='<div class="col-lg-4 col-xs-7">'+
          '<div class="small-box bg-aqua">'+
              '<div class="inner">'+
                  '<h3>{{$count['sites']}}</h3>'+
                  '<p>Sites</p>'+
              '</div>'+
              '<div class="icon">'+
                  '<i class="fa fa-television" aria-hidden="true"></i>'+
              '</div>'+
              '<a href="{{route('site.index')}}" class="small-box-footer">'+
                  'More info <i class="fa fa-arrow-circle-right"></i>'+
              '</a>'+
          '</div>'+
      '</div>';

      url='{!!url('/home/store')!!}';
      $.ajax({
        url:url,
        type:'GET',
        cache:false,
        data:{cat:category,con:content},
        success:function(d){

          if(d=="f")
          {
            sweetAlert("Oops...", "You have already added!", "error");
          }
          else {
            var obj=$.parseJSON(d);
            $.each(obj,function(key,val){
            $("#row").append(val.description);
          });
          }

        }
      });
      break;

      case 'orders':

      content='<div class="col-lg-4 col-xs-7">'+
          '<div class="small-box bg-green">'+
              '<div class="inner">'+
                  '<h3>{{$count['orders']}}</h3>'+
                  '<p>Orders</p>'+
              '</div>'+
              '<div class="icon">'+
                  '<i class="fa fa-shopping-cart"></i>'+
              '</div>'+
              '<a href="{{url('preorder/pending')}}" class="small-box-footer">'+
                  'More info<i class="fa fa-arrow-circle-right"></i>'+
              '</a>'+
          '</div>'+
      '</div>';

      url='{!!url('/home/store')!!}';
      $.ajax({
        url:url,
        type:'GET',
        cache:false,
        data:{cat:category,con:content},
        success:function(d){

          if(d=="f")
          {
            sweetAlert("Oops...", "You have already added!", "error");
          }
          else {
            var obj=$.parseJSON(d);
            $.each(obj,function(key,val){
            $("#row").append(val.description);
          });
          }

        }
      });
      break;


      default:

    }
  });

  function getdata()
  {
    var ur='{!!url('/home/getdata')!!}';
    $.ajax({
      url:ur,
      type:'GET',
      cache:false,
      success:function(d)
      {
        if(d=="f")
        {
          sweetAlert("Oops...", "You have already added!", "error");
        }
        else {
          var d=$.parseJSON(d);
          $.each(d,function(key,val){
          $("#row").append(val.description);
          });


        }


      }
    });
  }

});

</script>
@section('notifications')
    @include('includes.notification')
@stop
@endsection
