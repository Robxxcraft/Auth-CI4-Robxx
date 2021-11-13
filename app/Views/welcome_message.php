<?= $this->extend('default') ?>

<?= $this->section('title')?>
	Landing Page
<?= $this->endSection('title')?>
<?= $this->section('style')?>
body{
    position: relative;
}

.bg{
    position: absolute;
    right: 0px;
    top: 0px;
}

.button {
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    transition: 0.3s;
  }
  
.button:hover {
    background-color: blue;
    color: white;
}

.bg-custom{
    background-color: #fff !important;
    transition: 0.3s;
    color: gray !important;
}

.bg-custom:hover {
    background-color:#6884e7 !important;
    color: #fff !important;
}


.bg-active{
    background-color: transparent !important;
    transition: 0.3s;
    color: #6884e7 !important;
}

  .navbar{
      width: 100%;
  }

  .link-navbar{
    color: gray;
    transition: 0.3s;
  }

  .link-navbar:hover{
    color: #6884e7;
  }
<?= $this->endSection('style')?>
<?= $this->section('content')?>
<!-- navbar -->
<nav class="navbar navbar-expand-sm navbar-light mt-3 fixed-top" id="navbar">
	<div class="container">
		<a class="navbar-brand" href="/">
			<span style="color:dimgrey; font-weight: bold;">Robxx</span>
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
			aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
			<ul class="nav nav-pills">
				<li class="nav-item">
					<a class="nav-link active bg-active link-navbar" style="font-weight: bold;" href="#">Home &nbsp;&nbsp;</a>
				</li>
				<li class="nav-item">
					<a class="nav-link link-navbar" style="font-weight: bold;" href="/">About &nbsp;&nbsp;</a>
				</li>
				<li class="nav-item">
					<a class="nav-link link-navbar" style="font-weight: bold;" href="/profile">Profile &nbsp;&nbsp;</a>
				</li>
				<li class="nav-item">
					<a class="nav-link link-navbar" style="font-weight: bold;" href="https://wa.me/085791041224">Contact &nbsp;&nbsp;</a>
				</li>
        <?php if (session()->get('user')) : ?>
				<li class="nav-item">
					<a href="<?= base_url().'/logout'?>" class="nav-link bg-custom rounded shadow" style="font-weight: bold;">Logout</a>
	        	</li>
        <?php endif ?>

        <?php if (!session()->get('user')) : ?>
				<li class="nav-item">
					<a href="/login" class="nav-link bg-custom rounded shadow" style="font-weight: bold;" id="btn-sign">SIGN IN</a>
				</li>
        <?php endif ?>
		</ul>
		</div>

</nav>

<!-- konten -->
<img src="<?php echo base_url('images/bg.jpeg') ?>" class="bg" height="698" width="1400"></img>
<div class="container">

	<br><br><br>

	<div class="row mt-5 mb-5">

		<div class="col-sm-12 position-relative p-4">

			<div class="position-absolute top-0 end-0">

			</div>

			<?php if (!session()->get('user')) : ?>
			<h1 class="display-3 text-truncate" style="font-weight: bold;">Welcome</h1>
			<h1 class="display-3 text-truncate" style="font-weight: bold;">To Homepage</h1>
        <?php endif;?>

        <?php if (session()->get('user')) : ?>
			<h1 class="display-3 text-truncate" style="font-weight: bold;">Hello</h1>
			<h1 class="display-3 text-truncate" style="font-weight: bold;"><?= ucfirst(session()->get('user')['name']) ?></h1>
        <?php endif;?>

			<div class="mt-4" style="max-width: 400px;">
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
					sed diam nonummy nibh euismod tincidunt ut laoreet
					dolore magna </p>
			</div>

			<div class="mt-5">
				<a href="/register" class="button btn-primary rounded-pill shadow" style="font-weight: bold;">Get Started</a>
			</div>

			<br>

		</div>

	</div>

</div>

	<?= $this->endSection('content')?>