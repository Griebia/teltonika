<div >
    <!-- Saving new element -->
        <form action="/public/cities/save" method="get">
            <div class="inline">
                <label for="name">City name</label>
                <input type="text" name="name" id="name" placeholder="City name" class="input-filed" required>
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
                <label for="postCode">Post code</label>
                <input type="text" name="postCode" id="postCode" placeholder="Post code" class="input-filed" required>
            </div>
                <input type="hidden" name="country_fk" id="country_fk" value = "<?php echo $data['country_id']?>" required>
            <input type="submit"  value="Save">
        </form>

        <h2>Cities</h2>
    <!-- Table -->
        <table class="center">
            <tr>
            <th><b>City name</b></th>
            <th><b>City size</b></th>
            <th><b>City population<b></th>
            <th><b>City post code</b></th>
            <th><b>Actions</b></th>
            </tr>
            <?php 
                foreach($data['cities'] as $city){
                    echo "<tr>";
                    echo "<th> <a href=/public/cities/index/".$city->id."/>" .$city->name."</a></th>";
                    echo "<th>".$city->size."</th>";
                    echo "<th>".$city->population."</th>";
                    echo "<th>".$city->post_code."</th>";
                    echo "<th>  <button onclick='openForm(".$city->id.",\"".$city->name."\",".$city->size.",".$city->population.",\"".$city->post_code."\")'>Edit</button>
                                <input type=\"button\" onclick=\"location.href='/public/cities/delete/". $city->id . "/City/;'\" value=\"Delete\">
                            </th>";
                    echo "</tr>";
                }
            ?>


        </table>
        <!-- Numeration -->
        <div class="center">        
            <div class="pagination">
                <a href=/public/cities/index/<?php echo $data['country_id']."/?";if(count($_GET)> 1){$info =  $_SERVER['QUERY_STRING'];
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
                            echo "<a href=/public/cities/index/".$data['country_id']."/".$i."/?".$info.">" .$i."</a>";
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
                            echo "<a href=/public/cities/index/".$data['country_id']."/".$i."/?".$info.">" .$i."</a>";
                        }
                    }
                ?>
                <a href=/public/cities/index/<?php echo $data['country_id']."/".$data['numberOfPages']."/?"; ?><?php if(count($_GET)> 1){$info =  $_SERVER['QUERY_STRING'];
                                echo substr($info, strpos($info, "&") + 1); }?> >Last</a>

            </div>
        </div>

        <!-- Edit city -->
    <div class="form-popup" id="myForm">
        <form action="/public/cities/edit" class="form-container">
            <h1>Edit city</h1>
            
            <input type="hidden" placeholder="" name="id"  id="editId" required>
            <label for="name"><b>City name</b></label>
            <input type="text" placeholder="Name" name="name"  id="editName" required>

            <label for="size"><b>City size</b></label>
            <input type="number" step="1" name="size" id="editSize" placeholder="Size" class="input-filed" required>

            <label for="population"><b>Population</b></label>
            <input type="number" name="population" id="editPopulation" placeholder="Population" class="input-filed" required>

            <label for="phoneCode"><b>Post code</b></label>
            <input type="text" name="code" id="editCode" placeholder="Phone code" class="input-filed" required>
            <input type="hidden" placeholder="" name="country_fk"  value="<?php echo $data['country_id']?>" required>

            <button type="submit" class="btn">Edit</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>


</div>
