@extends('app')
@section('content')
  <!DOCTYPE html>
  <html>
    <head>

    </head>
    <body>

      <style>
        .preview-panel {
            text-align: center;
            background-color: #f5f5f5;
            margin-bottom: 30px;
            border-radius: 4px;
            border-bottom: 3px solid #eeeeee;
            position: relative;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .preview-panel .preview-panel-content {
            padding: 30px 15px;
        }
        .img-responsive {
            display: block;
            max-width: 100%;
            height: auto;
        }
        img{
          width="360";
          height="240";
        }
      </style>


      <div class="container">
        <div class="row">
          @foreach($template as $value=>$key)
          <div class="col-md-4 col-sm-6">
            <div class="preview-panel">
              <img src="{{url('/images/previews/'.$key["temp_pic"])}}" />
              <div class="preview-panel-content">
                  <h4 style="font-size:30px;">{{$key['name']}}</h4>
                  <ul style="list-style-type:none;">
                      <li>Rs :{{$key['price']}}</li>
                      <li>{{$key['description']}}.</li>
                  </ul>
                  <!-- <a href="{{url('/demo')}}" class="btn btn-primary">Preview</a> -->
                  <a href="{{route('changeTemplate.change',[$temp,$key['name'],$siteid])}}" class="btn btn-warning"  id="changetemp">Use Template</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

    </body>
  </html>
@endsection
