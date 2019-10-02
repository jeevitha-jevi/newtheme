<?php
if(is_array($_FILES)) {
    if(is_uploaded_file($_FILES['userFile']['tmp_name'])) {
        $sourcePath = $_FILES['userFile']['tmp_name'];
        $targetPath = "../../uploadedFiles/auditeeFiles/".$_FILES['userFile']['name'];
        if(move_uploaded_file($sourcePath,$targetPath)) {
        ?>
            <img src="<?php echo "php/".$_FILES['userImage']['name'];?>" style="width:100px;margin-bottom: 20px;" />
            <?php
        }
    }
}
?>