<div class="modal-content" id="checkListModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Manage Clause Checklist</h4>
    </div>
    <div class="modal-body">
        <form id="form1">
            <div>
                <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                <input type="hidden" class="form-control" id="ckl_clauseId">
                <input type="hidden" class="form-control" id="chekListId">
                <input type="hidden" class="form-control" id="ckl_action">
                

            </div>
            <div class="form-group">
                <label for="checkListDesc">Check List Query</label>
                <textarea class="form-control" maxlength="5000" rows="5" id="checkListDesc"></textarea>
            </div>
            <div class="form-group">
                <label for="checkListScore" style="margin-top: 5px;">Check List Score:</label><br>
                <input type="number" id="checklistScore">
            </div>
            <div class="form-group">
                <?php include '../common/formFieldDropDown.php';?>
            </div>
            <div id="multiChoiceModal" class="form-group">
                <span class="text-danger" id="cklOptionsError"></span>
                <ul id="multiChoiceUl" class="form-group">
                    <li>
                        <div class="row">
                            <input type="text" name="ckl_options[]">
                            <button type="button" class="btn btn-primary" onclick="addCklOption('')">Add</button>
                            <button type="button" class="btn btn-default" onclick="removeCklOption(this.id)">Remove</button>
                        </div>
                        <!-- <ul class="list-inline">
                            <li><input type="text" name="ckl_options[]" /></li>
                            <li> <button type="button" class="btn btn-primary" onclick="addCklOption()">Add</button></li>
                            <li> <button type="button" class="btn btn-default" onclick="removeCklOption()">Remove</button></li>
                        </ul> -->
                    </li>
                </ul>
            </div><br>
                             <button type="button" class="btn  btn-info collapsed fa fa-arrow-down" data-toggle="collapse" data-target="#demo"></button>
                  <div id="demo" class="collapse">
                   <div class="container-default" >
                   <div class="row">
                   <div class="col-md-4">
                   <div class="form-group">
                  <label for="usr">Control Type:</label>
                  <select id="controlType" class="form-control">
                      <option></option>
                      <option value="process" <?php if($checklist['checklistControlType']=="process") echo "selected='selected'"?>>Process</option>
                      <option value="technical" <?php if($checklist['checklistControlType']=="technical") echo "selected='selected'"?>>Technical</option>
                  </select>
                  
                </div>
                   </div>
                    <div class="col-md-4">
                   <div class="form-group">
                  <label for="usr">Classification:</label>
                   <select id="classification" class="form-control">
                    <option></option> 
                      <option value="corrective" <?php if($checklist['checklistClassification']=="corrective") echo "selected='selected'"?>>Corrective</option>
                      <option value="preventive" <?php if($checklist['checklistClassification']=="preventive") echo "selected='selected'"?>>Preventive</option>
                  </select>
                </div>
                   </div>
                    <div class="col-md-4">
                   <div class="form-group">
                  <label for="usr">Compliance Rating:</label>
                  <select id="rating" class="form-control">
                    <option></option> 
                      <option value="low" <?php if($checklist['checklistRating']=="low") echo "selected='selected'"?>>Low</option>
                      <option value="medium" <?php if($checklist['checklistRating']=="medium") echo "selected='selected'"?>>Medium</option>
                      <option value="high" <?php if($checklist['checklistRating']=="high") echo "selected='selected'"?>>High</option>
                  </select>
                </div>
                   </div>
                   </div>
                   <div class="row">
                     <div class="col-md-4">
                   <div class="form-group">
                  <label for="usr">Criticality:</label>
                  <select id="crticality" class="form-control">
                      <option></option>
                      <option value="key" <?php if($checklist['checklistCriticality']=="key") echo "selected='selected'"?> >Key</option>
                      <option value="nonkey" <?php if($checklist['checklistCriticality']=="nonkey") echo "selected='selected'"?>>Non Key</option>
                  </select>
                </div>
                   </div>
                    <div class="col-md-4">
                   <div class="form-group">
                  <label for="usr">Control Weakness:</label>
                  <select id="weakness" class="form-control">
                      <option></option>
                      <option value="yes" <?php if($checklist['checklistWeakness']=="yes") echo "selected='selected'"?>>Yes</option>
                      <option value="no" <?php if($checklist['checklistWeakness']=="no") echo "selected='selected'"?>>No</option> 
                  </select>
                </div>
                   </div>
                   </div>
                   <div class="row">
                    <div class="col-md-4">
                      <?php include '../compliance/mitigationControlComplianceDropDown.php';?>
                    </div>
                     <div class="col-md-4">
                      <!-- <label>Mapped Controls</label> -->
                      <div id="controlsDrop">
                      <?php include '../common/controlsDropDown.php';?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label>Mapped Controls:</label>
                   <select class="form-control"></select>                    
                  </div>
                   </div>
                   </div>
                  </div>
        </form>
    </div>  
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="manageChcekListButton" onclick="manageCheckList()" data-dismiss="modal" class="btn btn-primary">Create</button>
    </div>
</div>