<?php 
// $params = (isset($this->record))? array('id'=>$this->record['id']):'';
?>
<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>
    <div class="bg-white rounded-5">
        <div class="p-4 d-flex justify-content-center pb-4">
            
            <form style="width: 22rem;" class="p-4 border" method="post" action="<?php echo html_helpers::url(
                array('ctl'=>'login', 
                    'act'=>'login', 
                    // 'params'=> array('name'=>$name,'username'=>$username,'password'=>$password)
                )); ?>">
                <h1 class="text-center">Login</h1>
                <div class="d-flex mb-4">
                    <label class="text-center">Username:</label>
                    <input class="form-control mx-3" type="text" name="username" placeholder="Username">
                </div>
                <div class="d-flex mb-4">
                    <label class="text-center">Password:</label>
                    <input class="form-control mx-3" type="password" name="password" placeholder="Password">
                </div>
                <button class="btn btn-primary btn-block mx-auto d-block" name="btn_submit" type="submit">Login</button>
            </form>
        </div>

    </div>
</div>
