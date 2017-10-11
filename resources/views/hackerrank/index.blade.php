@extends('layouts.app')

@section('content') 
    <?php //phpinfo()?> 
      {{Form::open(['action'=>'ChallengeController@api','method'=>'post'])}}
        <h1>Juan Scarton's Cube Summation Challenge</h1>
        <fieldset>
          <legend><span class="number">1</span>Enter your input content here</legend>
          <label for="input">Input:</label>
          <textarea id="theInput" name="user_input" rows="10"></textarea>
        </fieldset>      
        <button id="runner" type="button">Run challenge</button>
        <fieldset>
          <legend><span class="number">2</span>Challenge output</legend>
          <label for="bio">Output:</label>
          <textarea id="theOutput" name="user_output" readonly="true" rows="10">run the challenge to see the output here</textarea>
        </fieldset>   
        <fieldset>
          <legend><span class="number">3</span>Get in contact!!!</legend>
          <span><i class="fa fa-lg fa-envelope"></i>&nbsp;jscarton@gmail.com</span>,
          <span><i class="fa fa-lg fa-skype"></i>&nbsp;jscarton</span>,
          <span><i class="fa fa-lg fa-phone"></i> or <i class="fa fa-lg fa-whatsapp"></i>&nbsp;+57 319.451.78.96</span>
        </fieldset>      
      {{Form::close()}}
@endsection