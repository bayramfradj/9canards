<?php require_once('header.php'); ?>

<?php

?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add User</h1>
	</div>
	<div class="content-header-right">
		<a href="users.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">

			

			<form class="form-horizontal" action="users.php" method="post" enctype="multipart/form-data" name="f">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Name : <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="name" placeholder="NAME" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">Email : <span>*</span></label>
							<div class="col-sm-6">
								<input type="email" class="form-control" name="email" placeholder="Example@gmail.com" required="">
							</div>
						</div>
						<div class="form-group"> 
							<label for="phone" class="col-sm-2 control-label">Phone : </label>
							<div class="col-sm-6">
									<input type="number" class="form-control" name="phone" placeholder="+21600001234">
							</div>
						</div>
						<div class="form-group">
							<label for="role" class="col-sm-2 control-label">Role :   <span>*</span></label>
							<div class="col-sm-6">
								<select name="role" required="" class="form-control">
									<option value="Publisher"><center> Publisher </center></option>
									<option value="Admin"><center>Admin</center></option>
									<option value="Super Admin"><center> Super Admin </center></option>
								</select>
							</div>
						</div>
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Photo : </label>
				            <div class="col-sm-6" >
				                <input type="file" name="photo" class="form-control">
				            </div>
				        </div>
				        <div class="form-group">
							<label for="Password" class="col-sm-2 control-label">Password : <span>*</span></label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="password" placeholder="Password " id="password" required="" onblur="verif1(this);">
							</div>
						</div>

						<div class="form-group">
							<label for="Password" class="col-sm-2 control-label">Repeat Password : <span>*</span></label>
							<div class="col-sm-6">
								<input type="Password" class="form-control" name="rpassword" id="rpassword" placeholder="Repeat Password" required="" onblur="verif(this)">
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1" id="sub">Submit</button>
							</div>
						</div>
						
						
						
						
					</div>
				</div>
			</form>
		</div>
	</div>

</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	function verif1(champ)
{
   if(champ.value.length<8)
   {
   	champ.style.backgroundColor = "#fba";
   		
  		champ.focus();
  		
   } 
   else
   {
      champ.style.backgroundColor = "";
 		
   }
}
function verif(champ)
{
   if(champ.value!=f.password.value)
   {
   	champ.style.backgroundColor = "#fba";
  		champ.focus();
   } 
   else
   {
      champ.style.backgroundColor = "";
 		
   }
}
</script>

<?php require_once('footer.php'); ?>