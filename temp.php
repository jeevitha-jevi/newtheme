<?php
$allData = array();
makeNewClause('1', $allData);
makeNewClause('2', $allData);
makeNewClause('1', $allData, makeNewArray('1.1'));
makeNewClause('1', $allData, makeNewArray('1.2'));
makeNewClause('1.1', $allData, makeNewArray('1.1.1'));


function makeNewClause($id, &$allData, $subClause=null){
    if (!array_key_exists($id, $allData)){
        $array = makeNewArray($id);
        $allData[$id] = $array;
    } 
    $array = $allData[$id]; 
    echo '<p> id : '.$id . ' , empty : '. ($subClause != null) .' : </p></br>';
    if ($subClause != null){
        if (!array_key_exists('subClause', $array)){
            $subClauseArray = array();
            $array['subClause'] = $subClauseArray;
        }
        $subClauseArray = $array['subClause'];
        array_push($subClauseArray, $subClause);
        $array['subClause'] = $subClauseArray;
        echo '<pre>';
        print_r($array);
        echo '</pre>'; 
        $allData[$id] = $array;
        $allData[$subClause['id']] = $subClauseArray;
    }
}
        
function makeNewArray($id){
    $array = array();
    $array['id'] = $id; 
    return $array;
}
?>

    <div>
        <?php
        echo '<pre>';
        print_r($allData);
        echo '</pre>';  
    ?>
    </div>

    <div>
        <?php
        echo '<pre>';
        print_r($allClauses);
        echo '</pre>';  
    ?>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseThree">Collapsible Group Item #3
                        </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">

                <div class="panel-group" id="accordion2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion2" href="#collapseThreeOne">Collapsible Group Item #3.1
                                        </a>
                            </h4>
                        </div>
                        <div id="collapseThreeOne" class="panel-collapse collapse in">
                            <div class="panel-body">Panel 3.1</div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion2" href="#collapseThreeTwo">Collapsible Group Item #3.2
                                        </a>
                            </h4>
                        </div>
                        <div id="collapseThreeTwo" class="panel-collapse collapse">
                            <div class="panel-body">Panel 3.2</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <nav class="side-menu side-menu-compact">
        <ul class="side-menu-list">
            <li class="blue opened">
                <a href="view/audit/auditorAdmin.php">
	                <i class="fa fa-life-ring active"></i>
	                <span class="lbl">Audit Management</span>
	            </a>
            </li>
            <li class="green">
                <a href="view/compliance/complianceAdmin.php">
	                <i class="fa fa-road"></i>
	                <span class="lbl">Compliance</span>
	            </a>
            </li>
        </ul>
    </nav>
