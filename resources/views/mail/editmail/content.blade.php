<form action="{{route('mail.update')}}" method="post">
	 @csrf
<div class="">
    <div class="row">
        <div class="col-md-9">
          <h5>Mail</h5> 
        </div>
        <div class="col-md-3">
                    
            
            <a class="btncreate rightdiv" href="javascript:history.go(-1)" title="Return to the previous page">Back</a>
            
            <button id="goback" class="btnsave rightdiv mr-2" style="background-color: #00bfff">Update</button>
          

        </div>
    </div>

<div class="card mt-1">
	<div class="card-body">
<div class="row">
	<div class="col-md-5 pr-1">
		 <div class="form-group">
		 	<label><h5><b>Company/Client Name</b></h5></label>
			<input type="text" name="cocliname" class="form-control" value="{{$mailinfo->cocliname}}">
		</div>	
	</div>
	<div class="col-md-5 px-1">
		<div class="form-group">
		   <label><h5><b>To</b></h5></label>
		    <input type="email" name="to" class="form-control" value="{{$mailinfo->to}}"> 
	    </div>
	</div>
</div>
<div class="row">
	<div class="col-md-5 pr-1">
		 <div class="form-group">
		 	<label><h5><b>User Name</b></h5></label>
			<input type="text" name="emailusername" class="form-control" value="{{$mailinfo->emailusername}}">
			<input type="hidden" name="id" value="{{$mailinfo->id}}">
		</div>	
	</div>
	<div class="col-md-5 px-1">
		<div class="form-group">
		   <label><h5><b>From :</b></h5></label>
		    <input type="email" name="from" class="form-control" value="{{$mailinfo->from}}"> 
	    </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
		  <label><h5><b>Subject</b></h5></label>
		  <input type="text" name="subject" class="form-control" value="{{$mailinfo->subject}}">
		</div>
	
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		
		<div class="form-group">
		  <label><h5><b>Body<b></h5></label>
		  <textarea name="body" class="form-control form-control2" id="mailtextbox"  >{{$mailinfo->body}}</textarea>
		  
		</div>

	</div>	
</div>
 </div>
</div>
</div>
</form>