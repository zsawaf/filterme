<html>
  <head>
    <title>Filter Me</title>
    <link href="./assets/css/main.css" rel="stylesheet"/>
  </head>
  <body>
    <div class="main-container">
      <!-- filter container -->
      <div class="filter-container">
        <label for="filter"><h4>Social Media Feed Filter</h4></label>
        <input name="filter" type="text" id="filter" placeholder="Enter one keyword you would like to filter"/>
        <div class="save-filter btn">Save Filter</div>
      </div> <!-- end filter container -->
      <!-- filter list -->
      <div class="filtered-list">
        <div class="column"><p>Current Filtered: </p></div>
        <div class="column result"><p>No filter yet.</p></div>
      </div> <!-- end filter list -->
      
      <div class="feeds">
        <div class="feed">Donald Duck is the best cartoon show</div>
        <div class="feed">'I'm not resigning,' Nunavut MP Hunter Tootoo says after admitting to 'inappropriate relationship'</div>
        <div class="feed">'What do you mean by shortly?' Word of which Russian athletes will compete coming down to the wire</div>
        <div class="feed">Quebec waiter arrested after seafood puts allergic customer in coma</div>
      </div>
    </div>
    <div class="modal-container">
        <div class="modal">
        <div class="title"></div>
        <input type="text" id="keyword" placeholder="Type in a keyword appropriate to the title">
        <div class="button-container">
          <div class="submit btn">Submit</div>
          <div class="close btn">Close</div>
        </div>
      </div>
    </div>
  </body>
  <footer>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="./assets/js/main.js"></script>
  </footer>
  

</html>

