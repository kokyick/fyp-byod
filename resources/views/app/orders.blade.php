﻿@extends('layouts.master')

@section('content')

<!--==============================content=================================-->
<div id="content">
    <!--==============================row7=================================-->
    <div class="row_7">
        <div class="container">
            <div class="row">
                <h2 class="pad_bot2">My Current Orders</h2>
                <div class="row links">
                    <div class="col-lg-6 col-md-6 col-sm-6" style="width:100%;">

                    @foreach ($COrderList as $cfood)
                    <div class="card" style="width: 30%;">
                           <div class="card-content">
                              <figure><img src="{{ asset('img/smalllogo1.png') }}" alt=""></figure>
                              <hr/>
                              <h2 style="padding:0;">Orders #{{ $cfood[0]['order_id'] }}</h2>
                              @if($cfood[0]['order_status']==1)
                                <h3><i style="color: #81C784;" class="fa fa-circle" aria-hidden="true"></i> Completed</h3>
                              @else
                                <h3><i style="color: #FDD835;" class="fa fa-circle" aria-hidden="true"></i> Processing</h3>
                              @endif
                              <hr/>

                              @foreach ($cfood as $cfoods)
                              <ul class="list2">
                                 <li>{{ $cfoods['name'] }} x {{ $cfoods['quantity'] }}</li>
                             </ul>
                             @endforeach
                             <hr/>
                             <h3>{{ $cfood[0]['order_bill'] }} RM</h3>
                             <hr/>
                         </div>
                     </div>
                   @endforeach
             </div>
         </div>

</div>
            <div class="row">
                <h2 class="pad_bot2">My Past Orders</h2>
                <div class="row links">
                    <div class="col-lg-6 col-md-6 col-sm-6" style="width:100%;">

                    @foreach ($OrderList as $food)
                    <div class="card" style="width: 30%;">
                           <div class="card-content">
                              <figure><img src="{{ asset('img/smalllogo1.png') }}" alt=""></figure>
                              <hr/>
                              <h2 style="padding:0;">Orders #{{ $food[0]['order_id'] }}</h2>
                              @if($food[0]['order_status']==1)
                                <h3><i style="color: #81C784;" class="fa fa-circle" aria-hidden="true"></i> Completed</h3>
                              @else
                                <h3><i style="color: #FDD835;" class="fa fa-circle" aria-hidden="true"></i> Processing</h3>
                              @endif
                              <hr/>

                              @foreach ($food as $foods)
                              <ul class="list2">
                                 <li>{{ $foods['name'] }} x {{ $foods['quantity'] }}</li>
                             </ul>
                             @endforeach
                             <hr/>
                             <h3>{{ $food[0]['order_bill'] }} RM</h3>
                             <hr/>
                         </div>
                     </div>
                   @endforeach
             </div>
         </div>

</div>
</div>
</div>
</div>
<!-- DISPLAY FOOD -->
<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    border-radius: 10px;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    border-radius: 10px 10px 0px 0px;
    background-color: #EF5350;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
	border-radius: 10px;
    padding: 2px 16px;
    background-color: #EF5350;
    color: white;
}
.center{
	width: 150px;
	margin: 40px auto;
}
</style>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2 style="color: #FFFFFF;">Fish</h2>
  </div>
  <div class="modal-body">
    <div class="row privacy_page">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <a href="#" class="thumb"><figure class="img-polaroid"><img src="img/food_img.jpg" alt=""></figure></a>
        </div>   
        <div class="col-lg-8 col-md-8 col-sm-8" style="text-align:center;">
            <figure><img src="img/smalllogo1.png" alt=""></figure>
            <hr/>
            <h3>Fish</h3>
            <hr/>
            <p>This is a fish.</p>
            <div class="center">

               <p>
               </p><div class="input-group">
                <span class="input-group-btn">
                   <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                    <span class="glyphicon glyphicon-minus"></span>
                </button>
            </span>
            <input type="text" name="quant[2]" class="form-control input-number" value="1" min="1" max="100">
            <span class="input-group-btn">
               <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
      <p></p>
      <h2 style="padding:0;"><i class="fa fa-trash" aria-hidden="true"></i></h2>
  </div>
</div> 
</div> 
</div>
<div class="modal-footer">
</div>
</div>

</div>

