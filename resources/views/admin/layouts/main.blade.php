
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Radian Admin</title>
    <link href="/assets/home/img/favicon.png" rel="icon">

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/7dc15b25a5.js" crossorigin="anonymous"></script>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        @media (max-width: 480px) {

            .h3{
                font-size: 20px;
            }
            .btn-status{
                width: 50px;
            }
            #accordionSidebar {
              height: 100%;
              width: 0;
              position: fixed;
              z-index: 1;
              top: 0;
              left: 0;
              overflow-x: hidden;
              overflow-y: hidden;
              /*transition: 0.5s;*/
            }
            #btn-toggle {
              /*transition: margin-left .5s;*/
            }
            .search-form{
                width: 160px;
                float: right;
            }
            .index-search, .pagination-table{
                padding-left: 8px;
                padding-right: 8px;
                padding-bottom: 0px;
            }
            .index-search select option {
                font-size: 10px;
            }
            .delete-modal {
                width: 70%;
                margin-left: auto;
                margin-right: auto;
                /* margin-left: 100px; */
            }#deleteModal h5 {
                text-align: center;
                font-size: 15px;
            }
            table thead {
              display: none;
            }

            table tbody {
              display: flex;
              flex-wrap: wrap;
              padding: 4px;
            }

            table tbody tr, table tbody td {
              display: block;
              border: 0px;
            }
            table tbody th{
                padding-left: 2px;
              border-bottom: 0px;
            }

            table tbody td {
              padding: 2px;
              font-weight: bold;
                font-size: 12px;
                padding-left: 20px;
            }

            table tbody td:before {
              content: attr(data-name);
              width: 80px;
              display: inline-block;
              text-transform: capitalize;
              font-weight: normal;
            }

            table tbody td.action {
              position: absolute;
              top: 4px;
              right: 4px;
            }

            table tbody tr {
              position: relative;
              /*width: calc(50% - 8px);*/
              width: 100%;
              border: 1px solid #E7E7E7;
              padding: 8px;
              margin: 4px;
            }
        }
    </style>
    <style>
        body {
          color: rgb(0, 0, 0);
        }
        .search-form{
            width: 160px;
        }
        table {
          width: 100%;
          border-spacing: 0;
          background-color: #FFFFFF;
          font-size: 14px;
        }

        thead th {
          color: #7A7A7A;
          text-align: left;
          background-color: #F9FAFC;
        }

        thead th, tbody td {
          padding: 14px;
          border: 0;
          border-bottom: 1px solid #E7E7E7;
        }
        tbody th{
            padding-left: 14px;
          border-bottom: 1px solid #E7E7E7;
        }

        tbody tr:hover {
          background-color: #F7F9FC;
        }

        td.action {
          text-align: center;
        }
        tbody .action{
            text-align: left;
        }
        tbody .td-center{
            text-align: center;
        }
    </style>
    <style>
        /* width */
      ::-webkit-scrollbar {
        width: 10px;
      }

      /* Track */
      ::-webkit-scrollbar-track {
        background: #f4f6f9; 
      }
       
      /* Handle */
      ::-webkit-scrollbar-thumb {
        background: #888; 
      }

      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
        background: #555; 
      }
    </style>
    @livewireStyles
</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="btn-toggle" onclick="openNav(this)" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle" src="/assets/admin/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Radian Bimbel</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Ya" untuk keluar dari dashboard.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="/assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/assets/admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/assets/admin/js/demo/chart-area-demo.js"></script>
    <script src="/assets/admin/js/demo/chart-pie-demo.js"></script>
    @livewireScripts

    <script>
        var click = false;
          function openNav(el) {
            if (!click) {
              document.getElementById("accordionSidebar").style.width = "100px";
              document.getElementById("btn-toggle").style.marginLeft = "100px";
              click = true;
            } else {
                document.getElementById("accordionSidebar").style.width = "0";
                 document.getElementById("btn-toggle").style.marginLeft= "0";
              click = false;
            }
          }
    </script>
    <script type="text/javascript">
        window.livewire.on('userStore', () => {
            $('#updateModal').modal('hide');
            $('#createModal').modal('hide');
            $('#deleteModal').modal('hide');
        });
    </script>
</body>

</html>