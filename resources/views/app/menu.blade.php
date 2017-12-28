﻿@extends('layouts.master')

@section('content')

<script type="text/javascript" src="{{ asset('js/template/jquery.isotope.min.js') }}"></script>	
<script>
    
    $(window).load(function() {  
    var $container = $('#container');
    //Run to initialise column sizes
    updateSize();

    //Load masonry when images all loaded
    $container.imagesLoaded( function(){

        $container.isotope({
            // options
            itemSelector : '.element',	
            layoutMode : 'masonry',
            transformsEnabled: true,
            columnWidth: function( containerWidth ) {
                containerWidth = $browserWidth;
                return Math.floor(containerWidth / $cols);
              }
        });
    });
    
	    // update columnWidth on window resize
    $(window).smartresize(function(){  
        updateSize();
        $container.isotope( 'reLayout' );
    });
	
    //Set item size
    function updateSize() {
        $browserWidth = $container.width();
        $cols = 4;

        if ($browserWidth >= 1170) {
            $cols = 4;
        }
        else if ($browserWidth >= 800 && $browserWidth < 1170) {
            $cols = 3;
        }
        else if ($browserWidth >= 480 && $browserWidth < 800) {
            $cols = 2;
        }
        else if ($browserWidth >= 320 && $browserWidth < 480) {
            $cols = 1;
        }
        else if ($browserWidth < 401) {
            $cols = 1;
        }
        //console.log("Browser width is:" + $browserWidth);
        //console.log("Cols is:" + $cols);

        // $gutterTotal = $cols * 20;
		$browserWidth = $browserWidth; // - $gutterTotal;
        $itemWidth = $browserWidth / $cols;
        $itemWidth = Math.floor($itemWidth);

        $(".element").each(function(index){
            $(this).css({"width":$itemWidth+"px"});             
        });
			

    
	  var $optionSets = $('#options .option-set'),
	      $optionLinks = $optionSets.find('a');

	  $optionLinks.click(function(){
	    var $this = $(this);
	    // don't proceed if already selected
	    if ( $this.hasClass('selected') ) {
	      return false;
	    }
	    var $optionSet = $this.parents('.option-set');
	    $optionSet.find('.selected').removeClass('selected');
	    $this.addClass('selected');

	    // make option object dynamically, i.e. { filter: '.my-filter-class' }
	    var options = {},
	        key = $optionSet.attr('data-option-key'),
	        value = $this.attr('data-option-value');
	    // parse 'false' as false boolean
	    value = value === 'false' ? false : value;
	    options[ key ] = value;
	    if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
	      // changes in layout modes need extra logic
	      changeLayoutMode( $this, options )
	    } else {
	      // otherwise, apply new options
	      $container.isotope( options );
	    }
	    
	    return false;
	  });		

    };

        // Initialize the gallery
        $('.thumb').touchTouch();
    
    });
    
  </script> 
<!--==============================content=================================-->
<div id="content">
    <!--==============================row8=================================-->
    <div class="row_8">
        <div class="container">
		<?php
			$postal=$OutData['postal_code'];
			$streetname=$OutData['streetname'];

			$url ="https://maps.googleapis.com/maps/api/geocode/xml?address={{$postal}}&sensor=false";
			$result = simplexml_load_file($url);
			
			//print_r($result->result->geometry->location);
		?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 gmap">
                      <div class="map"><iframe src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q={{$streetname}}&amp;aq=0&amp;sll={{$result->result->geometry->location->lat}},{{$result->result->geometry->location->lng}}&amp;sspn={{$result->result->geometry->location->lat}}{{$result->result->geometry->location->lng}}&amp;ie=UTF8&amp;hq=&amp;hnear={{$postal}}&amp;ll={{$result->result->geometry->location->lat}},{{$result->result->geometry->location->lng}}&amp;spn=0.01628,0.025663&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe></div>
                    </div>  
                 </div> 
                 <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 address">
                        <h2>Postal Address </h2>
                        <address>
                            <div class="info">
                                <p><span>Street Name:</span><strong>{{$OutData['streetname']}}</strong></p>
								<p><span>Unit no:</span><strong>{{$OutData['unit_no']}}</strong></p>
								<p><span>Postal code:</span><strong>{{$OutData['postal_code']}}</strong></p>
                            	<p><span>Telephone:</span> <strong>{{$OutData['contact_no']}}</strong></p>
                            	<p>Opening hours: </span> <strong>{{ date("H:i",strtotime($OutData['opening_time'])) }} - {{ date("H:i",strtotime($OutData['closing_time'])) }}</strong></p>
                            </div>
                        </address>
							<div class="card" style="width: 90%;">
								<div class="card-content">
									<figure><img src="{{ asset('img/smalllogo1.png') }}" alt=""></figure>
									<hr/>
									<h2 style="padding:0;">My Cart</h2>
									<hr/>
									@if(Session::get('cart'))
									<ul class="list2">
										@foreach (Session::get('cart') as $food)
											<li><a href="#filter" data-option-value=".{{ $food }}">{{ $food['itemname'] }} x{{ $food['quantity'] }}</a></li>
										@endforeach
										<hr/>
									</ul>
									@endif
								</div>
							</div>
                        <!--<address class="m_top1">
                            <div class="info">
                                <strong>9867 Mill Road, Cambridge, MG09 99HT </strong>
                            	<p><span>Telephone:</span> {{$OutData['contact_no']}}</p>
                            	<p><span>FAX:</span> +1 504 889 9898</p>
                            	<p>E-mail: <a href="mailto:#">mail@demolink.org</a></p>
                            </div>
                        </address>-->
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 address">
            <h2 class="pad_bot3"><i class="fa fa-cutlery" aria-hidden="true"></i> Menu </h2>
            <div class="row">
        		<div class="col-lg-12 col-md-12 col-sm-12">
                  <div id="options" class="clearfix">
                      <ul id="filters" class="pagination option-set clearfix" data-option-key="filter">
                        <li><a href="#filter" data-option-value="*" class="selected">All</a></li>
						@if($FoodTypeList)
							@foreach ($FoodTypeList as $FoodType)
								<li><a href="#filter" data-option-value=".{{ $FoodType['type_id'] }}">{{ $FoodType['name'] }}</a></li>
							@endforeach
						@endif
                      </ul>
                  </div><!-- #options -->
                  <div class="containerExtra">
                  <div id="container" class="clearfix">
				  @foreach ($MenuList as $Menu)
						<div class="element transition {{ $Menu['food_type_id'] }} myBtn" id="{{ route('singlemenus', $Menu['merchant_product_id']) }}" data-category="transition">
							<div class="card">
								<div class="card-content">
                                    <?php $pieces = explode(",", $Menu['name']); ?>
                    				<a href="#" class="thumb"><figure class="img-polaroid"><img class="img-thumb" src="{{ $Menu['product_image'] }}" alt=""></figure></a><span class="description">{{$Menu['name']}}</span>
									@for ($i = 0; $i <= round($Menu['avg_ratings']); $i++)
										<span>☆</span>
									@endfor
								</div>
							</div>
						</div>
				  @endforeach
		       </div>
               </div>
	        </div>
            </div>
                    </div>
                 </div> 
        </div>
    </div>
