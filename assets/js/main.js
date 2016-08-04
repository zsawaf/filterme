$(document).on('ready', function(){
  // add to filter list
  var filter;
  $('.save-filter').on('click', function(){
    filter = $("#filter").val();
    $(".filtered-list .result p").html(filter);
    post_filter(filter);
  });

  // FEED RELATED EVENTS
  $(".feed").on('click', function(){
    $(".modal .title").html($(this).html());
    $(".modal-container").toggleClass('show');
  });

  $(".modal .close").on('click', function(){
    $(".modal-container").toggleClass('show');
  });

  // right now only takes one keyword at a time
  $(".modal .submit").on('click', function(){
    var feed_title = $(".modal .title").html();
    var tag = $("#keyword").val();
    var post_data = {'feed_title': feed_title, 'feed_keyword': tag};
    $.ajax({
      url: './api/keywords/post.php',
      data: post_data,
      method: 'POST',
      success: function(response){
        $(".modal-container").toggleClass('show');
      }
    });
  });
  
  function post_filter(filter) {
    // eventually aggregate values in a json, then send one api call instead of several. 
    var feed_array = [];
    $('.feeds .feed').each(function(){
      var to_filter = $(this).html();
      feed_array.push(to_filter);
    });
    $.ajax({
      url: './api/filter/post.php',
      data: {'filter': filter, 'feed_title': JSON.stringify(feed_array)},
      method: 'POST',
      success: function(response) {
        response = response.split(",");
        var i = 0;
        $('.feeds .feed').each(function(){
          $(this).append(response[i]);
          $(this).addClass("filtered");
          i++;
        });
      }
    });
  }
});