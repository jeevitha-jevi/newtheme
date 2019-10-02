<?php
if(is_array($_FILES)) {
    if(is_uploaded_file($_FILES['import']['tmp_name'])) {
        $sourcePath = $_FILES['import']['tmp_name'];
        $targetPath = "../../uploadedFiles/ethics/".$_FILES['import']['name'];
        error_log("file_upload".print_r($_FILES,true));
        if(move_uploaded_file($sourcePath,$targetPath)) {
        ?>
            <img src="<?php echo "php/".$_FILES['userImage']['name'];?>" style="width:100px;margin-bottom: 20px;" />
            <?php
        }
    }
}
?>