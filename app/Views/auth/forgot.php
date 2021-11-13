<?= $this->extend('default') ?>

<?= $this->section('title') ?>
    Forgot
<?= $this->endSection('title') ?>
<?= $this->section('content') ?>
<section>

</section>
<section>
  <div class="container-fluid mt-5">
  <div class="text-center display-6" style="font-weight: bold;">Forgot</div>
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="<?= base_url('images/forgot.svg')?>" class="img-fluid"
          alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form class="mt-5" action="<?= base_url('forgot')?>" method="POST">
          <!-- Email input -->
          <?= csrf_field()?>
          
          <?php if(!empty(session()->getFlashdata('notFound'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('notFound') ?></div>
          <?php endif; ?>
          <div class="form-outline mb-4">
          <span class="text-danger"><?= isset($validation) && $validation->hasError('email') ? $validation->getError('email') : '' ?></span>
            <input type="email" id="form3Example3" class="form-control form-control-lg mb-2"
              placeholder="Enter a valid email address" name="email" />
            <label class="form-label" for="form3Example3">Email address</label>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Send</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="/login"
                class="link-danger">Login</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>

  <footer class="bg-primary mt-5 text-center text-white">
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