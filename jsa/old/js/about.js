jQuery(document).ready(function($) {
  $(".clientQuotes > div").not(".show").hide();
      function textloop() {
        // get the item that currently has the 'show' class
        var current = $(".clientQuotes .show");
        /*
         * find the next item with some help from jQuery's ternary operator
         * the syntax for the ternary operator is 'a ? b : c'
         * in other words 'if a is true return b otherwise return c'
         */
       // var next = current.next().length ? current.next() : current.parent().children(':first');
        // fade out the current item and remove the 'show' class
        function next_slide() {
          var current=$(".clientQuotes .show"),
          next = current.next("div").length ? current.next("div") : current.parent().children('div:first');
          current.fadeOut(400,function(){
          // fade in the next item and add the 'show' class
          next.fadeIn(400).addClass("show");
        }).removeClass("show");
        }

        function prev_slide() {
          var current=$(".clientQuotes .show"),
          prev = current.prev("div").length ? current.prev("div") : current.parent().children('div:last');
          current.fadeOut(400,function(){
          // fade in the next item and add the 'show' class
          prev.fadeIn(400).addClass("show");
        }).removeClass("show");
        }

      $(".nextQuote").click(function(){prev_slide();});

      $(".prevQuote").click(function(){next_slide(); });
      }
 
      // call the text loop method when the page loads
      textloop();

    });