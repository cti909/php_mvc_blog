<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>
<?php 
$params = (isset($this->record))? array('id'=>$this->record['id']):'';
?>
    <div class="bg-white rounded-5">
        <div class="p-4 d-flex justify-content-center pb-4">
            <form style="width: 22rem;" class="p-4 border" method="post" action="<?php echo html_helpers::url(
                array('ctl'=>'register', 
                'act'=>'register', 
			    'params'=>$params   
                )); ?>">
                <h1 class="text-center">Register</h1>
                <div class="row mb-4">
                    <label class="col-4">Name:</label>
                    <!-- <input class="col-8 form-control" style="width: auto;" type="text" name="name" placeholder="Name"> -->
                    <input class="col-8 form-control" style="width: auto;" name="data[<?php echo $this->controller; ?>][name]" type="text" id="name" placeholder="Name" <?php echo (isset($this->record))? "value='".$this->record['name']."'":""; ?>>
                </div>
                <div class="row mb-4">
                    <label class="col-4">Username:</label>
                    <!-- <input class="col-8 form-control" style="width: auto;" type="text" name="username" placeholder="Username"> -->
                    <input class="col-8 form-control" style="width: auto;" name="data[<?php echo $this->controller; ?>][username]" type="text" id="username" placeholder="Username" <?php echo (isset($this->record))? "value='".$this->record['username']."'":""; ?>>
                </div>
                <div class="row mb-4">
                    <label class="col-4">Password:</label>
                    <!-- <input class="col-8 form-control" style="width: auto;" type="password" name="password" placeholder="Password"> -->
                    <input class="col-8 form-control" style="width: auto;" name="data[<?php echo $this->controller; ?>][password]" type="text" id="password" placeholder="Password" <?php echo (isset($this->record))? "value='".$this->record['password']."'":""; ?>>
                </div>
                <button class="btn btn-primary btn-block mx-auto d-block" name="btn_submit">Register</button>
            </form>
        </div>

    </div>
</div>
