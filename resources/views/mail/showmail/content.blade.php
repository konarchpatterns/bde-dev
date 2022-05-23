<form action="{{route('mail.send',['id'=> $mailinfo->id])}}" method="get" onsubmit="return checkForm(this);">
	 @csrf
<div class="">
    <div class="row">
        <div class="col-md-7">
          <h5>Mail</h5> 
        </div>
        <div class="col-md-5"> 
            <a class="btn btn-info btn-outline rightdiv" href="javascript:history.go(-1)" title="Return to the previous page">Back</a>
        </div>
    </div>

<div class="card mt-1">
	<div class="card-body">
	<div class="row">
		<div class="col-md-6 pr-1">
			 <div class="form-group">
			 	<label><h5><b>Company/Client Name :</b></h5></label>
				<h5>{{ $mailinfo->cocliname}}</h5>
			</div>	
		</div>

		<div class="col-md-6 px-1">
			<div class="form-group">
			   <label><h5><b>To :</b></h5></label>
			   <h5>{{ $mailinfo->to}}</h5>
		    </div>
		</div>
    </div>
<div class="row">
	<div class="col-md-6 pr-1">
		 <div class="form-group">
		 	<label><h5><b>User Name :</b></h5></label>
			<h5>{{ $mailinfo->emailusername}}</h5>
		</div>	
	</div>

	<div class="col-md-6 px-1">
		<div class="form-group">
		   <label><h5><b>From :</b></h5></label>
		   <h5>{{ $mailinfo->from}}</h5>
	    </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 pr-1">
		<div class="form-group">
		  <label><h5><b>Subject :</b><h5></label>
		    <h5>{{$mailinfo->subject}}</h5>
		</div>
	
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		
		<div class="form-group">
		  <label><h5><b>Body :</b></h5></label>
		  <textarea name="body" class="form-control form-control2" id="mailtextbox"  readonly="">{{$mailinfo->body}}</textarea>
		  
		</div>

	</div>	

</div>
 </div>
</div>
</div>
</form>