@extends('app')
@section('content')
<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                   <thead>
                     <tr role="row">
                       <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 194px;">SiteName</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 240px;">PostID</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 167px;">Name</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 121px;">Email</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 121px;">Comment</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 121px;">Date</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 121px;">Approve</th>

                     </tr>
                   </thead>
                   <tbody>
                     @foreach($comment as $result)
                      <tr>
                        <td>
                          {{$result->sitename}}
                        </td>
                        <td>
                          {{$result->post_id}}
                        </td>
                        <td>
                          {{$result->name}}

                        </td>
                        <td>
                          {{$result->email}}
                        </td>
                        <td>
                          {{$result->comment}}
                        </td>
                        <td>
                          {{$result->created_at}}
                        </td>
                        <td>
                          <input type="checkbox" class="approve" id="{{$result->id}}">
                        </td>
                        <td>
                          <form method="post" action="{{route('delete.comment',$result->id)}}" class="delcom">
                            {{csrf_field()}}
                            <input type="submit" class="btn btn-danger" value="delete" id="commentdel">
                          </form>
                        </td>
                      <tr>
                     @endforeach
                  </tbody>
                   </table>

                   <script>



                   $(document).ready(function(){

                       showapproved();//calling the function to show states of the comments

                       $('.approve').change(function(){
                                //Changin the approve state to true
                                if($('.approve').prop('checked')==true){
                                                  var url='{!!url('/approve')!!}';
                                                  var id=$(this).attr('id');
                                                  $.ajax({
                                                                    url:url,
                                                                    type:'GET',
                                                                    data:{comid:id,chk:1},
                                                                    success:function(data)
                                                                    {
                                                                                      console.log(data);
                                                                    }


                                                  });

                                }
                                //changin the approve state to false
                                if($('.approve').prop('checked')==false){
                                                  var url='{!!url('/approve')!!}';
                                                  var id=$(this).attr('id');
                                                  $.ajax({
                                                                    url:url,
                                                                    type:'GET',
                                                                    data:{comid:id,chk:0},
                                                                    success:function(data)
                                                                    {
                                                                                      console.log(data);
                                                                    }


                                                  });
                                }
                       });

                       //onload show the stae of the comment whether approved or not
                       function showapproved()
                       {
                                         var url='{!!url('/getapprovecomments')!!}';
                                         $.ajax({

                                                           url:url,
                                                           type:'GET',
                                                           success:function(data)
                                                           {
                                                                             $.each(JSON.parse(data),function(id,obj){
                                                                                      var val=obj.id;
                                                                                      $("#"+val).prop('checked',true);
                                                                                      console.log(val);
                                                                             });
                                                           }
                                         });
                       }
                   });
                   </script>
@endsection
