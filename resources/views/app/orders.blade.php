@extends('layouts.master')

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
                    @if($COrderList!=null)
                    @foreach ($COrderList as $cfood)
                    <div class="card" style="width: 30%;">
                           <div class="card-content" style="width:auto;">
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
                                 <li>({{$cfoods['restaurant_food_id']}}) {{ $cfoods['name'] }} x {{ $cfoods['quantity'] }}</li>
                             </ul>
                             @endforeach

                              <h3 class="myBtn" id="{{ $cfood[0]['order_id'] }}"><i style="color: #81C784;" class="fa fa-plus" aria-hidden="true"></i> Add more dishes</h3>
                             <hr/>
                             <h3>{{ $cfood[0]['order_bill'] }} RM</h3>
                             <hr/>
                         </div>
                     </div>
                   @endforeach
                   @endif
             </div>
         </div>

</div>
            <div class="row">
                <h2 class="pad_bot2">My Past Orders</h2>
                <div class="row links">
                    <div class="col-lg-6 col-md-6 col-sm-6" style="width:100%;">
                    @if($COrderList!=null)
                    @foreach ($OrderList as $food)
                    <div class="card" style="width: 30%;">
                           <div class="card-content" style="width:auto;">
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
                                 <li>({{$foods['restaurant_food_id']}}) {{ $foods['name'] }} x {{ $foods['quantity'] }}</li>
                             </ul>
                             @endforeach

                              <h3 class="myBtn" id="{{ $food[0]['order_id'] }}"><i style="color: #81C784;" class="fa fa-plus" aria-hidden="true"></i> Add more dishes</h3>
                             <hr/>
                             <h3>{{ $food[0]['order_bill'] }} RM</h3>
                             <hr/>
                         </div>
                     </div>
                   @endforeach
                   @endif
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

  <!-- Add Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
    <div class="modal-tit">
    <h2 style="color: #FFFFFF;">Add new dish to restaurant</h2>
    </div>
    </div>
    <div class="modal-body">
        <div class="row privacy_page">   
      <div style="text-align:center;">
        <figure><img src="{{ asset('img/smalllogo1.png') }}" alt=""></figure>
        <hr/>
        <div class="modal-info">
          
              <div class="input-group" style="width:100%;">
                <h3>Select dish</h3>
                <div class="table-responsive">     
          <table id="table" style="height: auto;" class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Add To Order</th>
              </tr>
            </thead>
            <tbody>
               @foreach ($DishList as $Dish)
              <tr class="vieworders">
                <td>
                  {{ $Dish['merchant_product_id'] }}
                </td>
                <td>
                    <a href="#" class="thumb"><figure class="img-polaroid"><img class="img-thumb" src="{{ $Dish['product_image'] }}" alt=""></figure></a>
                </td>
                <td>
                    {{ $Dish['name'] }}
                </td>
                <td>
                  <form action="{{ route('dodishadd')}}" method="POST">
                    {{ csrf_field() }}
                     <input style="display: block;" placeholder="Quantity" id="quant" type="number" name="quant" class="form-control">
                     <textarea style="display: block;" rows="3" placeholder="Remarks" id="rmk" type="text" name="rmk" class="form-control"></textarea> 
                     <input style="display: none;" id="orderid" type="text" name="orderid" class="order_id ord form-control input-number">
                     <input style="display: none;" id="dishid" type="text" name="dishid" value="{{ $Dish['outletproduct_id'] }}" class="ord form-control input-number">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Order</button>
                  </form>
                </td>
              </tr>
             @endforeach
          </tbody>
        </table>
        </div>

              </div>
          
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


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
$('.myBtn').click(function(){
  var food = $(this).attr('id');
  $('.order_id').attr('value', food);
  // $.get(food,function(data){
  //   var header="<h3>" + data.name + "</h3>";
  //   var body=data.price+" RM<br/> ";
  //   for (i = 0; i < Math.round(data.avg_ratings); i++) { 
  //     body += "<span>☆</span>";
  //   }
  //   var title = "<h2 style='color: #FFFFFF;'>"+data.name+"</h2>"
  //   $(".modal-info").html(body);
  //   $(".modal-head").html(header);
  //   $(".modal-tit").html(title);
  //   $("#modal_image").attr("src",data.product_image);
  //   $('#itemid').attr('value', data.merchant_product_id);
  //   $('#itemname').attr('value', data.name);
  //   $('#itemprice').attr('value', data.price);
  //   $('#itemproduct_image').attr('value', data.product_image);
  //   $('#itemfood_type').attr('value', data.food_type);
  //   $('#itemmerchant_id').attr('value', data.merchant_id);
  //       $('#itemoutlet_productid').attr('value', data.outletproduct_id)
  // });
  

  modal.style.display = "block";
});

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



@endsection