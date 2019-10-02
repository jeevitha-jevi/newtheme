<div class="modal-content" id="complianceClauseModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Manage Compliance Clause Details</h4>
    </div>
    <div class="modal-body">
        <form id="form1">
            <div>
                <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                <input type="hidden" class="form-control" id="clauseId">
                <input type="hidden" class="form-control" id="complianceId" value="<?php echo $complianceId ?>">
                <input type="hidden" class="form-control" id="parentClauseId">
                <input type="hidden" class="form-control" id="action">
            </div>
            <div class="form-group">
                <label for="clauseName">Clause Name</label>
                <input type="text" class="form-control" id="clauseName">
            </div>
            <div class="form-group">
                <label for="clauseDesc">Decription</label>
                <textarea class="form-control" maxlength="5000" rows="5" id="clauseDesc"></textarea>
            </div>
            <div class="form-group">
                <label for="number">Order Number</label>
                <input type="text" class="form-control" id="number">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="manageButton" onclick="manageModal()" data-dismiss="modal" class="btn btn-primary">Create</button>
    </div>
</div>