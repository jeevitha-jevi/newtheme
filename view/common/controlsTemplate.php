 <div class="container">
              <div class="panel panel-default">
              <form action="#" role="form" style="margin:5px;">
                            <div class="form-group">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="uploadedFiles/auditeeFiles/template.jpg" onclick="window.location.href='assets/template.xlsx'" alt="avatar" id="" style="width: 200px;height: 150px;" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div> 
                                <input type="file" id="upload" name="file" accept="image/*"  >                      
                                  <input type="hidden" id="userFileName" value="<?php echo $userImage[0]['image_name']; ?>" >                                  
                                </div>
                              </div>
                              <div class="margin-top-10">                                
                                <button type="button" class="btn green" id="manageButton" onclick="saveUserProfilePicture()">Save Changes</button>    
                              </div>
                              
                              <div class="clearfix margin-top-10">
                                <span class="label label-danger">NOTE! </span>
                                <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                              </div>
                            </div>                            
                          </form>
            </div>   
            </div>  