<?php
include "header.php";
?>


<section class="add-post-section">
    <div class="container">
        <div class="add-post">
            <h2>Create New Post</h2>
            <hr class="add-post-hr">
            <div class="add-post-inputs">
                <input type="text" class="caption-input" name="post-caption" placeholder="Write a Caption...">
                <div class="choose-file-div">
                    <img src="../images/add-post/media.svg">
                    <br>
                    <input type="file" class="choose-file-input" id="post-photo" name="post-photo" hidden>
                    <label class="choose-file-label" for="post-photo">Select from device</label>
                </div>
            </div>

        </div>
    </div>
</section>


<?php
include "footer.php";
?>
