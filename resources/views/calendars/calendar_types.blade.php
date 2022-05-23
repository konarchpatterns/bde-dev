<!-- @extends('layouts.dashboard') -->

@section('style')


<style type="text/css">

.box {
    width:50%;
    height:400px;
    background:#FFF;
    margin:40px auto;
   
}

.box1 {
    width:60%;
    height:180px;
    /*//background:#FFF;*/
    margin:20px auto;
    padding: 40px;
    
}

/*==================================================
 * Effect 8
 * ===============================================*/
.effect8
{
    position:relative;
    -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
       -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
}
.effect8:before, .effect8:after
{
    content:"";
    position:absolute;
    z-index:-1;
    -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
    box-shadow:0 0 20px rgba(0,0,0,0.8);
    top:10px;
    bottom:10px;
    left:0;
    right:0;
    -moz-border-radius:100px / 10px;
    border-radius:100px / 10px;
}
.effect8:after
{
    right:10px;
    left:auto;
    -webkit-transform:skew(8deg) rotate(3deg);
       -moz-transform:skew(8deg) rotate(3deg);
        -ms-transform:skew(8deg) rotate(3deg);
         -o-transform:skew(8deg) rotate(3deg);
            transform:skew(8deg) rotate(3deg);
}

/*label.radio {
    padding: 10px;
}*/

.radio {
  margin: 16px 0;
  display: block;
  cursor: pointer;
}
.radio input {
  display: none;
}
.radio input + span {
  line-height: 22px;
  height: 22px;
  padding-left: 22px;
  display: block;
  position: relative;
}
.radio input + span:not(:empty) {
  padding-left: 30px;
}
.radio input + span:before, .radio input + span:after {
  content: '';
  width: 22px;
  height: 22px;
  display: block;
  border-radius: 50%;
  left: 0;
  top: 0;
  position: absolute;
}


.radio input + span:before {
  background: #D1D7E3;
  transition: background 0.2s ease, -webkit-transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 2);
  transition: background 0.2s ease, transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 2);
  transition: background 0.2s ease, transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 2), -webkit-transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 2);
}
.radio input + span:after {
  background: #fff;
  -webkit-transform: scale(0.78);
          transform: scale(0.78);
  transition: -webkit-transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.4);
  transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.4);
  transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.4), -webkit-transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.4);
}
.radio input:checked + span:before {
  -webkit-transform: scale(1.04);
          transform: scale(1.04);
  background: #5D9BFB;
}
.radio input:checked + span:after {
  -webkit-transform: scale(0.4);
          transform: scale(0.4);
  transition: -webkit-transform .3s ease;
  transition: transform .3s ease;
  transition: transform .3s ease, -webkit-transform .3s ease;
}
.radio:hover input + span:before {
  -webkit-transform: scale(0.92);
          transform: scale(0.92);
}
.radio:hover input + span:after {
  -webkit-transform: scale(0.74);
          transform: scale(0.74);
}
.radio:hover input:checked + span:after {
  -webkit-transform: scale(0.4);
          transform: scale(0.4);
}

</style>

@endsection

@section('content')
 <h3> Create </h3>

<div class="box effect8">
	
	{!! Form::open(['id' =>'target', 'method'=>'get', 'action' => 'EventController@CallMethod']) !!}

   <div class="box1">
           
            <input type="hidden" name="title"  value =" {{ $data['title'] }}" >
            <input type="hidden" name="start_date" value ="{{ $data['start_date'] }}" >
            
		<div class=" row">
			<h2>
    		<label class="radio">
	        	<input type="radio" name="scope" checked="" value="Meeting">
        		<span>Meeting</span>
    		</label>
    		</h2>
    	</div>	

    	<div class=" row">
	    	<h2>
    		<label class="radio" >
		        <input type="radio" name="scope" value="Call">
        		<span>Call</span>
    		</label>
        	</h2>

    	</div> 	

    	<div class=" row">
    		<h2>
    		<label class="radio">
		        <input type="radio" name="scope" value="Task">
        		<span>Task</span>
    		</label>
    		</h2>
		</div>
	
  	</div>
	{!! Form::close() !!}
</div>

@endsection

@section('script')  

<script type="text/javascript">
	// $('input:radio[name="scope"]').change(
 //    			function(){ 
 //        $('label').css('background', 'green');
 //    });  

 $('input:radio[name="scope"]').click(function(){ 
 	  $( "#target" ).submit();

    }); 

</script>
@endsection

