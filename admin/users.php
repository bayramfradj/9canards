<?php require_once('header.php'); 
include_once('../model/User.php');
$User = new User(); ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Users</h1>
	</div>
	<div class="content-header-right">
		<a href="user.php" class="btn btn-primary btn-sm">Add New</a>
	</div>
</section>

 
<section class="content">
		<?php
			if(isset($_POST['form1']))
			 {
			$valid = 1;
			$path = $_FILES['photo']['name'];
   			$path_tmp = $_FILES['photo']['tmp_name'];
   			$statement = $User->NbrMail($_POST['email']);
			$resulte = $statement->fetch();
			if ($resulte[0]>0) {

				$valid = 0;
				$error_message ="email user already exists<br>";
			}

			 if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
		            $valid = 0;
		            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    }

		    if ($valid==1) {
		    	$n=htmlentities($_POST['name']);
		    	$e=htmlentities($_POST['email']);
		    	$p=htmlentities($_POST['phone']);
		    	$r=htmlentities($_POST['role']);
		    	$pass=htmlentities($_POST['rpassword']);
		    	$pc=md5($pass);
		    	if($path!='') {
		    		 move_uploaded_file( $path_tmp, '../assets/uploads/'.$path );
		    	}
		    	$User->insert(array($n,$e,$p,$r,$pc,$path));
				$success_message = 'user is added successfully!';

				 $message = '<p>Hi '.$n.'</p><br><p>welcome to Admin Panel </p><br><p>you can login to admin panel with that information :</p><br><p>email: '.$e.'</p><br><p>Password : '.$pass.'</p><br><p><a href="'.BASE_URL.'/admin/login.php">click here to connect</a></p>';
		        
		        
		        $subject = "Welcome to Admin panel";
		        $headers = "From: noreply@" . BASE_URL . "\r\n" .
		                   "Reply-To: noreply@" . BASE_URL . "\r\n" .
		                   "X-Mailer: PHP/" . phpversion() . "\r\n" . 
		                   "MIME-Version: 1.0\r\n" . 
		                   "Content-Type: text/html; charset=ISO-8859-1\r\n";

		        mail($e, $subject, $message, $headers);


		    }


			}




		?>

		<?php
			if (isset($_POST['role'])&&isset($_POST['id'])&&$_POST['id']>1) {
				$r=htmlentities($_POST['role']);
				$id=htmlentities($_POST['id']);
				$User->updateRole(array($r,$id));

				if ($_SESSION['user']['id']==$id) {
					# code...

					$_SESSION['user']['role']=$r;
				}
				
					?>
					
						<div class="col-md-12 callout callout-success">
							<center>sucsusfuly Update</center>
						</div>
						




					<?php
					
				

			}
		?>


		<?php
			if (isset($_POST['idd'])&&$_POST['idd']>-1) {
				$id=htmlentities($_POST['idd']);
				$User->delete($id);

				if ($_SESSION['user']['id']==$id) {
					# code...

					header('location:logout.php');
				}
				
					?>
					
						
						<div class="col-md-12 callout callout-success">
							<center>sucsusfuly Delete</center>
						</div>
						




					<?php
					
				

			}
		?>
	<div class="row">
		<div class="col-md-12">
				<?php if($error_message): ?>
			<div class="callout callout-danger">
				<p>
				<?php echo $error_message; ?>
				</p>
			</div>
			<?php endif; ?>

			<?php if($success_message): ?>
			<div class="callout callout-success">
				<p><?php echo $success_message; ?></p>
			</div>
			<?php endif; ?>

			<div class="box box-info">

				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Photo</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Role</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							$statement = $User->all();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
							foreach ($result as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td>
										<?php
										if($row['photo'] == '')
										{
											echo '<img src="../assets/uploads/no-photo1.jpg" alt="" style="width:180px;">';
										}
										else
										{
											echo '<img src="../assets/uploads/'.$row['photo'].'" alt="'.$row['full_name'].'" style="width:120px; height:120px; " class="user-image">';
										}
										?>
									</td>
									<td><?php echo $row['full_name']; ?></td>
									<td>
										<?php echo $row['email']; ?>
									</td>
									<td><?php echo $row['phone']; ?></td>
									<td><?php echo $row['role']; ?></td>
									<td>										
										
										<a href="#" class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#<?php echo $row['id']; ?>">Edit</a>



										<div class="modal fade" id="<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										    <div class="modal-dialog">
										        <div class="modal-content">
										        	<form action="#" method="POST">
										            <div class="modal-header">
										                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										                <h4 class="modal-title" id="myModalLabel">Edit Role <?php echo $row['full_name']; ?></h4>
										            </div>
										            <div class="modal-body">
										            	<input type="hidden" name="id" value="<?= $row['id'] ?>">
										                <p>Role : <select name="role" >
										                	<option value="Super Admin" <?php if($row['role']=='Super Admin')echo "selected";  ?>>Super Admin</option>
										                	<option value="Admin" <?php if($row['role']=='Admin')echo "selected";  ?> >Admin</option>
										                	<option value="Publisher" <?php if($row['role']=='Publisher')echo "selected";  ?> >Publisher</option>

										                 </select> </p> 
										            </div>
										            <div class="modal-footer">
										                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										                <button class="btn btn-primary btn-ok" type="submite">Edit</button>
										            </div>
										            </form>
										        </div>
										    </div>
										</div>


										<a href="#" class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#<?php echo $row['id'].'d'; ?>">Delete</a>



										<div class="modal fade" id="<?php echo $row['id'].'d'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										    <div class="modal-dialog">
										        <div class="modal-content">
										        	<form action="#" method="POST">
										            <div class="modal-header">
										                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
										            </div>
										            <div class="modal-body">
										            	<input type="hidden" name="idd" value="<?= $row['id'] ?>">
										               <p>Are you sure want to delete this user ?</p>
										            </div>
										            <div class="modal-footer">
										                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										                <button class="btn btn-danger btn-ok" type="submite">Delete</button>
										            </div>
										            </form>
										        </div>
										    </div>
										</div>

										 
									</td>
								</tr>
								<?php
							}
							?>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


</section>






<?php require_once('footer.php'); ?>