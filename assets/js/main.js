$(document).on('ready', function(){
  // add to filter list
  var filter_list = [];
  $('.save-filter').on('click', function(){
    var filter_val = $("#filter").val().split(",");
    for (var i=0;  i<filter_val.length; i++) {
      if ($.inArray(filter_val[i], filter_list) == -1 && filter_val[i] != "") {
        filter_list.push(filter_val[i]);
      }
    }
    $(".filtered-list .result p").html(filter_list.toString(''));
    post_filter();
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
  
  function run_filter() {
    $('.feeds .feed').each(function(){
      var to_filter = $(this).html();
      for (var i=0; i < filter_list.length; i++) {
        var includes = contain_keyword(filter_list[i], to_filter);
        if (includes) {
          break;
        }
      }
      if (includes) {
        $(this).append('<div class="alert"></div>');
      }
    });
  }
  
  function contain_keyword(str1, str2) {
    return str2.toLowerCase().includes(str1.toLowerCase());
  }
});