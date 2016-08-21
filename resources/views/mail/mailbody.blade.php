
{{--@foreach($data['name'] as $value=>$key)--}}
<h2><?php echo "Hello,". $data['name'] ?></h2>
<h3>Thank you for your e-mail.</h3>
<h3><?php echo $data['body'] ?></h3>
<h3><?php echo "Reply by : ".$data['reply_by'] ?></h3>
{{--@endforeach--}}