<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="" />
     <meta name="author" content="" />

     <!-- Title -->
     <title>Sorry, This Page Can&#39;t Be Accessed</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" />
     <style type="text/css">
          #footer{
     text-align: center;
     position: fixed;
     margin-left: 530px;
     bottom: 0px
}
     </style>
</head>

<body class="bg-dark text-white py-5">
     <div class="container py-5">
          <div class="row  text-center ">
               <div class="col-md-2">
                    
               </div>
               <div class="col-md-2 text-center">
                    <p><i class="fa fa-exclamation-triangle fa-5x "></i><br/>Status Code: 4</p>
               </div>
               <div class="col-md-3">
                    <h3>OPPSSS!!!! Sorry...</h3>
                    <p>Sorry, No Internet Connection</p>
                    <a class="btn btn-danger" href="{{route('company.index')}}">Go Back</a>
               </div>
                <div class="col-md-5">
                    
               </div>
          </div>
     </div>

     <div id="footer" class="text-center">
          <img src="{{asset('patternscrmdesign/assets/img/patternslogo.png')}}"> Patterns CRM  2019
     </div>
</body>

</html>