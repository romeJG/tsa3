<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>

	<div class="d-flex align-items-center justify-content-center mt-5">
		<div class="card align-middle" style="width: 1200px;">
			<div class="card-body">
				<h5 class="card-title">TSA 3 Pagination and File Upload</h5>
				<?php if (isset($message)) {
					echo $message;
				}
				if (isset($error)) {
					echo $error;
				}
				?>


				<?php
				if (isset($user_data)) {
					foreach ($user_data->result() as $row) {
				?>
						<div class="row">
							<div class="col-md-4">
								<?php echo form_open_multipart('welcome/formvalidation'); ?>
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="fname" class="form-label">Firstname</label>
											<input type="text" class="form-control" value="<?php echo $row->firstname; ?>" id="fname" name="fname" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="lname" class="form-label">Lastname</label>
											<input type="text" class="form-control" value="<?php echo $row->lastname; ?>" id="lname" name="lname" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<div class="mb-3">
									<label for="uname" class="form-label">Username</label>
									<input type="text" class="form-control" value="<?php echo $row->username; ?>" id="uname" name="uname" aria-describedby="emailHelp">
								</div>
								<div class="mb-3">
									<label for="exampleInputPassword1" class="form-label">Password</label>
									<input type="password" class="form-control" value="<?php echo $row->password; ?>" id="exampleInputPassword1" name="password">
								</div>

								<div class="form-group">
									<input type="hidden" name="hidden_id" value="<?php echo $row->id; ?>" />
								</div>
								<button type="submit" class="btn btn-primary">Change</button>
								</form>
							</div>

						<?php
					}
				} else {
						?>
						<div class="row">
							<div class="col-md-4">
								<?php echo form_open_multipart('welcome/imagevalidation'); ?>
								<div class="mb-3">
									<label for="image" class="form-label">User Avatar</label>
									<input type="file" class="form-control" id="image" name="image">
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="fname" class="form-label">Firstname</label>
											<input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="lname" class="form-label">Lastname</label>
											<input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<div class="mb-3">
									<label for="uname" class="form-label">Username</label>
									<input type="text" class="form-control" id="uname" name="uname" aria-describedby="emailHelp">
								</div>
								<div class="mb-3">
									<label for="exampleInputPassword1" class="form-label">Password</label>
									<input type="password" class="form-control" id="exampleInputPassword1" name="password">
								</div>
								<button type="submit" class="btn btn-primary">Add</button>
								</form>
							</div>

						<?php
					}
						?>
						<div class="col-md-8">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">User Avatar</th>
										<th scope="col">Firstname</th>
										<th scope="col">Lastname</th>
										<th scope="col">Username</th>
										<th scope="col">Password</th>
										<th scope="col">Edit</th>

									</tr>
								</thead>
								<tbody>

									<?php
									if ($fetch_data->num_rows() > 0) {
										foreach ($fetch_data->result() as $row) {
									?>
											<tr>
												<th scope="row"><?php echo $row->id ?></th>
												<td>
													<img src="<?php echo base_url(); ?>/upload/<?php echo $row->avatar ?>" width="100px">
												</td>

												<td><?php echo $row->firstname ?></td>
												<td><?php echo $row->lastname ?></td>
												<td><?php echo $row->username ?></td>
												<td><?php echo $row->password ?></td>
												<td>
													<a type="button" class="btn btn-primary" href="<?php echo base_url(); ?>index.php/welcome/edituser/<?php echo $row->id ?>">
														<i class="bi bi-pencil-fill"></i>
													</a>

													<a type="button" class="btn btn-primary" href="<?php echo base_url(); ?>index.php/welcome/deleteuser/<?php echo $row->id ?>">
														<i class="bi bi-trash-fill"></i>
													</a>
												</td>

											</tr>
									<?php
										}
									}

									?>

								</tbody>
							</table>

							<?php echo $pagination; ?>
						</div>
						</div>
						</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>