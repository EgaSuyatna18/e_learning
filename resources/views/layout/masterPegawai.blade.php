<!DOCTYPE html>
<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/datatables/css/jquery.dataTables.min.css">
</head>
<body class="pb-5">

    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: salmon;">
        <div class="container-fluid">
          <a class="navbar-brand" href="/beranda">E-Learning</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/beranda">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/pegawai/training">Training</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/pegawai/mytraining">My Training</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/pegawai/info">Info</a>
              </li>
            </ul>
            <div class="dropdown ms-auto">
              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/logout">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    
      <div class="container">
        @yield('content')
      </div>

      <footer class="text-center text-lg-start fixed-bottom" style="background-color: salmon;">
        <div class="text-center p-3">
          © 2020 Copyright:
          <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
      </footer>

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
            <p class="text-success">{{ session()->get('notify') }}</p>
          </div>
        </div>
      </div>

    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/jquery/jquery.js"></script>
    <script src="/assets/datatables/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready( function () {
        $('#dt thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#dt thead');
          $('#dt').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function () {
                var api = this.api();
    
                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
    
                        // On every keypress in this input
                        $(
                            'input',
                            $('.filters th').eq($(api.column(colIdx).header()).index())
                        )
                            .off('keyup change')
                            .on('change', function (e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();
    
                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != ''
                                            ? regexr.replace('{search}', '(((' + this.value + ')))')
                                            : '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function (e) {
                                e.stopPropagation();
    
                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
        });
      } );
    </script>

    @if ($errors->any() || session()->has('notify'))
        <script>
            var myAlert =document.getElementById('liveToast');
            var bsAlert = new bootstrap.Toast(myAlert);
            bsAlert.show();
        </script>
        @endif
</body>
</html>