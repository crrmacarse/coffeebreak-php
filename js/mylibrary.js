// JavaScript Document
function isWhitespace(text){
    return (text.trim().length == 0);
  }

function hasSpace(text) {
    return (text.split(' ').length > 1);
  }

  function hasvalueof(text, gg) {
    return (text.split(gg).length > 1);
  }

  function pausecomp(millis)
  {
    var date = new Date();
    var curDate = null;

    do { curDate = new Date(); }
    while(curDate-date < millis);
  }

  function pohibitClosing(id, arguu)
  {
    $('#' + id).on('hide.bs.modal', function (e) {
      return arguu;
    });
  }

  function haswrongspaces(txt) {
    var z = false;
    var x = txt.split(' ');
    var y = x.length;
    for(var i = 0; i < y; i++ )
    {
      if(x[i].length < 1)
      {
        z = true;
      }
    }
    return z;
  }

  function invalidNaming(txt) {
    return (haswrongspaces(txt) || isWhitespace(txt));
  }

  function isbelow(num, txt) {
    return txt.length < num;
  }

  function setSpaceToZero(the_input) {
    if(isWhitespace(the_input.value))
    {
      the_input.value = 0;
    }
  }

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

	var navbarHide = function() {
		"use strict";
	$( document ).ready(function() {
		 if ($("nav").offset().top > 0) {
		 	$("#mainNav").removeClass("navbarTransparent");
		 }
		else{
			$("#mainNav").addClass("navbarTransparent");
		}
		});
	};
	
	navbarHide();
	$(window).scroll(navbarHide);
	
	
	