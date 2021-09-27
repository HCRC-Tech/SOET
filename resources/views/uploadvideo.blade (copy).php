<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1,   shrink-to-fit=no">
<title>Video upload</title>
</head>
<body>
<div>
<h3>Upload a video</h3>
<hr>
<form method="POST" action="{{ url('/uploadVideo') }}" enctype="multipart/form-data" >
{{ csrf_field() }}
<div >
<label>Title</label>
<input type="text" name="title" placeholder="Enter Title">
</div>
<div >
<label>Choose Video</label>
<input type="file"  name="video">
</div>
<hr>
<button type="submit" >Submit</button>
</form>
</div>
</body>
</html>