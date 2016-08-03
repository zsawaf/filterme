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
        <input name="filter" type="text" id="filter" placeholder="Enter keywords you would like to filter, separated by a comma. EG: Politics, Religion, Sports"/>
        <div class="save-filter btn">Save Filter</div>
      </div> <!-- end filter container -->
      <!-- filter list -->
      <div class="filtered-list">
        <div class="column"><p>Current Filtered: </p></div>
        <div class="column result"><p>No filter yet.</p></div>
      </div> <!-- end filter list -->
      
      <div class="feeds">
        <div class="feed">Will Donald Trump win the US presidential election?</div>
        <div class="feed">Are the Toronto Raptors screwed this year?</div>
        <div class="feed">Pets, human's bestfriend?</div>
        <div class="feed">Bombings in Syria continue, ISIS in power.</div>
        <div class="feed">Donald Trump, is he what the US need?</div>
        <div class="feed">Hide yo kids, hide yo wives, the pope is here.</div>
        <div class="feed">political concepts</div>
        <div class="feed">religion & politics</div>
        <div class="feed">POLITICS he said</div>
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

