<div >
    <!-- Saving new element -->
        <form action="/public/countries/save" method="get">
            <div class="inline">
                <label for="name">Country name</label>
                <input type="text" name="name" id="name" placeholder="Country name" class="input-filed" required>
            </div>
            &nbsp;
            <div class="inline">
                <label for="size">Size</label>
                <input type="number" step="1" name="size" id="size" placeholder="Size" class="input-filed" required>
            </div>
            &nbsp;
            <div class="inline">
                <label for="population">Population</label>
                <input type="number" name="population" id="population" placeholder="Population" class="input-filed" required>
            </div>
            &nbsp;
            <div class="inline">
                <label for="phoneCode">Phone code</label>
                <input type="text" name="phoneCode" id="phoneCode" placeholder="Phone code" class="input-filed" required>
            </div>

            <input type="submit" value="Save">
        </form>

        <h2>Countries</h2>
    <!-- Table -->
        <table class="center">
            <tr>
            <th><b>Country name</b></th>
            <th><b>Country size</b></th>
            <th><b>Country population<b></th>
            <th><b>Country phone code</b></th>
            <th><b>Actions</b></th>
            </tr>
            <?php 
                foreach($data['countries'] as $country){
                    echo "<tr>";
                    echo "<th> <a href=/public/cities/index/".$country->id."/>" .$country->name."</a></th>";
                    echo "<th>".$country->size."</th>";
                    echo "<th>".$country->population."</th>";
                    echo "<th>".$country->phone_code."</th>";
                    echo "<th>  <button onclick='openForm(".$country->id.",\"".$country->name."\",".$country->size.",".$country->population.",\"".$country->phone_code."\")'>Edit</button>
                                <input type=\"button\" onclick=\"location.href='/public/countries/delete/". $country->id . "/Country/;'\" value=\"Delete\">
                            </th>";
                    echo "</tr>";
                }
            ?>


        </table>
        <!-- Numeration -->
        <div class="center">        
            <div class="pagination">
                <a href=/public/countries/index/?<?php if(count($_GET)> 1){$info =  $_SERVER['QUERY_STRING'];
                                echo substr($info, strpos($info, "&") + 1); }?>>First</a>
                <?php 
                    $page = $data['page'];
                    for($i = $page-2; $i <= $page; $i++){
                        if($i< 1){
                            continue;
                        }else{
                            $info="";

                            if(count($_GET) > 1){
                                $info =  $_SERVER['QUERY_STRING'];
                                $info = substr($info, strpos($info, "&") + 1); 
                            }

                            echo "<a href=/public/countries/index/".$i."/?".$info.">" .$i."</a>";
                        }
                    }

                    for($i = $page+1; $i <= $page+2; $i++){
                        if($i > $data['numberOfPages']){
                            break;
                        }else{
                            $info="";

                            if(count($_GET) > 1){
                                $info =  $_SERVER['QUERY_STRING'];
                                $info = substr($info, strpos($info, "&") + 1); 
                            }
                            
                            echo "<a href=/public/countries/index/".$i."/?".$info.">" .$i."</a>";
                        }
                    }
                ?>
                <a href=/public/countries/index/<?php echo $data['numberOfPages']."/?"; ?><?php if(count($_GET)> 1){$info =  $_SERVER['QUERY_STRING'];
                                echo substr($info, strpos($info, "&") + 1); }?> >Last</a>

            </div>
        </div>

    <!-- Edit country -->
    <div class="form-popup" id="myForm">
        <form action="/public/countries/edit" class="form-container">
            <h1>Edit country</h1>
            
            <input type="hidden" placeholder="" name="id"  id="editId" required>
            <label for="name"><b>Country name</b></label>
            <input type="text" placeholder="Name" name="name"  id="editName" required>

            <label for="size"><b>Country size</b></label>
            <input type="number" step="1" name="size" id="editSize" placeholder="Size" class="input-filed" required>

            <label for="population"><b>Population</b></label>
            <input type="number" name="population" id="editPopulation" placeholder="Population" class="input-filed" required>

            <label for="phoneCode"><b>Phone code</b></label>
            <input type="text" name="code" id="editCode" placeholder="Phone code" class="input-filed" required>

            <button type="submit" class="btn">Edit</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>

</div>
