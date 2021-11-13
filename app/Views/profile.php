<?= $this->extend('default') ?>

<?= $this->section('title') ?>
    Profile
<?= $this->endSection('title') ?>
<?= $this->section('style') ?>
.bg-custom{
    background-color: #6884e7!important;
    transition: 0.3s;
    color: #fff !important;
}

.bg-custom:hover {
    background-color: #fff  !important;
    color: gray !important;
}
<?= $this->endSection('style') ?>
<?= $this->section('content') ?>
<nav class="navbar navbar-expand-sm navbar-light mt-2" >
<div class="container">
  <a class="navbar-brand" style="font-weight: bolder;" href="/">Robxx</a>
  <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div id="my-nav" class="collapse navbar-collapse justify-content-end">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/profile" style="font-weight: bold;">Profile</a>
      </li>
      <li class="nav-item">
					<a href="<?= base_url().'/logout'?>" class="nav-link bg-custom rounded shadow" style="font-weight: bold;">Logout</a>
	    </li>
    </ul>
  </div>
  </div>
</nav>
  <section>
  <div class="card rounded-pills" style="background-color: lightgrey;">
  <div class="card-body">
  <div class="container">
    <div class="row">
                      <div class="col-sm-4 bg-primary rounded-left">
                        <div class="card-block text-center text-white">
                            
                            <img src="<?= session()->get('user')['photo'] ?>" width="120" height="120" class="mt-5" style="border-radius: 50%;" alt="">
                            <h2 class="font-weight-bold mt-4"><?= session()->get('user')['name'] ?></h2>
                            <p class="mt-2 mb-5"><?= session()->get('user')['created_at'] ?></p>
                        </div>
                        </div>
                        <div class="col-sm-8 bg-white rounded-right">
                            <div class="mt-3 text-center">Profile Detail</div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="font-weight-bold">Name</p>
                                    <h6 class="text-muted"><?= session()->get('user')['name'] ?></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="font-weight-bold">Email</p>
                                    <h6 class="text-muted"><?= session()->get('user')['email'] ?></h6>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                            <span style="font-weight: bold;">Description</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque amet repellat explicabo quibusdam recusandae numquam, ratione officiis eius reprehenderit exercitationem itaque esse tenetur, modi suscipit, asperiores ad. Placeat, perspiciatis nihil.</p>
                            </div>
                        </div>
  </div>
  </div></div>
  </div>
  </section>
<footer class="bg-primary text-center text-white">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4 mt-3">
      <!-- Facebook -->
      <a class="btn btn-outline-light m-1" style="border-radius: 50%;" href="#!" role="button"
        ><i class="fa fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light m-1" style="border-radius: 50%;" href="#!" role="button"
        ><i class="fa fa-twitter"></i
      ></a>

      <!-- Google -->
      <a class="btn btn-outline-light m-1" style="border-radius: 50%;" href="#!" role="button"
        ><i class="fa fa-google"></i
      ></a>

      <!-- Instagram -->
      <a class="btn btn-outline-light m-1" style="border-radius: 50%;" href="#!" role="button"
        ><i class="fa fa-instagram"></i
      ></a>

      <!-- Github -->
      <a class="btn btn-outline-light m-1" style="border-radius: 50%;" href="#!" role="button"><i class="fa fa-github"></i></a>
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3 bg-primary">
    © 2021 Copyright. All Right Reserved
  </div>
  <!-- Copyright -->
</footer>
<?= $this->endSection('content') ?>