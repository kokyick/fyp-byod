@extends('layouts.master')

@section('content')

<!--==============================content=================================-->
<div id="content">
    <!--==============================row8=================================-->
    <div class="row_8">
        <div class="container">
                    <div class="col-lg-8 col-md-8 col-sm-8 address">
                        <h2 class="pad_bot1">Add New Card</h2>
                        <form action="{{ route('doregister')}}" id="registerform" name="registerform" class="reservation-form" method="POST">
						  {{ csrf_field() }}
                          <div class="success">Reservation form submitted! <strong>We will be in touch soon.</strong> </div>
                          <fieldset>
                            <div class="coll-1">
							  <div class="txt-form">Card holder's name<span>:</span></div>
                              <label class="email">
                                <input id="name" name="name" type="text" placeholder="Name:"><br>
                                <span class="error">*This is not a valid email address.</span> <span class="empty">*This field is required.</span> </label>
                            </div>
                            <div class="coll-2">
                              <div class="txt-form">Card Number<span>:</span></div>
                              <label class="email">
                                <input id="cardno" name="cardno" type="text" placeholder="Card Number:"><br>
                                <span class="error">*This is not a valid email address.</span> <span class="empty">*This field is required.</span> </label>
                            </div>
                            <div class="coll-3">
                              <div class="txt-form">Expiry Date:</div>
                              <label class="password">
                                <input id="expdate" name="expdate" type="text" placeholder="Expiry Date:"><br>
                                <span class="error">*This is not a valid card.</span> <span class="empty">*This field is required.</span> </label>
                            </div>
                            <div class="coll-4">
                              <div class="txt-form">CVC:</div>
                              <label class="password">
                                <input id="cvc" name="cvc" type="text" placeholder="CVC:"><br>
                                <span class="error">*This is not a valid card.</span> <span class="empty">*This field is required.</span> </label>
                            </div>
                            <div class="clear"></div>

                          </fieldset>
                          <div class="buttons-wrapper clearfix">
							<a href="#" onclick="registerform.submit();" class="btn-link btn-link2" data-type="submit">Add Card<span></span></a>
							<a href="#" class="btn-link btn-link2" data-type="reset">Clear<span></span></a>
						  </div>
                        </form>
                    </div>
                 </div> 
        </div>
    </div>
</div>
@endsection