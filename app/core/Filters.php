<!-- Filter button -->
<button onclick="filterBtn()">Filters</button>
<!-- Filters -->
<div id = filters class="filters">
    <h2>Fillter</h2>
    <!-- Search -->
    <div class="inline">
        <form action="/public/<?php echo $_GET['url']?>/" method="get">
            <label for="search">Search</label>
            <input type="text" name="search" value ="<?php if(isset($_GET['search']))echo $_GET['search']?>"class ="inline">
            <input type="submit" class="inline" value="Search">
        </form>
    </div>
    <!-- Sorting -->
    <div >
        <label for="sorting">Sorting</label>
        <form action="/public/<?php echo $_GET['url']?>/" method="get" >
            <select id = "selection" name = "sorting" onchange=" this.form.submit()">
                <?php if($_GET['sorting'] == 'ASC'):?>
                    <option value="ASC" name="ASC" selected = "selected">Ascending</option>
                <?php else:?>
                    <option value="ASC" name="ASC">Ascending</option>
                <?php endif?>
                <?php if($_GET['sorting'] == 'DESC'):?>
                    <option value="DESC" name="DESC" selected = "selected">Descending</option>
                <?php else:?>
                    <option value="DESC" name="DESC">Descending</option>
                <?php endif?>
            </select> 
        </form>
    </div>

    <!-- Date filtering -->
    <div class=inline>
        <form action="/public/<?php echo $_GET['url']?>" method="get">
            <label for="fromDatetime">From date</label>
            <?php if(isset($_GET['start'])):?>
                <input type="datetime-local" id="start"name="start" value="<?php echo $_GET['start']?>"min="2018-06-07T00:00" max="2018-06-14T00:00">
            <?php else:?>
                <input type="datetime-local" placeholder="2000-05-12T19:30" id="start"name="start" min="2018-06-07T00:00" max="2018-06-14T00:00">
            <?php endif?>
            <label for="toDatetime">To date</label>
            <?php if(isset($_GET['start'])):?>
                <input type="datetime-local" id="end" name="end" value="<?php echo $_GET['end']?>" min="2018-06-07T00:00" max="2022-06-14T00:00">
            <?php else:?>
                <input type="datetime-local" placeholder="2022-05-12T19:30" id="end" name="end" min="2018-06-07T00:00" max="2022-06-14T00:00">
            <?php endif?>
            <input type="submit" class="button-primary" value="Select">
        </form>
    </div>

</div>