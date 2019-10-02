<?php
require_once __DIR__.'/../../php/common/metaData.php';
$GLOBALS['count']=0;

foreach ($allClauses as $clause){
    formPanel($clause);
    error_log("clauseDisplay".print_r($clause,true));
}

function formPanel($clause){
    $hasChilderClauses = $clause['hasChildrenClauses'];
    $clauseId = $clause['clauseId'];
    $clauseName = $clause['clauseName'];
    $clauseDesc = $clause['clauseDesc'];
    $complianceId = $clause['complianceId'];
    $parentClauseId = $clause['parentClauseId'];
    $orderNumber = $clause['orderNumber'];
    $isClauseViewOnly = $clause['isClauseViewOnly'];
    $isClauseActive = $clause['isClauseActive'];
    $complStatus = $clause['compl_status'];    
?>
    <div class="panel-group" id="<?php echo 'accordion'.$accordionId ?>">
        <div class="panel panel-default">
            <div class="panel-heading" style="background: #f5f5f5">
                <h4 class="panel-title pull-left">
                    <a data-toggle="collapse"  href="<?php echo '#collapse'.$clauseId ?>">
                        <?php echo $clauseName ?>
                    </a>

                </h4>
                <?php if($isActive || (($_SESSION['user_role']=='super_admin') && $GLOBALS['workingStatus']=='in_draft')) {?>
                <div class="panel-title pull-right" style="background: #f5f5f5">
                    <?php
                    if ($hasChilderClauses){
                        // The only child clauses can be added
                        ?>
                        <button class="btn btn-default" onclick="showModal(false, <?php echo $clauseId ?>, true)"><i class="fa fa-file"></i>    Sub Domain</button>
                        <?php
                        } else {
                        $checklists = $clause['checklists']; 
                        if ($checklists != null){ 
                            // In this case only checklists can be added
                            ?>
                            <button class="btn btn-default" onclick="showModal(false, <?php echo $clauseId ?>, false)"><i class="fa fa-file"></i>    Controls</button>
                        <?php
                        } else {
                            // leaf node both of them can be added
                        ?>
                            <button class="btn btn-default" onclick="showModal(false, <?php echo $clauseId ?>, true)"><i class="fa fa-file"></i>    Sub Domain</button>
                            <button class="btn btn-default" onclick="showModal(false, <?php echo $clauseId ?>, false)"><i class="fa fa-file"></i>    Controls</button>
                        <?php
                            }
                        }
                        ?>
                            <button class="btn btn-default" onclick="showModal(true, <?php echo $clauseId ?>, true)"><i class="fa fa-user"></i>    update</button>
                            <button class="btn btn-default" onclick="deleteModal(<?php echo $clauseId ?>)"><i class="fa fa-trash"></i>    delete</button>
                </div>
                <?php }?>
                <div class="clearfix"></div>
                <div>
                    <input type="hidden" class="form-control" id="<?php echo 'clauseId'.$clauseId ?>" value="<?php echo $clauseId ?>">
                    <input type="hidden" class="form-control" id="<?php echo 'clauseName'.$clauseId ?>" value="<?php echo $clauseName ?>">
                    <input type="hidden" class="form-control" id="<?php echo 'clauseDesc'.$clauseId ?>" value="<?php echo $clauseDesc ?>">
                    <input type="hidden" class="form-control" id="<?php echo 'complianceId'.$clauseId ?>" value="<?php echo $complianceId ?>">
                    <input type="hidden" class="form-control" id="<?php echo 'parentClauseId'.$clauseId ?>" value="<?php echo $parentClauseId ?>">
                    <input type="hidden" class="form-control" id="<?php echo 'orderNumber'.$clauseId ?>" value="<?php echo $orderNumber ?>">
                </div>
            </div>
        
        <?php
    $subClauses = $clause['subClauses'];
    if ($subClauses != null){
        $accordionId = $clauseId;
        ?>
            <div id="<?php echo 'collapse'.$clauseId ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php
                    foreach ($subClauses as $subClause){
                        formPanel($subClause);
                    }
                    ?>
                </div>
            </div>
            </div>
        </div>
            <?php
    } else {
        // Means end of leaf and check we have any checklists
        $checklists = $clause['checklists'];
        if ($checklists != null){
            ?>
                <div id="<?php echo 'collapse'.$clauseId ?>" class="panel-collapse collapse">
                    <div class="panel-body" >
                        <?php
            foreach ($checklists as $checklist){
                $chkClauseId = $checklist['clauseId'];
                $checklistId = $checklist['checklistId'];
                $checklistDesc = $checklist['checklistDesc'];     
                $cklOptions = $checklist['cklOptions'];
                $fieldTypeId = $checklist['formFieldType'];
                $checklistScore=$checklist['checklistScore'];
                ?>
                            <div class="panel">
                                <?php 
                                    echo $checklist['checklistDesc'];
                                ?>
                                <?php //if($isClauseActive) {?>
                                    <div class="pull-right">
                                        <button class="btn btn-default" onclick="showModal(true, <?php echo $checklistId ?>, false)"><i class="fa fa-user"></i>    update</button>
                                        <button class="btn btn-default" onclick="deleteChecklist(<?php echo $checklistId ?>)"><i class="fa fa-trash"></i>    delete</button>
                                    </div>
                                <?php //}?>
                                <div class="clearfix"  ></div>
                                <div>
                                    <input type="hidden" class="form-control" id="<?php echo 'clauseId'.$checklistId ?>" value="<?php echo $chkClauseId ?>">
                                    <input type="hidden" class="form-control" id="<?php echo 'checklistDesc'.$checklistId ?>" value="<?php echo $checklistDesc ?>">
                                    <input type="hidden" class="form-control" id="<?php echo 'checklistScore'.$checklistId ?>" value="<?php echo $checklistScore ?>">

                                    <input type="hidden" class="form-control" id="<?php echo 'formFieldType'.$checklistId ?>" value="<?php echo $fieldTypeId ?>">
                                    <input type="hidden" class="form-control" id="controlType<?php echo $checklist['checklistId']?>" value="<?php echo $checklist['checklistControlType']?>">
                                    <input type="hidden" class="form-control" id="classification<?php echo $checklist['checklistId']?>" value="<?php echo $checklist['checklistClassification']?>">
                                    <input type="hidden" class="form-control" id="rating<?php echo $checklist['checklistId']?>" value="<?php echo $checklist['checklistRating']?>">
                                    <input type="hidden" class="form-control" id="crticality<?php echo $checklist['checklistId']?>" value="<?php echo $checklist['checklistCriticality']?>">
                                    <input type="hidden" class="form-control" id="weakness<?php echo $checklist['checklistId']?>" value="<?php echo $checklist['checklistWeakness']?>">
                                    <input type="hidden" class="form-control" id="mapped<?php echo $checklist['checklistId']?>">
                                </div>
                                <?php
                                    if (MetaData::isMultiChoice($fieldTypeId)) {
                                        ?>

                                    <div id="<?php echo 'cklOptsModal'.$checklistId ?>">
                                        <ul id="<?php echo 'cklOpts'.$checklistId ?>">
                                            <?php
                                        foreach($cklOptions as $cklOpt){
                                        ?>
                                                <li>
                                                    <div class="panel-default">
                                                        <input type="<?php echo MetaData::getMlChoiceControl($fieldTypeId) ?>" name="cklOptionResp[]" value="<?php echo $cklOpt['cklOptId'] ?>" disabled="disabled">
                                                        <?php echo $cklOpt['cklOptData'] ?>
                                                        <input type="hidden" class="form-control" id="<?php echo 'cklOptId-'.$cklOpt['cklOptId']?>" value="<?php echo $cklOpt['cklOptId'] ?>">
                                                        <input type="hidden" class="form-control" id="<?php echo 'cklOptData'.$cklOpt['cklOptId'] ?>" value="<?php echo $cklOpt['cklOptData'] ?>">
                                                    </div>
                                                </li>
                                                <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                    <?php
                                    }
                                        ?>
                            </div>
                            <?php
            }
            ?>
                    </div>
                </div>
                </div>
            </div>
                <?php
        }
    }
    ?>

    <?php
   
if($clause['parentClauseId']==NULL){
    if($GLOBALS['count']!=0)
    {
    error_log("inside condition");
    ?>
</div>
</div>

<?php
}
/*if($GLOBALS['count']==0)
{
    $GLOBALS['count']+=1;
}*/
}
}
?>