</div>

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
	  <div class="modal-tit">
      
	  </div>
    </div>
    <div class="modal-body">
        <div class="row privacy_page">
            <div class="col-lg-4 col-md-4 col-sm-4">
				<a href="#" class="thumb"><figure class="img-polaroid"><img class="img-thumb" id="modal_image" src="{{ asset('img/food_img.jpg') }}" alt=""></figure></a>
			</div>   
			<div class="col-lg-8 col-md-8 col-sm-8" style="text-align:center;">
				<figure><img src="{{ asset('img/smalllogo1.png') }}" alt=""></figure>
				<hr/>
				<div class="modal-head">
					
				</div>
				<hr/>
				<div class="modal-info">
					
				</div>
				 <div class="center">
					<p></p>
					<form action="{{ route('addcart')}}" style="float: right; margin-left: 5px;" method="POST">
						{{ csrf_field() }}
						<div class="input-group">
						  <span class="input-group-btn">
							  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="foodQuantity">
								<span class="glyphicon glyphicon-minus"></span>
							  </button>
						  </span>
						  <input id="foodQuantity" type="text" name="foodQuantity" class="form-control input-number" value="1" min="1" max="100">
						  <span class="input-group-btn">
							  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="foodQuantity">
								  <span class="glyphicon glyphicon-plus"></span>
							  </button>
						  </span>
						</div>
						<input style="display: none;" id="outletid" type="text" name="outletid" class="form-control input-number" value="{{$OutData['outlet_id']}}">
						<input style="display: none;" id="itemid" type="text" name="itemid" class="form-control input-number">
						<input style="display: none;" id="itemname" type="text" name="itemname" class="form-control input-number">
						<input style="display: none;" id="itemprice" type="text" name="itemprice" class="form-control input-number">
						<input style="display: none;" id="itemproduct_image" type="text" name="itemproduct_image" class="form-control input-number">
                        <input style="display: none;" id="itemoutlet_productid" type="text" name="itemoutlet_productid" class="form-control input-number">
						<input style="display: none;" id="itemfood_type" type="text" name="itemfood_type" class="form-control input-number">
						<input style="display: none;" id="itemmerchant_id" type="text" name="itemmerchant_id" class="form-control input-number">
						<p></p>
						<button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
					</form>
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
	$.get(food,function(data){
		var header="<h3>" + data.name + "</h3>";
		var body=data.price+" RM<br/> ";
		for (i = 0; i < Math.round(data.avg_ratings); i++) { 
			body += "<span>☆</span>";
		}
		var title = "<h2 style='color: #FFFFFF;'>"+data.name+"</h2>"
		$(".modal-info").html(body);
		$(".modal-head").html(header);
		$(".modal-tit").html(title);
		$("#modal_image").attr("src",data.product_image);
		$('#itemid').attr('value', data.merchant_product_id);
		$('#itemname').attr('value', data.name);
		$('#itemprice').attr('value', data.price);
		$('#itemproduct_image').attr('value', data.product_image);
		$('#itemfood_type').attr('value', data.food_type);
		$('#itemmerchant_id').attr('value', data.merchant_id);
        $('#itemoutlet_productid').attr('value', data.outletproduct_id)
	});
	

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