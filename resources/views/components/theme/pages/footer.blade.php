                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan Logout jika ingin keluar</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= frontend("vendor/jquery/jquery.min.js")?>"></script>
    <script src="<?= frontend("vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
    <script src="<?= frontend("summernote/summernote-bs4.js") ?>"></script>
    <script src="<?= frontend("vendor/jquery-easing/jquery.easing.min.js")?>"></script>
    <script src="<?= frontend("js/sb-admin-2.min.js")?>"></script>
    <script src="<?= frontend("vendor/datatables/jquery.dataTables.min.js")?>"></script>
    <script src="<?= frontend("vendor/datatables/dataTables.bootstrap4.min.js")?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('scripts')
    @livewireScripts
    <script>
        $('#dataTable').dataTable().fnDestroy();
        $("#dataTable").dataTable({
            "paging": true,
            "searching": true
        });
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        $(document).ready(function() {
            $('.obat-select').select2();
        });
    </script>
  </body>
</html>
