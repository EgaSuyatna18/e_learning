<!DOCTYPE html>
<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <form action="/login" method="post" class="border border-1 shadow shadow-lg rounded p-4">
            @csrf
            <h1 class="text-center my-4">E-Training</h1>

            <div class="mb-4">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
          
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4 form-control">Login</button>
          
          </form>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <strong class="me-auto">Notifikasi</strong>
            <small>baru saja</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            @foreach ($errors->all() as $message)
                <p class="text-danger">{{ $message }}</p>
            @endforeach
          </div>
        </div>
      </div>

    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    @if ($errors->any())
      <script>
          var myAlert =document.getElementById('liveToast');
          var bsAlert = new bootstrap.Toast(myAlert);
          bsAlert.show();
      </script>
    @endif
</body>
</html>