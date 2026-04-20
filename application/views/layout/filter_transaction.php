        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style/select2/select2-bootstrap-5-theme.min.css">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5>Search Data</h5>
                        <button type="reset" class="btn btn-shadow btn-info" id="btnDownload"> <i class="ti ti-download me-1"> </i>Download Report</button>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label class="form-label">Date Range</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pc-date_range_picker-4" placeholder="Select date range">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="area_id">Area Name</label>
                            <select class="form-select" id="area_id">
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="station_id">Station</label>
                            <select class="form-select" id="station_id">
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="card-footer d-flex justify-content-end">
                                <button class="btn btn-shadow btn-info" id="filterDate">Search</button>
                                &nbsp;
                                <button type="reset" class="btn btn-shadow btn-warning" id="btnReset">Reset</button>
                                &nbsp;

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="<?php echo base_url('assets/request/js/filter_transaction.js?v=') . time(); ?>"></script>