<form action="{{route('mail.store')}}" method="post" onsubmit="return checkForm(this);">
	 @csrf
<div class="">
    <div class="row">
        <div class="col-md-8">
          <h5>Mail</h5> 
        </div>
        <div class="col-md-4">
                    
            
            <a class="btn btn-info btn-outline rightdiv" href="javascript:history.go(-1)" title="Return to the previous page">Back</a>
            <input type="submit" name="myButton" class="btn btn-success btn-outline rightdiv mr-2" value="Send">
          

        </div>
    </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card mt-1">
	<div class="card-body">
<div class="row">
	<div class="col-md-5 pr-1">
	<label><h5><b>Company/Client Name </b></h5></label>
	   <input type="text" name="cocliname" class="form-control" value="" required="" id="companynameid">
    </div>
    <div class="col-md-5 px-1">
	   <label><h5><b>To</b></h5></label>
		  @if(isset($id))
		    <input type="email" name="to" class="form-control" value="{{$id}}" required="" readonly="">
		  @else
		    <input type="email" name="to" class="form-control" value="" required="">
		  @endif
    </div>
    <div class="col-md-2 pl-2 mt-3">
<br>
			 <a href="#" class="btn btn-success btn-outline " id="firstmail">Add</a>
    </div>
</div>		
<div class="row mt-2">
	<div class="col-md-5 pr-1">
		 <div class="form-group">
		 	<label><h5><b>User Name</b></h5></label>
		 	@role('admin|bde')
		 	    <input type="text" name="emailusername" class="form-control" value="{{ Auth::user()->name}}" required=""  id="BDEid" >
		 	@else
				<input type="text" name="emailusername" class="form-control" value="{{ Auth::user()->name}}" required="" readonly="" id="BDEid" readonly="">
			@endrole
		</div>	
	</div>
	<div class="col-md-5 px-1">														
		<div class="form-group">
		   <label><h5><b>From</b></h5></label>
		  @if('admin|bde')
		    <input type="email" name="from" class="form-control" value="hello@patterns247.com" required="">
		  @else
		     <input type="email" name="from" class="form-control" value="hello@patterns247.com" required="" readonly="">
		  @endif
	    </div>
	</div>

</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
		 		 <label><h5><b>Subject</b></h5></label>
		 		 <input type="text" name="subject" class="form-control" required="">
			</div>
	    </div>
			
	</div>
<div class="row">
	<div class="col-md-12">
		
		<div class="form-group">
	   
		  <label><h5><b>Body</b></h5></label>
		@permission('edit.email')
		  <textarea name="body" class="form-control form-control2" id="mailtextbox"  required=""></textarea>
		@else
		  <textarea name="body" class="form-control form-control2" id="mailtextbox"  required="" readonly=""></textarea>
		@endpermission   
		</div>

	</div>	
</div>
<div class="row">
	<div class="col-md-2">
	   
    </div>
</div>
 </div>
</div>
</div>
</form>