<script>
//number
//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
 $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
             (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
             (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
             return;
         }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
//end number

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<!-- DISPLAY CARD -->
<style>
/* The Modal (background) */
.modal1 {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content1 {
    position: relative;
    border-radius: 10px;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close1 {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close1:hover,
.close1:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header1 {
    padding: 2px 16px;
    border-radius: 10px 10px 0px 0px;
    background-color: #EF5350;
    color: white;
}

.modal-body1 {padding: 2px 90px;}

.modal-footer1 {
	border-radius: 10px;
    padding: 2px 16px;
    background-color: #EF5350;
    color: white;
}
</style>

<!-- The Modal -->
<div id="myModal1" class="modal1">

  <!-- Modal content -->
  <div class="modal-content1">
    <div class="modal-header1">
      <span class="close1">&times;</span>
      <h2 style="color: #FFFFFF;">Payment</h2>
  </div>
  <div class="modal-body1">
    <div class="row privacy_page" style="padding:10px; text-align:center;">

        <figure><img src="img/smalllogo1.png" alt=""></figure>
        <hr/>
        <h3>Choose your card:</h3>
        <hr/>

        <form action="{{ route('ordercard')}}" method="POST">
            {{ csrf_field() }}
          <select id="aitemfood_type" name="aitemfood_type"  class="form-control">
              <option value="0003">XXXX-XXXX-XXXX-0003</option>
          </select>
          <hr/>
          <h3>Enter your table id:</h3>
          <hr/>
          <input type="number" class="form-control" name="tableId" id="tableId" required="true">
          <input type="text" style="display: none;" class="form-control" name="amt" id="amt" value="{{Session::get('subtotal')}}" required="true">
          <div class="center">

           <p>
           </p>
           <p></p>

           <button type="submit" class="btn btn-danger"><i class="fa fa-money" aria-hidden="true"></i> Pay now</button><br/>
           <a href="{{ route('addcard')}}" class="btn-link btn-link2">Add card<span></span></a>
       </div>
   </form>

</div> 
</div>
<div class="modal-footer1">
</div>
</div>

</div>

<script>
    var modal1 = document.getElementById('myModal1');
// Get the button that opens the modal
var btn1 = document.getElementById("myBtn1");

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close1")[0];

// When the user clicks the button, open the modal 
btn1.onclick = function() {
    modal1.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
    modal1.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}
</script>

<!-- Update table number -->
<style>
/* The Modal (background) */
.modal2 {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal2-content {
    position: relative;
    border-radius: 10px;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close2 {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close2:hover,
.close2:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal2-header {
    padding: 2px 16px;
    border-radius: 10px 10px 0px 0px;
    background-color: #EF5350;
    color: white;
}

.modal2-body {padding: 2px 90px;}

.modal2-footer {
    border-radius: 10px;
    padding: 2px 16px;
    background-color: #EF5350;
    color: white;
}
</style>

<!-- The Modal -->
<div id="myModal2" class="modal2">

  <!-- Modal content -->
  <div class="modal2-content">
    <div class="modal2-header">
      <span class="close2">&times;</span>
      <h2 style="color: #FFFFFF;">Enter table ID</h2>
  </div>
  <div class="modal2-body">
    <div class="row privacy_page" style="padding:10px; text-align:center;">

        <figure><img src="img/smalllogo1.png" alt=""></figure>
        <hr/>
        <h3>Enter your table id:</h3>
        <hr/>
        <form action="{{ route('ordercash')}}" method="POST">
            {{ csrf_field() }}
            <input type="number" class="form-control" name="table_id" id="table_id" required="true">
            <input type="text" style="display: none;" class="form-control" name="total_bill" id="total_bill" value="{{Session::get('subtotal')}}" required="true">
            <div class="center">

                <p>
                </p>
                <p></p>

                <button type="submit" class="btn btn-primary"><i class="fa fa-money" aria-hidden="true"></i> Send Order</button><br/>
                <!-- <a href="{{ route('addcard')}}" class="btn-link btn-link2">Add card<span></span></a> -->
            </div>
        </form>

    </div> 
</div>
<div class="modal2-footer">
</div>
</div>

</div>

<script>
    var modal2 = document.getElementById('myModal2');
// Get the button that opens the modal
var btn2 = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
btn2.onclick = function() {
    modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
    modal2.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}
</script>


@endsection